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
            Site         : {$data[0]->site}
            Profile      : {$data[0]->profile}
            Validity     : {$data[0]->validity}
            Qty          : " . count($data) . "
            Price        : Rp " . number_format($data[0]->price) . "
            Seller Price : Rp " . number_format($data[0]->seller_price) . "
            Total        : Rp " . number_format(count($data) * $data[0]->seller_price) . "
            -------------------------------------------

            Silakan transfer ke

            Bank                : BRI
            Atas Nama           : PT CATURDAYA MITRA MANDIRI
            Nomor Rekening      : 1170 0100 0310 562
            Jumlah              : Rp. " . number_format(count($data) * $data[0]->seller_price) . "
            Konfirmasi via WA   : 0858 4890 9262 (Bagas)
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
        $mail->cc('arifin@cdmm.co.id');
        $mail->cc('ade.wijaya@cdmm.co.id');
        $mail->cc('tono.triwibowo@cdmm.co.id');

        return $mail;
    }
}
