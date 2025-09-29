<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BahasaDaerahController extends Controller
{
    public function index()
    {
        return view('pages.bahasa_daerah.bahasa');
    }
}
