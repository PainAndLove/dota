<?php
	require 'config.php';
	class Request
	{
		private $url;
		



		public function setUrl($url,$param)
		{
			$config=new Config;
			$url=$url.'?';
			foreach($param as $key=>$value)
				$url=$url.$key.'='.$value.'&';
			$url=$url.'key='.$config->getKey();
			$this->url=$url;
		}

		public function send()
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->url);
	        curl_setopt($ch, CURLOPT_ENCODING , "gzip");
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        // Ignore SSL warnings and questions
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

	        $r = curl_exec($ch);
	        curl_close($ch);
	        libxml_use_internal_errors(true);
	        var_dump($r);
		}
	}
?>