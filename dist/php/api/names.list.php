<?php
header("Content-type: application/json");
include('../init.php');
$qty = Input::get('qty');
if(is_numeric($qty)) {

	print(json_encode(array('status'  => array('code'=>'200', 'message' => 'OK'),
					        'results' => Suggestion::getSuggestions($qty))
		));

} else {

	print(json_encode(array('status' => array( 'code' => '401', 'message' => 'Invalid inputs'))
		));
	
}
