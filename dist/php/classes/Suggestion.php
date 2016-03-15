<?php
class Suggestion {

	private $_db;

	public function __construct()
    {
    	$this->_db = DB::getInstance();
    }

    public function getSuggestions($qty){
    	$db = DB::getInstance();
		$sql = "SELECT * FROM rooms.suggestions WHERE `clean` = 1 ORDER BY datetime desc LIMIT " . $qty;
		$data = $db->query($sql);					
		return $data->results();
    }

    public function getThemes(){
    	$db = DB::getInstance();
		$sql = "SELECT * FROM rooms.themes";
		$data = $db->query($sql);					
		return $data->results();
    }

    public function getSuggestionsCloud($qty, $theme){
    	if($theme){
    		$sql_theme = " AND rooms.themes.id = " . $theme;
    	}
    	$db = DB::getInstance();
		$sql = "SELECT 
				    name text, themeName theme, COUNT(name) weight
				FROM
				    rooms.suggestions
				LEFT JOIN rooms.themes on rooms.themes.id = rooms.suggestions.theme
				WHERE
				    `clean` = 1 " . $sql_theme . "
				GROUP BY name , theme
				ORDER BY datetime DESC LIMIT 	" . $qty;
		$data = $db->query($sql);					
		return $data->results();
    }

    private function checkIP($name, $theme, $userIp) {
    	$sql = "SELECT count(*) as count FROM rooms.suggestions where `name` = '".$name."' and `ip` = '".$userIp."' and `theme` = '".$theme."'";
    	$data = $this->_db->query($sql)->first()->count;
    	if($data == 0) {
    		return true;
    	}
    	return false;
    }

    public function addSuggestion($name, $theme, $user){
    	$date = date("Y/m/d H:i:s"). substr((string)microtime(), 1, 3);
    	$userIp = getUserIP();

		//check for profanities
		$censor = new Snipe\BanBuilder\CensorWords;
		$censor->setDictionary('en-uk');
		$censored = $censor->censorString($name);

		if(count($censored['matched']) > 0){
			// add to censor table
			if($this->checkIP($name, $theme, $userIp)){
				$sql = "INSERT INTO `rooms`.`suggestions` (`theme`, `name`, `user`, `datetime`, `ip`, `clean`) VALUES ('".$theme."', '".$name."', '".$user."', '".$date."', '".$userIp."', '0')";

				$data = $this->_db->query($sql);				
				if(!$data->error()){
					return array('type' => 'PROFANITY', 'msg' => $censored);
				} else {
					return array('type' => 'DATABASE', 'msg' => $data->errorInfo());
				}
			} else {
				return array('type' => 'LOGIC', 'msg' => 'User already submitted this');
			}
		} else {
			// check if IP has submitted already
			if($this->checkIP($name, $theme, $userIp)){
				$sql = "INSERT INTO `rooms`.`suggestions` (`theme`, `name`, `user`, `datetime`, `ip`, `clean`) VALUES ('".$theme."', '".$name."', '".$user."', '".$date."', '".$userIp."', '1')";

				$data = $this->_db->query($sql);			
				if(!$data->error()){
					return True;
				} else {
					return array('type' => 'DATABASE', 'msg' => $data->errorInfo());
				}
			} else {
				return array('type' => 'LOGIC', 'msg' => 'You have already submitted this idea!');
			}
		}
    }

}