    Wybrana opcja kolumna <?php echo $id_column ?>
    Wybrana opcja korona <?php echo $id_crown ?>
<form name="form" action="/index.php/<?php echo $url ?>/krok_c/">
    
    id kolumny: <input type="text" name="id_column" value="<?php echo $id_column ?>">
    id korony: <input type="text" name="id_crown" value="0">

    <input type="submit" value="dalej">
</form>
    
    
<ol>
<?php foreach($list->result() as $row): ?>
    <li><?php echo $row->title ?> <?php if(is_file($dir.'crown_'.$row->id.'.png')) echo '<img src="'.$dir_relative.'/crown_'.$row->id.'.png'.'" style="max-width: 100px; max-height: 150px">'; ?> <a href="javascript:chooseCrown('<?php echo $row->id ?>')" >wybierz</a></li>
<?php endforeach; ?>
</ol>  
    
    
    
    
    
    <script type="text/javascript">
    
    
    
    
    function chooseCrown(id)
    {
        document.form.id_crown.value = id;
    }
    
    </script>        