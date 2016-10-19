<div class="container">
    <div class="row">
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('createArticle') }}">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <textarea type="text" class="form-control" id="content" name="content"
                        placeholder="いまどうしてる？" required></textarea>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('app.home.tweet') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
