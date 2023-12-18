<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;

class OrderController extends Controller
{
    public function ViewOrder(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }
        $data = \DB::select("SELECT * FROM laptops WHERE status = 'Ready'");

        return view('user.order', [
            'data_laptop' => $data
        ]);
    }

    public function ProceedOrder(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }
        if ($r->id_laptop === NULL) {
            Alert::warning('Pemesanan Gagal', 'Silahkan periksa kembali pesanan anda');
            return redirect(route('user.order'));
        }
        \DB::insert("INSERT INTO orders VALUES (null, '$r->id_user','$r->city','$r->zip','$r->address','$r->id_laptop','$r->duration','$r->totprice','$r->pickupdate','Pending')");
        \DB::update("UPDATE laptops SET status='Pending' WHERE id='$r->id_laptop'");
        $data = \DB::select("SELECT * FROM orders ORDER BY id DESC LIMIT 1");
        $data_laptop = \DB::select("SELECT * FROM laptops WHERE id = '$r->id_laptop'");
        $email = session()->get('email');
        session([
            'id' => $data[0]->id,
            'city' => $data[0]->city,
            'zip' => $data[0]->zip,
            'address' => $data[0]->address,
            'nama_laptop' => $data_laptop[0]->nama_laptop,
            'price' => $data_laptop[0]->price,
            'duration' => $data[0]->duration,
            'totprice' => $data[0]->totprice,
            'pickupdate' => $data[0]->pickupdate,
        ]);
        Alert::success('Pemesanan Sukses', 'Silahkan periksa email anda untuk langkah selanjutnya' . ', Email :' . $email);
        return redirect(route('user.home'));
    }

    public function ViewHistory(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }

        $email = $r->session()->get('email');

        // Check if the email parameter is provided
        if ($email) {
            $data = \DB::select("SELECT * FROM vorders WHERE email = '$email'");
        } else {
            // If no email parameter is provided, retrieve all orders
            $data = \DB::select("SELECT * FROM vorders");
        }

        return view('user.history', [
            'data_order' => $data
        ]);
    }

    public function ViewAdminOrder(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }
        $data = \DB::select("SELECT * FROM vorders");

        return view('admin.order.data', [
            'data_order' => $data
        ]);
    }

    public function EditOrder(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $data_vorders = \DB::select("SELECT * FROM vorders WHERE id = '$id'");
        $data_orders = \DB::select("SELECT * FROM orders WHERE id = '$id'");


        if (count($data_vorders) === 0) {
            return redirect(route('admin.home'));
        }
        return view('admin.order.edit', [
            'data' => $data_vorders[0],
            'data_orders' => $data_orders[0]
        ]);
    }

    public function UpdateOrder(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        if ($r->status === 'On Process') {
            Alert::success('Data Berhasil Diubah');
            \DB::update("UPDATE orders SET status ='$r->status' WHERE id='$r->id'");
            \DB::update("UPDATE laptops SET status='On Process' WHERE id='$r->id_laptop'");
            return redirect(route('admin.home.order'));
        }

        if ($r->status === 'Finished') {
            Alert::success('Data Berhasil Diubah');
            \DB::update("UPDATE orders SET status ='$r->status' WHERE id='$r->id'");
            \DB::update("UPDATE laptops SET status='Finished' WHERE id='$r->id_laptop'");
            return redirect(route('admin.home.order'));
        }
        Alert::success('Data Berhasil Diubah');
        \DB::update("UPDATE orders SET status ='$r->status' WHERE id='$r->id'");
        return redirect(route('admin.home.order'));
    }

    public function DeleteOrder(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('email') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }
        Alert::success('Data Berhasil Dihapus');
        \DB::delete("DELETE FROM orders WHERE id = $id");
        return redirect(route('admin.home.order'));
    }
}
