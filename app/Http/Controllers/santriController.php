<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class santriController extends Controller
{
    public function index()
    {
        $santri = DB::table('users')->get();
        return view('admin.santri.index', ['santri' => $santri]);
    }

    public function store(Request $request)
    {
        $add = new User;
        $add->name = $request->name;
        $add->email = $request->email;
        $add->password = $request->no_hp1;
        $add->no_hp1 = $request->no_hp1;
        $add->no_hp2 = $request->no_hp2;
        $add->password = Hash::make('password');
        $add->save();

        $add->assignRole('santri');

        return redirect('santri');
    }
}
