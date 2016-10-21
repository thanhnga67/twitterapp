$(document).ready(function(){
    $('#btn-post').on('click', function(){
        $.ajax({
            url: 'createArticle',
            type: "post",
            data: {'content':$('#content').val(), '_token': $('input[name=_token]').val()},
            success: function(data){
                $('#list-articles').prepend(data['uparticle']);
            },
            error: function(){
                alert('ツイートは140文以内です。');
            }
        });     
    });
});

var page = 1;
$("#load-more").click(function () {
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
    });
}
