<div class="d-flex justify-content-center h-100">
    <div class="card">
        <div class="card-header">
            <h3>Sign In</h3>
            <div class="d-flex justify-content-end social_icon">
                <span><i class="fab fa-facebook-square"></i></span>
                <span><i class="fab fa-google-plus-square"></i></span>
                <span><i class="fab fa-twitter-square"></i></span>
            </div>
        </div>
        <div class="card-body">
            <form id="loginForm" action="<?php echo URL; ?>Login/run" method="post">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="login" placeholder="login">
                    <div class="invalid-feedback" id="loginLogInError">
                    </div>

                </div>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="password">
                    <div class="invalid-feedback" id="passwordLogInError">
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" id="loginSubmit" class="btn float-right login_btn">
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                <a href="#" data-toggle="modal" data-target="#myForgotPasswordModal">Forgot your password?</a>
            </div>
        </div>
    </div>
</div>

<div id="myForgotPasswordModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="forgotPasswordForm" action="<?php echo URL; ?>Login/forgotPassword" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Password: Forgot</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <p >Please enter your email we will send you link and you will able to set a new password for your account</p>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="loginCheck" class="form-control"  placeholder="Email">
                        <div class="invalid-feedback" id="loginCheckError">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" id="forgotPassword" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>


<script>

    $(document).on('click','#loginSubmit',function () {

        var frm = $('#loginForm');


        frm.submit(function (e) {

            e.preventDefault();

            var me = $(this);

            if(me.data('requestRunning')){
                return;
            }

            me.data('requestRunning',true);

            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function (data) {
                    window.location.href = "<?php echo URL; ?>/index";
                },
                error: function (data) {
                    me.data('requestRunning',false);

                    var error = JSON.parse(data.responseText);
                    var errors = error.errors;
                    var loginError = errors.login;
                    var passwordError = errors.password;

                    console.log(passwordError);
                    console.log(loginError);


                    $.each(errors, function (index, value) {

                        $('input[name="' + index + '"]').addClass("is-invalid");

                        $('#' + index + "LogInError").html(value);
                    });

                    if (loginError === undefined)
                    {
                        $('input[name="login"]').removeClass("is-invalid");
                    }

                    if(passwordError===undefined){
                        $('input[name="password"]').removeClass("is-invalid");
                    }
                },
            });

        });
    });

    $(document).on('click','#forgotPassword',function () {

        var frm = $('#forgotPasswordForm');


        frm.submit(function (e) {

            e.preventDefault();

            var me = $(this);

            if(me.data('requestRunning')){
                return;
            }

            me.data('requestRunning',true);

            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function (data) {
                    $('#myForgotPasswordModal').modal('toggle');
                },
                error: function (data) {

                    console.log('error')
                    me.data('requestRunning',false);

                    var error = JSON.parse(data.responseText);
                    var errors = error.errors;
                    var loginError = errors.loginCheck;
                    $.each(errors, function (index, value) {

                        $('input[name="' + index + '"]').addClass("is-invalid");

                        $('#' + index + "Error").html(value);
                    })

                    if (loginError === undefined)
                    {
                        $('input[name="loginCheck"]').removeClass("is-invalid");
                    }
                },
            });

        });
    });

</script>
