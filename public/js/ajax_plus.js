$(document).ready(function(){
  $('#btn-post').on('click', function(){
    $.ajax({
      url: 'createArticle',
      type: "post",
      data: {'content':$('#content').val().replace("&#10;", "\n"), '_token': $('input[name=_token]').val()},
      success: function(data){
        $('#list-articles').prepend(data['uparticle']);
        $('#article-form textarea').val(''); 
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
        $("div.alert").fadeIn( 300 ).delay( 3000 ).fadeOut( 400 );
      }
    });
  });
});

$("#load-more").click(function (){
  loadMore();
});

function loadMore(){
  let getPageUrl = 'home/nextPage';
  console.log($('.tweet').length);
  $.ajax({
    type : 'get',
    url : getPageUrl,
    data : {
      offset : $('.tweet').length,
    },
    dataType : 'json',
    encode : true,
    success: function(data){
      $("#list-articles").append(data.downarticle);
      if (data.flag < 10) {
        $('#load-more').hide();
      }
    }
  });
}
