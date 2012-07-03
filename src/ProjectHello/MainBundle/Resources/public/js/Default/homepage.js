


$(document).ready(function () {
    
    /*
     * Reveal script
     * 
     * @requires jquery.reveal
     */
    
    $('#loginBtn').click(function(e) {
        e.preventDefault();
        resetLoginForm();
        $('#loginModal').reveal({
            animation: 'fadeAndPop',                   //fade, fadeAndPop, none
            animationspeed: 300,                       //how fast animtions are
            closeonbackgroundclick: true,              //if you click background will modal close?
            dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
        });
    });
    
    /*
     * Login script
     * 
     * @requires jquery.form.plugin
     */
    
    var loginLoadingImg = $('div#loginModal > form > div.form-actions > em > img');
    var loginSubmitBtn = $('div#loginModal > form > div.form-actions > button');
    var loginMsg = $('div#loginModal > form > div.form-actions > span');
    
    $('div#loginModal > form').ajaxForm({
        beforeSubmit: function () {
            loginSubmitBtn.hide();
            loginLoadingImg.show();
            loginMsg.html("<em>Verifying ...<em>").css('color', 'gray');
        },
        success: function (data, statusText, xhr, $form) {
            if (data.success) {
                loginMsg.html("<em>Logging in...<em>").css('color', 'green');
                window.location.replace(data.url);
            }
            else {
                loginSubmitBtn.show();
                loginLoadingImg.hide();
                loginMsg.html("You provided wrong credentials.").css('color', 'red');
            }
        }
    });
    
    /*
     *  --- Utility functions ---
     */
    
    /**
     * Clear all fields of login form and erase previous error
     * messages. This function should be called everytime the login
     * form is revealed.
     */
    function resetLoginForm()
    {
        loginMsg.html('');
        $('div#loginModal > form :input').val('');
    }
});