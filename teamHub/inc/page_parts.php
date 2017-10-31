<?php 

/**
* Helps create the shared parts of all pages
*/

class PAGE {
	
	public static function HEADER($page_title) {
		
		global $QUERY;
		global $DB;
		global $home_url;

		require_once "header.php";
	}

	public static function title($title) {
		
	}

	public static function checkRequiredParams(...$requiredParams) {
		
		foreach ($requiredParams as $value) {
	
			if (!isset($_GET[$value])) {
				header("Location: 404.php");
			}
		}

	}
	
	public static function FOOTER() {
		
		require_once "footer.php";

	}
}
