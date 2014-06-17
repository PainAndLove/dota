<?php
class KeyBoxTool
	{
		private $api_getLiveLeagueGames="http://api.steampowered.com/IDOTA2Match_570/GetLiveLeagueGames/v1/";
		private $api_getMatchDetails="http://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/v1";
		private $api_getMatchHistory="http://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/v1";
		private $api_getPlayerSummaries="http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/";
		
		private $array_key=array('BDFA0FFFE3181AF0A905C2A77AD95CE9','9F9CBB13D386CDCAACED51CA41E9F132','D47E7CEF4ADD5420E652A1EEB451E4B4','DB358F888DF525ECA92ADBE2902A1AF6');
		private $key_total=4;

		public function __construct()
		{
			$this->host='localhost';
			$this->user='root';
			$this->pwd='';
			$this->database='mysql';
	
		}

		//获取数字密匙
		public function getKey()
		{
			$count=rand(0,$this->key_total-1);
			return $this->array_key[$count];
		}

		public function __set($name,$value)
		{
			$this->$name=$value;
		}

		public function __get($name)
		{
			if(isset($this->$name))
				return $this->$name;
			else
				return NULL;
		}
	}
?>