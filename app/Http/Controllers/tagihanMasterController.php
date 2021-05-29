<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class tagihanMasterController extends Controller
{
    public function index()
    {
        $tagihan_master = DB::table('tagihan_master')->get();

        return view('admin.tagihanMaster.index', [
            'tagihan_master' => $tagihan_master,
        ]);
    }
}
