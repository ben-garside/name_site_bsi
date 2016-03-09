<?php
header("Content-type: application/json");
include('../init.php');




$name = Input::get('name');
$user = Input::get('user');
$theme = Input::get('theme');

if($name && is_numeric($theme)) {
	$sug = new Suggestion();
	$newSug = $sug->addSuggestion($name, $theme, $user);
	if($newSug === True){
		print(json_encode(array('status' => array('code'=>'200', 'message' => 'OK')
			)));
	} else {
	print(json_encode(array('status' => array('code'=>'401', 'message' => $newSug)
			)));
	}

} else {
	print(json_encode(array('status'  => array('code'=>'401', 'message' => 'Invalis inputs')
		)))	;
}