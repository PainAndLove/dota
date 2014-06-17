<?php
	class AbilityUpgrades
	{
		private $slots_id;
		private $ability;
		private $time;
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