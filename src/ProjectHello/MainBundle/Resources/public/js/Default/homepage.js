


$(document).ready(function () {
    
    var loadingImg = $('div#loginModal > form > div.form-actions > em');
    var submitBtn = $('div#loginModal > form > div.form-actions > button');
    
    $("#login-form").submit(function () {
    
        submitBtn.hide();
        loadingImg.show();
        
        $.post('/login_check', $(this).serialize(), function (data) {        
        
            if (data.success) {
                
                window.location.replace(data.url);
            }
            else {
                
                submitBtn.show();
                loadingImg.hide();
                
                alert("You provided wrong credentials.");
            }
        });
        
        return false;
    });
});