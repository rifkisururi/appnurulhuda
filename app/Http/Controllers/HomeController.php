<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->count();
        $yayasan = DB::table('yayasan')->count();
        $persenPembayaran = DB::table('yayasan')->count();

        $query = "select (select COUNT(*) from tagihan_detail td where flag_pay = 1)/(select COUNT(*) from tagihan_detail) * 100 as persen";
        $persenPembayaran = DB::select($query)[0]->persen;

        $menungguPembayaran = DB::table('tagihan_detail')->where('flag_pay', '=', 0)->count();

        return view('home', [
            'jumlahSantri' => $users,
            'yayasan' => $yayasan,
            'persenPembayaran' => intval($persenPembayaran),
            'menungguPembayaran' => $menungguPembayaran,
        ]);
    }
}
