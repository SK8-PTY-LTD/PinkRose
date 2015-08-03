<?php


function post_grid_themes_flat($post_id)
	{
		
		$post_grid_themes = get_post_meta( $post_id, 'post_grid_themes', true );
		$post_grid_masonry_enable = get_post_meta( $post_id, 'post_grid_masonry_enable', true );		
		
		$post_grid_bg_img = get_post_meta( $post_id, 'post_grid_bg_img', true );		
		$post_grid_thumb_size = get_post_meta( $post_id, 'post_grid_thumb_size', true );
		$post_grid_empty_thumb = get_post_meta( $post_id, 'post_grid_empty_thumb', true );		
			
		$post_grid_post_per_page = get_post_meta( $post_id, 'post_grid_post_per_page', true );
		$post_grid_social_share_display = get_post_meta( $post_id, 'post_grid_social_share_display', true );		
		$post_grid_pagination_display = get_post_meta( $post_id, 'post_grid_pagination_display', true );		

		$post_grid_excerpt_count = get_post_meta( $post_id, 'post_grid_excerpt_count', true );		
		$post_grid_read_more_text = get_post_meta( $post_id, 'post_grid_read_more_text', true );					
		
		$post_grid_bg_img = get_post_meta( $post_id, 'post_grid_bg_img', true );
		$post_grid_items_width = get_post_meta( $post_id, 'post_grid_items_width', true );				
		$post_grid_thumb_height = get_post_meta( $post_id, 'post_grid_thumb_height', true );	

		$post_grid_query_order = get_post_meta( $post_id, 'post_grid_query_order', true );
		$post_grid_query_orderby = get_post_meta( $post_id, 'post_grid_query_orderby', true );		
		$post_grid_posttype = get_post_meta( $post_id, 'post_grid_posttype', true );
		$post_grid_taxonomy = get_post_meta( $post_id, 'post_grid_taxonomy', true );
		$post_grid_taxonomy_category = get_post_meta( $post_id, 'post_grid_taxonomy_category', true );				
		
		$post_grid_meta_author_display = get_post_meta( $post_id, 'post_grid_meta_author_display', true );		
		$post_grid_meta_date_display = get_post_meta( $post_id, 'post_grid_meta_date_display', true );				
		$post_grid_meta_categories_display = get_post_meta( $post_id, 'post_grid_meta_categories_display', true );
		$post_grid_meta_tags_display = get_post_meta( $post_id, 'post_grid_meta_tags_display', true );		
		$post_grid_meta_comments_display = get_post_meta( $post_id, 'post_grid_meta_comments_display', true );		
		
		$post_grid_items = get_post_meta( $post_id, 'post_grid_items', true );		
		$post_grid_wrapper = get_post_meta( $post_id, 'post_grid_wrapper', true );		
		$post_grid_items_display = get_post_meta( $post_id, 'post_grid_items_display', true );		
		
		if(empty($post_grid_items))
			{
			$post_grid_items = array('post_title'=>'Title',
											'content'=>'Content',
											'thumbnail'=>'Thumbnail',
											'meta'=>'Meta',
											'social'=>'Social',
											'hover_items'=>'Hover Items',
											'woocommerce'=>'WooCommerce'
											);
			}
		
		if(empty($post_grid_items_display))
			{
			$post_grid_items_display = array('post_title'=>'on',
											'content'=>'on',
											'thumbnail'=>'on',
											'meta'=>'on',
											'social'=>'on',
											'hover_items'=>'on',
											'woocommerce'=>'on'
											);
			}		
		
		
		
		
		
		
		
		if(empty($post_grid_read_more_text))
			{
				$post_grid_read_more_text = 'Read More.';
			}
			
		if(empty($post_grid_excerpt_count))
			{
				$post_grid_excerpt_count = 30;
			}

		

		$html  = '';
		$html .= '<div style="background:url('.$post_grid_bg_img.');" class="post-grid-container-main" >'; 	
		$html .= '<div class="post-grid-container post-grid-container-'.$post_id.' '.$post_grid_themes.' " >'; 
		$html .= '<div class="post-grid-items" >'; 
		
		
		
		if ( get_query_var('paged') ) {
		
			$paged = get_query_var('paged');
		
		} elseif ( get_query_var('page') ) {
		
			$paged = get_query_var('page');
		
		} else {
		
			$paged = 1;
		
		}
		
		
		
		if(!empty($post_grid_taxonomy))
			{
				$wp_query = new WP_Query(
					array (
						'post_type' => $post_grid_posttype,
						'post_status' => 'publish',
						'tax_query' => array(
							array(
								   'taxonomy' => $post_grid_taxonomy,
								   'field' => 'id',
								   'terms' => $post_grid_taxonomy_category,
							)
						),
						
						'orderby' => $post_grid_query_orderby,
						'order' => $post_grid_query_order,
						'posts_per_page' => $post_grid_post_per_page,
						'paged' => $paged
						) );	
			}
		else
			{
				$wp_query = new WP_Query(
					array (
						'post_type' => $post_grid_posttype,
						'post_status' => 'publish',
						'orderby' => $post_grid_query_orderby,
						'order' => $post_grid_query_order,
						'posts_per_page' => $post_grid_post_per_page,
						'paged' => $paged
						) );
			}

		if ( $wp_query->have_posts() ) :
		
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
		
		
		$html .= '<div class="grid-single" style="max-width:'.$post_grid_items_width.';" >';
		foreach($post_grid_items as $key=>$items)
			{
				if($key == 'post_title')
					{
						if(!empty($post_grid_items_display[$key]))
							{
								if(!empty($post_grid_wrapper[$key]['start']))
									{
										$html .=$post_grid_wrapper[$key]['start'];
									}
								else
									{
										$html .= '<div class="title">';
									}

								$html .= get_the_title();

								if(!empty($post_grid_wrapper[$key]['end']))
									{
										$html .=$post_grid_wrapper[$key]['end'];
									}
								else
									{
										$html .= '</div >';	
									}
	
							}
						
					}
				elseif($key == 'content')
					{
						if(!empty($post_grid_items_display[$key]))
							{
							$content = get_the_content();
							$content =  wp_trim_words( $content , $post_grid_excerpt_count, ' <a class="read-more" href="'.get_the_permalink().'">'.$post_grid_read_more_text.'</a>' );
							
							if(!empty($post_grid_wrapper[$key]['start']))
								{
								
									$html .=$post_grid_wrapper[$key]['start'];
								}
							else
								{
									$html .= '<div class="content">';
								}
								
							$html .= $content;	
							
							if(!empty($post_grid_wrapper[$key]['end']))
								{
								
									$html .=$post_grid_wrapper[$key]['end'];
								}
							else
								{
									$html .= '</div >';	
								}
													
													
							
							}

					}
				elseif($key == 'thumbnail')
					{
						
						if(!empty($post_grid_items_display[$key]))
							{
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $post_grid_thumb_size );
							$thumb_url = $thumb['0'];		
	
							if(empty($thumb_url))
								{
								$thumb_url = $post_grid_empty_thumb;
								}
	
							if(!empty($post_grid_wrapper[$key]['start']))
								{
									$html .=$post_grid_wrapper[$key]['start'];
								}
							else
								{
									$html .= '<div class="thumb" style="max-height:'.$post_grid_thumb_height.';" >';
								}
	
								
							$html .= '<img src="'.$thumb_url.'" />';	
							
							if(!empty($post_grid_wrapper[$key]['end']))
								{
									$html .=$post_grid_wrapper[$key]['end'];
								}
							else
								{
									$html .= '</div >';	
								}
	
							
							}
						
	
					}
				elseif($key == 'meta')
					{
						if(!empty($post_grid_items_display[$key]))
							{
								
							if(!empty($post_grid_wrapper[$key]['start']))
								{
									$html .=$post_grid_wrapper[$key]['start'];
								}
							else
								{
									$html .= '<div class="meta">';
								}
								
							
							
							if($post_grid_meta_date_display == 'yes')		
							$html .= '<span class="date">'.get_the_date('M d Y').'</span>';	
							
							if($post_grid_meta_author_display == 'yes')
							$html .= '<span class="author">'.get_the_author().'</span>';
							
							if(!empty($category_output) && $post_grid_meta_categories_display == 'yes')
							$html .= '<span class="cayegory">'.trim($category_output, $separator).'</span>';
							
							if(!empty($tags_links) && $post_grid_meta_tags_display == 'yes')
							$html .= '<span class="tags">'.$tags_links.'</span>';
							
							$total_comments = wp_count_comments( get_the_ID() );
							if($post_grid_meta_comments_display == 'yes')		
							$html .= '<span class="comments">'.$total_comments->approved.'</span>';	
							
							
							if(!empty($post_grid_wrapper[$key]['end']))
								{
									$html .=$post_grid_wrapper[$key]['end'];
								}
							else
								{
									$html .= '</div >';
								}
							
							
							
							
							
							
							
							}

	
					}
				elseif($key == 'social')
					{
						if(!empty($post_grid_items_display[$key]))
							{
								
								
							if(!empty($post_grid_wrapper[$key]['start']))
								{
									$html .=$post_grid_wrapper[$key]['start'];
								}
							else
								{
									$html .= '<div class="social-icon">';
								}

							
							$html .= '
								<span class="fb">
									<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.get_permalink().'"> </a>
								</span>
								<span class="twitter">
									<a target="_blank" href="https://twitter.com/intent/tweet?url='.get_permalink().'&text='.get_the_title().'"></a>
								</span>
								<span class="gplus">
									<a target="_blank" href="https://plus.google.com/share?url='.get_permalink().'"></a>
								</span>
							';
							
							
							if(!empty($post_grid_wrapper[$key]['end']))
								{
									$html .=$post_grid_wrapper[$key]['end'];
								}
							else
								{
									$html .= '</div >';	
								}
							
							
							
							
								
							}
						
					
							
					}


				if($key == 'hover_items')
					{
						if(!empty($post_grid_items_display[$key]))
							{
								if(!empty($post_grid_wrapper[$key]['start']))
									{
										$html .=$post_grid_wrapper[$key]['start'];
									}
								else
									{
										$html .= '<div class="hover-items">';
									}

								//$html .= '<a title="Zoom." class="zoom"></a>';
								$html .= '<a title="Read More." href="'.get_the_permalink().'" class="post-link"></a>';

								if(!empty($post_grid_wrapper[$key]['end']))
									{
										$html .=$post_grid_wrapper[$key]['end'];
									}
								else
									{
										$html .= '</div >';	
									}
	
							}
						
					}

				if($key == 'woocommerce')
					{
						
						$is_product = get_post_type( get_the_ID() );
						$active_plugins = get_option('active_plugins');
						
						if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product')
							{
								if(!empty($post_grid_items_display[$key]))
									{
										if(!empty($post_grid_wrapper[$key]['start']))
											{
												$html .=$post_grid_wrapper[$key]['start'];
											}
										else
											{
												$html .= '<div class="pg-woocommerce">';
											}
											
										global $woocommerce, $product;
										
										$price = $product->get_price_html();
										$cart = do_shortcode('[add_to_cart id="'.get_the_ID().'"]');
										$rating = $product->get_average_rating();
										$rating = (($rating/5)*100);
										$html .= '<div class="pg-price">'.$price.'</div>';
										$html .= '<div class="pg-cart">'.$cart.'</div>';
										$html .= '<div class="pg-rating woocommerce"><div class="woocommerce-product-rating"><div class="star-rating" title="Rated '.$rating.'"><span style="width:'.$rating.'%;"></span></div></div></div>';																
		
										if(!empty($post_grid_wrapper[$key]['end']))
											{
												$html .=$post_grid_wrapper[$key]['end'];
											}
										else
											{
												$html .= '</div >';	
											}
			
									}
							}
						
						

						
					}



				else
					{
						
					}
					
			}
		$html .= '</div >';	
			
		endwhile;
		
		
		$html .= '</div >';	
		
		
		
		
				
		if($post_grid_pagination_display == 'yes')
			{
				$html .= '<div class="paginate">';
				$big = 999999999; // need an unlikely integer
				$html .= paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, $paged ),
					'total' => $wp_query->max_num_pages
					) );
			
				$html .= '</div >';	
			}					

		//$html .= '<div class="load-more"><span postid="'.$post_id.'" per_page="'.$post_grid_post_per_page.'" offset="'.$post_grid_post_per_page.'" class="load">Load More</span></div >';

		
		
		
		wp_reset_query();
		endif;
			
		$html .= '</div>';
		$html .= '</div>';
		
		
		
		
		if($post_grid_masonry_enable == 'yes' )
			{
				$html .= '<script>
				jQuery(document).ready(function($) {
				var container = document.querySelector(".post-grid-container-'.$post_id.' .post-grid-items");
				var msnry = new Masonry( container, {isFitWidth: true
				
				});
				});
				</script>';	
				
				
				
				$html .= '<style type="text/css">
				
						.post-grid-container-'.$post_id.' .post-grid-items {
						  margin: 0 auto !important;
						}
						</style>
						';

			}
		
		
		
		
		
		
		return $html;
	}