<div class="d-flex justify-content-center h-100">
    <div class="card">
        <div class="card-header">
            <h3 class="mt-2">Set Your Password</h3>
            <div class="d-flex justify-content-end social_icon">
                <span><i class="fab fa-facebook-square"></i></span>
                <span><i class="fab fa-google-plus-square"></i></span>
                <span><i class="fab fa-twitter-square"></i></span>
            </div>
        </div>
        <div class="card-body">
            <form id="setFirstPasswordForm" method="post">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" name="setPassword" placeholder="Password">
                    <div class="invalid-feedback" id="setPasswordError">
                    </div>

                </div>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm password">
                    <div class="invalid-feedback" id="confirmPasswordError">
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" id="setPasswordSubmit" class="btn float-right login_btn">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">



    $(document).on('click','#setPasswordSubmit',function () {

        var frm = $('#setFirstPasswordForm');


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
                    window.location.href = "<?php echo URL; ?>/login";
                },
                error: function (data) {

                    me.data('requestRunning',false);

                    var error = JSON.parse(data.responseText);
                    var errors = error.errors;
                    var passwordError = errors.setPassword;
                    var confirmPasswordError = errors.confirmPassword;

                    console.log(passwordError);
                    console.log(confirmPasswordError);

                    $.each(errors, function (index, value) {

                        $('input[name="' + index + '"]').addClass("is-invalid");
                        $('select[name="' + index + '"]').addClass("is-invalid");

                        $('#' + index + "Error").html(value);
                    })

                    if (passwordError === undefined)
                    {
                        $('input[name="setPassword"]').removeClass("is-invalid");
                    }

                    if(confirmPasswordError===undefined){
                        $('input[name="confirmPassword"]').removeClass("is-invalid");
                    }
                },
            });

        });

    });

</script>