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
    }
    input[type="button"] {
        border:2px solid;
        border-radius:5px;
        -moz-border-radius:5px;
    }
</style>


<div class="mn <?php echo $msg_css ?>"><?php echo $msg ?></div>

<?php panelshowTop('Slupy'); ?>

		<?php showLink('Dodaj', "/index.php/{$url}/edycja/0", '', true) ?><br><br>
		
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
			getLink('Edycja',"/index.php/{$url}/edycja/{$row->id}").' '.
			getLink('Usuń',"#usun", "if(confirm('Potwierdz usuniecie'))location.href='/index.php/{$url}/usun/{$row->id}'")
			);	 
		?>
		
		<?php endforeach; ?>
		
		</table>



<?php panelShowBottom(); ?>