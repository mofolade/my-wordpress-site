<div class="wrap" id="onecom-ui">
	<div class="loading-overlay fullscreen-loader">
		<div class="loading-overlay-content">
			<div class="loader"></div>
		</div>
	</div><!-- loader -->
	<div class="onecom-notifier"></div>

	<?php
	if ( ! ismWP() && function_exists('onecom_premium_theme_admin_notice') ) {
		onecom_premium_theme_admin_notice();
	}
	?>

	<h1 class="one-title"> <?php _e('Plugins', OC_PLUGIN_DOMAIN); ?> </h1>

	<div class="page-subtitle">
		<?php _e('Improve the experience of your website with one.com plugins.', OC_PLUGIN_DOMAIN); ?>
	</div>

	<?php
	// Get plugins data
	$plugins = onecom_fetch_plugins();

	if ( is_wp_error($plugins) ) {
		load_template(dirname(__FILE__) . '/wpapi-error.php');
	} else {
		// filter out the plugins with property hidden=true
		$plugins = array_filter($plugins ?? [], function($p) {
			return ! $p->hidden;
		});

		$plugin_count = onecom_plugins_count();
	?>

	<div class="wrap_inner inner one_wrap">
		<div class="h-parent-wrap">
			<div class="h-parent">
				<div class="h-child">
					<div class="onecom_tabs_container">
						<a href="<?php echo admin_url('admin.php?page=onecom-wp-plugins'); ?>" class="onecom_tab active">
							<?php _e('One.com plugins', OC_PLUGIN_DOMAIN); ?><span><?php echo $plugin_count['onecom_excluding_generic'] ?></span>
						</a>
						<a href="<?php echo admin_url('admin.php?page=onecom-wp-recommended-plugins'); ?>" class="onecom_tab">
							<?php _e('Recommended plugins', OC_PLUGIN_DOMAIN); ?><span><?php echo $plugin_count['recommended'] ?></span>
						</a>
						<a href="<?php echo admin_url('admin.php?page=onecom-wp-discouraged-plugins'); ?>" class="onecom_tab">
							<?php _e('Discouraged plugins', OC_PLUGIN_DOMAIN); ?><span><?php echo $plugin_count['discouraged'] ?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div id="free" class="tab active-tab">

			<div class="plugin-browser widefat">

				<?php
					// GET WP Rocket plugin info and append to plugins list json
					$wp_rocket             = new Onecom_Wp_Rocket();
					$wp_rocket_plugin_info = $wp_rocket->wp_rocket_plugin_info();
					$plugins[]             = (object) $wp_rocket_plugin_info;

					foreach ( $plugins as $key => $plugin ) : ?>
						<?php
						// @todo - remove onephoto condition once removed permanantely from json
						if ( $plugin->slug === 'onecom-themes-plugins' || $plugin->slug === 'onecom-onephoto' || $plugin->slug === 'onecom-php-scanner' ) {
							unset($plugins[ $key ]);
							continue;
						}
						$plugin_installed = $plugin_activated = false;
						if ( is_dir(WP_PLUGIN_DIR . '/' . $plugin->slug) ) {
							$plugin_installed = true;

							$plugin_infos = get_plugins('/'.$plugin->slug);
							if ( ! empty($plugin_infos) ) {
								foreach ( $plugin_infos as $file => $info ) :
									$is_inactivate = is_plugin_inactive($plugin->slug.'/'.$file);
									if ( ! $is_inactivate ) {
										$plugin_activated = true;
									} else {
										$activateUrl = add_query_arg( array(
											'_wpnonce' => wp_create_nonce('activate-plugin_' . $plugin->slug.'/'.$file),
											'action'   => 'activate',
											'plugin'   => $plugin->slug.'/'.$file,
										), admin_url('plugins.php') );
									}
								endforeach;
							}
						}
						?>
                        <div class="one-plugin-card
							<?php echo ( count( $plugins )  == 1 ) ? 'single-plugin' : ''; ?> <?php echo ( $plugin_installed ) ? 'installed' : ''; ?>" >
                            <div class="plugin-card-top <?php echo $plugin->slug; ?>">
                                <div class="name column-name oc-flex">
                                    <?php
                                    $thumbnail_url = $plugin->thumbnail;
                                    ?>
                                    <span class="plugin-icon-wrapper icon-available">
                                        <span class="plugin-icon-wrapper-inner"><img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $plugin->name; ?>" /></span>
                                    </span>
                                    <h3>
                                        <span><?php echo $plugin->name; ?></span>
                                    </h3>
                                    <div class="action-links">
                                    <ul class="plugin-action-buttons">
                                        <li>
                                            <?php if ( $plugin->slug === 'wp-rocket'
                                                           && $wp_rocket->is_wp_rocket_addon_purchased() && !$plugin_installed  ) :
                                                $oc_utm_medium = oc_utm_medium() ?? 'wp_rocket';
                                                $cp_login = OC_CP_LOGIN_URL."&amp;utm_source=onecom_wp_plugin&amp;utm_medium=$oc_utm_medium";
                                                ?>
                                                <a class="activate-plugin btn button_1 oc-wp-rocket-cp-link" target="_blank" href="<?php echo $cp_login; ?>" data-slug="<?php echo $plugin->slug; ?>" data-name="<?php echo $plugin->name ?>" ><?php _e( 'Activate', OC_PLUGIN_DOMAIN); ?></a>
                                            <?php elseif ( $plugin->slug === 'wp-rocket' && !$plugin_installed ) : ?>
                                                <a class="btn button_1 wp-rocket-guide-link" target="_blank" href="<?php echo $wp_rocket->wp_rocket_translated_guide(); ?>" data-slug="<?php echo $plugin->slug; ?>" data-name="<?php echo $plugin->name ?>" ><?php _e( 'Learn more', OC_PLUGIN_DOMAIN); ?></a>
                                            <?php elseif( $plugin_installed && $plugin_activated ) : ?>
                                                <a class="installed-plugin btn button_1" href="javascript:void(0)" data-slug="<?php echo $plugin->slug; ?>" data-name="<?php echo $plugin->name ?>" disabled="true" ><?php _e( 'Active', OC_PLUGIN_DOMAIN); ?></a>
                                            <?php elseif ( $plugin_installed && ( ! $plugin_activated ) ) : ?>
                                                <?php if( ( ! isset( $plugin->redirect ) ) || $plugin->redirect != '' ) : ?>
                                                    <a class="activate-plugin activate-plugin-ajax btn button_1" href="javascript:void(0)" data-action="onecom_activate_plugin" data-redirect="<?php echo $plugin->redirect; ?>" data-slug="<?php echo $plugin->slug.'/'.$file; ?>" data-name="<?php echo $plugin->name ?>"><?php _e( 'Activate', OC_PLUGIN_DOMAIN); ?></a>
                                                <?php else : ?>
                                                    <a class="activate-plugin btn button_1" href="<?php echo esc_url($activateUrl) ?>"><?php _e( 'Activate', OC_PLUGIN_DOMAIN); ?></a>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <a class="install-now btn button_1" href="javascript:void(0)" data-slug="<?php echo $plugin->slug; ?>" data-name="<?php echo $plugin->name ?>" aria-label="Install <?php echo $plugin->name ?> now" data-action="onecom_install_plugin" data-redirect="<?php echo $plugin->redirect; ?>" data-plugin_type="<?php echo $plugin->type; ?>"><?php _e( 'Install now', OC_PLUGIN_DOMAIN); ?></a>
                                            <?php endif; ?>
                                        </li>

									</ul>
								</div>
                                </div>
                                <div class="desc column-description">
                                    <p><?php _e($plugin->description, OC_PLUGIN_DOMAIN); ?>
                                        <?php
                                        $plugin_info_slug = "plugin-install.php?tab=plugin-information&plugin=".$plugin->slug."&TB_iframe=true&width=772&height=521";
                                        $plugin_network_admin_url = esc_url(network_admin_url( $plugin_info_slug ));
                                        $plugin_admin_url = esc_url(admin_url( $plugin_info_slug ));
										$info_url = ( is_multisite() ) ? $plugin_network_admin_url : $plugin_admin_url;
                                        ?>
                                    </p>
                                </div>
                                <?php if(true === onecom_checkdate_timestamp($plugin->new)){ ?>
                                    <div class="oc-new-ribbon">
                                        <span class="oc-new-ribbon-text"><?php echo __('New', OC_PLUGIN_DOMAIN); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div> <!-- one-plugin-card -->
                    <?php endforeach; ?>
			</div> <!-- plugin-browser -->
		</div> <!-- tab -->
	</div> <!-- wrap_inner -->
<?php } ?>

</div> <!-- wrap -->
<?php add_thickbox(); ?>
<span class="dashicons dashicons-arrow-up-alt onecom-move-up"></span>