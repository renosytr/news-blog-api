<?php

namespace App\Providers;

// use Illuminate\Auth\Notifications\ResetPassword;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
        //     return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        // });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $verification = config('app.frontend_url') . "/email/email_verify_url=" . $url;

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('You got this email because you have not yet verify your email address registered in our website. Click the button below to verify your email address.')
                ->action("Verify it's me!", $verification);
        });
    }
}
