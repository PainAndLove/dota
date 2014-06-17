<?php
	class MatchDetails
	{
		private $season;
		private $radiant_win;
		private $duration;
		private $start_time;
		private $match_id;
		private $match_seq_num;
		private $tower_status_radiant;
		private $tower_status_dire;
		private $barracks_status_radiant;
		private $barracks_status_dire;
		private $cluster;
		private $first_blood_time;
		private $lobby_type;
		private $human_players;
		private $leagueid;
		private $positive_votes;
		private $negative_votes;
		private $game_mode;

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