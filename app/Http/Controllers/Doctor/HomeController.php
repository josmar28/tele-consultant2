<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\PendingMeeting;
use App\Patient;
class HomeController extends Controller
{
	public function __construct()
    {
        if(!$login = Session::get('auth')){
            $this->middleware('auth');
        }
    } 

    public function index()
    {
        return view('doctors.home');
    }
}
