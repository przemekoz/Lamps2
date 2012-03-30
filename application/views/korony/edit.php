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

<?php panelshowTop('Korony - dodaj/edytuj'); ?>

<form enctype="multipart/form-data" name="form" method="post" action="/index.php/<?php echo $url ?>/save">

<input type="hidden" name="id" value="<?php echo $id; ?>">

<?php echo inputText('Nazwa:', 'title', $title) ?>

<?php echo inputTextarea('Opis:', 'description', $description) ?>

<?php echo form_checkbox('street', 1, $street); ?> Miasto - Ulica<br>

<?php echo form_checkbox('garden', 1, $garden); ?> Dom - Ogród<br>

<?php if(is_file($dir.'crown_'.$id.'.png')) echo '<img src="'.$dir_relative.'/crown_'.$id.'.png'.'" style="max-width: 600px; max-height: 600px"><br><br>'; ?>
obrazek (PNG)<br> 
<input class="input_text" style="width:50%" type="file" name="file">


<?php panelShowSubmitCancel($url); ?>
</form>
