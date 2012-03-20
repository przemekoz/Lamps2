    Wybrana opcja <?php echo $id_column ?>
<form name="form" action="/index.php/<?php echo $url ?>/krok_b/">
    
    id kolumny: <input type="text" name="id_column" value="0">

    <input type="submit" value="dalej">
</form>
    
    

<ol>
<?php foreach($list->result() as $row): ?>
    <li><?php echo $row->title ?> <?php if(is_file($dir.'column_'.$row->id.'.png')) echo '<img src="'.$dir_relative.'/column_'.$row->id.'.png'.'" style="max-width: 100px; max-height: 150px">'; ?> <a href="javascript:chooseColumn('<?php echo $row->id ?>')" >wybierz</a></li>
<?php endforeach; ?>
</ol>  
    
    
    
    <script type="text/javascript">
    
    
    
    
    function chooseColumn(id)
    {
        document.form.id_column.value = id;
    }
    
    </script>    
    