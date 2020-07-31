<!--<h1>Login</h1>-->
<!---->
<!--<form action="login/run" method="post">-->
<!---->
<!--    <label>Login</label><input type="text" name="login" /><br />-->
<!--    <label>Password</label><input type="password" name="password" /><br />-->
<!--    <label></label><input type="submit" />-->
<!--</form>-->

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
            <form action="login/run" method="post">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="login" placeholder="login">

                </div>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" placeholder="password" name="password">
                </div>
<!--                <div class="row align-items-center remember">-->
<!--                    <input type="checkbox">Remember Me-->
<!--                </div>-->
                <div class="form-group">
                    <input type="submit" class="btn float-right login_btn">
<!--                    <input type="submit" value="Login" />-->
                </div>
            </form>
        </div>
    </div>
</div>