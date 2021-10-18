<?php
/*
 * Template Name: Vlogs Template
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @page FullyBossed
 * @since FullyBossed 1.0
 */
get_header();
?>
<?php
        $pillar=isset($_GET['pillar']) ? $_GET['pillar']:'';
	    $plierData = get_page_by_path($pillar, OBJECT, 'pillar');
		$pillar_id=$plierData->ID;
		#pr($plierData,1);
		if(empty($pillar_id)){
			 $url=home_url()."/services/blogs-vlogs/";
			 echo "<script>window.location.assign('".$url."');</script>";
			 exit();
		}
		$categorys = get_categories(array('taxonomy' => 'vlog_category'));
		//$category_post_pillar=get_term_meta(20,'category_post_pillar',true);
		//pr($category_post_pillar,1);
		$nocargory=true;
?>
<div class="content">
	<div class="page-inner-title u-spacing ubg-grey">
		<div class="container">
			<div class="dark text-center">
				<h5>Vlogs</h5>
				<h2>
					<mark class="mark-yellow">
						<span><?php echo substr($plierData->post_title,0,1);?></span><?php echo substr($plierData->post_title,1);?>
					</mark>
				</h2>
			</div>
		</div>
	</div>
<div class="listing-content u-spacing ubg-white">
		<div class="container">
		<?php
		foreach($categorys as $key=>$val){
			   $name=$val->name;
				$term_id=$val->term_id;
				$slug=$val->slug;

			    $category_post_pillar=get_term_meta($term_id,'category_pillar',true);
			    // print_r($category_post_pillar);
				// if(in_array($pillar_id,$category_post_pillar)){
					$nocargory=false;
		?>
			<div class="listing-list" style="margin-top:40px; margin-bottom: 0px;">
				<div class="tabs-area dark">
					<h4><?php echo $val->name?></h4>
				</div>
				<div class="u-row">
				    <div class="listing-box">
				    	<div class="swiper-container blog-slide1">
		   					<div class="swiper-wrapper">
								<?php
						// 1st query not empty
                $args=array(
									'posts_per_page'   => '-1',
									'orderby'          => 'post_date',
									// 'order'            => 'ASC',
									'post_type'        => 'vlogs',
									'meta_query'			 => array(
										array(
											'key'			=> 'vlog_3rd_party',
											'value'		=> array(''),
											'compare'	=> 'NOT IN',
										),
									),
									'tax_query' => array(
										array(
											'taxonomy' 		=> 'vlog_category',
											'terms' 			=> $term_id,
											'field' 			=> 'term_id',
										),
									),
								);
								$posts=query_posts($args);

					// 2nd query empty
								$args1=array(
									'posts_per_page'   => '-1',
									'orderby'          => 'post_date',
									'post_status'			 =>  'publish',
									// 'order'            => 'ASC',
									'post_type'        => 'vlogs',
									'offset' 					 =>  0,
									'meta_query'			 => array(
										array(
											'key'			=> 'vlog_3rd_party',
											'value'		=> array(''),
											'compare'	=> 'IN',
										),
									),
									'tax_query' => array(
										array(
											'taxonomy' 		=> 'vlog_category',
											'terms' 			=> $term_id,
											'field' 			=> 'term_id',
										),
									),
								);			
								// print_r($args1);				
								$posts1=query_posts($args1);
                $noPost=true;
            // 1st loop
                foreach($posts1 as $post2){
									$post_id2=$post2->ID;
									$post_title2=$post2->post_title;
									$post_content2=$post2->post_content;
									$image_url=get_the_post_thumbnail_url($post_id2);
									$external_link=get_post_meta($post_id2,'external_link',true);									
									$vlog_3rd_party=get_post_meta($post_id2,'vlog_3rd_party',true);
									$vlog_3rd_party=isset($vlog_3rd_party[0]) ? $vlog_3rd_party[0]:'';									
									$permalink=get_permalink($post_id2);
									$post_post_pillar=get_post_meta($post_id2,'category_pillar',true);
									if(empty($external_link)){
										$external_link=$permalink;
									}
									if(empty($image_url)){									
										$image_url='https://fullybossed.com/wp-content/uploads/2021/04/insta-img.jpg';									
									}
									// if(in_array($pillar_id,$post_post_pillar)){
										$noPost=false;
								?>
		   						<div class="swiper-slide">
		   							<div class="listing-box-single dark">
		   								<?php if (empty($vlog_3rd_party)) {
		   								 ?>
		   								<a href="<?php echo $external_link;?>" target="_blank">
		   									<div class="listing-box-img" style="background-image: url(https://fullybossed.com/wp-content/uploads/2021/04/blog-thumb-overlay.png)">
		   										<div style="background-image: url(<?php echo $image_url?>)"></div>
											</div>
		   								</a>
		   							<?php } ?>
										<h5 class="mt-2">
											<a href="<?php echo $external_link?>" target="_blank"><?php echo $post_title2?>
											</a>
										</h5>
										<?php
										if(!empty($vlog_3rd_party)){
										?>
										<div class="third-party-tag">
											<div class="best-tag">
												<img src="/wp-content/themes/fullybossed/images/decorated-yellow12.png">
											</div>
										</div>
                    <?php } ?>
		                <!--<div class="social-icons">
													<div>
														<a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a>
														<a target="_blank" href="#"><i class="fab fa-instagram"></i></a>
														<a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
														<a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
														<a target="_blank" href="#"><i class="fab fa-whatsapp"></i></a>
														<a target="_blank" href="#"><i class="fas fa-envelope"></i></a>
													</div>
												</div>-->
		   							</div>
		   						</div>
								<?php
								// }
								}

					// 2nd loop
								foreach($posts as $post){
									$post_id=$post->ID;
									$post_title=$post->post_title;
									$post_content=$post->post_content;
									$image_url=get_the_post_thumbnail_url($post_id);
									$external_link=get_post_meta($post_id,'external_link',true);									
									$vlog_3rd_party=get_post_meta($post_id,'vlog_3rd_party',true);
									$vlog_3rd_party=isset($vlog_3rd_party[0]) ? $vlog_3rd_party[0]:'';									
									$permalink=get_permalink($post_id);
									$post_post_pillar=get_post_meta($post_id,'category_pillar',true);

									if(empty($external_link)){
										$external_link=$permalink;
									}
									if(empty($image_url)){										
										$image_url='https://fullybossed.com/wp-content/uploads/2021/04/insta-img.jpg';		
									}
									// if(in_array($pillar_id,$post_post_pillar)){
										$noPost=false;
								?>
		   						<div class="swiper-slide">
		   							<div class="listing-box-single dark">
		   								<a href="<?php echo $external_link;?>" target="_blank">
		   									<div class="listing-box-img" style="background-image: url(https://fullybossed.com/wp-content/uploads/2021/04/blog-thumb-overlay.png)">
		   										<div style="background-image: url(<?php echo $image_url?>)"></div>
											</div>
		   								</a>
										<h5 class="mt-2">
											<a href="<?php echo $external_link?>" target="_blank"><?php echo $post_title?>
											</a>
										</h5>
										<?php
										if(!empty($vlog_3rd_party)){
										?>
										<div class="third-party-tag">
											<div class="best-tag">
												<img src="/wp-content/themes/fullybossed/images/decorated-yellow12.png">
											</div>
										</div>
                    <?php } ?>
		               	<!--<div class="social-icons">
													<div>
														<a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a>
														<a target="_blank" href="#"><i class="fab fa-instagram"></i></a>
														<a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
														<a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
														<a target="_blank" href="#"><i class="fab fa-whatsapp"></i></a>
														<a target="_blank" href="#"><i class="fas fa-envelope"></i></a>
													</div>
												</div>-->
		   							</div>
		   						</div>
								<?php
								// }
								}
								if($noPost) { ?>
								    <div class="col-md-12">
								    <h3>No vlogs found this category</h3>
								    </div>
								<?php
								}?>
		   					</div>
		   					<div class="swiper-pagination"></div>
		   				</div>
		   			</div>
			    </div>
			</div>
		<?php
			//}
		 } ?>
		<?php
		if($nocargory){
		?>
		<div class="col-md-12">
			<h3>No Vlogs found</h3>
		</div>
		<?php }
		?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
<script>
function myFunction(x) {
    if (x.matches) {
	   //alert('OK1');
      var swiper = new Swiper('.swiper-container.blog-slide1', {
        slidesPerView: 4,
        spaceBetween: 30,
        speed: 800,
		breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1,
		  spaceBetween: 30
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 3,
		  spaceBetween: 30
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 4,
		  spaceBetween: 30
		},
		},
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
          //dynamicBullets: true,
          renderBullet: function (index, className) {
			  
 	 		  return '<span class="' + className + '">' + (index + 1) + '</span>';
    		},
        },
    });
    } else { 
	    //alert('Ok');
        var swiper = new Swiper('.swiper-container.blog-slide1', {
        slidesPerView: 4,
        spaceBetween: 30,
        speed: 800,
		breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1,
		  spaceBetween: 30
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 3,
		  spaceBetween: 30
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 4,
		  spaceBetween: 30
		},
		},
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
          dynamicBullets: true,
          renderBullet: function (index, className) {
     	 	return '<span class="' + className + '">' + (index + 1) + '</span>';
          },
        },
      });
    }
  }
  var x = window.matchMedia("(max-width:768px)");
  myFunction(x);
  x.addListener(myFunction);
</script>
