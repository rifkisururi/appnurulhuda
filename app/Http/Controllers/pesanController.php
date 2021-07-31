<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\jobs\ProcessSendNotifikasi;

class pesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $santri = DB::table('users')->get();
        $yayasan = DB::table('yayasan')->get();
        $SENDER_EMAIL = env("SENDER_EMAIL");
        $SENDER_WA = env("SENDER_WA");

        return view('pesan.kirimPesan', [
            'santri' => $santri,
            'yayasan' => $yayasan,
            'SENDER_WA' => $SENDER_WA,
            'SENDER_EMAIL' => $SENDER_EMAIL
        ]);
    }

    public function kirimPesan(Request $request)
    {
        $isiPesan = $request->isiPesan;
        $media = $request->media;
        $yayasan = $request->yayasan;

        if ($media == "email") {
            $sender = env("SENDER_EMAIL");

            $type = 1;
        } else if ($media == "whatsapp") {
            $sender = env("SENDER_WA");
            $isiPesan = $s = str_replace("\n", '<br>', $isiPesan);
            $type = 0;
        }


        if ($yayasan == 0) {
            $idUser = DB::table('users')->select('id')->get();
        } else if ($yayasan == -1) {
            $idUser =  $request->id_user;
        } else {
            // berdasarkan yayasan
            $idUser = DB::table('users')->select('id')->where('id_yayasan', '=', $yayasan)->get();
        }

        $data['type'] = $type;
        $data['sender'] = $sender;


        foreach ($idUser as $user) {
            if ($yayasan >= 0) {
                $user = $user->id;
            }

            $no_hp1 =
                DB::table('users')
                ->where('id', '=', $user)
                ->value('no_hp1');

            $no_hp2 =
                DB::table('users')
                ->where('id', '=', $user)
                ->value('no_hp2');

            $nama =
                DB::table('users')
                ->where('id', '=', $user)
                ->value('name');


            $isiPesan = preg_replace("/\r\n|\r|\n/", '', str_replace('$nama', $nama, $isiPesan));

            $data['isiPesan'] = $isiPesan;
            //$data['isiPesan']  = str_replace('$nama', $nama, $isiPesan);
            //echo str_replace('$nama', $nama, $isiPesan);

            if ($no_hp1 != "0" || $no_hp1 != null) {
                $data['dest'] = $no_hp1;
                dispatch(new ProcessSendNotifikasi($data));
            }
            if (($no_hp2 != "0" || $no_hp2 != null) && $no_hp1 != $no_hp2) {
                $data['dest'] = $no_hp2;
                dispatch(new ProcessSendNotifikasi($data));
            }
        }

        echo "<script>alert('Pesan telah masuk antrian pengiriman, silahkan cek pengirim yang digunakan');</script>";
        echo "<script>window.location.href = '';</script>";
    }
}
