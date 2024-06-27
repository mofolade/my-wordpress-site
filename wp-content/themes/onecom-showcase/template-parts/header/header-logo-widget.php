<section class="oct-head-bar">
    <div class="container">
        <div class="row d-lg-none">
            <div class="col-1">
                <button class="menu-toggle mobile-only" aria-controls="sticky_menu" aria-expanded="false">Menu</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="oct-site-logo">
                    <?php if ('off' != ot_get_option('logo_switch')): ?>

                        <h1 class="site-title">
                            <a href="<?php echo home_url('/'); ?>" rel="home">
                                <?php
                                $logo = ot_get_option('logo_img');
                                if (strlen($logo)) {
                                    printf('<img src="%s" alt="%s" role="logo" />', $logo, get_bloginfo('name'));
                                } else {
                                    echo get_bloginfo('title');
                                }
                                ?>
                            </a>
                        </h1>
                        <!-- END logo container -->
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8">

                <div class="oct-header-widget text-md-right">
                    <div class="clearfix visible-md"></div>
                    <!-- START Header Sidebar -->
                    <?php dynamic_sidebar('oct-header-1'); ?>
                    <!-- END Header Sidebar -->
                </div>
            </div>
        </div>
    </div>
</section>