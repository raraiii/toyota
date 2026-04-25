<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SendOTPNotification extends Notification
{
    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable) { return ['mail']; }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('KODE VERIFIKASI TOYOTA')
            ->greeting('Halo Pengguna!')
            ->line('Berikut adalah kode OTP Anda untuk verifikasi registrasi:')
            ->line('**' . $this->otp . '**')
            ->line('Gunakan kode ini sebelum 10 menit untuk menyelesaikan pendaftaran.')
            ->line('Terima kasih!');
    }
}