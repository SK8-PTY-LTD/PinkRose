<?php


class PostgridClass
	{
		
		public 	$grid_items = array('post_title'=>'Title',
									'content'=>'Content',
									'thumbnail'=>'Thumbnail',
									'meta'=>'Meta',									
									'social'=>'Social',
									'hover_items'=>'Hover Items',
									);
									
		public	$grid_items_properties = array('content'=> array('body','read_more'),
												'thumbnail'=> array('video','img'),
												'meta'=> array(	'post_date','post_author','terms','comments_count',),															
												'social'=> array('facebook','twitter','googleplus'),				
												'hover_items'=> array('zoom','link'),
												);
												
												
												
		public 	$post_grid_items_display = array('post_title'=>'on',
									'content'=>'on',
									'thumbnail'=>'on',
									'meta'=>'on',									
									'social'=>'on',
									'hover_items'=>'on',
									);												
												
												
												
												
												
									
									
									
									
	public function settings_grid_get_post_meta($post_id,$meta_key)
				{	
					return get_post_meta( $post_id, $meta_key, true );
				
				}								





	public function post_grid_settings_builder_saved_items()
				{

					global $post;
					$post_grid_items = $this->settings_grid_get_post_meta($post->ID, 'post_grid_items');
					$post_grid_wrapper = $this->settings_grid_get_post_meta($post->ID, 'post_grid_wrapper');
					$post_grid_items_display = $this->settings_grid_get_post_meta($post->ID, 'post_grid_items_display');
					$post_grid_post_meta_fields = $this->settings_grid_get_post_meta($post->ID, 'post_grid_post_meta_fields');					
					
					$html = '';
					
					if(empty($post_grid_items))
						{
							$post_grid_items = $this->grid_items;
						}
					
				
					foreach($post_grid_items as $key=>$name)
						{
							
							if(empty($post_grid_wrapper[$key]['start']))
								{
									$post_grid_wrapper[$key]['start'] = '';
								}
							
							if(empty($post_grid_wrapper[$key]['end']))
								{
									$post_grid_wrapper[$key]['end'] = '';
								}
								
								
								
								
					$html .= '<div class="saved-item" data-class="saved-item" id="'.$key.'"><div class="header">'.$name;
					if(!empty($post_grid_items_display[$key]))
						{
					$html .= '<span class="input-switch"><input checked type="checkbox" id="switch-'.$key.'" name="post_grid_items_display['.$key.']" class="switch" />
	<label title="Display on grid ?" for="switch-'.$key.'">&nbsp;</label>
</span>';

						}
					else
						{
					$html .= '<span class="input-switch"><input type="checkbox" id="switch-'.$key.'" name="post_grid_items_display['.$key.']" class="switch" />
	<label title="Display on grid ?" for="switch-'.$key.'">&nbsp;</label>
</span>';
						}

					$html .= '<span class="remove">X</span>';
					
					$html .= '</div>';
							
					$html .= '<input type="hidden" name="post_grid_items['.$key.']" value="'.$name.'" />';							
					$html .= '<div class="options">';
					$html .= '<b>'.$name.'</b> wrapper <input placeholder="<div>" type="text" name="post_grid_wrapper['.$key.'][start]" value="'.htmlentities($post_grid_wrapper[$key]['start'],ENT_QUOTES).'" /> <b>'.$name.'</b> goes here <input placeholder="</div>"  type="text" name="post_grid_wrapper['.$key.'][end]" value="'.htmlentities($post_grid_wrapper[$key]['end'],ENT_QUOTES).'" />';
					
					if($key =='meta_fields')
						{
							$html .= '<div class="options-meta_fields"><br /> <br />';
							$html .= 'Custom Meta Fields. comma separated';
							
							$html .= '<input style="width:80%" type="text" placeholder="post_view_count,post_share_count" name="post_grid_post_meta_fields['.$key.']" value="'.$post_grid_post_meta_fields.'" />';	
							$html .= '</div>';
						}

					
						
					$html .= '</div>';									
					$html .= '</div>';
					
	
								
						}
					return $html;
				}


	public function post_grid_settings_builder_items()
				{	
					global $post;
					$grid_items = $this->grid_items;
					$post_grid_wrapper = $this->settings_grid_get_post_meta($post->ID, 'post_grid_wrapper');
					$post_grid_items_display = $this->settings_grid_get_post_meta($post->ID, 'post_grid_items_display');
					$html = '';
				
				
					foreach($grid_items as $key=>$name)
						{
							
							if(empty($post_grid_wrapper[$key]['start']))
								{
									$post_grid_wrapper[$key]['start'] = '';
								}
							
							if(empty($post_grid_wrapper[$key]['end']))
								{
									$post_grid_wrapper[$key]['end'] = '';
								}
								
					$html .= '<div title="'.$name.'" class="item draggable" id="'.$key.'">'.$name;
					
																						
								
							$html .= '</div>';
					
	
								
						}
					return $html;
				}


			
	public function settings_grid_items()
				{
					global $post;
									
					$html = '';
					$html .= '<div class="post-grid-builder">';	
					$html .= '<div  class="items" id="items">';	
					$html .= '<p><b>Grid Items</b></p>';
					$html .= '<p>Post Grid items drag on <b>Grid Layout</b> to build your own layout.</p>';
					
					$html .= $this->post_grid_settings_builder_items();
					$html .= '</div>';
					$html .= '<div id="canvas" class="canvas droppable" >';	
					$html .= '<p><b>Grid Layout</b></p>';
					$html .= '<p>Drag-drop items to re-order. multiple items not supported for each. for example you can\'t add two "Title" on layout.</p>';
					$html .= '<div class="items-container sortable" >';	
					$html .= $this->post_grid_settings_builder_saved_items();
					$html .= '</div></div>';
					
					$html .= '</div>';						
									
									
					return $html;
				}
	
	
	public function post_grid_content()
				{
					
				}
		
	
	}