<?php

namespace App\Notifications;

use App\Models\Voucher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

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
        $this->comment  = $comment;
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
        $data = Voucher::where('comment', $this->comment)->get();

        $summary = "
            -------------------------------------------
            Site         : WIDE1-Pintas
            Profile      : {$data[0]->profile}
            Validity     : {$data[0]->validity}
            Qty          : " . count($data) . "
            Price        : " . number_format($data[0]->price) . "
            Seller Price : " . number_format($data[0]->seller_price) . "
            Total        : " . number_format(count($data) * $data[0]->seller_price) . "
            -------------------------------------------
        ";

        $mail = (new MailMessage)
            ->subject("WiDe - Voucher {$this->comment} siap diunduh")
            ->greeting("Hi!")
            ->line('Vouchermu sudah siap diunduh.')
            ->line(new HtmlString($summary))
            ->action('Klik di sini untuk mengunduh vouchermu', url('/voucher/print/?comment=' . $this->comment))
            ->line('Terimakasih!');

        $mail->cc('udibagas@wide.co.id');
        $mail->cc('voucher@wide.co.id');

        return $mail;
    }
}
