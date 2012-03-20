<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$globalSelectId = 0;

if ( ! function_exists('select_custom'))
{
	function select_custom($arrayValuesLabels)
	{
            global $globalSelectId; 
        
            $items = '';
            foreach ($arrayValuesLabels as $k => $v) {
                $items .= '<div onclick="selValue(\''.$k.'\', \''.$globalSelectId.'\')" style="height: 30px; background: white; margin-bottom: 1px; cursor: pointer">'.$v.'</div>';
            }
            
                $select = '
               <input type="text" id="sel'.$globalSelectId.'" value="">
                <div id="sel_menu'.$globalSelectId.'" style="display:none; background: red; width: 300px; position: absolute; top:0; left:0; z-index: 900">
                    <div style="padding: 2px;">
                        '.$items.'
                    </div>
                </div>
    
                <div id="sel_index'.$globalSelectId.'" style="margin-left: 10px"> - wybierz menu - </div><a href="javascript:show_menu('.$globalSelectId.')">show menu</a>';
        
                $globalSelectId ++;
                return $select;
	}
}


if ( ! function_exists('select_custom_fonts'))
{
	function select_custom_extra($option = 'font')
	{
            global $globalSelectId;
            
            $arrayValuesLabels['font']  = array('font-family:tahoma'=>'Tahoma', 'font-family:arial'=>'Arial', 'font-family:times new roman'=>'Domyslna');
            $arrayValuesLabels['size']  = array('font-size:11px'=>'11','font-size:15px'=>'15','font-size:19px'=>'19','font-size:22px'=>'22');
            $arrayValuesLabels['color']  = array('color:red'=>'czerwony','color:black'=>'czarny','color:green'=>'zielony');
            
            
            $items = '';
            foreach ($arrayValuesLabels[$option] as $k => $v) {
                $items .= '<div onclick="selValue(\''.$k.'\', \''.$globalSelectId.'\')" style="'.$k.'; height: 30px; background: white; margin-bottom: 1px; cursor: pointer">'.$v.'</div>';
            }
            
                $select = '
               <input type="text" id="sel'.$globalSelectId.'" value="">
                <div id="sel_menu'.$globalSelectId.'" style="display:none; background: red; width: 300px; position: absolute; top:0; left:0; z-index: 900">
                    <div style="padding: 2px;">
                        '.$items.'
                    </div>
                </div>
    
                <div id="sel_index'.$globalSelectId.'" style="margin-left: 10px"> - wybierz menu - </div><a href="javascript:show_menu(\''.$globalSelectId.'\')">show menu</a>';
        
                $globalSelectId ++;
                return $select;
	}
}


if (!function_exists('select_checkbox')) 
{
	function select_checkbox()
	{
		$html = '
			<input id="values" type="text" value=""><br>
		<div id="sel02" onclick="show()" style="width:200px; height: 20px; border:1px solid black; cursor:pointer"></div>
		<div id="sel01" style="display:none; width:200px; height: 10px; border:1px solid black; cursor:pointer">
			<input type="checkbox" name="select0" id="s0" value="01" title="text uno"><label for="select0">text uno</label><br>
			<input type="checkbox" name="select1" id="s1" value="02" title="text due"><label for="select1">text due</label><br>
			<input type="checkbox" name="select2" id="s2" value="03" title="text tre"><label for="select2">text tre</label><br>
		</div>
		
		<script type="text/javascript">
		
		var selvisible = false;
		
		function show() {
		
			if (selvisible) {
				hide();
				return; //EXIT
			}
		
			document.getElementById("sel01").style.height = 100+"px";
			document.getElementById("sel01").style.display = "block";
			selvisible = true;
		}
		
		function hide() {
			selvisible = false;
			document.getElementById("sel01").style.height = 10+"px";
			document.getElementById("sel01").style.display = "none";

			var iter = 0;
			var val = new Array();
			var name = new Array();	
			for (var i=0; i<3; i++) {
				var obj = document.getElementById("s"+i);
				if (obj.checked) {
					val[iter] = obj.value;
					name[iter] = obj.title;
					iter++;
				}
			}
			document.getElementById("values").value = val.join(",");
			document.getElementById("sel02").innerHTML = name.join(", ");
		}
		
		</script>
		';
		
		return $html;
	}
}
        
        
        


/* End of file select_helper.php */
/* Location: ./application/helpers/select_helper.php */
