<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            return view('admin.dashboard');
        }
        return redirect()->route('auth.login');
    }
}
