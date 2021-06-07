<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\yayasan_model;
use Illuminate\Support\Facades\DB;

class yayasan_controller extends Controller
{
    public function index()
    {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $data = yayasan_model::findOrFail($id);
            $data->delete();
            return redirect('');
        } else {

            $yayasan = DB::select("
                select y.id, y.status, y.nama, count(s.id) as jumlah from yayasan y
                inner join users s on y.id = s.id_yayasan
                group by y.id, y.status, y.nama
            ");
            return view('admin.yayasan.index', ['yayasan' => $yayasan]);
        }
    }

    public function store(Request $request)
    {
        $add = new yayasan_model;
        $add->nama = $request->nama;

        $add->save();

        return redirect('');
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $data = yayasan_model::findOrFail($id);
        $data->nama = $request->nama;
        $data->save();

        return redirect('');
    }
}
