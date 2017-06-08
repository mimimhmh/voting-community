<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotesController extends Controller
{

    //
    public function __construct() {

        $this->middleware('auth');
    }

    public function store($link) {

        auth()->user()->votes()->toggle($link);

        return back();
    }
}
