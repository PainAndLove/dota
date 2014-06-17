<?php
	require_once 'class.object.php';
	class AdditionalUnits
	{
		private $slots_id;
		private $unitname;
		private $item_0;
		private $item_1;
		private $item_2;
		private $item_3;
		private $item_4;
		private $item_5;

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