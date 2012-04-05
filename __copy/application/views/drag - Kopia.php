<html>
<head>
<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/ui.draggable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.droppable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.resizable.min.js" type="text/javascript"></script>
<script src="/javascript/json.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    
<style type="text/css"> 
    .draggable {
        border: 1px solid #bbb;
        z-index: 200;
    }
    .resizable {
        border: 2px solid red;
    }
    .canvas-active {
        opacity: 0.8;
        border: 2px solid red;
    }
    .draggable:hover {
        opacity: 0.8;
        border: 1px solid red;
    }
</style>

</head>    
<body>
    


    
    <div style="width:100%; text-align: center">
        <div style="margin: 0 auto; width: 80%; text-align: left">
            
            
            
            
            <div style="float: left; width: 70%; text-align: center;">
                <div style="width: 90%; margin: 0 auto; text-align: left;">
                    
                    <div id="canvas" style="z-index: 100; width: 100%; background:  url(/img/street.jpg); border: 1px solid red; height: 500px"></div>
                    
                </div>
            </div>
            <div style="float: left; width: 30%; text-align: center;">
                <div style="width: 90%; margin: 0 auto; text-align: left;">
                    
                    
                    <div id="list-items" style="border: 1px solid blue; height: 500px; ">
                        
                        <div class="draggable" id="parent-prod1" style="border: 1px solid #eee; margin-bottom: 10px; text-align: center; width: 100px; height: 150px"><img id="prod1" src="/img/tree.png" width="100" height="150"></div>
                        <div style="border: 1px solid #eee; margin-bottom: 10px; text-align: center"><img id="prod2" class="draggable" src="/img/tree.png" width="100" height="150"></div>
                        <div style="border: 1px solid #eee; margin-bottom: 10px; text-align: center"><img id="prod3" class="draggable" src="/img/tree.png" width="100" height="150"></div>
                        <div style="border: 1px solid #eee; margin-bottom: 10px; text-align: center"><img id="prod4" class="draggable" src="/img/tree.png" width="100" height="150"></div>
                        <div style="border: 1px solid #eee; margin-bottom: 10px; text-align: center"><img id="prod5" class="draggable" src="/img/tree.png" width="100" height="150"></div>
                        <div style="border: 1px solid #eee; margin-bottom: 10px; text-align: center"><img id="prod6" class="draggable" src="/img/tree.png" width="100" height="150"></div>
                    </div>
                    
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            
        </div>
    </div>
    
    
    
    
    
    
    <script type="text/javascript">
        $(document).ready(function() {
            
            $(".draggable").draggable({ hoverClass: "product-active", revert: "invalid", cursor: 'move', opacity: 0.35, addClasses: false, helper: 'clone', containment: "document" /*, containment: 'window', helper: 'clone',  stack: "#canvas" */ });
            
            
            $("#parent_prod6").draggable({hoverClass: "product-active", cursor: 'move', opacity: 0.35, addClasses: false,containment: '#canvas'});
            
            
            $(".resizable").resizable({ aspectRatio: true, autoHide: true, ghost: true });
            $("div#canvas > div > img").resizable({ aspectRatio: true, autoHide: true, ghost: true });
            
            $("#canvas").droppable({
              accept: "#list-items div",
              hoverClass: "canvas-active",
              drop: function(event, ui) { 
                 var dragObject = ui.draggable;
                 addItem( dragObject );
                 
//                 alert(dragObject.attr('id').children().attr('id'))
                 
                 //zalozenie rekordu
                 var id = dragObject.attr('id');
                 products[id] = new Array();
                 products[id][0] = dragObject.attr('src'); //src
                 products[id][1] = 0; //x
                 products[id][2] = 0; //y
                 
                 /*
                  $.post("/index.php/emailstemplate/ajax_add_item_to_bg/", { src: dragObject.attr('src'), img_width: dragObject.attr('width'), img_height: dragObject.attr('height') },
                   function(data) {
                        if (data == 'ok') {
                           //ok 
                        }
                   });
                   */
                  
              }
            });
            
         });
         
         var products = new Array();
         
         function addItem( $item ) {
            //$item.addClass('resizable');    
            var clone = $item.clone();
            clone.appendTo($("#canvas"));
            
            clone.draggable({hoverClass: "product-active", cursor: 'move', opacity: 0.35, addClasses: false,containment: '#canvas'});
            clone.children().resizable({containment: '#canvas'});
            //clone.resizable({
            //clone.draggable({
                
                /*
                containment: "parent", 
                cursor: 'move', 
                stop:function(event, ui) { 
                   var dragObject = clone;
                   
                   //zmiana rekordu
                   var id = dragObject.attr('id');
                   products[id][1] = parseInt(ui.position.left); //x
                   products[id][2] = parseInt(ui.position.top); //y
                  */ 
                   
                  //alert(clone.id);
                  //alert(parseInt(ui.position.left) +' : '+parseInt(ui.position.top));
                  /*
                  $.post("/index.php/emailstemplate/ajax_change_pos_product/", { src: dragObject.attr('src'), img_width: dragObject.attr('width'), img_height: dragObject.attr('height'), x: parseInt(ui.position.left), y: parseInt(ui.position.top) },
                   function(data) {
                        if (data == 'ok') {
                           //ok 
                        }
                   });
                }
                   */
             //});    
            
            clone.dblclick(function (event, ui) {
                //alert('mozesz zmienic rozmiar...')
                alert('mozesz przesunac obiekt...')
                //clone.resizable();    
                clone.draggable({
                    containment: "parent", 
                    cursor: 'move', 
                    stop:function(event, ui) { 
                       var dragObject = clone;

                       //zmiana rekordu
                       var id = dragObject.attr('id');
                       products[id][1] = parseInt(ui.position.left); //x
                       products[id][2] = parseInt(ui.position.top); //y});    
                    }
               });
        });//dbclick
         }//addItem
  
  
         function show_prods() {
              
              $.post("/index.php/emailstemplate/ajax_save_image/", { products: array2json(products) },
               function(data) {
                    if (data == 'ok') {
                       //ok 
                    }
               });
         }















function array2json(arr) {
    var parts = [];
    var is_list = (Object.prototype.toString.apply(arr) === '[object Array]');

    for(var key in arr) {
    	var value = arr[key];
        if(typeof value == "object") { //Custom handling for arrays
            if(is_list) parts.push(array2json(value)); /* :RECURSION: */
            else parts[key] = array2json(value); /* :RECURSION: */
        } else {
            var str = "";
            if(!is_list) str = '"' + key + '":';

            //Custom handling for multiple data types
            if(typeof value == "number") str += value; //Numbers
            else if(value === false) str += 'false'; //The booleans
            else if(value === true) str += 'true';
            else str += '"' + value + '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Functions?)

            parts.push(str);
        }
    }
    var json = parts.join(",");
    
    if(is_list) return '[' + json + ']';//Return numerical JSON
    return '{' + json + '}';//Return associative JSON
}
    </script>
    
    <a href="javascript:show_prods()" >zapisz obrazek</a> 
    
</body>
</html>