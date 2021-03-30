<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoucherGeneratedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $comment;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
            ->subject("WiDe - Voucher siap di download")
            ->greeting("Hi!")
            ->line('Vouchermu sudah siap diunduh.')
            ->action('Klik di sini untuk mengunduh vouchermu', url('/voucher/print/?comment=' . $this->comment))
            ->line('Terimakasih!');

        $mail->cc('didik@wide.co.id');

        return $mail;
    }
}
