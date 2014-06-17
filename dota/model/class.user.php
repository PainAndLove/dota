<?php
	class User
	{
		private $account_id;
		private $personaname;
		private $steamid;

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