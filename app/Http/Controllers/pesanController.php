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
        $SENDER_EMAIL = env("SENDER_EMAIL");
        $SENDER_WA = env("SENDER_WA");

        return view('pesan.kirimPesan', [
            'santri' => $santri,
            'SENDER_WA' => $SENDER_WA,
            'SENDER_EMAIL' => $SENDER_EMAIL
        ]);
    }

    public function kirimPesan(Request $request)
    {
        if ($request->media == "email") {
            $data['sender'] = env("SENDER_EMAIL");
            $data['type'] = 1;
        } else if ($request->media == "whatsapp") {
            $data['sender'] = env("SENDER_WA");
            $data['type'] = 0;
        }

        $isiPesan = $request->isiPesan;

        $id =  $request->id_user;
        foreach ($id as $user) {

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

            $data['isiPesan'] = str_replace('$nama', $nama, $isiPesan);
            if ($no_hp1 != "0" || $no_hp1 != null) {
                $data['dest'] = $no_hp1;
                dispatch(new ProcessSendNotifikasi($data));
            }

            if (($no_hp2 != "0" || $no_hp2 != null) && $no_hp1 != $no_hp2) {
                $data['dest'] = $no_hp2;
                dispatch(new ProcessSendNotifikasi($data));
            }
        }
    }
}
