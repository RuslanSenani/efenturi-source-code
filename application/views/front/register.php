<!---user-osganizator section start---->
<section>
    <div class="registration">
        <div class="col-lg-6  col-md-12 m-auto col-sm-12 col-xs-12 col-12 for_titles">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <ul class="underline">
                    <li class="for-under-line active" data-type="user">
                        <?= $string['register_type_1']; ?>
                    </li>
                    <li class="for-under-line" data-type="company">
                        <?= $string['register_type_2']; ?>
                    </li>

                </ul>
            </div>
            <div class="form-part">
                <form action="<?= get_base_url('register/submit'); ?>" method="post">


                    <input type="hidden" name="type" value="user" />
                    <div class="row for-together">
                        <div class="form-group together col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for=""><?= $string['firstname']; ?></label>
                            <input type="text" name="firstname" id="">
                            <div data-error="firstname"></div>
                        </div>
                        <div class="form-group together col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for=""><?= $string['lastname']; ?></label>
                            <input type="text" name="lastname" id="">
                            <div data-error="lastname"></div>
                        </div>
                    </div>





                    <div class="form-group single">
                        <label for=""><?= $string['email']; ?></label>
                        <input type="email" name="email" id="">
                        <div data-error="email"></div>
                    </div>
                    <div class="form-group single">
                        <label for=""><?= $string['company']; ?></label>
                        <input type="text" name="company" id="">
                        <div data-error="company"></div>
                    </div>


                    <div class="form-group single">
                        <label for=""><?= $string['positions']; ?></label>
                        <input type="text" name="positions" id="">
                        <div data-error="positions"></div>
                    </div>



                    <div class="form-group single">
                        <label for=""><?= $string['location']; ?></label>
                        <input type="text" name="location" id="">
                        <div data-error="location"></div>
                    </div>

                    <div class="form-group single">
                        <label for=""><?= $string['password']; ?></label>
                        <input type="password" name="password" id="">
                        <div data-error="password"></div>
                    </div>
                    
                    <div class="form-group single">
                        <label for=""><?= $string['password']; ?></label>
                        <input type="password" name="passwordretry" id="">
                        <div data-error="passwordretry"></div>
                    </div>

                    <div class="form-group single">
                        <label>
                            <input type="checkbox" name="terms" value="1" />
                            <a href="<?= $string['terms_link']; ?>"><?= $string['terms_button']; ?></a>
                        </label>
                    </div>
                </form>
            </div>
            <div class="register">
                <div id="success"></div>
                <button data-send-form="true" disabled id="reg" class="btn"><?= $string['register_button']; ?></button>
            </div>
        </div>
    </div>
</section>
<!---user-osganizator section start---->