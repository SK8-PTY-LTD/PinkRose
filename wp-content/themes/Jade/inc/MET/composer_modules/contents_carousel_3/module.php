<?php

// Register Module
add_action('dslc_hook_register_modules',
    create_function('', 'return dslc_register_module( "MET_ContentsCarousel3" );')
);

class MET_ContentsCarousel3 extends DSLC_Module {

    var $module_id = 'MET_ContentsCarousel3';
    var $module_title = 'Vertical with Image';
    var $module_icon = 'info';
    var $module_category = 'met - post carousels';

    function options() {

        $post_type_categoryArgs = categoryArgs('', '', 1);

        $dslc_options = array(

            /**
             * Click to Edit Contents
             */
            array(
                'label' => __( 'Title', 'dslc_string' ),
                'id' => 'head_title',
                'std' => 'EDIT TITLE',
                'type' => 'text',
                'visibility' => 'hidden'
            ),
            array(
                'label' => __( 'View All', 'dslc_string' ),
                'id' => 'view_all',
                'std' => 'View All',
                'type' => 'text',
                'visibility' => 'hidden'
            ),

            /**
             * Elements Visibility Options
             */
            array(
                'label' => __( 'Elements', 'dslc_string' ),
                'id' => 'elements',
                'std' => 'head head_title view_all navigation image title date content',
                'type' => 'checkbox',
                'choices' => array(
                    array(
                        'label' => __( 'Head', 'dslc_string' ),
                        'value' => 'head'
                    ),
                    array(
                        'label' => __( 'Head Title', 'dslc_string' ),
                        'value' => 'head_title'
                    ),
                    array(
                        'label' => __( 'View All', 'dslc_string' ),
                        'value' => 'view_all'
                    ),
                    array(
                        'label' => __( 'Navigation', 'dslc_string' ),
                        'value' => 'navigation'
                    ),
                    array(
                        'label' => __( 'Image', 'dslc_string' ),
                        'value' => 'image'
                    ),
                    array(
                        'label' => __( 'Title', 'dslc_string' ),
                        'value' => 'title'
                    ),
                    array(
                        'label' => __( 'Date', 'dslc_string' ),
                        'value' => 'date'
                    ),
                    array(
                        'label' => __( 'Content', 'dslc_string' ),
                        'value' => 'content'
                    ),
                )
            ),
            array(
                'label' => __( 'Posts Amount', 'dslc_string' ),
                'id' => 'amount',
                'std' => '3',
                'type' => 'text',
            ),
            array(
                'label' => __( 'Post Type', 'dslc_string' ),
                'id' => 'post_type',
                'std' => $post_type_categoryArgs[0]['value'],
                'type' => 'select',
                'choices' => $post_type_categoryArgs
            ),
            array(
                'label' => __( 'Category IDs [Seperate with "," Comma]', 'dslc_string' ),
                'id' => 'category_ids',
                'std' => '',
                'type' => 'text',
            ),
            array(
                'label' => __( 'Order By', 'dslc_string' ),
                'id' => 'orderby',
                'std' => 'date',
                'type' => 'select',
                'choices' => array(
                    array(
                        'label' => __( 'Publish Date', 'dslc_string' ),
                        'value' => 'date'
                    ),
                    array(
                        'label' => __( 'Modified Date', 'dslc_string' ),
                        'value' => 'modified'
                    ),
                    array(
                        'label' => __( 'Random', 'dslc_string' ),
                        'value' => 'rand'
                    ),
                    array(
                        'label' => __( 'Alphabetic', 'dslc_string' ),
                        'value' => 'title'
                    ),
                    array(
                        'label' => __( 'Comment Count', 'dslc_string' ),
                        'value' => 'comment_count'
                    ),
                )
            ),
            array(
                'label' => __( 'Order', 'dslc_string' ),
                'id' => 'order',
                'std' => 'DESC',
                'type' => 'select',
                'choices' => array(
                    array(
                        'label' => __( 'Ascending', 'dslc_string' ),
                        'value' => 'ASC'
                    ),
                    array(
                        'label' => __( 'Descending', 'dslc_string' ),
                        'value' => 'DESC'
                    )
                )
            ),
            array(
                'label' => __( 'Offset', 'dslc_string' ),
                'id' => 'offset',
                'std' => '0',
                'type' => 'text',
            ),
            array(
                'label' => __( 'Max Length ( amount of words )', 'dslc_string' ),
                'id' => 'excerpt_length',
                'std' => '20',
                'type' => 'text'
            ),
            array(
                'label' => __( 'Resize - Height', 'dslc_string' ),
                'id' => 'thumb_resize_height',
                'std' => '',
                'type' => 'text'
            ),
            array(
                'label' => __( 'Resize - Width', 'dslc_string' ),
                'id' => 'thumb_resize_width_manual',
                'std' => '150',
                'type' => 'text',
            ),
            array(
                'label' => __( 'Resize - Width', 'dslc_string' ),
                'id' => 'thumb_resize_width',
                'std' => '150',
                'type' => 'text',
                'visibility' => 'hidden'
            ),

            /**
             * General Options
             */
            array(
                'label' => __( 'View All Link', 'dslc_string' ),
                'id' => 'view_all_link',
                'std' => '#',
                'type' => 'text'
            ),
        );

        $dslc_options = array_merge(
            $dslc_options,

            // Box
            lc_general('.met_content_box', '', array('background-color' => ''), 'Box'),

            // Head Background Color
            lc_general('.met_content_box header', 'Head', array('background-color' => '')),

            // Head Fonts
            lc_general('.met_content_box header span', 'Head', array('color' => '','font-size' => '19','line-height' => '25'), 'Title'),

            // Head View All Fonts
            lc_general('.met_content_box header a', 'Head', array('color' => '','color:hover' => '','font-size' => '12','line-height' => '25'), 'View All'),

            // Head Paddings
            lc_paddings('.met_content_box header', 'Head', array('t' => '15', 'r' => '30', 'b' => '15', 'l' => '30')),

            // Navigation Prev
            lc_general('.met_upcoming_events_prev', 'Navigation', array('background-color' => '', 'color' => '', 'color:hover' => '', 'font-size' => '12', 'width' => '50'), 'Previous'),

            // Navigation Next
            lc_general('.met_upcoming_events_next', 'Navigation', array('background-color' => '', 'color' => '', 'color:hover' => '', 'font-size' => '12', 'width' => '50'), 'Next'),

            // Title
            lc_general('.met_box_carousel_title', 'Title', array('color' => '', 'color:hover' => '', 'font-size' => '18', 'line-height' => '19', 'font-weight' => '400')),

            // Date
            lc_general('.met_box_carousel_date', 'Date', array('color' => '', 'color:hover' => '', 'font-size' => '12')),

            // Content
            lc_general('.met_p', 'Content', array('color' => '', 'font-size' => '14', 'line-height' => '22', 'text-shadow' => '#FFFFFF')),

            // Content Paddings
            lc_paddings('article', 'Content', array('t' => '30', 'r' => '30', 'b' => '30', 'l' => '30'))
        );

        $dslc_options = array_merge( $dslc_options, $this->presets_options() );
		return apply_filters( 'dslc_module_options', $dslc_options, $this->module_id );

    }

    function output( $options ) {

        global $dslc_active;

        if ( $dslc_active && is_user_logged_in() && current_user_can( DS_LIVE_COMPOSER_CAPABILITY ) )
            $dslc_is_admin = true;
        else
            $dslc_is_admin = false;


        $this->module_start( $options );

        /* Module output starts here */
        $asyncScripts = "[]";
        if ( $dslc_is_admin )
            $asyncScripts = '["'.get_template_directory_uri().'/js/jquery.bxslider.min.js"]';
        else
            wp_enqueue_script('metcreative-bxslider');

        if ( ! isset( $options['excerpt_length'] ) ) $options['excerpt_length'] = 20;

        // General args
        $args = array(
            'post_type' => $options['post_type'],
            'posts_per_page' => $options['amount'],
            'order' => $options['order'],
            'orderby' => $options['orderby'],
            'offset' => $options['offset']
        );

        // Category args
        $args = array_merge($args, categoryArgs($options['post_type'], $options['category_ids']));

        // Do the query
        $dslc_query = new WP_Query( $args );

        // Main Elements
        $elements = $options['elements'];
        if ( ! empty( $elements ) )
            $elements = explode( ' ', trim( $elements ) );
        else
            $elements = array();


        $elementID = uniqid('carousel_');
        ?>

        <div id="<?php echo $elementID ?>" class="met_content_box">
            <?php if( in_array( 'head', $elements ) ) : ?>
                <header>
                    <?php if( in_array( 'head_title', $elements ) ) : ?>
                        <?php if( $dslc_is_admin ): ?>
                            <span class="dslca-editable-content" data-id="head_title" data-type="simple" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?>><?php echo stripslashes($options['head_title']); ?></span>
                        <?php elseif( !empty($options['head_title'] ) && !$dslc_is_admin): ?>
                            <span><?php echo stripslashes($options['head_title']); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if( in_array( 'view_all', $elements ) ) : ?>
                        <?php if( $dslc_is_admin ): ?>
                            <a href="<?php echo $options['view_all_link']; ?>" class="met_color2 dslca-editable-content" data-id="view_all" data-type="simple" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?>><?php echo stripslashes($options['view_all']); ?></a>
                        <?php elseif( !empty($options['view_all'] ) && !$dslc_is_admin): ?>
                            <a href="<?php echo $options['view_all_link']; ?>" class="met_color2"><?php echo stripslashes($options['view_all']); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if( in_array( 'navigation', $elements ) ) : ?>
                        <nav class="met_carousel_nav_on_header">
                            <a href="#" class="met_upcoming_events_prev met_transition previous"><i class="dslc-icon dslc-icon-chevron-up"></i></a>
                            <a href="#" class="met_upcoming_events_next met_transition next"><i class="dslc-icon dslc-icon-chevron-down"></i></a>
                        </nav>
                    <?php endif; ?>
                </header>
            <?php endif; ?>
            <section>
                <?php
                if ( $dslc_query->have_posts() ){
                    ?>
                    <div class="met_box_carousel vertical" data-carousel-mode="vertical" data-carousel-min="2" data-carousel-max="2">
                    <?php
                        while ( $dslc_query->have_posts() ) : $dslc_query->the_post();
                            $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                            $thumb_url = $thumb_url[0];
                            if(!empty($thumb_url)):
                        ?>
                        <article class="clearfix">
                            <?php
                            if( in_array( 'image', $elements ) && !empty($thumb_url) ) :
                                $resizedImage = imageResizing($thumb_url,$options['thumb_resize_height'],$options['thumb_resize_width_manual']);
                            ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <img src="<?php echo $resizedImage['url']; ?>" alt="<?php the_title(); ?>">
                                </a>
                            <?php endif; ?>
                            <div>
                                <?php if( in_array( 'title', $elements ) ) : ?>
                                    <a class="met_box_carousel_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <?php endif; ?>

                                <?php if( in_array( 'date', $elements ) ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="met_box_carousel_date met_color"><?php the_time( get_option( 'date_format' ) ); ?></a>
                                <?php endif; ?>

                                <?php if( in_array( 'content', $elements ) ) : ?>
                                    <div class="met_p" style="text-shadow: -1px -1px 0 <?php echo $options['met_p_text_shadow'] ?>"><?php echo wp_trim_words( get_the_excerpt(), $options['excerpt_length'] ); ?></div>
                                <?php endif; ?>
                            </div>
                        </article>
                        <?php
                            endif;
                        endwhile;
                        ?>
                    </div>
                    <?php
                }else{
                    if ( $dslc_is_admin ) :
                        ?><div class="met_latest_blog_box clearfix"><div class="dslc-notification dslc-red">You do not have any events at the moment. Go to <strong>WP Admin &rarr; Events</strong> to add some. <span class="dslca-refresh-module-hook dslc-icon dslc-icon-refresh"></span></span></div></div><?php
                    endif;
                }
                ?>
            </section>
        </div>
        <script>jQuery(document).ready(function(){CoreJS.loadAsync(<?php echo $asyncScripts; ?>,["boxCarousel|<?php echo $elementID ?>"]);});</script>
        <?php

        /* Module output ends here */
        wp_reset_query();
        $this->module_end( $options );

    }

}