


<?php panelshowTop('Tło'); ?>

<form enctype="multipart/form-data" name="form" method="post" action="/index.php/<?php echo $url ?>/save">

		<div style="float:left;padding: 15px 10px 0 0">
			<?php echo inputFile('Obrazek (JPG):', 'file') ?>
		</div>
		<div style="float:left;">
			<?php echo getButton('Dodaj', 'document.form.submit()') ?>
		</div>
		<div style="clear:both"></div>
		


		
</form>
	
		<?php foreach($list->result() as $row): ?>

		<img style="max-width:150px; max-height: 150px; padding: 10px" src="/uploads/background_<?php echo $row->id ?>.jpg"> <?php echo getLink('Usuń',"#usun", "if(confirm('Potwierdź usunięcie'))location.href='/index.php/{$url}/usun/{$row->id}'"); ?> <br clear="all">		
		
		<?php endforeach; ?>
		
		</table>



<?php panelShowBottom(); ?>