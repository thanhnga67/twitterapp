@extends('layouts.app')
@section('content')
<div class="containe">
  <div class="content">
    <h1 class="welcomeText">Twitterへようこそ</h1>
    <h2 class="nowText">「いま」起きていることを見つけよう。</h2>
    @if (Auth::guest())
    <div class="custom-btn">
      <a href="{{ url('/register') }}" class="btn btn-default center btn-lg">{{ trans('app.home.register') }}</a>
    </div>
    <div>
      <a href="{{ url('/login') }}" class="btn btn-info center btn-lg">{{ trans('app.home.login') }}</a>
    </div>
    @endif
  </div>
  </div>
@endsection