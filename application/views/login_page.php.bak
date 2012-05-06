<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">

* {
	margin: 0;
	padding:0;
}
body {
	background: #fff;
	text-align: center;
}

</style>
</head>
<body>



<?php echo panelshowTopLogout(' - logowanie') ?>

<form action="/index.php/Home/login" method="post">
<br>
<br>

<table border="0" cellpadding="7" cellspacing="7" style="border: 1px solid #003D4C; margin: 0 auto; text-align: left">
<tr><td>Nazwa użytkownika</td><td><?php echo form_input(array('name'=>'username', 'type'=>'text'), '', 'style="width:170px; height:27px; padding:0 5px"') ?></td></tr>
<tr><td>Hasło</td><td><?php echo form_input(array('name'=>'password', 'type'=>'password'),'', 'style="width:170px; height:27px; padding:0 5px"') ?></td></tr>
<tr><td colspan="2" style="color:red"><?php if (!empty($msg)) echo $msg?></td></tr>
<tr><td colspan="2" align="center"><?php echo showSubmit('Zaloguj')?></td></tr>
</table>






</form>

</body>
</html>