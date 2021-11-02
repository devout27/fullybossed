<?php
/**
 * The template for displaying all single vlog
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
get_header();
global $post;
$post_id=$post->ID;
$post_title=$post->post_title;
$post_content=$post->post_content;
$image_url=get_the_post_thumbnail_url($post_id);
$external_link=get_post_meta($post_id,'external_link',true);
$post_3rd_party=get_post_meta($post_id,'post_3rd_party',true);
$post_3rd_party=isset($post_3rd_party[0]) ? $post_3rd_party[0]:'';
$video_url_id=get_post_meta($post_id,'video_url',true);
$video_url=wp_get_attachment_url($video_url_id);
$video_external_url=get_post_meta($post_id,'video_external_url',true);
if(empty($image_url)){

	$image_url='https://fullybossed.com/wp-content/uploads/2021/04/insta-img.jpg';
}

if(empty($external_link)){

	$external_link=$permalink;
}
$post_post_pillar=get_post_meta($post_id,'category_post_pillar',true);
?>
<div class="content">
	<div class="page-inner-title u-spacing ubg-grey">
		<div class="container">
			<div class="dark text-center single-page-title">
				<h2>
					<mark class="mark-yellow">
						<?php echo $post_title?>
					</mark>
				</h2>
			</div>
		</div>
   </div>
   <div class="container">
   <div class="row single-ping">
       <!--<div class="single-p-img">
	   <img src="<?php echo $image_url?>"></div>-->

	    <?php if(!empty($video_url)){?>
		<div class="col-sm-12">
		 <video width="100%" height="100%" controls autoplay>
		  <source src="<?php echo $video_url?>" type="video/mp4">
		  <source src="<?php echo $video_url?>" type="video/ogg">
		  <source src="<?php echo $video_url?>" type="video/webm">
		  Your browser does not support the video tag.
		</video>
		</div>
		<?php
		}?>
		<?php if(!empty($video_external_url)){ ?>
			<div class="col-sm-12">
				<div class="custome-vlog-video mt-5">
					<iframe width="100%" height="800px" webkitallowfullscreen mozallowfullscreen allowfullscreen src="<?php echo $video_external_url?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>

		<?php
		}?>
	    <div class="col-sm-12">
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
   </div>
  </div>
 </div>
<?php
get_footer();
