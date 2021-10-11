<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package WordPress
 * @subpackage FullyBossed
 * @since FullyBossed 1.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title>Fully Bossed</title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
	<style>
	.loader {

		position: fixed;

		background: rgba(255, 255, 255, 0.6);

		top: 0px;

		right: 0px;

		left: 0px;

		bottom: 0px;

		z-index: 99999;

		width: 100%;

		height: 100vh;

		display: none;

	}

	.loader div {

		width: 100%;

		height: 100vh;

		display: flex;

		justify-content: center;

		align-items: center;

	}

	.loader div img {

		height: 80px;

		width: 80px;

	}
	a,button{
	  text-decoration: none !important;;
	}
	.error{
		color: red !important;
		font-size: 14px;
	}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body <?php body_class();
	global $wp_query;
	$admin_logged_in = false;
	$post = $wp_query->get_queried_object();
  	// $pagename = $post->post_name;
	if( current_user_can('administrator') ) {
		$admin_logged_in = true;
	}


?> >
<div class="container-fluid site-header ">
	<div class="row align-items-center">
		<div class="col-8 col-md-4 col-lg-4 col-xl-4">
			<div class="site-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/wp-content/uploads/2021/04/fully-bossed-logo-caudex-regular1.png" alt="Fully Bossed">
				</a>
			</div>
		</div>
		<?php if($admin_logged_in == true) { ?>
		<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
			<div class="menu-area">
				<div class="menu-btn">
					<label for="btn" class="icon"><span class="bar-btn"><i class="fas fa-bars"></i></span></label>
					<!-- <input type="checkbox" id="btn"> -->
				</div>
				<?php wp_nav_menu( array( 'container_class' => 'header-menu-area', 'theme_location' => 'primary' ) ); ?>
		    </div>
		</div>
		<?php } ?>
	</div>
</div>

<div id="loder-img" class="loader">

	<div>

		<img src="<?php //echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/loader.gif' ?>" width="80">
	</div>
</div>