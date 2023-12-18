<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
class UserController extends Controller
{
    public function ViewAdminUser(Request $r) {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin' ) {
            return redirect(route('admin.login.view'));
        }
        $data = \DB::select("SELECT * FROM users");

        return view('admin.user.data', [
            'data_user' => $data
        ]);
    }

    public function EditUser(Request $r, $id) {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin' ) {
            return redirect(route('admin.login.view'));
        }

        $data = \DB::select("SELECT * FROM users WHERE id = '$id'");
        if (count($data) === 0) {
            return redirect(route('admin.home.user'));
        }
        return view('admin.user.edit', [
            'data' => $data[0]
        ]);
    }

    public function UpdateUser(Request $r) {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin' ) {
            return redirect(route('admin.login.view'));
        }
        Alert::success('Data Berhasil Diubah');
        \DB::update("UPDATE users SET email='$r->email', phone='$r->phone', nama_user='$r->nama_user', password='$r->password' WHERE id='$r->id'");
        return redirect(route('admin.home.user'));
    }



    public function DeleteUser(Request $r,$id){
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin' ) {
            return redirect(route('admin.login.view'));
        }
        Alert::success('User Berhasil Dihapus');
        \DB::delete("DELETE FROM users WHERE id = $id");
        return redirect(route('admin.home.user'));
    }
}
