<?php

/*
 * MC Mega Menu(wp-content/plugins/mc-mega-menu) plugin is active, use mmm walker class for filters.
 * */
if( class_exists( 'MET_Mega_Menu_Walker' ) ){
	new MET_Mega_Menu_Walker();

	function mmm_post_thumbnail_url($thumb_url){
		return aq_resize($thumb_url, str_replace('px','',met_option('mmm_posts_item_size','width')), str_replace('px','',met_option('mmm_posts_item_size','height')),true,true,true);
	}add_filter('mmm_post_thumbnail_url','mmm_post_thumbnail_url');

	function mmm_tabbed_post_thumbnail_url($thumb_url){
		return aq_resize($thumb_url, str_replace('px','',met_option('mmm_tabbed_posts_item_size','width')), str_replace('px','',met_option('mmm_tabbed_posts_item_size','height')),true,true,true);
	}add_filter('mmm_tabbed_post_thumbnail_url','mmm_tabbed_post_thumbnail_url');

	function mmm_tabbed_post_thumbnail_effect($post_id){
		return met_option('mmm_tabbed_item_effect');
	}add_filter('mmm_tabbed_post_thumbnail_effect','mmm_tabbed_post_thumbnail_effect');

	function mmm_post_thumbnail_effect($post_id){
		return met_option('mmm_posts_item_effect');
	}add_filter('mmm_post_thumbnail_effect','mmm_post_thumbnail_effect');
}else{
	/*
	 * MC Mega Menu(wp-content/plugins/mc-mega-menu) plugin is not active, create new class with filters for Jade main nav output.
	 *
	 * This walker class simple version of MC Mega Menu class, just create regular nav output for Jade.
	 * */
	if( !class_exists( 'Jade_Main_Nav_Walker' ) ){
		class Jade_Main_Nav_Walker {

			var $mmm_key = '_mmm_options';

			var $mmm_item = 0;
			var $mmm_item_depth = array();
			var $mmm_item_icon = array();

			var $mmm_html_markup = array();
			var $mmm_html_markup_values = array();

			var $mmm_nav_item_class = array();

			public function __construct() {

				$this->mmm_html_markup = array(
					'start_el' => array(
						'li' => '{$indent}<li {$item_atts}>',
						'a'  => '{$args.before}<a {$link_atts}>{$args.link_before}{$the_title}{$args.link_after}</a>{$args.after}'
					),
					'end_el' => array(
						'li'		=> '</li><!-- #menu-item-{$menu_ID} -->'."\n",
					),
					'start_lvl' => array(
						'default' 		=>	"\n" .'{$indent}<ul {$item_atts}>'. "\n",
					),
					'end_lvl' => array(
						'default' 		=>	'{$indent}</ul>'."\n",
					)
				);

				add_filter( 'the_title', array( $this, 'met_mega_menu_the_title' ), 10, 2 );

				add_filter( 'mmm_start_el', array( $this, 'met_mega_menu_start_el' ) );
				add_filter( 'mmm_end_el', array( $this, 'met_mega_menu_end_el' ) );
				add_filter( 'mmm_start_lvl', array( $this, 'met_mega_menu_start_lvl' ) );
				add_filter( 'mmm_end_lvl', array( $this, 'met_mega_menu_end_lvl' ) );

				add_filter( 'mmm_parse_html_markup', array( $this, 'met_mega_menu_parse_html_markup' ), 10, 3 );
				add_filter( 'mmm_nav_atts', array( $this, 'met_mega_menu_nav_atts' ), 10, 3 );
			}

			function met_mega_menu_the_title( $title, $id ) {
				$output = '';

				if( isset($this->mmm_item_data[$id]) ){ //we need to filter only mega menu titles.
					if( isset($this->mmm_item_icon[$id]) ){
						$output .= $this->mmm_item_icon[$id];
					}

					$output .= '<span class="met-menu-item-label">';
					if( isset($this->mmm_item_depth[$id]) AND $this->mmm_item_depth[$id] == 0 AND !empty($title) ){
						$output .= '<span>';
						$output .= $title;
						$output .= '</span>';
					}else{
						$output .= $title;
					}

					if(
						( isset($this->mmm_item_depth[$id]) AND $this->mmm_item_depth[$id] === 0 AND met_option('primary_nav_desc_status') ) OR
						( isset($this->mmm_item_depth[$id]) AND $this->mmm_item_depth[$id] >= 1 AND met_option('primary_nav_dropdown_desc_status') )
					){
						if( isset($this->mmm_item->description) AND !empty($this->mmm_item->description) ){
							$output .= '<small class="met-menu-item-desc">';
							$output .= $this->mmm_item->description;
							$output .= '</small>';
						}
					}

					$output .= '</span>'; //.met-menu-item-label
				}else{
					$output = $title; //its not mega menu item, return original title.
				}

				return $output;
			}

			function met_mega_menu_parse_html_markup( $markup_id, $el_id, $markup_values ) {

				$markup = $this->mmm_html_markup[$markup_id][$el_id];

				$keys = $values = array();
				foreach ($markup_values as $key => $value) {
					if( is_array($value) ){
						foreach($value as $sub_key => $sub_value){
							$keys[] = '{$'.$key.'.'.$sub_key.'}';
							$values[] = $sub_value;
						}
					}else{
						$keys[] = '{$'.$key.'}';
						$values[] = $value;
					}
				}

				return str_replace($keys, $values, $markup);

			}

			function met_mega_menu_nav_atts($atts = array(), $doImplode = false, $implodeGlue = ''){

				if(count($atts)){
					foreach ( $atts as $attr => $value ) {
						if(is_array($value)) $value = implode(' ',$value);

						if ( ! empty( $value ) ) {
							$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
							$item_atts_result[] = $attr . '="' . $value . '"';
						}
					}
					return ($doImplode) ? implode($implodeGlue,$item_atts_result) : $item_atts_result;
				}else{
					return;
				}
			}

			function met_mega_menu_start_el( $el_data = array() ) {
				$item_atts = $link_atts = array();
				$final_output = null;

				$menu_item 		= $el_data['item'];
				$menu_depth		= $el_data['depth'];
				$menu_args		= $el_data['args'];

				$this->mmm_item								= $menu_item;
				$this->mmm_item_depth[$menu_item->ID]		= $menu_depth;

				/*
				 * Prepare Menu Item Icon Output
				 * */
				if( $menu_depth >= 1 ){
					$this->mmm_item_icon[$menu_item->ID]			= '<i class="met-menu-icon fa fa-caret-right"></i>';
				}

				/*
				 * Link Atts (<a>)
				 * */
				if( $menu_depth === 0 ) $link_atts['class'][] = 'met_vcenter';
				$link_atts['class'][] = 'menu-link';
				$link_atts['title']  = ! empty( $menu_item->attr_title ) ? $menu_item->attr_title : '';
				$link_atts['target'] = ! empty( $menu_item->target )     ? $menu_item->target     : '';
				$link_atts['rel']    = ! empty( $menu_item->xfn )        ? $menu_item->xfn        : '';
				$link_atts['href']   = ! empty( $menu_item->url )        ? $menu_item->url        : '';
				$link_atts = apply_filters('nav_menu_link_attributes', $link_atts, $menu_item, $menu_args);
				$link_atts = apply_filters('mmm_nav_atts', $link_atts, true, ' ');

				/*
				 * Item Atts (<li>)
				 * */
				$indent = ( $menu_depth ) ? str_repeat( "\t", $menu_depth ) : '';

				$item_atts_id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $menu_item->ID, $menu_item, $menu_args );
				$item_atts['id'] = $item_atts_id ? esc_attr( $item_atts_id ) : '';

				$item_atts['class'][] = 'menu-item-' . $menu_item->ID;

				$item_atts['class'][] = ( $menu_depth == 0 ? 'main-menu-item' : 'sub-menu-item' );
				$item_atts['class'][] = ( $menu_depth >=2 ? 'sub-sub-menu-item' : '' );
				$item_atts['class'][] = ( $menu_depth % 2 ? 'menu-item-odd' : 'menu-item-even' );
				$item_atts['class'][] = 'menu-item-depth-' . $menu_depth;

				if( $menu_depth === 0 ) $item_atts['class'][] = 'met_vcenter';

				$item_atts_class = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
				$item_atts['class'][] = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $item_atts_class ), $menu_item ) ) );

				$item_atts = apply_filters('mmm_nav_atts', $item_atts, true, ' ');

				$the_title = apply_filters('the_title', $menu_item->title, $menu_item->ID);

				$item_output = apply_filters('mmm_parse_html_markup', 'start_el', 'li', array(
					'item_atts' => $item_atts,
					'indent' => $indent
				));

				$link_output = apply_filters('mmm_parse_html_markup', 'start_el', 'a', array(
					'args' => array(
						'before' 		=> $menu_args->before,
						'after' 		=> $menu_args->after,
						'link_before' 	=> $menu_args->link_before,
						'link_after' 	=> $menu_args->link_after
					),
					'link_atts' => $link_atts,
					'the_title' => $the_title,
				));

				$final_output = $item_output.apply_filters( 'walker_nav_menu_start_el', $link_output, $menu_item, $menu_depth, $menu_args );

				return $final_output;
			}

			function met_mega_menu_end_el( $el_data = array() ) {
				$posts_output = null;

				$menu_item 		= $el_data['item'];
				$menu_depth		= $el_data['depth'];
				$menu_args		= $el_data['args'];

				$output = apply_filters('mmm_parse_html_markup', 'end_el', 'li', array(
					'menu_ID' 		=> $menu_item->ID,
				));

				return $output;
			}

			function met_mega_menu_start_lvl( $lvl_data = array() ){
				$item_atts = array();
				$output = null;

				$depth = $lvl_data['depth'];
				$args = $lvl_data['args'];

				$indent = str_repeat("\t", $depth);
				$display_depth = ( $depth + 1);

				$item_atts['class'] = array(
					'sub-menu',
					( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
					( $display_depth >=2 ? 'sub-sub-menu' : '' ),
					'menu-depth-' . $display_depth
				);

				$item_atts = apply_filters('mmm_nav_atts',$item_atts,true,' ');

				$output = apply_filters('mmm_parse_html_markup', 'start_lvl', 'default', array(
					'indent' => $indent,
					'item_atts' => $item_atts,
				));

				return $output;
			}

			function met_mega_menu_end_lvl( $lvl_data = array() ){
				$output = $tab_item_data = $tab_category_output = null;

				$depth = $lvl_data['depth'];
				$args = $lvl_data['args'];

				$indent = str_repeat("\t", $depth);

				$output = apply_filters('mmm_parse_html_markup', 'end_lvl', 'default', array(
					'indent' => $indent,
				));

				return $output;
			}
		}
	}

	new Jade_Main_Nav_Walker();
}


if(!class_exists('Jade_Walker_Nav_Menu')){
	/**
	 * Create HTML list of nav menu items.
	 *
	 * @since 3.0.0
	 * @uses Walker
	 */
	class Jade_Walker_Nav_Menu extends Walker_Nav_Menu {

		/**
		 * What the class handles.
		 *
		 * @see Walker::$tree_type
		 * @since 3.0.0
		 * @var string
		 */
		var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

		/**
		 * Database fields to use.
		 *
		 * @see Walker::$db_fields
		 * @since 3.0.0
		 * @todo Decouple this.
		 * @var array
		 */
		var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= apply_filters('mmm_start_lvl', array(
				'depth'			=> $depth,
				'args'			=> $args,
			));
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= apply_filters('mmm_end_lvl', array(
				'depth'			=> $depth,
				'args'			=> $args,
			));
		}

		/**
		 * Start the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 * @param int    $id     Current item ID.
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$output .= apply_filters('mmm_start_el', array(
				'item' 			=> $item,
				'depth'			=> $depth,
				'args'			=> $args,
			));
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @see Walker::end_el()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Page data object. Not used.
		 * @param int    $depth  Depth of page. Not Used.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= apply_filters('mmm_end_el', array(
				'item' 			=> $item,
				'depth'			=> $depth,
				'args'			=> $args,
			));
		}
	} // Jade_Walker_Nav_Menu
}