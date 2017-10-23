<?php 
	class Format{
		
		public function formatdate($data){
			return date("F j, Y, g:i a", strtotime($data));
		}

		public function textShorten($body, $limit = 400){
			$body = $body."";
			$body = substr($body, 0, $limit);
			$body = substr($body, 0, strrpos($body, ' '));
			$body = $body."....";
			return $body;
		}

		public function validation($data){
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function formattitle(){
			$path = $_SERVER['SCRIPT_FILENAME'];
			$title = basename($path, '.php');
			//$title = str_replace('_', ' ', $title);
			if ($title == 'index') {
				$title = 'home';
			}elseif ($title == 'contact') {
				$title = 'contact';
			}
			return $title = ucwords($title);
		}
	}

?>