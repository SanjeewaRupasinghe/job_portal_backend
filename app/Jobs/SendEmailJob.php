<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = 60;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * Mailable class name
     *
     * @var string
     */
    protected $mailable;

    /**
     * Email data
     *
     * @var array
     */
    protected $data;

    /**
     * Recipient email
     *
     * @var string|array
     */
    protected $to;

    /**
     * Create a new job instance.
     */
    public function __construct(string $mailable, array $data, $to)
    {
        $this->mailable = $mailable;
        $this->data = $data;
        $this->to = $to;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->to)->send(new $this->mailable($this->data));

            Log::info('Queue email sent successfully', [
                'mailable' => $this->mailable,
                'recipient' => is_array($this->to) ? implode(', ', $this->to) : $this->to,
            ]);
        } catch (\Exception $e) {
            Log::error('Queue email failed', [
                'mailable' => $this->mailable,
                'recipient' => is_array($this->to) ? implode(', ', $this->to) : $this->to,
                'error' => $e->getMessage(),
                'attempt' => $this->attempts(),
            ]);

            // Re-throw to trigger retry mechanism
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::critical('Email job failed after all retries', [
            'mailable' => $this->mailable,
            'recipient' => is_array($this->to) ? implode(', ', $this->to) : $this->to,
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts(),
        ]);
    }
}
