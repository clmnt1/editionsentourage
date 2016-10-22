<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php elegant_description(); ?>
	<?php elegant_keywords(); ?>
	<?php elegant_canonical(); ?>

	<?php do_action( 'et_head_meta' ); ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( $template_directory_uri . '/js/html5.js"' ); ?>" type="text/javascript"></script>
	<![endif]-->

	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>

	<?php wp_head(); ?>
	
		<link rel="apple-touch-icon" sizes="57x57" href="/wp-content/themes/editionsentourage/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/wp-content/themes/editionsentourage/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/wp-content/themes/editionsentourage/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/wp-content/themes/editionsentourage/favicons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/wp-content/themes/editionsentourage/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/wp-content/themes/editionsentourage/favicons/apple-touch-icon-120x120.png">
<link rel="icon" type="image/png" href="/wp-content/themes/editionsentourage/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/wp-content/themes/editionsentourage/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/wp-content/themes/editionsentourage/favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/wp-content/themes/editionsentourage/favicons/manifest.json">
<link rel="mask-icon" href="/wp-content/themes/editionsentourage/favicons/safari-pinned-tab.svg" color="#e74536">
<meta name="apple-mobile-web-app-title" content="Éditions Entourage">
<meta name="application-name" content="Éditions Entourage">
<meta name="msapplication-TileColor" content="#b5e3d8">
<meta name="theme-color" content="#b5e3d8">	
<script src="<?php echo esc_url( get_stylesheet_directory_uri() . '/js/slide-menu.js'); ?>" type="text/javascript"></script>

</head>
<body <?php body_class(); ?>>
	<div id="page-container">
<?php
	if ( is_page_template( 'page-template-blank.php' ) ) {
		return;
	}

	$et_secondary_nav_items = et_divi_get_top_nav_items();

	$et_phone_number = $et_secondary_nav_items->phone_number;

	$et_email = $et_secondary_nav_items->email;

	$et_contact_info_defined = $et_secondary_nav_items->contact_info_defined;

	$show_header_social_icons = $et_secondary_nav_items->show_header_social_icons;

	$et_secondary_nav = $et_secondary_nav_items->secondary_nav;

	$et_top_info_defined = $et_secondary_nav_items->top_info_defined;

	$et_slide_header = 'slide' === et_get_option( 'header_style', 'left' ) || 'fullscreen' === et_get_option( 'header_style', 'left' ) ? true : false;
?>

		<div id="et-main-area">