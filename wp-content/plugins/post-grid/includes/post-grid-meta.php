<?php


function post_grid_posttype_register() {
 
        $labels = array(
                'name' => _x('Post Grid', 'post_grid'),
                'singular_name' => _x('Post Grid', 'post_grid'),
                'add_new' => _x('New Post Grid', 'post_grid'),
                'add_new_item' => __('New Post Grid'),
                'edit_item' => __('Edit Post Grid'),
                'new_item' => __('New Post Grid'),
                'view_item' => __('View Post Grid'),
                'search_items' => __('Search Post Grid'),
                'not_found' =>  __('Nothing found'),
                'not_found_in_trash' => __('Nothing found in Trash'),
                'parent_item_colon' => ''
        );
 
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => null,
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title'),
				'menu_icon' => 'dashicons-media-spreadsheet',
				
          );
 
        register_post_type( 'post_grid' , $args );

}

add_action('init', 'post_grid_posttype_register');





/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function meta_boxes_post_grid()
	{
		$screens = array( 'post_grid' );
		foreach ( $screens as $screen )
			{
				add_meta_box('post_grid_metabox',__( 'Post Grid Options','post_grid' ),'meta_boxes_post_grid_input', $screen);
			}
	}
add_action( 'add_meta_boxes', 'meta_boxes_post_grid' );


function meta_boxes_post_grid_input( $post ) {
	
	global $post;
	wp_nonce_field( 'meta_boxes_post_grid_input', 'meta_boxes_post_grid_input_nonce' );
	
	
	$post_grid_post_per_page = get_post_meta( $post->ID, 'post_grid_post_per_page', true );
	$post_grid_themes = get_post_meta( $post->ID, 'post_grid_themes', true );
	$post_grid_masonry_enable = get_post_meta( $post->ID, 'post_grid_masonry_enable', true );	
	
	$post_grid_bg_img = get_post_meta( $post->ID, 'post_grid_bg_img', true );	
	$post_grid_thumb_size = get_post_meta( $post->ID, 'post_grid_thumb_size', true );	
	$post_grid_empty_thumb = get_post_meta( $post->ID, 'post_grid_empty_thumb', true );

	$post_grid_social_share_display = get_post_meta( $post->ID, 'post_grid_social_share_display', true );	
	$post_grid_pagination_display = get_post_meta( $post->ID, 'post_grid_pagination_display', true );		

	$post_grid_excerpt_count = get_post_meta( $post->ID, 'post_grid_excerpt_count', true );	
	$post_grid_read_more_text = get_post_meta( $post->ID, 'post_grid_read_more_text', true );			
	
	$post_grid_query_order = get_post_meta( $post->ID, 'post_grid_query_order', true );	
	$post_grid_query_orderby = get_post_meta( $post->ID, 'post_grid_query_orderby', true );			
	$post_grid_posttype = get_post_meta( $post->ID, 'post_grid_posttype', true );	
	
	$post_grid_items_width = get_post_meta( $post->ID, 'post_grid_items_width', true );		
	$post_grid_thumb_height = get_post_meta( $post->ID, 'post_grid_thumb_height', true );	
	
	$post_grid_meta_author_display = get_post_meta( $post->ID, 'post_grid_meta_author_display', true );	
	$post_grid_meta_date_display = get_post_meta( $post->ID, 'post_grid_meta_date_display', true );		
	$post_grid_meta_categories_display = get_post_meta( $post->ID, 'post_grid_meta_categories_display', true );	
	$post_grid_meta_tags_display = get_post_meta( $post->ID, 'post_grid_meta_tags_display', true );		
	$post_grid_meta_comments_display = get_post_meta( $post->ID, 'post_grid_meta_comments_display', true );
	
	
	$post_grid_items = get_post_meta( $post->ID, 'post_grid_items', true );		
	$post_grid_wrapper = get_post_meta( $post->ID, 'post_grid_wrapper', true );	
	$post_grid_items_display = get_post_meta( $post->ID, 'post_grid_items_display', true );			
	$post_grid_post_meta_fields = get_post_meta( $post->ID, 'post_grid_post_meta_fields', true );	

?>

    <div class="para-settings post-grid-settings">
        <div class="option-box">
            <p class="option-title">Shortcode</p>
            <p class="option-info">Copy this shortcode and paste on page or post where you want to display post grid. <br />Use PHP code to your themes file to display post grid.</p>
			<textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" >[post_grid <?php echo ' id="'.$post->ID.'"';?> ]</textarea>
        <br /><br />
        PHP Code:<br />
        <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[post_grid id='; echo "'".$post->ID."' ]"; echo '"); ?>'; ?></textarea>  
		</div>


        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Options</li>
            <li nav="2" class="nav2">Style</li>
            <li nav="3" class="nav3">Content</li>
            <li nav="4" class="nav4">Grid Builder</li>            
        </ul> <!-- tab-nav end -->
        
		<ul class="box">
            <li style="display: block;" class="box1 tab-box active">
				<div class="option-box">
                    <p class="option-title">Grid Post per page</p>
                    <p class="option-info"></p>
					<input type="text" size="5"  name="post_grid_post_per_page" value="<?php if(!empty($post_grid_post_per_page))echo $post_grid_post_per_page; else echo 10; ?>" />                   
                </div>
                
				<div class="option-box">
                    <p class="option-title">Grid items width</p>
                    <p class="option-info">Value with px, or %</p>
					<input type="text" placeholder="ex: 250px" size="10"  name="post_grid_items_width" value="<?php if(!empty($post_grid_items_width))echo $post_grid_items_width; ?>" />                   
                </div>  
                
				     
                
				<div class="option-box">
                    <p class="option-title">Grid thumbnail height</p>
                    <p class="option-info">Value with px</p>
					<input type="text" placeholder="ex: 150px" size="10"  name="post_grid_thumb_height" value="<?php if(!empty($post_grid_thumb_height)) echo $post_grid_thumb_height; ?>" />                   
                </div>
                
                
				<div class="option-box">
                    <p class="option-title">Display Pagination</p>
                    <p class="option-info"></p>
                    
					<select name="post_grid_pagination_display"  >
                    <option value="yes" <?php if($post_grid_pagination_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($post_grid_pagination_display=="no")echo "selected"; ?>>No</option>                  
                    </select>
                  
                </div>                
                
                
                
                
                
                
               
            </li>
            <li style="display: none;" class="box2 tab-box ">
				<div class="option-box">
                    <p class="option-title">Themes</p>
                    <p class="option-info"></p>
					<select name="post_grid_themes"  >
                    <option value="flat" <?php if($post_grid_themes=="flat")echo "selected"; ?>>Flat</option>
                    <option value="rounded" <?php if($post_grid_themes=="rounded")echo "selected"; ?>>Rounded</option>
                  
                                       
                    
                    
                                    
                    </select>                 
                </div>
                
                
				<div class="option-box">
                    <p class="option-title">Active Masonry Grid</p>
                    <p class="option-info">Masonry Style grid.</p>
                    <select name="post_grid_masonry_enable"  >
                    <option  value="no" <?php if($post_grid_masonry_enable=="no")echo "selected"; ?>>No</option>
                    <option  value="yes" <?php if($post_grid_masonry_enable=="yes")echo "selected"; ?>>Yes</option>
             
                    </select>                 
                </div>                
                
                
                
                
                
                
                
                
                
				<div class="option-box">
                    <p class="option-title"><?php _e('Background Image.','post_grid'); ?></p>
                    <p class="option-info"><?php _e('Background image for post grid area.','post_grid'); ?></p>
                                           
            <script>
            jQuery(document).ready(function(jQuery)
                {
                        jQuery(".post_grid_bg_img_list li").click(function()
                            { 	
                                jQuery('.post_grid_bg_img_list li.bg-selected').removeClass('bg-selected');
                                jQuery(this).addClass('bg-selected');
                                
                                var post_grid_bg_img = jQuery(this).attr('data-url');
            
                                jQuery('#post_grid_bg_img').val(post_grid_bg_img);
                                
                            })	
            
                                
                })
            
            </script> 
                    
            
            <?php
            
            
            
                $dir_path = post_grid_plugin_dir."css/bg/";
                $filenames=glob($dir_path."*.png*");
            
            
                $post_grid_bg_img = get_post_meta( $post->ID, 'post_grid_bg_img', true );
                
                if(empty($post_grid_bg_img))
                    {
                    $post_grid_bg_img = "";
                    }
            
            
                $count=count($filenames);
                
            
                $i=0;
                echo "<ul class='post_grid_bg_img_list' >";
            
                while($i<$count)
                    {
                        $filelink= str_replace($dir_path,"",$filenames[$i]);
                        
                        $filelink= post_grid_plugin_url."css/bg/".$filelink;
                        
                        
                        if($post_grid_bg_img==$filelink)
                            {
                                echo '<li  class="bg-selected" data-url="'.$filelink.'">';
                            }
                        else
                            {
                                echo '<li   data-url="'.$filelink.'">';
                            }
                        
                        
                        echo "<img  width='70px' height='50px' src='".$filelink."' />";
                        echo "</li>";
                        $i++;
                    }
                    
                echo "</ul>";
                
                echo "<input style='width:100%;' value='".$post_grid_bg_img."'    placeholder='Please select image or left blank' id='post_grid_bg_img' name='post_grid_bg_img'  type='text' />";
            
            
            
            ?>
				</div> 
                
                
				<div class="option-box">
                    <p class="option-title"><?php _e('Thumbnail Size.','post_grid'); ?></p>
                    <p class="option-info"><?php _e('Thumbnail size of member on grid.','post_grid'); ?></p>
                    <select name="post_grid_thumb_size" >
                    <option value="none" <?php if($post_grid_thumb_size=="none") echo "selected"; ?>>None</option>
                    <option value="thumbnail" <?php if($post_grid_thumb_size=="thumbnail") echo "selected"; ?>>Thumbnail</option>
                    <option value="medium" <?php if($post_grid_thumb_size=="medium") echo "selected"; ?>>Medium</option>
                    <option value="large" <?php if($post_grid_thumb_size=="large") echo "selected"; ?>>Large</option>                               
                    <option value="full" <?php if($post_grid_thumb_size=="full") echo "selected"; ?>>Full</option>   

                    </select>
                </div>  
                
				<div class="option-box">
                    <p class="option-title">Empty Thumbnail</p>
                    <p class="option-info"></p>
					<input type="text" name="post_grid_empty_thumb" id="post_grid_empty_thumb" value="<?php if(!empty($post_grid_empty_thumb)) echo $post_grid_empty_thumb; ?>" /><br />
                    <input id="post_grid_empty_thumb_upload" class="post_grid_empty_thumb_upload button" type="button" value="Upload Image" />
                       <br />
                       
                       
                        <?php
                        	if(empty($post_grid_empty_thumb))
								{
								?>
                                <img class="post_grid_empty_thumb_display" width="300px" src="<?php echo post_grid_plugin_url.'css/no-thumb.png'; ?>" />
                                <?php
								}
							else
								{
								?>
                                <img class="post_grid_empty_thumb_display" width="300px" src="<?php echo $post_grid_empty_thumb; ?>" />
                                <?php
								}
						?>
                       
                       
                       
                       
                       
					<script>
                        jQuery(document).ready(function($){

                            var custom_uploader; 
                         
                            jQuery('#post_grid_empty_thumb_upload').click(function(e) {
													
                                e.preventDefault();
                         
                                //If the uploader object has already been created, reopen the dialog
                                if (custom_uploader) {
                                    custom_uploader.open();
                                    return;
                                }
                        
                                //Extend the wp.media object
                                custom_uploader = wp.media.frames.file_frame = wp.media({
                                    title: 'Choose Image',
                                    button: {
                                        text: 'Choose Image'
                                    },
                                    multiple: false
                                });
                        
                                //When a file is selected, grab the URL and set it as the text field's value
                                custom_uploader.on('select', function() {
                                    attachment = custom_uploader.state().get('selection').first().toJSON();
                                    jQuery('#post_grid_empty_thumb').val(attachment.url);
                                    jQuery('.post_grid_empty_thumb_display').attr('src',attachment.url);									
                                });
                         
                                //Open the uploader dialog
                                custom_uploader.open();
                         
                            });
                            
                            
                        })
                    </script>      
                </div>
                
				<div class="option-box">
                    <p class="option-title">Display Social Share Buttons</p>
                    <p class="option-info"></p>
					<select name="post_grid_social_share_display"  >
                    <option value="yes" <?php if($post_grid_social_share_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($post_grid_social_share_display=="no")echo "selected"; ?>>No</option>                    
                  
                                      
                  
                    </select>                 
                </div>                 
                
                
                
				               
                
                
                

                
                
				<div class="option-box">
                    <p class="option-title">Display Author</p>
                    <p class="option-info"></p>
					<select name="post_grid_meta_author_display"  >
                    <option value="yes" <?php if($post_grid_meta_author_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($post_grid_meta_author_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div> 
                
				<div class="option-box">
                    <p class="option-title">Display Date</p>
                    <p class="option-info"></p>
					<select name="post_grid_meta_date_display"  >
                    <option value="yes" <?php if($post_grid_meta_date_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($post_grid_meta_date_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div>
                
				<div class="option-box">
                    <p class="option-title">Display Categories</p>
                    <p class="option-info"></p>
					<select name="post_grid_meta_categories_display"  >
                    <option value="yes" <?php if($post_grid_meta_categories_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($post_grid_meta_categories_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div>
                
				<div class="option-box">
                    <p class="option-title">Display Tags</p>
                    <p class="option-info"></p>
					<select name="post_grid_meta_tags_display"  >
                    <option value="yes" <?php if($post_grid_meta_tags_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($post_grid_meta_tags_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div>
                
                
				<div class="option-box">
                    <p class="option-title">Display Comments Counts</p>
                    <p class="option-info"></p>
					<select name="post_grid_meta_comments_display"  >
                    <option value="yes" <?php if($post_grid_meta_comments_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($post_grid_meta_comments_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div>                          
                               
                                 
                

            </li>
            <li style="display: none;" class="box3 tab-box ">
				
                
				<div class="option-box">
                    <p class="option-title">Content excerpt count</p>
                    <p class="option-info"></p>
					<input type="text" placeholder="30" name="post_grid_excerpt_count" value="<?php if(!empty($post_grid_excerpt_count)) echo $post_grid_excerpt_count; ?>" /><br />                       
                    
                    <p class="option-title">Read more Text</p>
                    <p class="option-info"></p>
					<input type="text" placeholder="Read More" name="post_grid_read_more_text" value="<?php if(!empty($post_grid_read_more_text)) echo $post_grid_read_more_text; else echo 'Read More'; ?>" /><br />                   
                </div> 
                
                
                
				<div class="option-box">
                    <p class="option-title"><?php _e('Post query order','post_grid'); ?></p>
                    <p class="option-info"></p>
                    <select name="post_grid_query_order" >
                    <option value="ASC" <?php if($post_grid_query_order=="ASC") echo "selected"; ?>>ASC</option>
                    <option value="DESC" <?php if($post_grid_query_order=="DESC") echo "selected"; ?>>DESC</option>

                    </select>
                </div>
                
				<div class="option-box">
                    <p class="option-title"><?php _e('Post query orderby','post_grid'); ?></p>
                    <p class="option-info"></p>
                    <select name="post_grid_query_orderby" >
                    <option value="none" <?php if($post_grid_query_orderby=="none") echo "selected"; ?>>None</option>
                    <option value="ID" <?php if($post_grid_query_orderby=="ID") echo "selected"; ?>>ID</option>
                    <option value="date" <?php if($post_grid_query_orderby=="date") echo "selected"; ?>>Date</option>
                    <option value="rand" <?php if($post_grid_query_orderby=="rand") echo "selected"; ?>>Rand</option>                    <option value="comment_count" <?php if($post_grid_query_orderby=="comment_count") echo "selected"; ?>>Comment Count</option>                    
                    
                    <option value="author" <?php if($post_grid_query_orderby=="author") echo "selected"; ?>>Author</option>                                       
                    <option value="title" <?php if($post_grid_query_orderby=="title") echo "selected"; ?>>Title</option>
                    <option value="name" <?php if($post_grid_query_orderby=="name") echo "selected"; ?>>Name</option>                    <option value="type" <?php if($post_grid_query_orderby=="type") echo "selected"; ?>>Type</option>      
                    
                    
               

                    </select>
                </div>                
                
                
                
                
				<div class="option-box">
                    <p class="option-title">Grid Content Post type</p>
                    <p class="option-info"></p>
                    <?php
						
						$post_types = get_post_types( '', 'names' ); 
						
						foreach ( $post_types as $post_type ) {
						
							if($post_type=='post')
								{
								   echo '<label><input type="checkbox" name="post_grid_posttype['.$post_type.']"  value ="'.$post_type.'" ' ?> 
								   <?php if ( isset( $post_grid_posttype[$post_type] ) ) echo "checked"; ?>
								   <?php echo' >'. $post_type.'</label><br />' ;
							   
								}
							
								
								
						
							else
								{
								   echo '<label><input type="checkbox" name="post_grid_posttype['.$post_type.']"  value ="'.$post_type.'" ' ?> 
								   <?php if ( isset( $post_grid_posttype[$post_type] ) ) echo "checked"; ?>
								   <?php echo' >'. $post_type.'</label><br />' ;
						   
								}
						
						}
						?>
                </div>

            </li>
            <li style="display: none;" class="box4 tab-box ">
            
				<div class="option-box">
                    <p class="option-title">Grid Builder</p>
                    <p class="option-info"></p>
                    
                   
                    <?php
                    		$Postgridbuilder = new PostgridClass();
							echo $Postgridbuilder->settings_grid_items();
					
					?>
                    

 <script>
 jQuery(document).ready(function($)
	{
jQuery(function() {
$( ".items-container" ).sortable();
//$( ".items-container" ).disableSelection();
});

})

</script>        
                    
<script>
jQuery(document).ready(function($)
	{
		$( ".draggable" ).draggable();
        $( ".droppable, #droppable-inner" ).droppable({
            activeClass: "ui-state-hover",
            hoverClass: "ui-state-active",
            drop: function( event, ui ) {
				
				var drop_item_id = ui.draggable.attr('id');
				var drop_item_data_class = ui.draggable.attr('data-class');				
				var drop_item_title = ui.draggable.attr('title');
				
				if(drop_item_data_class == 'saved-item')
					{
					
					}
				else
					{
				
						//alert(ui.draggable.attr('id') + ' was dropped from ' + ui.draggable.parent().attr('id'));
						$( this ).addClass( "ui-state-highlight" );
						
						// Move the dragged element into its new container
						ui.draggable.attr('style','position:relative');
						
						
						var content = '<div id="'+drop_item_id+'" data-class="saved-item" class="saved-item draggable ui-draggable ui-draggable-handle ui-sortable-handle" style="position:relative"><div class="header">'+drop_item_title+'<span class="input-switch"><input id="switch-'+drop_item_id+'" class="switch" type="checkbox" name="post_grid_items_display['+drop_item_id+']">&nbsp;<label for="switch-'+drop_item_id+'" title="Display on grid ?">&nbsp;</label></span><span class="remove">X</span><input type="hidden" name="post_grid_items['+drop_item_id+']" value="'+drop_item_title+'" /></div><div class="options"><b>'+drop_item_title+'</b> wrapper <input placeholder="<div>" type="text" name="post_grid_wrapper['+drop_item_id+'][start]" value="" /><b>'+drop_item_title+'</b> goes here <input placeholder="</div>"  type="text" name="post_grid_wrapper['+drop_item_id+'][end]" value="" /></div></div>';
						
						
						$(this).children('.items-container').append(content);
					}
				

                
                return false;
            }            
        });
	})
</script>
                    
                    
                    
                    
                    
                </div> 
            </li>
        </ul>

    
    </div>
    
    
    

    
    
    
<?php


	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function meta_boxes_post_grid_save( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['meta_boxes_post_grid_input_nonce'] ) )
    return $post_id;

  $nonce = $_POST['meta_boxes_post_grid_input_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'meta_boxes_post_grid_input' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;



  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
	$post_grid_post_per_page = sanitize_text_field( $_POST['post_grid_post_per_page'] );	
	$post_grid_themes = sanitize_text_field( $_POST['post_grid_themes'] );
	$post_grid_masonry_enable = sanitize_text_field( $_POST['post_grid_masonry_enable'] );	
	
	$post_grid_bg_img = sanitize_text_field( $_POST['post_grid_bg_img'] );	
	
	$post_grid_thumb_size = sanitize_text_field( $_POST['post_grid_thumb_size'] );	
	$post_grid_empty_thumb = sanitize_text_field( $_POST['post_grid_empty_thumb'] );	
		
	$post_grid_social_share_display = sanitize_text_field( $_POST['post_grid_social_share_display'] );	
	$post_grid_pagination_display = sanitize_text_field( $_POST['post_grid_pagination_display'] );		
		

	$post_grid_excerpt_count = sanitize_text_field( $_POST['post_grid_excerpt_count'] );	
	$post_grid_read_more_text = sanitize_text_field( $_POST['post_grid_read_more_text'] );		
			
	$post_grid_query_order = sanitize_text_field( $_POST['post_grid_query_order'] );
	$post_grid_query_orderby = sanitize_text_field( $_POST['post_grid_query_orderby'] );	
	$post_grid_posttype = stripslashes_deep( $_POST['post_grid_posttype'] );
	
		
	$post_grid_items_width = sanitize_text_field( $_POST['post_grid_items_width'] );		

	$post_grid_thumb_height = sanitize_text_field( $_POST['post_grid_thumb_height'] );	
	
	$post_grid_meta_author_display = sanitize_text_field( $_POST['post_grid_meta_author_display'] );	
	$post_grid_meta_date_display = sanitize_text_field( $_POST['post_grid_meta_date_display'] );
	$post_grid_meta_categories_display = sanitize_text_field( $_POST['post_grid_meta_categories_display'] );	
	$post_grid_meta_tags_display = sanitize_text_field( $_POST['post_grid_meta_tags_display'] );	
	$post_grid_meta_comments_display = sanitize_text_field( $_POST['post_grid_meta_comments_display'] );		
	
	
	$post_grid_items = stripslashes_deep( $_POST['post_grid_items'] );	
	$post_grid_wrapper = stripslashes_deep( $_POST['post_grid_wrapper'] );
	$post_grid_items_display = stripslashes_deep( $_POST['post_grid_items_display'] );			
	$post_grid_post_meta_fields = sanitize_text_field( $_POST['post_grid_post_meta_fields'] );	

  // Update the meta field in the database.
	update_post_meta( $post_id, 'post_grid_post_per_page', $post_grid_post_per_page );	
	update_post_meta( $post_id, 'post_grid_themes', $post_grid_themes );
	update_post_meta( $post_id, 'post_grid_masonry_enable', $post_grid_masonry_enable );	
	
	update_post_meta( $post_id, 'post_grid_bg_img', $post_grid_bg_img );	
	
	update_post_meta( $post_id, 'post_grid_thumb_size', $post_grid_thumb_size );	
	update_post_meta( $post_id, 'post_grid_empty_thumb', $post_grid_empty_thumb );	
	update_post_meta( $post_id, 'post_grid_social_share_display', $post_grid_social_share_display );	
	update_post_meta( $post_id, 'post_grid_pagination_display', $post_grid_pagination_display );		

	update_post_meta( $post_id, 'post_grid_excerpt_count', $post_grid_excerpt_count );	
	update_post_meta( $post_id, 'post_grid_read_more_text', $post_grid_read_more_text );			
	
	update_post_meta( $post_id, 'post_grid_query_order', $post_grid_query_order );
	update_post_meta( $post_id, 'post_grid_query_orderby', $post_grid_query_orderby );	
	update_post_meta( $post_id, 'post_grid_posttype', $post_grid_posttype );	
	
	update_post_meta( $post_id, 'post_grid_items_width', $post_grid_items_width );	
	//update_post_meta( $post_id, 'post_grid_thumb_width', $post_grid_thumb_width );
	update_post_meta( $post_id, 'post_grid_thumb_height', $post_grid_thumb_height );
	
	update_post_meta( $post_id, 'post_grid_meta_author_display', $post_grid_meta_author_display );		
	update_post_meta( $post_id, 'post_grid_meta_date_display', $post_grid_meta_date_display );	
	update_post_meta( $post_id, 'post_grid_meta_categories_display', $post_grid_meta_categories_display );		
	update_post_meta( $post_id, 'post_grid_meta_tags_display', $post_grid_meta_tags_display );
	update_post_meta( $post_id, 'post_grid_meta_comments_display', $post_grid_meta_comments_display );	
	
	
	update_post_meta( $post_id, 'post_grid_items', $post_grid_items );	
	update_post_meta( $post_id, 'post_grid_wrapper', $post_grid_wrapper );
	update_post_meta( $post_id, 'post_grid_items_display', $post_grid_items_display );	
	update_post_meta( $post_id, 'post_grid_post_meta_fields', $post_grid_post_meta_fields );	
}
add_action( 'save_post', 'meta_boxes_post_grid_save' );






?>