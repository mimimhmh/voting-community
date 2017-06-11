<?php

namespace App\Http\Controllers;


use App\Channel;
use App\CommunityLink;
use App\Exceptions\CommunityLinkAlreadySubmitted;
use App\Http\Requests\LinksRequest;

class CommunityLinksController extends Controller
{

    public function __construct() {

        $this->middleware('auth')->except(['index']);
    }

    /**
     * @param Channel $channel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Channel $channel = null) {

        $orderBy = request()->exists('popular') ? 'votes_count': 'updated_at';

        $links = CommunityLink::with('channel', 'user')->withCount('votes')
            ->forChannel($channel)
            ->where('approved', 1)
            ->orderBy($orderBy, 'DESC')
            ->paginate(3);


        $channels = Channel::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels', 'channel'));
    }

    /**
     * @param LinksRequest $form
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(LinksRequest $form) {

        try
        {
            $form->persist();

            if (auth()->user()->isTrusted())
            {
                flash('Thanks for contribution!', 'success');
            } else
            {
                flash()->overlay('This contribution will be approved shortly.', 'Thanks!');
            }
        } catch (CommunityLinkAlreadySubmitted $e)
        {

            flash()->overlay(
                'We will instead bump the timestamps shortly. Thanks.',
                'That link Has Already Been Submitted!');
        }

        return back();
    }

    /*
        public function store(LinksRequest $request) {


            CommunityLink::from(auth()->user())->contribute($request->all(), $this);

            if (auth()->user()->isTrusted())
            {
                flash('Thanks for contribution!', 'success');
            } else
            {
                flash()->overlay('This contribution will be approved shortly.', 'Thanks!');
            }

            return back();
        }

        public function alertLinkAlreadySubmitted() {

            flash()->overlay(
                'We will instead bump the timestamps shortly. Thanks.',
                'That link Has Already Been Submitted!');

            return redirect('\community');
        }
        */

}
