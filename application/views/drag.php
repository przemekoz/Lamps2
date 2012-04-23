<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<style type="text/css">

* {
	margin: 0;
	padding:0;
}

.product-resize {
	border: 1px solid black;
}
.draggable {
	z-index: 200;
}
.draggable img {
	/* border: 1px dotted #000; */
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

.product-active {
	border: 1px solid black;
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

.btn_in{
	padding:8px 4px 0 0; 
	text-align:center; 
	color:#67806E;
	font-weight:bold; 
	font-family:tahoma,sans-serif;
	font-size:11px
}	

.btn_out {
	cursor:pointer; 
	float:left; 
	margin:44px 0 0 38px; 
	width: 94px; 
	height: 34px; 
	background: url('/img/btn.png') top left no-repeat;
}	


</style>

</head>
<body onContextMenu="return false;">


<div style="width:100%; height: 126px; text-align:center; background: url('/img/bg.gif') top left; padding: 10px 0 0 0;">

	<div style="width: 956px; height: 126px; background: url('/img/toolbar2.png') top left no-repeat; margin: 0 auto; text-align: left">

<!-- 
		<div onclick="save_all()" class="btn_out" title="Zapisz">
			<div class="btn_in">Zapisz</div>
		</div>
		<div style="margin-left: 95px" onclick="window.open('/uploads/u<?php echo $userid ?>_saved.jpg?r=<?php echo rand(0,99)?>', '_blank')" class="btn_out" title="Podgląd">
 -->
		<div style="margin-left: 95px" onclick="window.open('/index.php/EmailsTemplate/preview', '_blank')" class="btn_out" title="Podgląd">
			<div class="btn_in">Podgląd</div>
		</div>
		<div onclick="clear_canvas()" class="btn_out" title="Wyczyść">
			<div class="btn_in">Wyczyść</div>
		</div>
		<div onclick="window.open('/index.php/EmailsTemplate/pdf', '_blank')" class="btn_out" title="Wydrukuj">
			<div class="btn_in">Wydrukuj</div>
		</div>
		<div onclick="window.open('/index.php/EmailsTemplate/downloadjpg', '_blank')" class="btn_out" title="Pobierz JPG">
			<div class="btn_in">Pobierz JPG</div>
		</div>
		<div onclick="window.open('/index.php/EmailsTemplate/downloadpdf', '_blank')" class="btn_out" title="Pobierz PDF">
			<div class="btn_in">Pobierz PDF</div>
		</div>
		<div onclick="window.open('/index.php/EmailsTemplate/send_form', '_blank')" class="btn_out" title="Wyślij email">
			<div class="btn_in" style="font-size:10px">Wyślij Zapytanie</div>
		</div>

		
		<div style="clear: both"></div>
	</div>
</div>
<div style="width: 100%; height: 4px; background: url('/img/break.png') repeat-x;"></div>


<div style="text-align: center;width:100%;margin-top:15px">
	<div style="width:1012px; height:612px; background: #fff; margin:0 auto;text-align: left">
		<div style="float:left;text-align: center">
		
		<?php ob_start(); ?>

						
		<?php

			/* odczytanie rozmiaru pliku tła - potrzebne do dynamicznego skalowania warstwy #canvas */
			$bgWidth = 0; 
			$bgHeight = 0;
			if (is_file($_SERVER['DOCUMENT_ROOT'].$bg)) {
				list($bgWidth, $bgHeight) = getimagesize($_SERVER['DOCUMENT_ROOT'].$bg);
			}
			
			
			//@todo - dodac zabezpieczneie na wypadek za duzego rozmiaru
			
			//@todo - dodac zabezpiecznie jakby odczytany rozmiar byl null
		?>

		<div id="canvas" onclick="hideContextMenu()" style="margin: 0 auto; z-index: 100;position: relative; width:<?php echo $bgWidth?>px; height: <?php echo $bgHeight?>px; background: url('<?php echo $bg ?>') no-repeat;padding:0;font-size:1px;line-height:1px"></div>
		
			<?php 
				$content = ob_get_clean();
				echo divShadow(812, 612, $content,0) 
			?>
				
				<br>
			 <?php //showButton('Wybierz tło', "show_add_bg()", 'grey'); ?>
			 <?php showButton('Wybierz tło', "location.href='/index.php/EmailsTemplate/choose_background'", 'grey'); ?>
		</div>
		<div style="float:left;">
		
		<?php ob_start(); ?>





					<div id="list-items" style="position: relative;  width: 188px; height: 588px; text-align: center; overflow: auto;">
						
						<?php 
						
						foreach ($items as $filename) {
							
							echo '
							<div class="draggable" title="Złap lampę i przesuń na tło" id="parent-prod'.str_replace('.png', '', $filename).'" style="margin-bottom: 10px">
								<img id="prod'.str_replace('.png', '', $filename).'" class="'.str_replace('.png', '', $filename).'" src="/uploads/'.$filename.'" style="max-width:170px">
							</div>
							';
						}//foreach
						
						?>
						
					</div>


		
			<?php 
				$content = ob_get_clean();
				echo divShadow(200, 610, $content,0);
				echo '<br>';		
				showButton('Dodaj element', "if('".$bgid."' == '0'){alert('Proszę najpierw wybrać tło.')}else{wnd=window.open('/index.php/EmailsTemplate/choose_item?bg=".$bgid."')}", 'grey')
			?>
				
		</div>
		<div style="clear:both"></div>
	</div>
</div>
<!-- 
<textarea id="elements_msg" style="border:none; width:100%; height:100px"></textarea>
 -->

<!-- FOOTER -->
<?php echo footer_html() ?>




<!-- kuler base color #cdcdcd ! -->


 
 	<?php 
 		$aLinks = array();
 		$aLinks[] = contextMenuLink('Usuń obrazek','del_canvas_prod();hideContextMenu()', 'edit_delete.png');
 		$aLinks[] = contextMenuLink('Odwróć', "invert();hideContextMenu()", 'mirror.png');
 		$aLinks[] = contextMenuLink('Przesuń na górę', 'on_top();hideContextMenu()', 'stock_to_top.png');
 		
		showContextMenu($aLinks, 'contextMenu');
		 	
 		$aLinks = array();
 		$aLinks[] = contextMenuLink('Zapisz obrazek','save_all();hideContextMenu()', 'save.png');
 		$aLinks[] = contextMenuLink('Zapisz jako pdf', "window.open('/index.php/EmailsTemplate/pdf');hideContextMenu()", 'pdf.png');
 		$aLinks[] = contextMenuLink('Wyczyść', 'clear_canvas();hideContextMenu()', 'package_purge.png');
 		
		showContextMenu($aLinks, 'contextMenuMain'); 	
 	?>


<!-- onclick="hide_add_bg()" -->
<div id="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2000; display: none; background: black; opacity: 0.7"></div>
<div id="popup_canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 3000; display: none;">
	<div id="add_bg_form" style="position: relative; top: 400px; margin: 0 auto; width: 500px; height: 308px; border: 1px solid #ddd; z-index: 4000; background: white;">
		<div style="padding: 20px">
		 Wybierz obrazek tła:
			<form enctype="multipart/form-data" name="form" method="post" action="/index.php/EmailsTemplate/uploadBg">
				<input type="file" style="height:30px" name="file"><br><br>
				<table width="100%"><tr><td width="50%"><?php showSubmit('Zapisz', 'green'); ?></td><td width="50%"><?php showButton('Anuluj', 'hide_add_bg()', 'grey'); ?></td></tr></table>
			</form>
		</div>
	</div>
</div>


<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/ui.draggable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.droppable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.resizable.min.js" type="text/javascript"></script>
<!-- 
<script src="/javascript/json.js" type="text/javascript"></script>
 -->

	<script type="text/javascript">
        $(document).ready(function() {





                  $("div#list-items img").each(function() {

                   var width = $(this).width();

                   //Max-width substitution (works for all browsers)
                   if (width > 170) {
                     $(this).css("width", "170px");
                   }

                 });
                  






        	
            
            $(".draggable").draggable({ hoverClass: "product-active", revert: "invalid", cursor: 'move', opacity: 0.35, addClasses: false, helper: 'clone', containment: "document" /*, containment: 'window', helper: 'clone',  stack: "#canvas" */ });
            
            
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
                 products[id][7] = ELEMENTS_DATA[products[id][6]+'.png']['text']; 
                 
                 /* zapisanie automatyczne */
            		save_all();
                 
                 //zapisanie informacji o dodanym elemencie
                 //document.getElementById('elements_msg').value += ' ' + ELEMENTS_DATA[products[id][6]+'.png']['text'] + "\r\n";

                 //zwiekszenie liczby dodanych elementow
                 ELEMENTS_DATA[products[id][6]+'.png']['count'] += 1;
                 
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

					//tablica przechowuje dane na temat wygenerowanych przez usera lamp 
        	var ELEMENTS_DATA = [];
					<?php echo $JS_ELEMENTS_DATA?>
         
         
         function drop_item( item ) {


            //item.addClass('resizable');    
            var clone = item.clone();
            //clone.addClass('resizable');    
        	  
        	  
        	  
            clone.css('position', 'absolute');
            clone.css('top', lastXY+'px');
            clone.css('left', lastXY+'px');
            clone.children().css('border', '1px dotted black');
            //clone.children().css('max-height', '600px');
            /* ustawienie oryginalnych rozmiarow */
            clone.children().css('height', ELEMENTS_DATA[item.children().attr('class')+'.png']['height']+'px');
            clone.children().css('width', ELEMENTS_DATA[item.children().attr('class')+'.png']['width']+'px');
            
            clone.appendTo($("#canvas"));
            
            var text = ELEMENTS_DATA[item.children().attr('class')+'.png']['text']; 
            clone.attr('title', text+". - Kliknij prawym -");
                
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

						clone.children().mouseover(function(event, ui){
							this.style.border = '1px dotted white';
						});
				
						clone.children().mouseout(function(event, ui){
							this.style.border = '1px dotted black';
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
                    
                    /* zapisanie automatyczne */
            				save_all();
                }       
            });

            //clone.children().resizable({containment: '#canvas'});

            //clone.resizable({containment: '#canvas'});
           
           /*
            */
           clone.children().resizable({containment: '#canvas', aspectRatio: true, autoHide: true,
               stop: function(event, ui){ 

               	   	 var id = clone.attr('id');

                     
                   products[id][3] = parseInt(ui.size.width); //current width
                   products[id][4] = parseInt(ui.size.height); //current height;
           }});
            
            /* zapisanie automatyczne */
            save_all();
            
            clone.click(function (event, ui) {
            	 //zapisanie aktualnego id
                utilSetCurrentItem(clone.attr('id'));
            });
            
         }//drop_item
  
  
         function save_all() {
              $.post("/index.php/EmailsTemplate/ajax_save_image/", { products: array2json(products), bg: '<?php echo $bg ?>' },
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
              
              //zminijszenie liczby dodanych elementow
              ELEMENTS_DATA[products[currCanvasId][6]+'.png']['count'] -= 1;
							
              products = unset(products, currCanvasId);
              
              /* zapisanie automatyczne */
            	save_all();
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
              
              /* zapisanie automatyczne */
            	save_all();
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
							products[i][0] = '/uploads/inv_'+products[i][6]+'.png'; 
							obj.attr('src', products[i][0]);
							
							/* zapisanie automatyczne */
	            save_all();
	            
							return true;
					 }
			 
					 //jest img inv, zamien na normalne
					 products[i][5] = 'norm';
					 products[i][0] = '/uploads/'+products[i][6]+'.png'; 
					 obj.attr('src', products[i][0])

						/* zapisanie automatyczne */
            save_all();
	            
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
    
    //jesli nie kliknieto prawym przyciskiem myszy - to ustawiaj pozycje menu 
    if (checkRightClick(e)) {
	    $('#contextMenu, #contextMenuMain').css({'left':e.pageX,'top':e.pageY});
    }    
    
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


	/* zapisanie układu po uruchomieuniu strony - np. wybranie tla przez usera */
	save_all();
		
		
		function add_element(id_elem, id_user, text, width, height) {

			alert(id_elem +' : '+ id_user +' : '+ text +' : '+ width +' : '+ height);
			
			var newChild = document.createElement('div');
			newChild.setAttribute('id', 'parent-produ'+id_user+'_i'+id_elem);
			newChild.setAttribute('class', 'draggable');
			newChild.setAttribute('style', 'margin-bottom: 10px');
			newChild.setAttribute('title', 'Złap lampę i przesuń na tło');

			var newImg = document.createElement('img');
			newImg.setAttribute('id', 'produ'+id_user+'_i'+id_elem);
			newImg.setAttribute('class', 'u'+id_user+'_i'+id_elem);
			newImg.setAttribute('src', '/uploads/u'+id_user+'_i'+id_elem+'.png');


			ELEMENTS_DATA['u'+id_user+'_i'+id_elem+'.png'] = {'text':text, 'count':0, 'width':width, 'height':height};

			 
			newChild.appendChild(newImg);
	
			document.getElementById('list-items').appendChild(newChild);
			$('#parent-produ'+id_user+'_i'+id_elem).draggable({ hoverClass: "product-active", revert: "invalid", cursor: 'move', opacity: 0.35, addClasses: false, helper: 'clone', containment: "document" });
			alert('Nowa lampa została dodana...');			
		}




		
    </script>
</body>
</html>