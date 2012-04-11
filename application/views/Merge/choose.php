<style>
    input[type="button"] {
        border:2px solid;
        border-radius:5px;
        -moz-border-radius:5px;
    }
</style>


<div class="mn <?php echo $msg_css ?>"><?php echo $msg ?></div>

<?php panelshowTop('Łączenie wybór elementu głównego '); ?>
	
	
<form name="form" action="/index.php/<?php echo $url?>/merge">

<?php echo form_hidden('src', $src)?>	
<?php echo form_hidden('dst', $dst)?>

<b>Wybierz element główny:</b><br>
<?php echo form_dropdown('id', $options)?>	

<?php panelShowSubmitCancel($url); ?>
</form>		
		

<?php panelShowBottom(); ?>
