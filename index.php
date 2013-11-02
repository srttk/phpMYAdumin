<?php
/*
* Author	:	Sarath
* Email		:	sarath.hacks@gmail.com
* Created	:	October 2013
*/
include('config/db.php');

if(isset($_POST['createDB'])){
	$crt_db=trim($_POST['crt_db']);
	$error_cdb=FALSE;
	if(strlen($crt_db)<1){
		$error_cdb=TRUE;
	}
	if($error_cdb==FALSE){
		$db->query("CREATE DATABASE ".$crt_db);
	}
}


$db_results=$db->query("SHOW DATABASES");
if($db_results->num_rows>0){
	while($_dbrow=$db_results->fetch_assoc())
			{
				$databases[]=$_dbrow;
			}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Adumin MySQL Manager- </title>
</head>
<style type="text/css">
*{
	margin: 0;
	padding: 0;
	font-family: Helvetica;
}
	.container{
		width: 1060px;
		margin: auto;
	}
	.header{
		background: #f55;
		color: #fff;
	}
	.left{
		width: 250px;
		background: #dedfdf;
		text-align: center;
		float: left;
	}
	.left ul{
		padding: 5px;
		background: #eff;
		text-align: left;
		list-style: none;
	}
	.right{
		background: #efefef;
		float: left;
		width: 800px;
		min-height: 490px;
		padding: 5px;
	}
	.holder{
		background: #fff;
		border-radius: 5px;
		margin-top:20px;
		padding: 20px;

	}
	.current{
		background: #66A7AA;
		border-radius: 5px;
		padding:1px 5px;
	}
	.rtable{
		border: solid 1px #454545;
		border-collapse: collapse;	
		padding: 3px;
		width: 400px;
	}
	.rtable tr th{
		background: #000;
		color: #fff;
	}
	.rtable tr td{
		border:dotted 1px #333;
	}
	.btn{
		border: none;
		background: #f55;
		color: #fff;
		padding: 2px;
		margin-left: 2px;
		cursor: pointer;
		border-radius: 3px;
	}
	.btn:hover{
		background: #f44;
	}

	.footer{
		background: #3f3f3f;
		width: 1060px;
		clear: both;
		text-align: center;
		color: #ccc;
		margin: auto;
	}
</style>
<body>
<?php
include('config/db.php');
?>
<div class="container">
	<div class="header">
		<h1>Adumin</h1>
	</div>
	<div class="left">
		<ul>
			<li> <h2>Databases</h2></li>
			<?php
			//var_dump($databases);
			if(isset($_GET['db'])){
				$cur_db=$_GET['db'];
			}else{$cur_db=NULL;}
			foreach ($databases as $s_db) {
				foreach ($s_db as $db_name) {
					if($cur_db==$db_name){$curdb_tab='class="current"';}else{$curdb_tab="";}
					echo '<li ><a '.$curdb_tab.' href="?db='.$db_name.'">'.$db_name.'</a></li>';
				}
			}
			?>
			<li style="margin-top:5px;"><form method="post"><input name="crt_db" type="text"/><input class="btn" type="submit" name="createDB" value="Create Db"></form></li>
		</ul>
	</div>
	<div class="right">
		<div class="holder">
			<?php
				if(isset($_GET['db']))
					{

						$_db=trim($_GET['db']);
						echo $dbhost.'>>'.$_db;
						$db->select_db($_db);
						$_tbl_result=$db->query("SHOW TABLES");
						if($_tbl_result){
							if($_tbl_result->num_rows>0){
							//Start table //
							echo '<table class="rtable"><tr><th>Tables</th><th>Actions</th></tr>';
							while ($_tbls=$_tbl_result->fetch_array()) {
								echo '<tr><td>'.$_tbls[0].'</td><td style="text-align:center;"><a title="Delete table" href="#">x</a></td></tr>';
							}
							echo '</table>';
							//End table//
							}
						}else{
							echo 'No database selected';
						}
						
					}else{echo '<h1>Welcome to Adumin 1.0</h1>';}
			?>
		</div>
	</div>
	
</div>
<div class="footer">
	&copy;2013 Sarath Production
</div>
</body>
</html>
