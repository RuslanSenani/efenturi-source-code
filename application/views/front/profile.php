<!------- profile owner start --------->
<?php
$user_id = $this->session->userdata("user")['id'];
$user_info = $this->home_model->get_user_info($user_id);
?>
<section>
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 profil-owner-left text-right">

            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 profil-owner-right">

                <div class="col-md-12 col-sm-12 col-12 for-header text-center">
                    <div class="bg-color-img">
                        <div class="bg-image" style="background-image:url(<?= get_image($user_info['image']); ?>);"></div>
                    </div>
                    <div class="under-description">
                        <div class="owner-name">
                            <h2>
                                <span><?= $user_info['firstname'] ?> <?= $user_info['lastname']; ?></span>
                            </h2>
                        </div>
                        <div class="position">
                            <div class="owner_position">
                                <div class="owner_position_title">
                                    <p>
                                        <span><?= $user_info['positions']; ?></span>
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Personal informaton -->
                <div class="col-md-12 col-sm-12 col-12 profile-information-part">
                    <div class="for-all-title">
                        <h4>
                            <span><?= $string['cv_page1_title']; ?></span>
                        </h4>
                    </div>
                    <div class="profile-information-body">
                        <div class="profile-information-form">

                            <form action="<?= get_base_url('edit/user'); ?>" method="post">
                                <input type="hidden" name="user_id" value="<?= $user_info['id']; ?>">
                                <div data-error="user_id"></div>
                                <div class="form-group profile-information-forms">
                                    <label for=""><?= $string['firstname']; ?>*</label>
                                    <input type="text" name="firstname" value="<?= $user_info['firstname']; ?>" placeholder="First Name">
                                    <div data-error="firstname"></div>
                                </div>
                                <div class="form-group profile-information-forms">
                                    <label for=""><?= $string['lastname']; ?>*</label>
                                    <input type="text" name="lastname" value="<?= $user_info['lastname']; ?>" placeholder="Last Name">
                                    <div data-error="lastname"></div>
                                </div>

                                <div class="form-group profile-information-forms">
                                    <label for=""><?= $string['email']; ?>*</label>
                                    <input type="email" name="email" value="<?= $user_info['email']; ?>" placeholder="Email">
                                    <div data-error="email"></div>
                                </div>

                                <div class="form-group profile-information-forms">
                                    <label for=""><?= $string['location']; ?>*</label>
                                    <input type="text" name="location" value="<?= $user_info['location']; ?>" placeholder="Location">
                                    <div data-error="location"></div>
                                </div>
                                <div class="form-group profile-information-forms">
                                    <label for=""><?= $string['company']; ?>*</label>
                                    <input type="text" name="company" value="<?= $user_info['company']; ?>">
                                    <div data-error="company"></div>

                                </div>
                                <div class="form-group profile-information-forms">
                                    <label for=""><?= $string['positions']; ?>*</label>
                                    <input type="text" name="positions" value="<?= $user_info['positions']; ?>">
                                    <div data-error="positions"></div>
                                </div>

                                <div class="form-group profile-information-forms">
                                    <label for=""><?= $string['password']; ?>*<br><span style="color: red;"><?= $string['if_you_not_change_the_password']; ?></span></label>
                                    <input type="password" name="password">
                                    <div data-error="password"></div>
                                </div>
                                <div class="form-group profile-information-forms">
                                    <label for="image"><?= $string['choose_file']; ?>*</label>
                                    <input type="file" name="image" id="image">
                                </div>
                                <br><br><br><br>
                                <!-- Save And Delete Buttons -->
                                <div class="col-md-12 col-sm-12 col-12 changes-delate text-center">
                                    <div>
                                        <input type="submit" class="btn" value="<?= $string['save_changes']; ?>">
                                    </div>
                                    <div>
                                        <a href="<?= get_base_url('delete/user/' . $user_info['id']); ?>"><?= $string['delate_account']; ?></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------ profile owner end ------------>