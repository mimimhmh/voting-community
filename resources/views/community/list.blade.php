<h3><a href="/community">
        Community </a>
    @if($channel->exists)
        &mdash; {{ $channel->title }}
    @endif
</h3>

<ul class="list-group">
    @if(count($links))
        @foreach($links as $link)
            <li class="list-group-item">
                <form method="post" action="">
                    {{ csrf_field() }}

                    <button type="button"
                            class="btn {{ Auth::check() &&
                             Auth::user()->votedFor($link)? 'btn-success' : 'btn-default'  }}
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

{{ $links->links() }}