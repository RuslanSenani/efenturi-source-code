<ul class="breadcrumbs">
    <li>
        <a href="<?=base_url();?>" title="<?=$string['home_btn'];?>"><?=$string['home_btn'];?>
        <i class="arrow_right"></i>
        </a>
    </li>
    <?php 
    $url=base_url();
    for($i=0;$i<count($breadcumb);$i++):
    ?>
    <li>
        <a href="<?php
        $url.=$breadcumb[$i]['url_tag'].'/';
        echo $url;
        ?>" title="<?=$breadcumb[$i]['title'];?>"><?=$breadcumb[$i]['title'];?>
        <?php if($i!=count($breadcumb)-1):?>
            <i class="arrow_right"></i>
        <?php endif;?>
        </a>
    </li>
    <?php endfor;?>
</ul>