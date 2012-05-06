<style>
    input[type="button"] {
        border:2px solid;
        border-radius:5px;
        -moz-border-radius:5px;
    }
</style>

<?php panelshowTop('Oprawy'); ?>

		<?php showLink('Dodaj', "/konfigurator.php/{$url}/edycja/0", '', true) ?><br><br>
		
		<?php panelShowTableTop() ?>
	
		<?php 
		$iter = 1;
		foreach($list->result() as $row): ?>
		
		<?php 
		panelShowTableList(
			//$row->id, 
			$iter++, 
			$row->title, 
			$row->street, 
			$row->garden, 
			$row->width.' x '.$row->height,
			getLink('Edycja',"/konfigurator.php/{$url}/edycja/{$row->id}").' '.
			getLink('Usuń',"#usun", "if(confirm('Potwierdź usunięcie'))location.href='/konfigurator.php/{$url}/usun/{$row->id}'")

			);	 
		?>
		
		<?php endforeach; ?>
		
		</table>


<?php panelShowBottom(); ?>
