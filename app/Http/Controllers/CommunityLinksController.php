<?php

namespace App\Http\Controllers;


use App\CommunityLink;

class CommunityLinksController extends Controller
{
    //
    public function index() {

        $links = CommunityLink::paginate(25);
        return view('community.index', compact('links'));
    }
}
