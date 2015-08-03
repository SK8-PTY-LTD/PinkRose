<?php
/**
 * Title         : MC Theme Hooks
 * Version       : 1.0.0
 * Author        : Murat KARAÇAM
 * Author URI    : http://metcreative.com
 */

if( !class_exists('MC_Framework_Hook') ){
	class MC_Framework_Hook {

		/**
		 * The singleton instance
		 */
		static private $instance = null;

		public $dslc_active = false;
		public $met_fsc_params = array();

		/**
		 *
		 */
		function __construct() {
			global $dslc_active;
			$this->dslc_active = $dslc_active;

			add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		}

		/**
		 * No cloning allowed
		 */
		private function __clone() {}

		/**
		 * getInstance
		 */
		static public function getInstance() {
			if(self::$instance == null) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		function after_setup_theme(){
			global $met_options,$met_dev_log,$mb_fsc_options;

			$met_dev_log['test'] = $this->met_fsc_params;
		}

		function met_fsc_init($params){

		}
	}

	new MC_Framework_Hook();
}
