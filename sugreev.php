<?php 
    /*
    Plugin Name: Sugreev
    Plugin URI: 
    Description: Plugin for Posting to FB on publishing a new page
    Author: Koustubh Desai
    Version: 0.0.1
    Author URI: 
    */
    /*
	https://www.airpair.com/wordpress/posts/developing-wordpress-plugin-from-scratch
	https://developer.wordpress.org/reference/functions/add_action/
	https://codeable.io/how-to-import-json-into-wordpress/
	include(WP_PLUGIN_DIR."/sugreev/Helper.php");

    */
    include('Helper.php');
    class Sugreev{
    	//constructor
    	var $helper;
    	function __construct(){
    		$priority = 10;
    		$arguments = 2;
    		add_action('admin_menu',array($this,'wpa_add_menu'));
    		register_activation_hook(__File__,array($this,'wpa_install'));
    		register_deactivation_hook(__File__,array($this,'wpa_uninstall'));
    		add_action( 'publish_post', array($this,'onpublish'), $priority, $arguments );
    		$this->$helper = new Helper();
    		$this->$helper->log('4 In Sugreev Construct ');
    	}
    	function wpa_add_menu(){
    		add_menu_page('Sugreev Plugin','FBPublish','manage_options','sugreev-dashboard',array(
				__Class__,'wpa_page_file_path'
    			),plugins_url('images/wp-sugreev-logo.jpg',__File__),'');
    		/*add_submenu_page('sugreev-dashboard','Sugreevify simple'.' Dashboard ',' Dashboard ','manage_options',' Sugreev Dashboard ',array(
    			__Class__,'wpa_page_file_path'
    		));
    		add_submenu_page('sugreev-dashboard','Sugreevify simple'.' Settings ','<b style="color:#f9845b"> Settings </b> ','manage_options',' Sugreev settings ',array(
    			__Class__,'wpa_page_file_path'
    		));*/
    		
    	}
    	

    	/*
    	*Actions performed on loading of menu pages
    	*/
    	function wpa_page_file_path(){
    		echo 'hyoe';
    		include('sugreev_settings.php');
    	}
    	/*
    	*Actions performed on activation of plugin
    	*/
    	function wpa_install(){
    		$this->$helper->log(' 2Plugin Sugreev installed ');

    		
    		
    	}
    	/*
    	*Actions performed on de-activation of plugin
    	*/
    	function wpa_uninstall(){
    		
			$this->$helper->log(' Uninstalled Sugreev ');
    	}
    	function onpublish( $ID, $post ) {
    		$this->$helper->log(' Published ... ');
			/* Post author ID. */
		    $author = $post->post_author; 
		    $name = get_the_author_meta( 'display_name', $author );
		    $email = get_the_author_meta( 'user_email', $author );
		    $title = $post->post_title;
		    $permalink = get_permalink( $ID );
		    $edit = get_edit_post_link( $ID, '' );
		    $to[] = sprintf( '%s <%s>', $name, $email );
		    $subject = sprintf( 'Published: %s', $title );
		    $message = sprintf ('Congratulations, %s! Your article “%s” has been published.' . "\n\n", $name, $title );
		    $message .= sprintf( 'View: %s', $permalink );
		    $headers[] = '';
		    /*wp_mail( $to, $subject, $message, $headers );*/
		    $this->$helper->log(join('\n',array($author,$name,$email,$title,$permalink,$edit)));
		}

    }

new Sugreev();
?>
