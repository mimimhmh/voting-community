<?php

namespace App\Http\Controllers;


use App\CommunityLink;
use App\Http\Requests\LinksRequest;

class CommunityLinksController extends Controller
{
    public function __construct() {

        $this->middleware('auth')->except(['index']);
    }

    public function index() {

        $links = CommunityLink::paginate(25);
        return view('community.index', compact('links'));
    }

    public function store(LinksRequest $request) {

        CommunityLink::from(auth()->user())->contribute($request->all());

        return back();
    }
}
