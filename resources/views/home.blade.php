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
                    @if(isset($articles))
                        @foreach ($articles as $item)
                            <li>
                                {{ $item->content }}
                            </li>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
