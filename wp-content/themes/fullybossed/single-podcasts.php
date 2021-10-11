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
       <div class="single-p-img"><img src="<?php echo $image_url?>"></div>
	    <div class="col-sm-12">
		   <p><?php echo $post_content ?></p>
	   </div>
   </div>
  </div>
 </div>
<?php
get_footer();
