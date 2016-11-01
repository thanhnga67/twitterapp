<div class="container">
<div class="col-md-11">
  <div class="row">
    <div class="panel-body">
      <form id="article-form" class="form-horizontal" role="form" method="POST" action="{{ url('createArticle') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <div class="col-md-8">
            <div id="form-errors"></div>
            <textarea type="text" class="form-control" id="content" name="content"
                placeholder="{{ trans('text.tweetContent') }}" rows="4" cols="40" required></textarea>
            <p class="error text-center alert alert-danger hidden"></p>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-1">
              <button type="button" class="btn btn-primary center-block" id="btn-post">
                {{ trans('app.home.tweet') }}
              </button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
</div>
