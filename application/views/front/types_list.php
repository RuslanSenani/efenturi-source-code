<!-- Types-lere Gore Olan Yer -->
<section>
  

    <div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-2 text-left">
        <div class="happening-now-center-word">
            <h2>
                <span><?= $string['types']; ?></span>
            </h2>
            <!-- <p>
                <span><?= $string['search_by_type']; ?></span>
            </p> -->
        </div>
    </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 by-category p-0">
            <div class="slider">
                <?php foreach ($types_categories as $cat) : ?>
                    <ul class="buttons">
                        <li><a href="<?= get_base_url('search/' . $cat['type_id']); ?>"><?= $cat['title']; ?></a></li>
                    </ul>
                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>