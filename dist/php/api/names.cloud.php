<?php
header("Content-type: application/json");
include('../init.php');
$qty = Input::get('qty');
$theme = Input::get('theme');
if(is_numeric($qty)) {
	$return = array();
	foreach (Suggestion::getSuggestionsCloud($qty, $theme) as $value) {
		$return[] = array( 'text' => $value->text, 
							'weight' => $value->weight,
							'html' => array('title' => 'Click to upvote!')
						);
		//$return[] = array('text' => $value->text, 'weight' => $value->weight);
	}
	print(json_encode(array('status'  => array('code'=>'200', 'message' => 'OK'),
					        'results' => $return), JSON_NUMERIC_CHECK
		));

} else {

	print(json_encode(array('status' => array( 'code' => '401', 'message' => 'Invalid inputs'))
		));
	
}
