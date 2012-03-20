<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */
if ( ! function_exists('showItem'))
{

	/**
	 *
	 * funkcja dodaje do szablonu jeden element na ekranie wyboru koolumny, korony, oprawy
	 * @param int $id - id rekordu w bazie
	 * @param string $title - nazwa elementu
	 * @param string $type - typ {column|crown|fitting}
	 * @return string
	 */
	function showItem($id, $title, $type) {

		$item  = '<div class="draggable '.$type.'" style="cursor: pointer;border:1px dotted #ddd;margin-bottom:10px" id="'.$id.'" onclick="setElement(\''.$type.'\', \''.$id.'\')"><div style=\"padding:5px 10px\">';
		$item .= '<table width="100%" ><tr><td width="50%" align="right"><img src="/uploads/'.$type.'_'.$id.'.png" style="max-width:150px;max-height:250px;"></td><td width="50%" valign="top">'.$title.'</td></table>';
		$item .= '</div></div>';

		return $item;
	}
}

if ( ! function_exists('showItemsInColumns'))
{

	function showItemsInColumns($arrayOfItems, $columnsCount) {

				
		
		$ids = array();
		//wyciagam idki dla pierwszej kolumny 
		for ($i=0; $i<count($arrayOfItems); $i++) {
			
			//jesli i jest id-kiem pierwszej kolumny (np. gdy liczba kolumn ma byc 2, beda to: 0,2,4....
			if ($i % $columnsCount == 0 ) {
				//na podstawie idka pierwzej kolumny wprowadzam id do kolejnych kolumn
				for ($k=0; $k<$columnsCount; $k++) {$ids[$k][] = $i+$k;}
			}
		}

		$column = array();
		//dla kolejnych obliczonych idikow sprawzamy czy w tablicy istnieje element i zapisujemy
		foreach ($ids as $idColumn => $ids) {
			$column[$idColumn] = '';
			
			foreach ($ids as $id) {
				if (isset($arrayOfItems[$id])) {
					$column[$idColumn] .= showItem($arrayOfItems[$id]->id, $arrayOfItems[$id]->code, $arrayOfItems[$id]->type);
				}
			}
		}
		
			
		
		$html  = '<div style="width: 100%;">';

		$divColumnWidth = floor(100 / $columnsCount);
		foreach ($column as $key => $col) {
			$html .= '<div style="float:left; width: '.$divColumnWidth.'%; "><div style="padding:5px;">'.$col.'</div></div>';
		}

		$html .= '<div style="clear: both;"></div>';
		$html .= '</div>';

		return $html;
	}
}