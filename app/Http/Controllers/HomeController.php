<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    $user = auth()->user();
    if (!$user) {
        abort(403, 'User belum login.');
    }

    $role = strtolower(trim($user->role));
    if ($role == 'admin') {
        return view('home');
    } elseif ($role == 'guru') {
        return redirect()->route('guru.dashboard');
    } elseif ($role == 'siswa') {
        return redirect()->route('siswa.dashboard');
    } else {
        abort(403, 'Akses tidak diizinkan. Role: ' . $user->role);
    }
}

}
