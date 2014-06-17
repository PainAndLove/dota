<?php
/*
 * 抽象类，用于初始化其余Model类
 */
	abstract class ObjectModel
	{
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