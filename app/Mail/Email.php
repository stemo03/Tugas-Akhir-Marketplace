<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TransactionDetail;

class Email extends Mailable
{
    use Queueable, SerializesModels;

     public $transactiondetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TransactionDetail $transactiondetail)
    {
        $this->transactiondetail = $transactiondetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('stevitarigan21@gmail.com', 'DANA DICAIRKAN')
                    ->subject('EMAIL')->view('pages.mail');
    }
}
