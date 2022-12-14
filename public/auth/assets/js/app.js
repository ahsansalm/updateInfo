$(document).ready(function () {

    
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        var target = $(e.target);
    
        if (target.parent().hasClass('disabled')) {
            return false;
        }
    });
    $(".first-step").click(function (e) {
        var email = $("#emailGet").val();
        var email_verification = $("#email_verification").val();
        var pass = $("#passGet").val();

        var regExpEmail = /^([\w\.\+]{1,})([^\W])(@)([\w]{1,})(\.[\w]{1,})+$/;
        var confirmPassword = $("#confirmPassword").val();
        var passwordregex6digits = new RegExp("^(?=.{6,})");
        var passwordregexLowercase = new RegExp("^(?=.*[a-z])");
        var passwordregexUppercase = new RegExp("^(?=.*[A-Z])");
        var passwordregexNumber = new RegExp("^(?=.*[0-9])");
        var passwordRegexSpecial = new RegExp("^(?=.*[!@#$%^&*])");
        var passwordRegexAll = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{6,})");

        if(email == ""){
             return false;
        }
        else if(email_verification == ""){
            return false;
       }
        else if(pass == ""){
            return false;
       }
        else if(!passwordregex6digits.test(pass)){
            return false;
        }
        else if(!passwordregexLowercase.test(pass)){
            return false;
        }
        else if(!passwordregexUppercase.test(pass)){
            return false;
        }
        else if(!passwordregexNumber.test(pass)){
            return false;
        }
        else if(!passwordRegexSpecial.test(pass)){
            return false;
        }
        else if(!passwordRegexAll.test(pass)){
            return false;
        }
        else if(confirmPassword == ""){
            return false;
        }
        else{
         var active = $('.wizard .nav-tabs li.active');
         active.next().removeClass('disabled');
         nextTab(active);
        }
 
     });

     $(".second-step").click(function (e) {
        var name = $("#name").val();
        var nameGet = $("#nameGet").val();
        var getAddress = $("#getAddress").val();
        var codeGet = $("#codeGet").val();
        var town = $("#town").val();
        var getCell = $("#getCell").val();
         if(nameGet == ""){
            return false;
            }
        else if(name == ""){
            return false;
       }
       else if(getAddress == ""){
        return false;
        }
        
        else if(codeGet == ""){
            return false;
        }

        else if(town == ""){
            return false;
        }

        else if(getCell == ""){
            return false;
        }

      
        else{
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
        }

       
       

    });
  
    $(".go-step").click(function (e) {
        var id = $(".BrandValue").val();
        if(id == ""){
            return false;
            }
            else{
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
            }
        

    });
    $(".go-next").click(function (e) {
        var value = $("#seriveData").val();
        if(value == ""){
            return false;
            }
            else{
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
            }
        

    });
    $(".next-benifit ").click(function (e) {
        var value = $("#benifitData").val();
        if(value == ""){
            return false;
            }
            else{
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
            }
        

    });



    $(".next-step").click(function (e) {

        var active = $('.wizard .nav-tabs li.active');
        active.next().removeClass('disabled');
        nextTab(active);
       

    });
    $(".prev-step").click(function (e) {

        var active = $('.wizard .nav-tabs li.active');
        prevTab(active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


$('.nav-tabs').on('click', 'li', function() {
    $('.nav-tabs li.active').removeClass('active');
    $(this).addClass('active');
});
