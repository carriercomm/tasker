$(document).ready(function($){

    $(".menu a").removeClass("active");
    $("[name='birthday']").mask("99.99.9999");

    $("#regForm").keypress(function(e){
          if(e.which == 13){
                ii = $('#sendReg').click();
                return false;                
          }
    });

    $("#sendReg").on("click", function(){
        user_api($("#regForm").serialize(),function(res){
            show_message("success","Регистрация выполнена");
            redirect("/",2);
        },function(res){
            $("#registration_captcha").html(res.captcha_html);
            if ($(".reg_erroru #captcha_name").length < 1) $("#captcha_name").append("&nbsp;<span class='reg_erroru' error='captcha'></span>")
            $("#regForm .reg_erroru").hide();
            $.each(res,function(k,v){
                $("[error='"+k+"']").text(v).show();
            })
        });
        return false;
    })

    $("#male,#female").on("click",function(){
        $("#male,#female").removeClass("select");
        $(this).addClass("select");
        if (this.id == "male") $("[name='gender'][value='m']").click();
        else if (this.id == "female") $("[name='gender'][value='f']").click();
    });

    var myDate = new Date();
    var offset = -myDate.getTimezoneOffset() * 60;
    var maxOffset = 15;
    var elem = "";
    $("#tz option").each(function(index){
        if (Math.abs(offset-$(this).val()) < maxOffset) {
            maxOffset = Math.abs(offset-$(this).val());
            elem = this;
        }
    });
    $(elem).attr("selected","selected");
});