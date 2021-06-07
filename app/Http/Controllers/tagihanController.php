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
}
