<h3><a href="/community">
        Community </a>
    @if($channel->exists)
        &mdash; {{ $channel->title }}
    @endif
</h3>

<ul class="nav nav-tabs">
    <li class="{{ request()->exists('popular')? '' : 'active' }}">
        <a href="{{ request()->url() }}">Most Recent</a>
    </li>

    <li class="{{ request()->exists('popular')? 'active' : '' }}">
        <a href="?popular=1">Most Popular</a>
    </li>
</ul>

<ul class="list-group">
    @if(count($links))
        @foreach($links as $link)
            <li class="communityLinks list-group-item">
                <form method="post" action="/votes/{{ $link->id }}">
                    {{ csrf_field() }}

                    <button type="submit"
                            class="btn {{ Auth::check() &&
                             Auth::user()->votedFor($link)? 'btn-success' : 'btn-default'  }}
                            {{Auth::guest()? 'disabled' : ''  }}
                            btn-sm">
                        {{ $link->votes->count() }}
                    </button>
                </form>

                <a href="/community/{{ $link->channel->slug }}" class="label label-default"
                   style="background: {{ $link->channel->color }}">
                    {{ $link->channel->title }}
                </a>
                <a href="{{ $link->link }}" target="_blank">
                    {{ $link->title }}
                </a>

                <small>
                    contributed by:
                    <a href="#">
                        {{ $link->creator->name }}
                    </a>
                    {{ $link->updated_at->diffForHumans() }}
                </small>
            </li>
        @endforeach
    @else
        <li class="list-group-item">
            No contributions yet.
        </li>
    @endif
</ul>


{{ $links->appends(request()->query())->links() }}