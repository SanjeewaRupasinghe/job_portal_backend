<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendEmailJob;
use App\Mail\WelcomeMail;

class EmailService
{
    /**
     * Send email immediately
     *
     * @param string $mailable
     * @param array $data
     * @param string|array $to
     * @return bool
     */
    public function send(string $mailable, array $data, $to): bool
    {
        try {
            Mail::to($to)->send(new $mailable($data));

            Log::info('Email sent successfully', [
                'mailable' => $mailable,
                'recipient' => is_array($to) ? implode(', ', $to) : $to,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Email sending failed', [
                'mailable' => $mailable,
                'recipient' => is_array($to) ? implode(', ', $to) : $to,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return false;
        }
    }

    /**
     * Queue email for sending
     *
     * @param string $mailable
     * @param array $data
     * @param string|array $to
     * @param string|null $queue
     * @param int $delay
     * @return void
     */
    public function queue(
        string $mailable,
        array $data,
        $to,
        ?string $queue = 'emails',
        int $delay = 0
    ): void {
        $job = new SendEmailJob($mailable, $data, $to);

        $job->onQueue($queue);

        if ($delay > 0) {
            dispatch($job)->delay(now()->addSeconds($delay));
        } else {
            dispatch($job);
        }

        Log::info('Email queued successfully', [
            'mailable' => $mailable,
            'recipient' => is_array($to) ? implode(', ', $to) : $to,
            'queue' => $queue,
            'delay' => $delay,
        ]);
    }

    /**
     * Send welcome email
     *
     * @param object $user
     * @return void
     */
    public function sendWelcomeEmail($user): void
    {
        $this->queue(
           WelcomeMail::class,
            [
                'name' => $user->name,
                'email' => $user->email,
                'userId' => $user->id,
            ],
            $user->email
        );
    }

    /**
     * Send email to multiple recipients
     *
     * @param string $mailable
     * @param array $data
     * @param array $recipients
     * @param bool $useQueue
     * @return void
     */
    public function sendBulk(
        string $mailable,
        array $data,
        array $recipients,
        bool $useQueue = true
    ): void {
        foreach ($recipients as $recipient) {
            if ($useQueue) {
                $this->queue($mailable, $data, $recipient);
            } else {
                $this->send($mailable, $data, $recipient);
            }
        }
    }

    /**
     * Send with CC and BCC
     *
     * @param string $mailable
     * @param array $data
     * @param string|array $to
     * @param array $cc
     * @param array $bcc
     * @return bool
     */
    public function sendWithCopies(
        string $mailable,
        array $data,
        $to,
        array $cc = [],
        array $bcc = []
    ): bool {
        try {
            $mail = Mail::to($to);

            if (!empty($cc)) {
                $mail->cc($cc);
            }

            if (!empty($bcc)) {
                $mail->bcc($bcc);
            }

            $mail->send(new $mailable($data));

            Log::info('Email with copies sent successfully', [
                'mailable' => $mailable,
                'recipient' => $to,
                'cc' => $cc,
                'bcc' => $bcc,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Email with copies failed', [
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
