<?php
/*
	grunt.concat_in_order.declare('Remp_Admin_Notice');
	grunt.concat_in_order.require('init');
*/

Class Remp_Admin_Notice {


	protected $admin_notice = '';


	function __construct( $notice, $is_error = false ) {
		$this->admin_notice = $this->set_admin_notice( $notice, $is_error );
		add_action( 'admin_notices', array( $this, 'print_admin_notice') );
	}
	
	protected function set_admin_notice( $notice, $is_error ){
		
		$style = $is_error ? 'style="color: red; font-size: large;"' : '';
		$tag_open = '<p ' . $style . '>';
		$tag_close = '</p>';
			
		if( gettype( $notice ) == 'string' ){
			$admin_notice = $tag_open . $notice . $tag_close;
		} elseif ( gettype( $notice ) == 'array' ){

			// if ( count($notice) !== count($notice, COUNT_RECURSIVE) ) {	// is multidimensional
				
				ob_start();
				print('<pre ' . $style . '>');    
				print_r( $notice );
				print('</pre>');
				$admin_notice = ob_get_contents();
				ob_end_clean();
			
			// } else {	// is onedimensional
			// 	$admin_notice = $tag_open . implode( $tag_close . $tag_open , $notice ) . $tag_close;		
			// }
		} else {
			$admin_notice = $notice;
		}
		
		return $admin_notice;
		
	}
	
	public function print_admin_notice(){
		print( $this->admin_notice );
	}


}

?>