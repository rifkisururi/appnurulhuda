<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSendNotifikasi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $type =  $this->data['type'];

        if ($type == 0) {
            $sender = env("SENDER_WA");
            $LINK_SENDER = env("LINK_SENDER") . "/sendWA2";
        } else if ($type == 1) {
            $sender = env("SENDER_EMAIL");
            $LINK_SENDER = env("LINK_SENDER") . "/sendEmail";
        }

        $dest = $this->data['dest'];
        $isiPesan = $this->data['isiPesan'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $LINK_SENDER,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('dest' => $dest, 'isiPesan' => $isiPesan, 'sender' => $sender),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
}
