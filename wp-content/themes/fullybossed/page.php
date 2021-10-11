<?php
/**
 * The template for displaying all single posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package WordPress
 * @subpackage FullyBossed
 * @since FullyBossed 1.0
*/

get_header(); ?>

<div class="content">
	<?php
		if ( have_posts() ) :
	    while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		else :
			_e( 'Sorry, no posts were found.', 'textdomain' );
		endif;
	?>
</div>

<?php get_footer(); ?>