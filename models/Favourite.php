<?php

include('dbconnect.php');

class Favourite {

	public function getFavourites(){
		$query = 'SELECT * FROM favourites';
		$queryConn = mysql_query($query);
		$result = array();
		if($queryConn){
			while($row = mysql_fetch_array($queryConn, MYSQL_ASSOC))
			{
				$result[] = $row;
			}

			ob_start();
			include "../templates/favourites-list.html";
			$content = ob_get_contents();
			ob_end_clean();
			
			$response = array(
				'success' => true,
				'content' => $content
			);
			
			echo json_encode($response);
		}
	}
	
	public function add($data){
		$checkQuery = 'SELECT * FROM favourites WHERE woeid = ' . $data['woeId'];
		$check = mysql_query($checkQuery);
		$row = mysql_fetch_array($check);
		
		if(!$row){
			$query = 'INSERT INTO favourites (location, woeid) VALUES("' . $data['location'] . '", ' . $data['woeId'] . ')';
			mysql_query($query) or die('Couldnt save!');
		} else {
			$response = array(
				'success' => false,
				'exists' => true
			);
			return json_encode($response);
			die();
		}
	}
	
	public function delete($data){
		$query = 'DELETE FROM favourites WHERE woeid = ' . $data['woeId'];
		mysql_query($query) or die('Couldnt delete!');
	}

}