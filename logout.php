<?php
include('admin/dbcon.php');
include('session.php');
mysql_query ("update log set logout_Date = NOW() where student_id = '$session_id' ")or die(mysql_error());
session_destroy();
header('location:index.php?queued=dex.disconnected'); 
?>