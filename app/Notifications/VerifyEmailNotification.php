<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */

     public function toMail($notifiable)
     {
        $url = url("/verify-email/{$notifiable->verification_token}");

         return (new MailMessage)
             ->subject('Verifikasi Alamat Email Anda')
             ->greeting('Hai!')
             ->line('Terima kasih telah menggunakan sistem informasi kami.')
             ->action('Verifikasi Alamat Email', $url)
             ->line('Jika Anda mengalami kesulitan klik tombol "Verifikasi Alamat Email", salin dan tempel URL berikut di browser web Anda:')
             ->line($url)
             ->line('Salam,')
             ->line('Penjadwalan & Peminjaman');
     }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
