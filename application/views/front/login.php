<!---user-osganizator section start---->
<section>
    <div class="registration">
        <div class="col-lg-6  col-md-12 m-auto col-sm-12 col-xs-12 col-12 for_titles">
            <div class="form-part">
                <h1 class="login-title"><?= $string['login_title']; ?></h1>
                <form method="post" action="<?= get_base_url('login/submit'); ?>">
                    <div class="form-group single">
                        <label for=""><?= $string['email']; ?></label>
                        <input type="email" name="email" id="">
                        <div data-error="email"></div>
                    </div>
                    <div class="form-group single">
                        <label for=""><?= $string['password']; ?>*</label>
                        <input type="password" name="password" id="">
                        <div data-error="password"></div>
                    </div>
                </form>
            </div>
            <div class="register">
                <div id="success"></div>
                <button data-send-form="true" class="btn"><?= $string['login_button']; ?></button>
            </div>
            <div style="padding-bottom:40px;">
                <a class="forgot-pw" href="<?= get_base_url('forgot-password'); ?>"><?= $string['forgot_button']; ?></a>
                <a style="float:right" class="forgot-pw" href="<?= get_base_url('register'); ?>"><?= $string['register_button']; ?></a>
            </div>
        </div>
    </div>
</section>
<!---user-osganizator section start---->