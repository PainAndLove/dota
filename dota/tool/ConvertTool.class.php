<?php
/*xml 转换为array
**array 转换为 xml
*/

class ConvertTool{

	/*@input array
	**output xml
	*/
	public static function arr2xml($arr,$node=null){
		if($node==null){
			$simxml=new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><root></root>');
		}else{
			$simxml=$node;
		}
		foreach ($arr as $key => $value) {
			//屏蔽数字打头标签
			if(is_numeric($key)){
				$key='item';
			}


			if(is_array($value)){
				self::arr2xml($value,$simxml->addChild($key));
			}else 
			if(is_scalar($value)){                //标量
				$simxml->addChild($key,$value);
			}
		}
		return $simxml->saveXML();
	}

	/*input simplexmlelement
	**output array
	*/
	public static function xml2arr($sim){
		$arr =(array)$sim;
		foreach ($arr as $key => $value) {
			if($value instanceof simplexmlelement || is_array($value))
			{
				$arr[$key]=self::xml2arr($value);
			}
		}
		return $arr;
	}
}

?>