<?PHP


	function sendMessage(){

		$token_notificacion=$_GET['token_notificacion'];
		$contenido=$_GET['contenido'];
		$pedido_id=$_GET['pedido_id'];
		$accion=$_GET['accion'];
		//$obj=$_REQUEST["obj"];
		$obj=$_GET['obj'];
		
		print_r($_GET);
		 
			$content = array(
				"en" => $contenido
				);
			
			$fields = array(
				'app_id' => "d972ea38-fbba-48de-ac2c-991904917c41",
				//'include_player_ids' => array($token_notificacion),
				'included_segments' => array('All'),
	      		'data' => array("contenido" => $contenido,"pedido_id"=>$pedido_id,"accion"=>$accion, "obj"=>$obj),
				'contents' => $content,
				'android_channel_id' => 'd3180c9d-44fc-4384-a49b-dd4b10609ad9',
				'android_sound' => 'notify',
				'ios_sound'=> 'notify',
				
			);
			
			$fields = json_encode($fields);
	    	print("\nJSON sent:\n");
	    	print($fields);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
														'Authorization: Basic NGMxNWE5YTItNjM2OC00NGNlLWE0NTYtYzNlNzg3NGI3OWNm'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			curl_close($ch);
			$pushes=$pushes.'"'.$server_output[$i]->push.'",';

		$pushes=substr($pushes, 0,-1);
		echo $pushes;
		
		return $response;
	}
	
	$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
  print("\n\nJSON received:\n");
	print($return);
  print("\n");
?>