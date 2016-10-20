@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('articleForm')
                </div>
                <div>
                    <ul id="list-articles">
                        @include('Articles', ['articles' => $articles])
                    </ul>
                </div>
                <div>
                    @if($articles->count() >= 10)
                        <button id="load-more" class="btn btn-success">{{ trans('app.home.loadmore')}}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
