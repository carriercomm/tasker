$(document).ready(function() {
    $(document).on("submit","#search_form",function(){
        search();
        if(typeof activate_fancy == 'function') {
            activate_fancy();
        }
        return false;
    });

    $('#search_form select').change(function(){
        $('#search_form').submit();
    });

    $("#search_form [type='checkbox']").change(function(){
        $('#search_form').submit();
    });

    $(document).on('keydown','input[name="search"]',function(){
          clearTimeout(window.timer);
          window.keypress = true;
          window.clear = true;
          window.timer = setTimeout(function(){$('#search_form').submit();},500);
    })
});

function get_page(page){
    $('[name="page"]').val(page);
    window.page = page;
    window.clear = false;
    $('#search_form').submit();
}

function search(){
    var input = $("input[name='search']");
    input.css('background','url(/source/images/admin/preloader.gif) 99% 50% no-repeat');
    if (window.keypress) window.keypress = false;

    if (window.clear) $('[name="page"]').val(1);
    var request = $('#search_form').serialize();
    p = $('#search_form').attr("path")
   
    user_api(request,function(res){
        clearTimeout(window.loading,300);
        input.css('background','');
        $('#search_result').html(res);

        if(jQuery().styler) {
            $(".popup input").styler();
        }
    },false,p);
}