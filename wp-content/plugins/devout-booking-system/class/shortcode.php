<?php
	add_shortcode('book-speaking-service', 'bookSpeakingService_callback');
	function bookSpeakingService_callback($atts){
		$code = $atts['code'];
		$url = home_url().'/booking-speaking-overview/';
		$html='<a href="'.$url.'"><button>Book Now</button></a>';
		return $html;
	}

	# [service-code code=195]
    add_shortcode('service-code', 'service_code');
	function service_code($atts){
		$code=$atts['code'];
		$url=home_url().'/booking-sessions/?code='.base64_encode($code);
		$html='<a href="'.$url.'"><button>Book Now</button></a>';
		return $html;
	}
	 # [coaching-service-code code=223 sessioncode=2]
	add_shortcode('coaching-service-code', 'coaching_service_code');
	function coaching_service_code($atts){
		$code = $atts['code'];
		$sessioncode = $atts['sessioncode'];
		$url = home_url().'/booking-coaching-sessions/?code='.base64_encode($code).'&sessioncode='.base64_encode($sessioncode).'&service_type='.base64_encode('coaching');

		$html='<a href="'.$url.'"><button>Book Now</button></a>';
		return $html;
	}
	 //#[podcasts limit=4]
	add_shortcode('podcasts', 'podcasts');
    function podcasts($atts){

		$limit=$atts['limit'];
		if(empty($limit)){
			$limit=20;
		}
		$args=array(
        'posts_per_page'   => $limit,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'podcasts',
        );
		$posts=get_posts($args);
		#pr($posts,1);

		$html='';
		foreach($posts as $post){

			$post_id=$post->ID;
			$post_title=$post->post_title;
			$image_url=get_the_post_thumbnail_url($post_id);
			$external_link=get_post_meta($post_id,'external_link',true);
			$html .='<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-d845bc7"  data-id="d845bc7" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-87a6a38 elementor-position-top elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="87a6a38" data-element_type="widget" data-widget_type="image-box.default">
				<div class="elementor-widget-container">
			<div class="elementor-image-box-wrapper"><figure class="elementor-image-box-img">
			<a href="'.$external_link.'" target="_blank">
			<img src="'.$image_url.'" class="attachment-full size-full" alt="" loading="lazy"width="400" height="400">
			</a>
			</figure>
			<div class="elementor-image-box-content"><h5 class="elementor-image-box-title"><a href="'.$external_link.'" target="_blank">'.$post_title.'</a></h5></div></div>		</div>
				</div>
		</div>
		</div>';
		}
		return $html;
	}

	//#[pillar limit=20]
	add_shortcode('pillar', 'pillar');
	function pillar($atts){
		$limit=$atts['limit'];
		if(empty($limit)){
			$limit=20;
		}
		$args=array(
        'posts_per_page'   => $limit,
        'orderby'          => 'post_title',
        'order'            => 'ASC',
        'post_type'        => 'pillar',
        );
		$posts=get_posts($args);
		$html='';
		foreach($posts as $post){

			$post_id=$post->ID;
			$post_title=$post->post_title;
			$post_content=$post->post_content;
			$image_url=get_the_post_thumbnail_url($post_id);
			$external_link=get_post_meta($post_id,'external_link',true);
			//pr($post);
			$html .='<section class="elementor-section elementor-inner-section elementor-element elementor-element-8953c21 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="8953c21" data-element_type="section">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-column elementor-col-66 elementor-inner-column elementor-element elementor-element-2ba5e0b" data-id="2ba5e0b" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
				<div class="elementor-element elementor-element-71f7298 elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="71f7298" data-element_type="widget" data-widget_type="icon-box.default">
					<div class="elementor-widget-container">
						<div class="elementor-icon-box-wrapper">
							<div class="elementor-icon-box-content">
								<h4 class="elementor-icon-box-title">
									<span><mark class="mark-peach first-letter"><span>'.substr($post_title,0,1).'</span>'.substr($post_title,1).'</mark></span>
								</h4>
								<p class="elementor-icon-box-description">'.$post_content.'</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-ecbbd2d" data-id="ecbbd2d" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
				<div class="elementor-element elementor-element-a0a338d link-text elementor-widget elementor-widget-text-editor" data-id="a0a338d" data-element_type="widget" data-widget_type="text-editor.default">
					<div class="elementor-widget-container">
						<div class="elementor-text-editor elementor-clearfix">View latest <a href="'.home_url().'/services/blogs-vlogs/blogs/?pillar='.$post->post_name.'">Blogs</a> or <a href="'.home_url().'/services/blogs-vlogs/vlogs/?pillar='.$post->post_name.'">Vlogs</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>';
		}
		return $html;

	}
	//#[podcast-pillar]
	add_shortcode('podcast-pillar', 'podcast_pillar');
	function podcast_pillar($atts){
		// $limit=$atts['limit'];
		if(empty($limit)){
			$limit=20;
		}
		$args=array(
        'posts_per_page'   => $limit,
        'orderby'          => 'post_title',
        'order'            => 'ASC',
        'post_type'        => 'pillar',
        );
		$posts=get_posts($args);
		$html='';
		foreach($posts as $post){

			$post_id=$post->ID;
			$post_title=$post->post_title;
			$post_content=$post->post_content;
			$image_url=get_the_post_thumbnail_url($post_id);
			$external_link=get_post_meta($post_id,'external_link',true);
			//pr($post);
			$html .='<section class="elementor-section custome-space-bottom elementor-inner-section elementor-element elementor-element-8953c21 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="8953c21" data-element_type="section">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-column elementor-col-66 elementor-inner-column elementor-element elementor-element-2ba5e0b" data-id="2ba5e0b" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
				<div class="elementor-element elementor-element-71f7298 elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="71f7298" data-element_type="widget" data-widget_type="icon-box.default">
					<div class="elementor-widget-container">
						<div class="elementor-icon-box-wrapper">
							<div class="elementor-icon-box-content">
								<h4 class="elementor-icon-box-title">
									<span><mark class="mark-peach first-letter"><span>'.substr($post_title,0,1).'</span>'.substr($post_title,1).'</mark></span>
								</h4>
								<p class="elementor-icon-box-description">'.$post_content.'</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-ecbbd2d" data-id="ecbbd2d" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
				<div class="elementor-element elementor-element-a0a338d link-text elementor-widget elementor-widget-text-editor" data-id="a0a338d" data-element_type="widget" data-widget_type="text-editor.default">
					<div class="elementor-widget-container">
						<div class="elementor-text-editor elementor-clearfix">View latest <a href="'.home_url().'/services/podcast/?pillar='.$post->post_name.'">Podcasts</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>';
		}
		return $html;

	}

?>