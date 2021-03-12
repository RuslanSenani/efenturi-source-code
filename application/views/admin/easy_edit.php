<style>
    @font-face {
        font-family: 'Material Icons';
        font-style: normal;
        font-weight: 400;
        src: url(<?=base_url();?>assets/admin_css/iconfont/MaterialIcons-Regular.eot);
        /* For IE6-8 */
        src: local('Material Icons'),
            local('MaterialIcons-Regular'),
            url(<?=base_url();?>assets/admin_css/iconfont/MaterialIcons-Regular.woff2) format('woff2'),
            url(<?=base_url();?>assets/admin_css/iconfont/MaterialIcons-Regular.woff) format('woff'),
            url(<?=base_url();?>assets/admin_css/iconfont/MaterialIcons-Regular.ttf) format('truetype');
    }

    .material-icons {
        font-family: 'Material Icons' !important;
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        display: inline-block;
        line-height: 1;
        text-transform: none;
        letter-spacing: normal;
        word-wrap: normal;
        white-space: nowrap;
        direction: ltr;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
        -moz-osx-font-smoothing: grayscale;
        font-feature-settings: 'liga';
    }


    .easy-edit-panel {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 30px;
        box-sizing: border-box;
        background: #2d2e2e;
        border-bottom: 1px solid #fff;
        z-index: 100;
        padding: 1px 10px;
        overflow: hidden;
    }

    .easy-edit-panel * {
        color: #fff !important;
        text-decoration: none;
    }

    .easy-edit-panel ul {
        position: relative;
        margin: 0;
        padding: 0;
        display:inline-block;
    }
    .easy-edit-panel .control{

    }
    .easy-edit-panel .settings{
        float: right;
    }

    .easy-edit-panel ul li {
        position: relative;
        display: inline-block;
        font-size: 12px;
        padding: 0px 5px;
        vertical-align: middle;
    }

    .easy-edit-panel ul i {
        vertical-align: middle;
        font-size: 15px;
    }
</style>
<div class="easy-edit-panel">
    <ul class="control">
        <?php foreach($admin_menu as $menu):?>
        <li>
            <a target="_blank" href="<?=base_url().$menu['url_tag'];?>">
                <i class="material-icons">
                    <?=$menu['icon'];?>
                </i>
                <?=$menu['title'];?>
            </a>
        </li>
        <?php endforeach;?>
    </ul>
    <ul class="settings">
        <?php if(!empty($edit_controller) and !empty($edit_id)):?>
        <li>
            <a target="_blank" href="<?=base_url();?>admin/<?=$edit_controller;?>#<?=$edit_id;?>">
                <i class="material-icons">edit</i>
                Redaktə et
            </a>
        </li>
        <?php endif;?>
        <li>
            <a href="<?=base_url();?>admin/account/logout">
                <i class="material-icons">power_settings_new</i>
                Çıxış
            </a>
        </li>
    </ul>
</div>