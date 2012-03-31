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
    .textarea {
    	height: 100px;
    }
    
</style>

<?php panelshowTop('Slupy - dodaj/edytuj'); ?>

<form enctype="multipart/form-data" name="form" method="post" action="/index.php/<?php echo $url ?>/save">

<input type="hidden" name="id" value="<?php echo $id; ?>">

<?php echo inputText('Nazwa:', 'title', $title) ?>

<?php echo inputTextarea('Opis:', 'description', $description) ?>

<?php echo form_checkbox('street', 1, $street); ?> Miasto - Ulica<br>

<?php echo form_checkbox('garden', 1, $garden); ?> Dom - Ogród<br>

Szerokość obrazka: <?php  echo $width?>px<br>
Wysokość obrazka: <?php  echo $height?>px<br>

<?php echo inputFile('Obrazek (PNG):', 'file', 'column_'.$id.'.png') ?>


<?php panelShowSubmitCancel($url); ?>
</form>


<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/main.js" type="text/javascript"></script>