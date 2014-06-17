<?php
//水印：指定水印复制到图片上
//缩略图：建立两张画布  复制到小画布上

class ImageTool{
	public static function imageInfo($image){
		if(!file_exists($image)){
			return false;
		}
		$info=getimagesize($image);
		if($info==false){
			return false;
		}
		$img['width']=$info[0];
		$img['height']=$info[1];
		$img['ext']=substr($info['mime'],strpos($info['mime'], '/')+1);

		return $img;
	}

	//加水印 dst目标 water水印 保存在savePath里（默认替换原始图） alpha透明度 
	//pos位置(0左上，1右上，2右下，3左下)
	public static function water($dst,$water,$savePath=NULL,$pos=2,$alpha=50){
		if(!file_exists($dst)||!file_exists($water)){
			return false;
		}
		//保证水印不必待操作图片大
		$dinfo=self::imageInfo($dst);
		$winfo=self::imageInfo($water);

		if($winfo['height']>$dinfo['height'] || $winfo['width']>$dinfo['width']){
			return false;
		}

		//加水印 判断后缀确定函数名
		$dfunc='imagecreatefrom'.$dinfo['ext'];
		$dsaveFunc='image'.$dinfo['ext']; //保存函数
		$wfunc='imagecreatefrom'.$winfo['ext'];

		if(!function_exists($dfunc) ||!function_exists($wfunc)){
			return false;
		}

		$dim=$dfunc($dst);
		$wim=$wfunc($water);
		switch ($pos) {
			case 0:
				$posx=0;
				$posy=0;
				break;
			case 1:
				$posx=$dinfo['width']-$winfo['width'];
				$posy=0;
				break;
			case 3:
				$posx=0;
				$posy=$dinfo['height']-$winfo['height'];
				break;
			case 2:
			default:
				$posx=$dinfo['width']-$winfo['width'];
				$posy=$dinfo['height']-$winfo['height'];
				break;
		}
		imagecopymerge($dim, $wim, $posx, $posy, 0, 0, $winfo['width'], $winfo['height'], $alpha);

		if($savePath==NULL){
			$savePath=$dst;
			unlink($dst);//删除原图以便覆盖
		}

		$dsaveFunc($dim,$savePath);
		imagedestroy($dim);
		imagedestroy($wim);

		return true;
	}

	//缩略
	public static function thumb($dst,$savePath=NULL,$width=200,$height=200){
		$dinfo=self::imageInfo($dst);
		if($dinfo==false){
			return false;
		}

		$clac=min($width/$dinfo['width'],$height/$dinfo['height']);

		$dfunc='imagecreatefrom'.$dinfo['ext'];
		$dim=$dfunc($dst);
		$tim=imagecreatetruecolor($width, $height);//保存到tim里
		$white=imagecolorallocate($tim, 255, 255, 255);
		imagefill($tim, 0, 0, $white);

		$dwidth=(int)$dinfo['width']*$clac;
		$dheight=(int)$dinfo['height']*$clac;

		$paddingx=(int)($width-$dwidth)/2;
		$paddingy=(int)($height-$dheight)/2;
		//要两端留白 所以不能直接从0开始
		imagecopyresampled($tim, $dim, $paddingx, $paddingy, 0, 0, $dwidth, $dheight, $dinfo['width'],$dinfo['height']);

		if(!$savePath){
			$savePath=$dst;
			unlink($dst);
		}

		$saveFunc='image'.$dinfo['ext'];
		$saveFunc($tim,$savePath);

		imagedestroy($dim);
		imagedestroy($tim);
	}

	//还是得借助新建一个php过程页面来调用此函数中转 
	public static function getIdentifyCode($width=50,$height=25){
		$im=imagecreatetruecolor($width, $height);
		$white=imagecolorallocate($im, 255, 255, 255);
		$gray=imagecolorallocate($im, 190, 190, 190);
		$str=substr(str_shuffle('abcdefg123456789'),0,4);
		$randcolor=imagecolorallocate($im, mt_rand(150,250), mt_rand(150,250), mt_rand(150,250));
		imagefill($im, 0, 0, $randcolor);
		imagestring($im, 5, 5, 5, $str,	$white);
		$randcolor=imagecolorallocate($im, mt_rand(0,250), mt_rand(0,250), mt_rand(0,250));
		imageline($im, 0, mt_rand(0,25),  mt_rand(0,25), mt_rand(0,25), $randcolor);
		header('content-type:image/png');
		imagepng($im);
		imagedestroy($im);
	}
}
?>