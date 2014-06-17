<?php
	class PicksBan
	{
		private $match_id;
		private $is_pick;
		private $hero_id;
		private $team;
		private $order;

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