<div class="container">
  <div class="row">
    <div class="form-group">
      <form id="article-form" class="form-horizontal" role="form" method="POST" action="{{ url('createArticle') }}">
        {{ csrf_field() }}
        <div class="col-md-7">
          <div id="form-errors"></div>
          <textarea type="text" class="form-control" id="content" name="content"
              placeholder="{{ trans('text.tweetContent') }}" required></textarea>
          <p class="error text-center alert alert-danger hidden"></p>
          <button type="button" class="btn btn-primary center-block" id="btn-post">
            {{ trans('app.home.tweet') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
