$(document).ready(function(){
  $('#btn-post').on('click', function(){
    $.ajax({
      url: 'createArticle',
      type: "post",
      data: {'content':$('#content').val(), '_token': $('input[name=_token]').val()},
      success: function(data){
        $('#list-articles').prepend(data['uparticle']);
      },
      error: function(data){
        var response = data.responseJSON;
        errorsHtml = '<div class="alert alert-danger">';
        var errorString = '<ul>';
        $.each( response.errors, function( key, value){
          errorString += '<li>' + value + '</li>';
        });
        errorString += '</ul></div>';
        $( '#form-errors' ).html( errorsHtml += errorString ); 
      }
    });
  });
});

var page = 1;
$("#load-more").click(function (){
  page++;
  loadMore(page);
});

function loadMore(page){
  $.ajax({
    url: '?page=' + page,
    type: 'get',
    beforeSend: function()
    {
      $('#load-more').show();
    },
    success: function(data){
      if(data.flag  < 10){
        $('#load-more').hide();
      }
      $("#list-articles").append(data.downarticle);
    }
    error: function(jqXHR, ajaxOptions, thrownError) {
      alert(trans('home.errors.not_respond'));
    }
  });
}
