<style type="text/css">
    #password {
        display: none;
    }
     .input_text {
    	height: 40px;
    	font-size:17px;
    	color: black;
    	padding: 0 0 0 0;
    	width: 100%;
    	font-family: arial;
    	margin: 3px 0 15px 0;
    }
    hr.break {
    	margin: 10px 0;
    	background: #003D4C;
    	height: 1px;
    	line-height: 1px;
    	
    	border:none;
    	border-top:1px solid #003D4C;
    	
    }
    
</style>

<?php panelshowTop('Korony - dodaj/edytuj'); ?>

<form enctype="multipart/form-data" name="form" method="post" action="/index.php/<?php echo $url ?>/save">

<input type="hidden" name="id" value="<?php echo $id; ?>">


<div style="float:left; width: 504px;">
<!-- KOLUMNA LEWA -->
	<?php echo inputText('Nazwa:', 'title', $title) ?>
	<?php echo inputTextarea('Opis:', 'description', $description) ?>
<!-- e:KOLUMNA LEWA -->
</div>
<div style="float:left; width: 440px;"><div style="padding:0 0 0 20px">
<!-- KOLUMNA PRAWA -->

	Typ: <?php echo form_dropdown('mode', array('stand'=>' Do opraw stojących', 'hang'=>' Do opraw wiszących'), $mode); ?>
	<hr class="break">	

	<?php echo form_checkbox('street', 1, $street); ?> Miasto - Ulica<br>
	<?php echo form_checkbox('garden', 1, $garden); ?> Dom - Ogród<br>
	<hr class="break">	
	
	Wymiar: 
	<b><?php  echo $width.' x '.$height?>
	<hr class="break">	
	
	<?php if(is_file($dir.'crown_'.$id.'.png')) echo '<img src="'.$dir_relative.'/crown_'.$id.'.png'.'" style="max-width: 600px; max-height: 600px"><br><br>'; ?>
	obrazek (PNG)<br> 
	<input class="input_text" style="width:50%" type="file" name="file">
	
	<hr class="break" style="margin-top:1px;margin-bottom:20px;">	
	<?php panelShowSubmitCancel($url); ?>
	
<!-- e:KOLUMNA PRAWA -->
</div></div>
<div style="clear:both"></div>





</form>
