<li>
  <div id ="timecount" class="row center-block">
    <div class="col-xs-6" style="border-top: 1px solid">
      <p class="text-left">{{ Auth::user()->name }}</p>
    </div>
    <div class="col-xs-5" style="border-top: 1px solid">
      @if (Carbon::now()->diffInMinutes($article->created_at) === 0)
        <p class="text-right">{{ trans('app.home.justnow') }}</p>
      @elseif (Carbon::now()->diffInDays($article->created_at) != 0)
        <p class="text-right">{{ $article->created_at->format('m月d日 H:i') }}<p>
      @else
        <p class="text-right">{{ ($article->created_at)->diffForHumans() }}<p>
      @endif
    </div>
  </div>
  <div class="col-xs-10">
    <p>
      {{ $article->content }}
    <p>
  </div>
</li>
