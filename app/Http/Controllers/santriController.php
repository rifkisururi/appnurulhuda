<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class santriController extends Controller
{
    public function index()
    {
        $santri = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.*', 'model_has_roles.role_id', 'roles.name as hakAkses')
            ->get();

        $roles = Role::pluck('name', 'name')->all();

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

    public function personalInfo()
    {

        $id = Auth::user()->id;
        $santri = DB::table('users')->where('id', '=', $id)->first();

        return view('santri.personalinfo', [
            'data' => $santri
        ]);
    }

    public function personalInfoUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->get('nama');
        $user->no_hp1 = $request->get('no_hp1');
        $user->no_hp2 = $request->get('no_hp2');
        $user->email = $request->get('email');
        if ($request->get('passwordBaru') != "" && $request->get('passwordBaru') == $request->get('passwordBaru2')) {
            $user->password = Hash::make($request->get('passwordBaru'));
        }
        $user->save();

        return redirect('/personalinfo');
    }

    public function ubahAkses($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('admin.santri.editAkses', compact('user', 'roles', 'userRole'));
    }

    public function updateAkses(Request $request, $id)
    {
        $user = User::find($id);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('role'));
        return redirect('/santri');
    }
}
