<section class="site-header oct-header-menu d-none d-lg-block">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- START nav container -->
                    <nav class="nav primary-nav" id="primary-nav">
                        <?php
                        wp_nav_menu(
                                array(
                                    'theme_location' => 'primary_oct_showcase',
                                    'container' => '',
                                    'fallback_cb' => 'onecom_add_nav_menu',
                                )
                        );
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</section>