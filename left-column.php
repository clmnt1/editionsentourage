<div class="left-column">
	<div id="top-navigation" data-height="<?php echo esc_attr( et_get_option( 'menu_height', '66' ) ); ?>" data-fixed-height="<?php echo esc_attr( et_get_option( 'minimized_menu_height', '40' ) ); ?>">
		<div class="container clearfix menu_container">
			<?php
			$logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && '' != $user_logo
				? $user_logo
				: $template_directory_uri . '/images/logo.png';
			?>
			<div class="logo_container">
				<span class="logo_helper"></span>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="slidemenu-control">
					<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="logo" data-height-percentage="<?php echo esc_attr( et_get_option( 'logo_height', '54' ) ); ?>" />
				</a>
			</div>

			<?php if ( ! $et_slide_header || is_customize_preview() ) : ?>
				<nav id="top-menu-nav" class="slidemenu-menu">
					<div class="left-bar">
						<div class="flex-container">
							<div class="social-links">
								<?php get_template_part( 'includes/social_icons', 'header' ); ?>
							</div>
							<div class="copyright"><span>2015-<?php echo date('Y'); ?> © <a href="http://www.clementribe.fr" title="Clément Ribé">C R</a> & <a href="http://www.leovirieu.fr" title="Léo Virieu">L V</a></span></div>
						</div>
					</div>
					<div class="middle-bar">
						<?php
						$menuClass = 'nav';
						if ( 'on' == et_get_option( 'divi_disable_toptier' ) ) $menuClass .= ' et_disable_top_tier';
						$primaryNav = '';

						$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => 'top-menu', 'echo' => false ) );

						if ( '' == $primaryNav ) :
							?>
							<ul id="top-menu" class="<?php echo esc_attr( $menuClass ); ?>">
								<?php if ( 'on' == et_get_option( 'divi_home_link' ) ) { ?>
									<li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'Divi' ); ?></a></li>
								<?php }; ?>

								<?php show_page_menu( $menuClass, false, false ); ?>
								<?php show_categories_menu( $menuClass, false ); ?>
							</ul>
							<?php
						else :
							echo( $primaryNav );
						endif;
						?>
						<!-- #contact -->
						<div id="et-info">
						<?php if ( '' !== ( $et_phone_number = et_get_option( 'phone_number' ) ) ) : ?>
							<a href="<?php echo esc_attr( 'callto:' . $et_phone_number ); ?>"><span><?php echo esc_html( $et_phone_number ); ?></span></a>
						<?php endif; ?>

						<?php if ( '' !== ( $et_email = et_get_option( 'header_email' ) ) ) : ?>
							<a href="<?php echo esc_attr( 'mailto:' . $et_email ); ?>"><span><?php echo esc_html( $et_email ); ?></span></a>
						<?php endif; ?>

						<?php
						if ( true === $show_header_social_icons ) {
							get_template_part( 'includes/social_icons', 'header' );
						} ?>
						</div> <!-- #et-info -->
						<!-- #fin-contact -->
						<!-- #search -->
						<?php if ( false !== et_get_option( 'show_search_icon', true ) || is_customize_preview() ) : ?>
						  <?php if ( 'fullscreen' !== et_get_option( 'header_style', 'left' ) ) { ?>
						    <div class="clear"></div>
						  <?php } ?>
						  <form role="search" method="get" class="et-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						    <?php
						      printf( '<input type="search" class="et-search-field" placeholder="" placeholder="%2$s" name="s" title="%3$s" />',
						        esc_attr__( 'Search &hellip;', 'Divi' ),
						        get_search_query(),
						        esc_attr__( 'Search for:', 'Divi' )
						      );
						    ?>
						    <button type="submit" id="searchsubmit_header"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/search-icon.svg" /></button>
						  </form>
						<?php endif; // true === et_get_option( 'show_search_icon', false ) ?>
						<!-- #end-search -->
						<!-- #et-secondary-menu -->
						<?php
							if ( is_page_template( 'page-template-blank.php' ) ) {
								return;
							}

							$et_secondary_nav_items = et_divi_get_top_nav_items();

							$et_secondary_nav = $et_secondary_nav_items->secondary_nav;

						?>
						<div id="et-secondary-menu">
						<?php
							if ( '' !== $et_secondary_nav ) {
								echo $et_secondary_nav;
							}
						?>
						</div>
						<!-- #end-et-secondary-menu -->
					</div>
				</nav>
			<?php endif; ?>

			<?php if ( $et_slide_header || is_customize_preview() ) : ?>
				<span class="mobile_menu_bar et_pb_header_toggle et_toggle_<?php echo et_get_option( 'header_style', 'left' ); ?>_menu"></span>
			<?php endif; ?>

			<?php if ( ( false !== et_get_option( 'show_search_icon', true ) && ! $et_slide_header ) || is_customize_preview() ) : ?>
				<div id="et_top_search">
					<span id="et_search_icon"></span>
				</div>

			<?php endif; // true === et_get_option( 'show_search_icon', false ) ?>

			<?php do_action( 'et_header_top' ); ?>

		</div> <!-- .container -->
	</div> <!-- #et-top-navigation -->
	<script type="text/javascript">
		jQuery('.menu_container').slideMenu("left");
	</script>
</div>
