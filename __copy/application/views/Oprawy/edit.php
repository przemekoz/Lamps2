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
    
</style>

<?php panelshowTop('Oprawy - dodaj/edytuj'); ?>

<form enctype="multipart/form-data" name="form" method="post" action="/index.php/<?php echo $url ?>/save">

<input type="hidden" name="id" value="<?php echo $id; ?>">

Kod:
<input class="input_text" type="text" name="code" value="<?php echo $code; ?>">

<?php if(is_file($dir.'fitting_'.$id.'.png')) echo '<img src="'.$dir_relative.'/fitting_'.$id.'.png'.'" style="max-width: 600px; max-height: 600px"><br><br>'; ?>
Obrazek (PNG)<br> 
<input class="input_text" style="width:50%" type="file" name="file">


<?php panelShowSubmitCancel($url); ?>
</form>
