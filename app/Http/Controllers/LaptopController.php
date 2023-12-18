<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;

class LaptopController extends Controller
{
    public function ViewLaptop(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $data = \DB::select("SELECT * FROM laptops");
        $data_operator = \DB::select("SELECT * FROM operators");

        return view('admin.laptop.data', [
            'data_laptop' => $data,
            'data_operator' => $data_operator
        ]);
    }

    public function AddLaptop(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }
        Alert::success('Berhasil Menambah Laptop');
        \DB::insert("INSERT INTO laptops VALUES (null, '$r->nama_laptop','$r->price','Ready','',null)");
        return redirect(route('admin.home.laptop'));
    }

    public function DeleteLaptop(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }
        Alert::success('Laptop Berhasil Dihapus');
        \DB::delete("DELETE FROM laptops WHERE id = $id");
        return redirect(route('admin.home.laptop'));
    }

    public function EditLaptop(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $data = \DB::select("SELECT * FROM laptops WHERE id = '$id'");
        if (count($data) === 0) {
            return redirect(route('admin.home.laptop'));
        }
        return view('admin.laptop.edit', [
            'data' => $data[0]
        ]);
    }

    public function UpdateLaptop(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }
        if ($r->id_operator === NULL) {
            Alert::success('Data Berhasil Diubah');
            \DB::update("UPDATE laptops SET nama_laptop='$r->nama_laptop', price='$r->price', status='$r->status', note='$r->note', id_operator = NULL WHERE id='$r->id'");
            return redirect(route('admin.home.laptop'));
        }
        Alert::success('Data Berhasil Diubah');
        \DB::update("UPDATE laptops SET nama_laptop='$r->nama_laptop', price='$r->price', status='$r->status', note='$r->note', id_operator = '$r->id_operator' WHERE id='$r->id'");
        return redirect(route('admin.home.laptop'));

    }

    public function ViewLaptopOperator(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'operator') {
            return redirect(route('operator.login.view'));
        }

        $id_operator = $r->session()->get('id');

        $data_laptop = \DB::select("SELECT * FROM laptops");
        $data_laptop_available = \DB::select("SELECT * FROM laptops WHERE id_operator IS NULL");
        $data_laptop_process = \DB::select("SELECT * FROM laptops WHERE id_operator = $id_operator");

        return view('operator.laptop.data', [
            'data_laptop' => $data_laptop,
            'data_laptop_available' => $data_laptop_available,
            'data_laptop_process' => $data_laptop_process
        ]);
    }

    public function AddLaptopOperator(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'operator') {
            return redirect(route('operator.login.view'));
        }
        Alert::success('Laptop Siap Untuk Diperiksa');
        $id_operator = $r->session()->get('id');
        \DB::update("UPDATE laptops SET id_operator = '$id_operator' WHERE id='$id'");
        return redirect(route('operator.home.laptop'));
    }

    public function EditLaptopOperator(Request $r, $id)
    {
        $role_check = $r->session()->get('role');
        if (!$r->session()->has('email') || $role_check !== 'operator') {
            return redirect(route('operator.login.view'));
        }

        $data = \DB::select("SELECT * FROM laptops WHERE id = '$id'");
        if (count($data) === 0) {
            return redirect(route('operator.home.laptop'));
        }
        return view('operator.laptop.edit', [
            'data' => $data[0]
        ]);
    }

    public function UpdateLaptopOperator(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'operator') {
            return redirect(route('operator.login.view'));
        }

        if ($r->status === 'Ready') {
            Alert::success('Laptop Siap Dipakai');
            \DB::update("UPDATE laptops SET nama_laptop='$r->nama_laptop', price='$r->price', status='$r->status', note='$r->note', id_operator = NULL WHERE id='$r->id'");
            return redirect(route('operator.home.laptop'));
        }
        \DB::update("UPDATE laptops SET nama_laptop='$r->nama_laptop', price='$r->price', status='$r->status', note='$r->note', id_operator = '$r->id_operator' WHERE id='$r->id'");
        return redirect(route('operator.home.laptop'));
    }

}
