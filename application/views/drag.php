<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">

* {
	margin: 0;
	padding:0;
}

.draggable {
	z-index: 200;
}
.draggable img {
	border: 1px dotted #eee;
	z-index: 200;
}

#resizable {
	width: 200px;
	border: 1px dotted #eee;
	height: 300px;
}

.canvas-active {
	opacity: 0.8;
}

.draggable:hover {
	opacity: 0.8;
	/* border: 1px dotted #ddd; */
	cursor: move;
}
     .input_text {
    	height: 40px;
    	font-size:17px;
    	color: black;
    	padding: 0 0 0 0;
    	width: 100%;
    	height: 134px;
    	font-family: arial;
    	margin: 3px 0 15px 0;
    }

</style>

</head>
<body onContextMenu="return false;">


<div style="width:100%; height: 126px; text-align:center; background: url('/img/bg.gif') top left; padding: 10px 0 0 0;">

	<div style="width: 956px; height: 126px; background: url('/img/toolbar2.png') top left no-repeat; margin: 0 auto; text-align: left">

		<div onclick="show_prods()" style="cursor:pointer; float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Zapisz">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold; font-family:tahoma,sans-serif;font-size:11px">Zapisz</div>
		</div>
		<div onclick="window.open('/uploads/tmp/u<?php echo $userid ?>_saved.jpg', '_blank')" style="cursor:pointer; float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Podgląd">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold; font-family:tahoma,sans-serif;font-size:11px">Podgląd</div>
		</div>
		<div onclick="clear_canvas()" style="cursor:pointer; float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Wyczyść">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Wyczyść</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/pdf', '_blank')" style="cursor:pointer;float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Wydrukuj">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Wydrukuj</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/downloadjpg', '_blank')" style="cursor:pointer;float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Pobierz JPG">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Pobierz JPG</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/downloadpdf', '_blank')" style="cursor:pointer;float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Pobierz PDF">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Pobierz PDF</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/send', '_blank')" style="cursor:pointer;float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Wyślij email">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Wyślij email</div>
		</div>

		
		<div style="clear: both"></div>
	</div>
</div>
<div style="width: 100%; height: 4px; background: url('/img/break.png') repeat-x;"></div>


<div style="text-align: center;width:100%;margin-top:15px">
	<div style="width:1000px; height:600px; background: #fff; margin:0 auto;text-align: left">
		<div style="float:left;">
		
		<?php ob_start(); ?>

						
						

		<div id="canvas" oncontextmenu="return onContextMenu('main')" style="z-index: 100;position: relative; width:688px; height: 588px; background: url('/uploads/tmp/<?php echo $bg ?>') no-repeat;"></div>
		
			<?php 
				$content = ob_get_clean();
				echo divShadow(700, 600, $content,0) 
			?>
				
				<br>
			 
			 <!-- onsubmit="alert('Funkcjonalność zablokowana.');return false;"  -->
			<!-- 
					<form enctype="multipart/form-data" name="form" method="post" action="/index.php/emailstemplate/uploadBg">
					<table width="100%"><tr><td width="50%"><input class="input_text" style="width:20%" type="file" name="file"></td><td width="50%"><?php showSubmit('Dodaj tło', 'grey'); ?></td></tr></table>
					</form>
			 -->
			 <?php showButton('Dodaj tło', "show_add_bg()", 'grey'); ?>
		</div>
		<div style="float:left;">
		
		<?php ob_start(); ?>





					<div id="list-items" style="position: relative;  width: 288px; height: 588px; text-align: center; overflow: auto;">
						
						<?php 
						
						foreach ($items as $filename) {
							
							echo '
							<div class="draggable" title="Przeciagnij obrazek na tło" id="parent-prod'.str_replace('.png', '', $filename).'" style="margin-bottom: 10px">
								<img id="prod'.str_replace('.png', '', $filename).'" class="'.str_replace('.png', '', $filename).'" src="/uploads/tmp/'.$filename.'" width="200" height="550">
							</div>
							';
						}//foreach
								//<img id="prod3" class="'.$filename.'" src="/uploads/tmp/'.$filename.'">
						
						
						
						?>
						
					</div>


		
			<?php 
				$content = ob_get_clean();
				echo divShadow(300, 600, $content,0);
				echo '<br>';		
				showButton('Dodaj element', "location.href='/index.php/emailstemplate/choose_item'", 'grey')
			?>
			<!-- 
				<a href="/index.php/emailstemplate/choose_item" title="Dodaj nowy element...">
					<img src="/img/icon/ico_new_element.png" width="60" height="60" style="border: 1px solid #ddd" title="Dodaj nowy element...">
				</a>
			 -->
				
		</div>
		<div style="clear:both"></div>
	</div>
</div>

<div id="elements_msg"></div>

<!-- FOOTER -->
<br clear="all">
<div style="background: #67806E; width:100%;height:150px;border-top:2px solid #674A3E;margin-top:40px">
<div style="padding:60px 40px 0 40px">
	<a href="#" title="" style="font-size:15px;font-family:tahoma,sans-serif; color:#fff;text-decoration: none; margin-right: 15px" onmouseover="this.style.borderBottom='1px dotted #fff'" onmouseout="this.style.borderBottom='none'">link1</a>
</div>
</div>





<!-- kuler base color #cdcdcd ! -->


 
 	<?php 
 		$aLinks = array();
 		$aLinks[] = contextMenuLink('Usuń obrazek','del_canvas_prod();hideContextMenu()', 'edit_delete.png');
 		$aLinks[] = contextMenuLink('Odwróć', "invert();hideContextMenu()", 'mirror.png');
 		$aLinks[] = contextMenuLink('Przesuń na górę', 'on_top();hideContextMenu()', 'stock_to_top.png');
 		
		showContextMenu($aLinks, 'contextMenu');
		 	
 		$aLinks = array();
 		$aLinks[] = contextMenuLink('Zapisz obrazek','show_prods();hideContextMenu()', 'save.png');
 		$aLinks[] = contextMenuLink('Zapisz jako pdf', "window.open('/index.php/emailstemplate/pdf');hideContextMenu()", 'pdf.png');
 		$aLinks[] = contextMenuLink('Wyczyść', 'clear_canvas();hideContextMenu()', 'package_purge.png');
 		
		showContextMenu($aLinks, 'contextMenuMain'); 	
 	?>


<!-- onclick="hide_add_bg()" -->
<div onclick="alert(1)" id="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2000; display: none; background: black; opacity: 0.7"></div>
<div id="popup_canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 3000; display: none;">
	<div id="add_bg_form" style="position: relative; top: 200px; margin: 0 auto; width: 500px; height: 308px; border: 1px solid #ddd; z-index: 4000; background: white;">
		<div style="padding: 20px">
		 Wybierz obrazek tła:
			<form enctype="multipart/form-data" name="form" method="post" action="/index.php/emailstemplate/uploadBg">
				<input class="input_text" style="width:20%" type="file" name="file">
				<table width="100%"><tr><td width="50%"><?php showSubmit('Zapisz', 'green'); ?></td><td width="50%"><?php showButton('Anuluj', 'hide_add_bg()', 'grey'); ?></td></tr></table>
			</form>
		</div>
	</div>
</div>


<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/ui.draggable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.droppable.min.js" type="text/javascript"></script>
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="/javascript/ui.resizable.min.js" type="text/javascript"></script>
<script src="/javascript/json.js" type="text/javascript"></script>

	<script type="text/javascript">
        $(document).ready(function() {
            
            $(".draggable").draggable({ hoverClass: "product-active", revert: "invalid", cursor: 'move', opacity: 0.35, addClasses: false, helper: 'clone', containment: "document" /*, containment: 'window', helper: 'clone',  stack: "#canvas" */ });
            
            
            $("#parent_prod6").draggable({hoverClass: "product-active", cursor: 'move', opacity: 0.35, addClasses: false,containment: '#canvas'});
            
            
            //$("#resizable").resizable();
            //$("div#canvas > div > img").resizable({ aspectRatio: true, autoHide: true, ghost: true });
            
            $("#canvas").droppable({
              accept: "#list-items div",
              hoverClass: "canvas-active",
              drop: function(event, ui) { 
                 var dragObject = ui.draggable;
                 drop_item( dragObject );
                 
                 
                 //zalozenie rekordu
                 var id = prodId+'canvas-'+dragObject.attr('id');
                 products[id] = new Array();
                 products[id][0] = dragObject.children().attr('src'); //src
                 products[id][1] = lastXY; //x
                 products[id][2] = lastXY; //y
                 products[id][3] = 0; //image width - 0 = oryginal
                 products[id][4] = 0; //image height - 0 = oryginal
                 products[id][5] = 'norm'; //czy obrazek jest normalny czy odbicie lustrzane 
                 products[id][6] = dragObject.children().attr('class'); //w class trzymana jest nazwa pliku 

                 
                 lastXY += 20;
                 prodId ++;
              }
            });
            
            
            
         });
         
         var products = new Array();
         var currCanvasId = null;
         var currZIndex = 200;
         var lastXY = 0;
         var prodId = 1;
         
         function drop_item( item ) {


            //item.addClass('resizable');    
            var clone = item.clone();
            //clone.addClass('resizable');    
        	  
        	  
        	  
            clone.css('position', 'absolute');
            clone.css('top', lastXY+'px');
            clone.css('left', lastXY+'px');
            clone.appendTo($("#canvas"));
            
            clone.attr('title', 'mozesz przesuwac obiekt, oraz zmieniac rozmiar lapiac za prawy dolny rog');
                
            //zmiana id clonowanego obiektu
            clone.attr('id', prodId+'canvas-'+clone.attr('id'));
            clone.children().attr('id', 'canvas-'+clone.children().attr('id'));


            //dziala w FF - rightclick
            clone.attr('oncontextmenu', 'return onContextMenu()');
            
            //document.getElementById(clone.attr('id')).onMouseDown = function(){return false}
            
            //dziala w IE - rightclick
						clone.mousedown(function(event, ui){
							checkRightClickIE(event);
						});	
            
            clone.draggable({
                hoverClass: "product-active", 
                cursor: 'move', 
                opacity: 0.35, 
                addClasses: false,
                containment: '#canvas', 
                drag: function (event, ui) {
                    //zapisanie aktualnego id
                    utilSetCurrentItem(clone.attr('id'));
                },
                stop: function (event, ui) {
                    var id = clone.attr('id');
                    //zapisanie aktualnego id
                    utilSetCurrentItem(id);

                    products[id][1] = parseInt(ui.position.left); //x
                    products[id][2] = parseInt(ui.position.top); //y;
                }       
            });

            //clone.children().resizable({containment: '#canvas'});

            //clone.resizable({containment: '#canvas'});
           
           /*
            */
           clone.children().resizable({containment: '#canvas', aspectRatio: true, 
               stop: function(event, ui){ 

               	   	 var id = clone.attr('id');

                     
                   products[id][3] = parseInt(ui.size.width); //current width
                   products[id][4] = parseInt(ui.size.height); //current height;
           }});
            
            clone.click(function (event, ui) {
            	 //zapisanie aktualnego id
                utilSetCurrentItem(clone.attr('id'));
            });
            
         }//drop_item
  
  
         function show_prods() {
              $.post("/index.php/emailstemplate/ajax_save_image/", { products: array2json(products) },
               function(data) {
                    if (data == 'ok') {
                       //ok 
                    }
               });
         }
         
         function del_canvas_prod() {
              $('#'+currCanvasId).remove();
              //usuniecie z tablicy obiektu
              //products[currCanvasId][0] = '';

              products = unset(products, currCanvasId);
         }


         /**
          * usuwa z w tablicy element o podanym id
          * @return array
          */
         function unset(arr, key) {
					 tmp = new Array();

		       for(var i in arr) {
           		if(i == key) {
               		continue;
           		} 		 	 
              tmp[i] = arr[i];   
           }

						return tmp;	         
         }

         
         
         function on_top() {
              currZIndex += 100;
              $('#'+currCanvasId).css('z-index', currZIndex);
         }
         
         function clear_canvas() {
              $('#canvas > .draggable').remove();
              products = new Array();
         }
         
         
         
         function foreach() {
            //var names = ["Chris", "Kate", "Steve"];
            //var names = {'a':"Chris", 'b':"Kate", 'c':"Steve"};
            var names = products;
            
            for(var i in names) {
                alert(i+'->'+names[i]);
            }
         }



         function checkRightClickIE(e) {
        		if (checkRightClick(e)) {
							//document.getElementById('message').innerHTML += ' +rightclick';
							onContextMenu()
        		}		
        	}    

         function checkRightClick(e) {
        		var rightclick;
        		if (!e) var e = window.event;
        		if (e.which) rightclick = (e.which == 3);
        		else if (e.button) rightclick = (e.button == 2);

        		if (rightclick) {
							//document.getElementById('message').innerHTML += ' +rightclick';
							//onContextMenu(e)
        		}		
        		return rightclick;

        	}    




         /*
          * Funkcja pomocnicza - ustawienie aktualnego obiektu w canvas-ie
          * 
          */
         function utilSetCurrentItem(id) {
        	 currCanvasId = id;
         }

         
         /*
          * Funkcja pomocnicza
          * 
          */
         function utilSetProductsImg(currCanvasId, obj) {


             var i = currCanvasId;

					 //jest img normalne, zamien na inv -> po zmianie wylot
        	 if(products[i][5] == 'norm') {
							products[i][5] = 'inv';
							products[i][0] = '/uploads/tmp/inv_'+products[i][6]+'.png'; 
							obj.attr('src', products[i][0]);
							return true;
					 }
			 
					 //jest img inv, zamien na normalne
					 products[i][5] = 'norm';
					 products[i][0] = '/uploads/tmp/'+products[i][6]+'.png'; 
					 obj.attr('src', products[i][0])
					 return true;
         }
         
         
function invert() {
	

									
	//dla kazdego obiektu potomengo szukamy img
	$('#'+currCanvasId).children().each(function(){

		
		
		$(this).children().each(function(){
				if (typeof($(this).attr('id')) != 'undefined' && $(this).attr('id') != '') {

					//ustawienie odpowiednich danych dla obrazka
					utilSetProductsImg(currCanvasId, $(this));
				}
		})
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

function hideContextMenu() {
	$('#contextMenu').hide();
	$('#contextMenuMain').hide();
	globalWasRightClick = false;
}

function onContextMenu( mode ) {

		if (mode == 'main') {
	    $('#contextMenuMain').fadeIn(50);
			return false;
		}
	
    $('#contextMenu').fadeIn(50);
    globalWasRightClick = true;
    return false;
}


var globalWasRightClick = false;

$(document).bind('mousedown',function(e){ 
    //$("#message").text("e.pageX: " + e.pageX + ", e.pageY: " + e.pageY);
    //$('#contextMenu').css('top', e.pageY);
    //$('#contextMenu').css('left', e.pageX);
    
    //jesli nie kliknieto prawym przyciskiem myszy - to ustawiaj pozycje menu 
    if (checkRightClick(e)) {
	    $('#contextMenu, #contextMenuMain').css({'left':e.pageX,'top':e.pageY});
    }    
    
    //hideContextMenu();
});


		function debug(v) {
			//return ;

			alert(v)
		}

		function show_add_bg() {
			$('#overlay').fadeIn();
			$('#popup_canvas').fadeIn();
		}

		function hide_add_bg() {
			$('#popup_canvas').fadeOut();
			$('#overlay').fadeOut();
		}

    </script>
</body>
</html>