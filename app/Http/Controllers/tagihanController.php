<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\tagihan_detail_model;

class tagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tagihan =
            DB::table('tagihan_detail')
            ->join('tagihan_master', 'tagihan_master.id', '=', 'tagihan_detail.id_tagihan_master')
            ->join('users', 'users.id', '=', 'tagihan_detail.id_user')
            ->select('tagihan_master.name', 'tagihan_detail.jumlah', 'users.name as nama_santri', 'tagihan_detail.flag_pay', 'tagihan_detail.id', 'tagihan_detail.jatuh_tempo', 'tagihan_detail.tanggal_bayar')
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
        //->get();

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
        if($action == 1){
            $data->tanggal_bayar = date('Y-m-d');
        }else{
            $data->tanggal_bayar = '2021-01-01';
        }

        $data->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
