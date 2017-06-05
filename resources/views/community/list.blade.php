<ul class="list-group">
    @if(count($links))
        @foreach($links as $link)
            <li class="list-group-item">
                            <span class="label label-default" style="background: {{ $link->channel->color }}">
                                {{ $link->channel->title }}
                            </span>
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