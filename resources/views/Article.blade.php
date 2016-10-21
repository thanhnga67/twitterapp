<li>
    <p>
        {{ $article->content }}
    <p>
    <p id ="timecount">
        {{ Carbon::setLocale('ja') }}
        @if (Carbon::now()->diffInMinutes($article->created_at) === 0)
        	<p>{{ trans('app.home.justnow') }}</p>
        @else
        	<p>{{ ($article->created_at)->diffForHumans() }}<p>
        @endif
    </p>
</li>
