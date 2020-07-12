<!-- See viewLoginClient.php -->
<div class="Login__container">
    <a href="/pfa/"> <img src="./assets/Images/logo.png" alt="" class="logo_site"></a>

    <div class="login_warp">

        <h2 class="login__title">Sign in to Account</h2>
        <span class="login-bar"></span>
        <form action="#" method="GET" class="login__form">
            <div class="email-div">
                <label for="login__email" class="email-input-label">Email</label>
                <input type="email" name="email" id="login__email" class="login__email">
            </div>
            <div class="pwd-div">
                <label for="login__pwd" class="pwd-input-label">Password</label>
                <input type="password" name="pwd" id="login__pwd" class="login__pwd" autocomplete="off">
            </div>
            <div class="check-div">
                <input type="checkbox" name="check" id="login__check" class="login__check">
                <label for="login__check" class="check-input-label">Remeber me</label>
            </div>
            <div class="login-btn-div">
                <input class="signin-btn" type="submit" value="LogIn">
            </div>
        </form>

    </div>
</div>
<div class="loginRight_side">
    <div class="login-right-side-wrap">
        <h2 class="greet-title">Hello There !</h2>
        <span class="greet-bar"></span>
        <h3 class="greet-descrip">Fill up personal information and start Journey with us.</h3>
        <a href="?controller=signup" class="greet-signup">Sign UP</a>
    </div>
</div>