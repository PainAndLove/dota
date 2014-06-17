
<?php
	class A
	{
		private $u;

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

	$a=new A;
	$b='u';
	$a->$b='x';
	echo $a->u;

?>