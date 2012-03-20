<style>
    .ms {
        border: 1px solid green;
        visibility: visible !important;
    }
    .mf {
        border: 1px solid red;
        visibility: visible !important;
    }
    .mn {
        visibility: hidden;
        margin: 10px 0;
    }
    input[type="button"] {
        border:2px solid;
        border-radius:5px;
        -moz-border-radius:5px;
    }
</style>


<div class="mn <?php echo $msg_css ?>"><?php echo $msg ?></div>

<?php panelshowTop('Korony'); ?>
	
		<?php showLink('Dodaj', "/index.php/{$url}/edycja/0", '', true) ?><br><br>
		
		<?php panelShowTableTop() ?>
	
		<?php foreach($list->result() as $row): ?>
		
		<?php panelShowTableList(
			$row->id, 
			$row->code, 
			getLink('Edycja',"/index.php/{$url}/edycja/{$row->id}").' '.
			getLink('Usun',"#usun", "if(confirm('Potwierdz usuniecie'))location.href='/index.php/{$url}/usun/{$row->id}'")
			);	 
		?>
		
		<?php endforeach; ?>
		
		</table>


<?php panelShowBottom(); ?>



<br><br><br><br><br><br>
<form method="post" action="/index.php/Users/login">
    Logowanie:
    <input type="text" name="username" value="">
    <input type="password" name="password" value="">
    <input type="hidden" name="type" value="user">
    <input type="submit" value="zaloguj">
    <input type="button" value="wyloguj" onclick="location.href='/index.php/Users/logout'">
</form>
</br>