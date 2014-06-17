<?php
	class Slots
	{
		private $account_id;
		private $player_slot;
		private $hero_id;
		private $item_0;
		private $item_1;
		private $item_2;
		private $item_3;
		private $item_4;
		private $item_5;
		private $kills;
		private $deaths;
		private $assists;
		private $leaver_status;
		private $gold;
		private $last_hits;
		private $denies;
		private $gold_per_min;
		private $xp_per_min;
		private $gold_spent;
		private $hero_damage;
		private $tower_damage;
		private $hero_healing;
		private $level;
		
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