@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="abc">
          <h1>Twitterへようこそ</h1>
          <br>
          <h2>「いま」起きていることを見つけよう。</h2>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          @if (Auth::guest())
            <a href="{{ url('/register') }}" class="btn btn-primary center-block">{{ trans('app.home.register') }}</a><br>
            <a href="{{ url('/login') }}" class="btn btn-primary center-block">{{ trans('app.home.login') }}</a>
          @endif
          <br>
          <br>
        </div>
      </div>
    </div>
  </div>
@endsection