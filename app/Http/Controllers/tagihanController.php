<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\tagihan_detail_model;

class tagihanController extends Controller
{
    public function index()
    {
        $tagihan =
            DB::table('tagihan_detail')
            ->join('tagihan_master', 'tagihan_master.id', '=', 'tagihan_detail.id_tagihan_master')
            ->join('users', 'users.id', '=', 'tagihan_detail.id_user')
            ->join('yayasan', 'yayasan.id', '=', 'users.id_yayasan')
            ->select('tagihan_master.name', 'yayasan.nama as namaYayasan', 'tagihan_detail.jumlah', 'users.name as nama_santri', 'tagihan_detail.flag_pay', 'tagihan_detail.id', 'tagihan_detail.jatuh_tempo', 'tagihan_detail.tanggal_bayar')
            ->get();

        $santri = DB::table('users')->get();
        $tagihan_master = DB::table('tagihan_master')->get();

        return view('admin.tagihan.index', [
            'tagihan' => $tagihan,
            'santri' => $santri,
            'tagihan_master' => $tagihan_master,
        ]);
    }

    public function nominal_tagihan($id)
    {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');

        $jml_tagihan =
            DB::table('tagihan_master')
            ->where('id', '=', $id)
            //->select('jumlah')
            ->value('jumlah');


        $data = array(
            'jumlah' => $jml_tagihan
        );

        return response([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function action(Request $request)
    {
        $id = $_GET['id'];
        $action = $_GET['action'];

        $data = tagihan_detail_model::findOrFail($id);

        $data->flag_pay = $action;
        if ($action == 1) {
            $data->tanggal_bayar = date('Y-m-d');
        } else {
            $data->tanggal_bayar = '2021-01-01';
        }

        $data->save();
    }

    public function vw_tagihanPerSantri()
    {
        $id = $_GET['id'];

        if (isset($_GET['bulan'])) {
            $bulan = $_GET['bulan'];
        } else {
            $bulan = 0;
        }

        if (isset($_GET['tahun'])) {
            $tahun = $_GET['tahun'];
        } else {
            $tahun = 0;
        }

        $tagihan = $this->tagihanPerSantri($id, $bulan, $tahun);

        $namaSantri =
            DB::table('users')
            ->where('id', '=', $id)
            ->value('name');

        return view('admin.tagihan.persantri', [
            'tagihan' => $tagihan,
            'namaSantri' => $namaSantri
        ]);
    }

    public function vw_tagihan($password)
    {
        $id = $_GET['id'];

        $tagihan = $this->tagihanPerSantri($id, $bulan, $tahun);

        $namaSantri =
            DB::table('users')
            ->where('id', '=', $id)
            ->value('name');

        return view('admin.tagihan.persantri', [
            'tagihan' => $tagihan,
            'namaSantri' => $namaSantri
        ]);
    }


    public function store(Request $request)
    {
        $add = new tagihan_detail_model;
        $add->id_user = $request->id_user;
        $add->id_tagihan_master = $request->id_tagihan_master;
        $add->jumlah = $request->jumlah;
        $add->jatuh_tempo = $request->jatuhtempo;
        $add->id_user_confirm = 0;
        $add->tanggal_bayar = '2021-01-01';
        $add->flag_pay = 0;
        $add->created_by = 0;

        $add->save();

        $no_hp1 =
            DB::table('users')
            ->where('id', '=', $request->id_user)
            ->value('no_hp1');

        $no_hp2 =
            DB::table('users')
            ->where('id', '=', $request->id_user)
            ->value('no_hp2');

        $name =
            DB::table('users')
            ->where('id', '=', $request->id_user)
            ->value('name');

        $nameTagihan =
            DB::table('tagihan_master')
            ->where('id', '=', $request->id_tagihan_master)
            ->value('name');

        $kata = "Assalamu'alaikum Bpk/Ibu $name,<br>Terdapat Iuran $nameTagihan sejumlah $request->jumlah jatuh tempo pada $request->jatuhtempo<br> Mohon kerjasamnanya membayar tepat waktu.<br><br>Matur suwun";

        $this->sendWA($no_hp1, $kata);
        $this->sendWA($no_hp2, $kata);

        return redirect('tagihan');
    }


    // backend 
    private function tagihanPerSantri($id, $bulan, $tahun)
    {
        if ($bulan == 0 || $tahun == 0) {

            $tagihan =
                DB::table('tagihan_detail')
                ->join('tagihan_master', 'tagihan_master.id', '=', 'tagihan_detail.id_tagihan_master')
                ->where('tagihan_detail.id_user', '=', $id)
                ->where('tagihan_detail.flag_pay', '=', 0)
                ->select('tagihan_master.name', 'tagihan_detail.jumlah', 'tagihan_detail.flag_pay', 'tagihan_detail.id', 'tagihan_detail.jatuh_tempo', 'tagihan_detail.tanggal_bayar')
                ->get();
        } else {

            $query = "
                select 
                    td.id, td.jumlah, td.jatuh_tempo, tm.name
                from 
                    tagihan_detail td
                    inner join tagihan_master tm on td.id_tagihan_master = tm.id
                where year(td.jatuh_tempo) = " . $tahun . " and month(td.jatuh_tempo) = " . $bulan . " and flag_pay = 0 and td.id_user = " . $id . "
                ";
            $tagihan = $this->execQuery($query);
        }

        return $tagihan;
    }

    public function json_tagihanPerSantri($id, $bulan, $tahun)
    {
        if ($bulan == 0 || $tahun == 0) {

            $tagihan =
                DB::table('tagihan_detail')
                ->join('tagihan_master', 'tagihan_master.id', '=', 'tagihan_detail.id_tagihan_master')
                ->where('tagihan_detail.id_user', '=', $id)
                ->where('tagihan_detail.flag_pay', '=', 0)
                ->select('tagihan_master.name', 'tagihan_detail.jumlah', 'tagihan_detail.flag_pay', 'tagihan_detail.id', 'tagihan_detail.jatuh_tempo', 'tagihan_detail.tanggal_bayar')
                ->get();
        } else {

            $query = "
                select 
                    td.id, td.jumlah, td.jatuh_tempo, tm.name
                from 
                    tagihan_detail td
                    inner join tagihan_master tm on td.id_tagihan_master = tm.id
                where year(td.jatuh_tempo) = " . $tahun . " and month(td.jatuh_tempo) = " . $bulan . " and flag_pay = 0 and td.id_user = " . $id . "
                ";

            $tagihan = $this->execQuery($query);
        }

        return response()->json($tagihan);
    }

    private function execQuery($query)
    {
        // echo $query;
        $output = DB::select($query);
        return $output;
    }

    public function kirimPesan()
    {
        $this->sendWA('62895401665951', 'ini adalah sebuat test, mohon abaikan aja<br>Tagihan Sahriah 10.000 jatuh tempo 2021-06-10 <br>Matur suwun');
        $this->sendWA('6289691965577', 'ini adalah sebuat test, mohon abaikan aja<br>Tagihan Sahriah 10.000 jatuh tempo 2021-06-10 <br>Matur suwun');
    }

    private function sendWA($d, $isiPesan)
    {
        $sender = env("SENDER_WA");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://whapi.io/api/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"app\": {\r\n    \"id\": \"$sender\",\r\n    \"time\": \"1605326773\",\r\n    \"data\": {\r\n      \"recipient\": {\r\n        \"id\": \"$d\"\r\n      },\r\n      \"message\": [\r\n        {\r\n          \"time\": \"1605326773\",\r\n          \"type\": \"text\",\r\n          \"value\": \"$isiPesan\"\r\n        }\r\n      ]\r\n    }\r\n  }\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "Cookie: __cfduid=d424776e2d5021b158f1e64c99f2d7fce1604293254; ci_session=3b712ap59vc924a9o15j5rti70gif6k0"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
}
