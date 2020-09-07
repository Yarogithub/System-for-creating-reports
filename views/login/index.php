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
            <form id="loginForm" action="login/run" method="post">
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

                    console.log('error')
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
                    })

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

</script>
