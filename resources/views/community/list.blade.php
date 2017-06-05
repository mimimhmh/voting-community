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