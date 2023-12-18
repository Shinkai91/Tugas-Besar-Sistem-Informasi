<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;

class LoginController extends Controller
{
    public function ViewUserLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('email') && $role_check === 'user') {
            $user = session()->get('nama');
            Alert::info('Sudah Login', 'Anda sudah login dengan user ' . $user);
            return redirect(route('user.home'));
        }

        return view('user.login');

    }

    public function AuthUserLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('email') && $role_check === 'user') {
            return redirect(route('user.home'));
        }

        $users = \DB::select("SELECT * FROM users WHERE email = '$r->email' && password = '$r->password'");
        if (count($users) === 0) {
            Alert::error('Login Gagal', 'Username atau password salah.');
            return redirect(route('user.login.auth'));
        }

        session([
            'id_user' => $users[0]->id,
            'email' => $users[0]->email,
            'nama' => $users[0]->nama_user,
            'phone' => $users[0]->phone,
            'role' => 'user',
        ]);

        // Display success message using SweetAlert
        Alert::success('Login Berhasil', 'Selamat datang, ' . $users[0]->nama_user)->persistent(true);

        return redirect(route('user.home'));
    }

    public function ViewUserRegister(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('email') && $role_check === 'user') {
            $user = session()->get('nama');
            Alert::info('Sudah Login', 'Anda sudah login dengan user ' . $user);
            return redirect(route('user.home'));
        }
        return view('user.register');
    }

    public function AuthUserRegister(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('email') && $role_check === 'user') {
            return redirect(route('user.home'));
        }

        // Check if the email and password combination already exists
        $existingUser = \DB::select("SELECT * FROM users WHERE email = '$r->email' AND password = '$r->password'");

        if (count($existingUser) > 0) {
            // Display an error alert and redirect back to the registration page
            Alert::error('Pendaftaran Gagal', 'Email dan password sudah terdaftar.');
            return redirect(route('user.register'));
        }

        // Registration successful, insert the new user into the database
        \DB::insert("INSERT INTO users VALUES (null, '$r->email','$r->phone','$r->nama_user','$r->password')");

        // Display a success alert
        Alert::success('Pendaftaran Berhasil', 'Silahkan login');

        // Redirect to the user home page
        return redirect(route('user.home'));
    }

    public function ViewAdminLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('email') && $role_check === 'admin') {
            return redirect(route('admin.home'));
        }
        return view('admin.login');
    }

    public function AuthAdminLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('email') && $role_check === 'admin') {
            return redirect(route('admin.home'));
        }

        $admin = \DB::select("SELECT * FROM admin WHERE email = '$r->email' && password = '$r->password'");

        if (count($admin) === 0) {
            // Display an error alert and redirect back to the login page
            Alert::error('Login Gagal', 'Username atau password salah.');
            return redirect(route('admin.login.auth'));
        }

        // Authentication successful, store information in the session
        session([
            'id' => $admin[0]->id,
            'email' => $admin[0]->email,
            'nama' => $admin[0]->nama,
            'role' => 'admin'
        ]);

        // Display a success alert
        Alert::success('Login Berhasil', 'Selamat datang, ' . $admin[0]->nama);

        // Redirect to the admin home page
        return redirect(route('admin.home'));
    }

    public function ViewOperatorLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('email') && $role_check === 'operator') {
            $user = session()->get('nama');
            Alert::info('Sudah Login', 'Anda sudah login dengan user ' . $user);
            return redirect(route('operator.home'));
        }
        return view('operator.login');
    }

    public function AuthOperatorLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('email') && $role_check === 'operator') {
            return redirect(route('operator.home'));
        }

        $operator = \DB::select("SELECT * FROM operators WHERE email = '$r->email' && password = '$r->password'");

        if (count($operator) === 0) {
            Alert::error('Login Gagal', 'Username atau password salah.')->persistent(true);
            return redirect(route('operator.login.auth'));
        }

        session([
            'id' => $operator[0]->id,
            'nama' => $operator[0]->nama,
            'email' => $operator[0]->email,
            'role' => 'operator'
        ]);

        return redirect(route('operator.home'));
    }

    public function logout(Request $r)
    {
        $role = $r->session()->get('role');

        $r->session()->flush();

        return redirect('/');
    }
}
