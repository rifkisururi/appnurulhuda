<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\tagihan_master_model;

class tagihanMasterController extends Controller
{
    public function index()
    {
        $tagihan_master = DB::select(
            "
        select 
            tm.id, tm.name , tm.jumlah, tm.keterangan  , COUNT(td.id_tagihan_master) as used
        from 
            tagihan_master tm
            left join tagihan_detail td on td.id_tagihan_master = tm.id 
        group by tm.id, tm.name , tm.jumlah, tm.keterangan  "
        );



        return view('admin.tagihanMaster.index', [
            'tagihan_master' => $tagihan_master,
        ]);
    }

    public function store(Request $request)
    {
        $add = new tagihan_master_model;
        $add->name = $request->name;
        $add->keterangan = $request->keterangan;
        $add->jumlah = $request->jumlah;
        $add->save();

        return redirect('tagihanMaster');
    }

    public function destroy($id)
    {
        $akun = tagihan_master_model::findOrFail($id);
        $akun->delete();
        return redirect('tagihanMaster');
    }
}
