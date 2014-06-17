<?php
class RequestMapper
	{
		private $url;
		
		/*input api-url
		**		api-key
		**		api的额外参数
		*/
		//注意此处已经写死用XML格式		
		public function setUrl($url,$api_key,$param=null)
		{
			$url=$url.'?';
			if($param){
				foreach($param as $key=>$value){
					$url=$url.$key.'='.$value.'&';
				}
			}
			$url=$url.'format=xml&';
			$url=$url.'key='.$api_key;
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
	        return $r;
		}
	}
?>