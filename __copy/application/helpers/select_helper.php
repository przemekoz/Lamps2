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



        
        
        


/* End of file select_helper.php */
/* Location: ./application/helpers/select_helper.php */
