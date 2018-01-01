<?php
class Helper{
	var $file;
	var $current;
	function __construct(){			
	}
	public function log($args){
		/*$this->$file = WP_PLUGIN_DIR."/sugreev/json/users.json"; 
		$this->$current = file_get_contents($this->$file);
		$this->$current .= $args."\n";
		file_put_contents($this->$file, $this->$current);*/
		$file = WP_PLUGIN_DIR."/sugreev/json/users.json"; 
		$current = file_get_contents($file);
		$current .= $args."\n";
		file_put_contents($file, $current);
	}
}