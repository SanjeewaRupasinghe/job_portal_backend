@extends('emails.layouts.email-layout')

@section('title', 'Welcome to Job to Apply')

@section('content')
    <h1 class="greeting">Welcome, {{ $name }}! 🎉</h1>

    <p class="text">
        Thank you for joining <strong>Job to Apply</strong> - your gateway to finding the perfect career opportunity.
        We're thrilled to have you as part of our growing community of job seekers and professionals.
    </p>

    <p class="text">
        Your account has been successfully created with the email: <strong>{{ $email }}</strong>
    </p>

    <div class="success-box">
        <strong>🎯 Your account is now active!</strong><br>
        You can start exploring thousands of job opportunities right away.
    </div>

    <div class="button-container">
        <a href="{{ config('app.url') }}/jobs" class="button-primary">Browse Jobs</a>
    </div>

    <div class="divider"></div>

    <h2 style="color: #0d2266; font-size: 20px; margin-bottom: 20px;">What You Can Do Now:</h2>

    <div class="list-container">
        <div class="list-item">
            <div class="list-item-title">📝 Complete Your Profile</div>
            <div class="list-item-description">
                Add your experience, skills, and resume to stand out to employers
            </div>
        </div>

        <div class="list-item">
            <div class="list-item-title">🔍 Search for Jobs</div>
            <div class="list-item-description">
                Browse thousands of job listings tailored to your preferences
            </div>
        </div>

        <div class="list-item">
            <div class="list-item-title">🔔 Set Job Alerts</div>
            <div class="list-item-description">
                Get notified when new jobs matching your criteria are posted
            </div>
        </div>

        <div class="list-item">
            <div class="list-item-title">💼 Apply with One Click</div>
            <div class="list-item-description">
                Save time by applying to multiple jobs with your saved profile
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <div class="info-box">
        <strong>💡 Pro Tip:</strong> Complete your profile within the next 24 hours to increase your visibility to employers by 3x!
    </div>

    <div class="button-container">
        <a href="{{ config('app.url') }}/profile/edit" class="button-secondary">Complete Profile</a>
        <a href="{{ config('app.url') }}/dashboard" class="button-outline" style="margin-left: 10px;">Go to Dashboard</a>
    </div>

    <div class="divider"></div>

    <p class="text">
        If you have any questions or need assistance, our support team is always here to help.
    </p>

    <p class="text">
        <strong>Happy Job Hunting!</strong><br>
        The Job to Apply Team
    </p>
@endsection
