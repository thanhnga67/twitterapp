@if(isset($articles))
    @foreach($articles as $article)
    	@include('Article')
    @endforeach
@endif
