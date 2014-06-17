<?php
define('ACC', true);
require('../include/init.php');

$am=new AdminModel();
echo $am->isAdmin('admin','11');
?>