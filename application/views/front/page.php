<section class="page-title overlay" style="background-image:url(<?=get_image($content['image']);?>);">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading ">
                    <h1><?=$content['title'];?></h1>
                </div>
                <?=$breadcumb;?>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->

<section class="flat-row main-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <article class="post-single">
                    <div class="entry-post fr-view page-content">
                        <?=$content['content'];?>
                    </div><!-- /.entry-post -->
                </article><!-- /.post-single -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->

    </div><!-- /.container -->
</section>