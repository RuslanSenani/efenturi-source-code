<!---------job-search-header-start------->
<?php
$cityes = $this->home_model->get_cityes();


?>

<section>
    <div class="col-lg-12 job-search-hd-bg">
        <div class="container">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="header-center-part">
                    <div class="header-center-under-word">
                        <h1>
                            <span><?= $string['organizer_job_button']; ?></span>
                        </h1>
                        <p>
                            <span> <?= $string['search_description']; ?></span>
                        </p>
                    </div>
                    <form data-stop action="<?= get_base_url('organizer_post'); ?>" method="POST">
                        <div class=search-input>
                            <div>
                                <input type="search" name="name" placeholder="Search...">
                            </div>
                            <div>
                                <select name="cities">
                                    <option value="0">---<?= $string['choosed']; ?>---</option>
                                    <?php foreach ($cityes as $city) : ?>
                                        <option value="<?= $city['city_id'] ?>"><?= $city['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <select name="job_graphic">
                                    <option value="0">---seçin---</option>
                                    <option value="full_time"><?= $string['full_time']; ?></option>
                                    <option value="part_time"><?= $string['part_time']; ?></option>
                                    <option value="freelancer"><?= $string['freelancer']; ?></option>
                                    <option value="intern"><?= $string['intern']; ?></option>

                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-info"><?= $string['search_button']; ?></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<!---------job-search-header-end--------->

<!-------job search main start------->
<section id="job_container">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-9 job-search-main-left">

                <?php if (count($content['search_results']) > 0) { ?>
                    <?php foreach ($content['search_results'] as $job) : ?>
                        <?php $evnts = $this->front_database_model->front_read('jobs', array('city_id=' => $job['city_id']));
                        $country = $this->home_model->get_country($evnts[0]['country_id'])['title'];
                        $city = $this->home_model->get_city($evnts[0]['city_id'])['title'];
                        $data = $this->front_database_model->front_read('users', array('id'=>$job['user_id']));
                        $say = count($data);
                        ?>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 all-left">
                            <div class="row">
                                <div class="first-part div-width">
                                    <div>
                                        <h4>
                                            <span><a target="_blank" href="<?= get_base_url('organizer/jobs/' . $job['id']); ?>"><?= $job['vacancy_name']; ?></a></span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="second-part div-width">
                                    <div>
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>

                                    <div>
                                        <p>
                                            <span><?= $country; ?> / <?= ($city) != null ? $city : $country; ?></span>
                                        </p>
                                    </div>
                                </div>

                                <div class="third-part  div-width">
                                    <div>
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <?php if ($say != 0) { ?>
                                        <div>
                                            <p>
                                                <span><?= $data[0]['email']; ?></span>
                                            </p>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="fourth-part div-width">
                                    <div>
                                        <i class="fas fa-tags"></i>
                                    </div>
                                    <div>
                                        <p>
                                            <?php
                                            if ($job['work_graphic'] == 'full_time') {
                                                echo $string['full_time'];
                                            }
                                            if ($job['work_graphic'] == 'part_time') {
                                                echo $string['part_time'];
                                            }
                                            if ($job['work_graphic'] == 'freelancer') {
                                                echo $string['freelancer'];
                                            }
                                            if ($job['work_graphic'] == 'intern') {
                                                echo $string['intern'];
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>
        <?php } else { ?>
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-9 job-search-main-left">

                <div class="alert alert-warning">
                    <?= $string['results_not_found']; ?>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php
    $ads = $this->front_database_model->front_read("promo", array("type" => 'reklam_2'));
    ?>

    <!-- Burda  Reklamlar Yerlesdirilecek   Hal-Hazirda Dinamik Deyil  -->
    <div class="col-12 col-xs-12 col-md-12 col-md-6 col-lg-3 pt-4">

        <div class="col-12 colxs-12 col-sm-12 col-md-6 col-lg-12">
            <?php foreach ($ads as $ad) { ?>
                <div class="medi-page-right-card for-reklams">
                    <a target="_blank" href="<?= $ad['url_tag']; ?>" class="for-media-page-img">
                        <img src="<?= get_image($ad['image']); ?>" alt="">
                    </a>
                </div>

            <?php } ?>
        </div>
    </div>

    </div>
    </div>
</section>
<!-------job search main end--------->