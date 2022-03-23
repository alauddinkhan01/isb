<?php

namespace App\Http\Controllers;

use App\Models\NewUser;
use Illuminate\Http\Request;

class MineController extends Controller
{
    public function index()
    {
        $user = NewUser::all();
        return view('mine',compact('user'));
    }
}
