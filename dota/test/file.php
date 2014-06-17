<?php
	$path='./';
	if(isset($_GET['dir']))
	{
		$path=$path.'/'.$_GET['dir'];
	}
	$dh=opendir($path);
	if($dh===false)
	{
		echo '打开出错';
		exit;
	}

	$list=array();

	while(($file=readdir($dh))!==false)
	{
		$list[]=$file;//自动追加
	}
	closedir($dh);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>新建网页</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="布尔教育 http://www.itbool.com" />

<style>
	td{
		border:2px solid gray;
	}
</style>
</head>
    <body>
    	<h1>文件管理系统</h1>
    	<table>
    		<tr>
    			<td>序号</td>
    			<td>文件名</td>
    			<td>操作</td>
    		</tr>

    		<?php foreach ($list as $k=>$v) { ?>
    			
    		<tr>
    			<td><?php echo $k?></td>
    			<td><?php echo $v?></td>
    			<td>
    				<?php 
	    				if(is_dir($path.'/'.$v)===true)
	    				{
	    					echo "<a href='file.php?dir=".$v."'>浏览</a>";
	    				}
	    				else
    					{
    						echo "<a href='".$v."'>下载</a>";
    					}
    				?>
    			</td>
    		</tr>

    		<?php }?>
    	</table>
    </body>
</html>