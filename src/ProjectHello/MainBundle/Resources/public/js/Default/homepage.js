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

    var loginLoadingImg = $('div#loginModal > form > div.form-actions > em');
    var loginSubmitBtn = $('div#loginModal > form > div.form-actions > button');
    var loginMsg = $('div#loginModal > form > div.form-actions > span');

    $('div#loginModal > form').ajaxForm({
        beforeSubmit : function() {
            loginSubmitBtn.hide();
            loginMsg.empty().hide();
            loginLoadingImg.show();
        },
        success: function (data, statusText, xhr, $form) {
            loginSubmitBtn.show();
            loginMsg.empty();
            loginLoadingImg.hide();

            if (data.success) {
                loginMsg.hide();
                window.location.replace(data.url);
            } else {
                loginMsg.html('You provided wrong credentials.').show();
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
        loginMsg.empty().hide();
        $('div#loginModal > form :input').val('');
    }

    /*************************************************** REGISTRATION ***********************************************/

    $('#registrationBtn').click(function(e) {
        e.preventDefault();
        $('#registrationModal').reveal({
            animation: 'fadeAndPop',                   //fade, fadeAndPop, none
            animationspeed: 300,                       //how fast animtions are
            closeonbackgroundclick: true,              //if you click background will modal close?
            dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
        });
    });

    $('div#registrationModal').find('button.btn-primary').click(function(){
        $('span.errorMsg').remove();

        var email = $('#user_emailAddress').val();
        var password = $('#user_password').val();
        var confirmPassword = $('#user_confirmPassword').val();

        var filter = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        var isValidEmail = filter.test(email);

        var submitBtn = $('div#registrationModal > form > div.form-actions > button');
        var loadingImg = $('div#registrationModal > form > div.form-actions > em');

        if (isValidEmail && password && password == confirmPassword) {
            submitBtn.hide();
            loadingImg.show();

            $.post(
                $('#hdnRegistrationLink').val(),
                $('div#registrationModal > form').serialize(),
                function(json) {
                    submitBtn.show();
                    loadingImg.hide();

                    if (json.error) {
                        $('#user_emailAddress').parent().append('<span class="errorMsg">' + json.error + '</span>');
                    } else {
                        $('div#registrationModal').find('p, form').remove();
                        $('div#registrationModal').append('<p>Thank you for registering. Please check your email to verify your account.</p>');

                        $('div#registrationModal').find('a.close-reveal-modal').unbind('click').click(function(){
                            location.reload();
                        });
                    }
                }
            );
        } else {
            if (!email) {
                $('#user_emailAddress').parent().append('<span class="errorMsg">Email address is required.</span>');
            } else if (!isValidEmail) {
                $('#user_emailAddress').parent().append('<span class="errorMsg">A valid email address is required.</span>');
            }

            if (!password) {
                $('#user_password').parent().append('<span class="errorMsg">Password is required.</span>');
            }

            if (!confirmPassword) {
                $('#user_confirmPassword').parent().append('<span class="errorMsg">Password must be confirmed.</span>');
            } else if (password != confirmPassword) {
                $('#user_confirmPassword').parent().append('<span class="errorMsg">Both passwords must be equal.</span>');
            }
        }

        return false;
    });
});