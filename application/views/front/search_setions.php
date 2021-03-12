<!---------searct-setion-start--------->
<section>
    <div class="col-lg-12 search-section">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <div class="center-word">
                    <h1>
                        <span><?= $string['search_title']; ?></span>
                    </h1>
                </div>
                <div class="center-search">
                    <form data-stop id="search_form" action="<?= get_base_url('search_query'); ?>" method="post">
                        <div class="form-group d-flex inputs justify-content-center">
                            <input name="title" class="one" type="text" placeholder="<?= $string['search_placeholder']; ?>">
                            <input type="submit" value="<?= $string['search_button']; ?>" class=" two submit ">
                        </div>
                    </form>

                </div>
                <div class="center-end-word">
                    <p>
                        <span>
                            <?= $string['search_description']; ?>
                        </span>
                    </p>
                </div>
                <div class="container">
                    <div class="col-lg-12 col-sm-12 col-12 d-flex justify-content-center">
                        <div>
                            <ul class="buttons for-new-btns for-unders-buttons">
                                <?php foreach ($home_categories as $cat) : ?>
                                    <li><a href="<?= get_base_url('search/' . $cat['stream_id']); ?>"><?= $cat['title']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------searct-setion-start--------->