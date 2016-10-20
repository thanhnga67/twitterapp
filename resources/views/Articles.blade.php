@if(isset($articles))
    @foreach($articles as $article)
    <li>
        <div>
            <p>
                {{ $article->content }}
            </p>
        </div>
    </li>
    @endforeach
@endif