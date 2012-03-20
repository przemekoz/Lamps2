<?php  //if (!defined('BASEPATH')) exit('No direct script access allowed');



/*
 * funkcje pomocne podczas żądań Request GET, POST, COOKIE,...
 * filtrowanie danych
 */

if ( !class_exists('Request')) 
{
	
	class Request {
			
		/**
		 * Fukcja pobiera dane z tablicy np. $_GET, $_POST, $_COOKIE
		 * 
		 * @param array $aData - tablica z której mają być pobrane dane
		 * @param string $param - lista przecinkowa w kótrj podaje się nazwe pola do zczytania, ewentualnie typ na, ewentualnie długość np. pole_1=>string(100)
		 * 
		 */
		static public function get_data($aData, $param) {
			
			//rozdzielenie listy przecinkowej na tablice
			$aParams = explode(',',$param);
			
			//wynikowa tablica
			$aRes = array();
			
			//dla każdego elementu tablicy sprawdzamy, nazwę, typ, długość
			foreach ($aParams as $param) {
				
				//msg
				//msg=>int				
				//msg=>int(11)				
				
				$opt = array('len'=>0, 'type'=>0, 'name'=>'');

				//wyłuskanie długości
				if ($start = strpos($param, '(') !== false) {
					//wytnij liczbe z nawiasów
					$opt['len'] = substr($param, $start, strpos($param, ')')-$start);
				}
				

				//wyłuskanie typu
				if ($start = strpos($param, '>') !== false) 
				{
					//jeżeli ustwona jest długość
					if (strlen($opt['len']))
					{
						//wytnij liczbe z nawiasów - od znaku '>' do znaku '('
						$opt['type'] = substr($param, strpos($param, '(')-$start);
					}
					//w przeciwnym przypadku
					else 
					{
						//wytnij liczbe z nawiasów - od znaku '>' do końca
						$opt['type'] = substr($param, $start);
					}
				}
				
				//wyłuskanie nazwy
				//jesli jest ustawiony typ
				if (!empty($opt['type']))
				{
					$opt['name'] = substr($param, 0, strpos($param, '='));
				}
				//w przeciwnym przypadku
				else 
				{
					$opt['name'] = $param;
				}
				
				//jezxeli ustawiona jest zmienna w tablicy wejsciowej
				if (isset($aData[ $opt['name'] ])) 
				{
					$aRes[ $opt['name'] ] = self::type( $aData[ $opt['name'] ], $opt['type'], $opt['len']); 
				} 
				//w przeciwnym przypadku
				else 
				{
					$aRes[ $opt['name'] ] = null; 
				}
			}
			
			return $aRes;
		}
		
		
		
		
		/**
		 * 
		 * Funkcja pobiera zmienna, a nastepnie sprawdza czy jest danego typu, jesli nie zapisuje null. Jeżeli zmienna jest okreslonego typu, to przycina do oczekiwanej dlugości
		 * @param unknown_type $data
		 * @param unknown_type $expect_type
		 * @param unknown_type $expect_len
		 */
		static public function type($data, $expect_type = null, $expect_len = null) {
			
			$aTypes = array('int'=>'is_int','numeric'=>'is_numeric', 'array'=>'is_array', 'string'=>'is_string');
			
			//jeżeli został w tablicy zdefiniowany oczekiwany typ 
			//oraz jeżeli funkcja dla oczekiwanego typu zwróci TRUE zwróć zmienną
			if (isset($aTypes[$expect_type]) && call_user_func($aTypes[$expect_type], $data)) {
				
				//jeżeli nie została ustawiona oczekiwana długość zmiennej, zwróć zmienną, w przeciwnym przypadku przytnij
				return !empty($expect_len) && !is_array($data) ? substr($data, 0, $expect_len) : $data;
			}
			//w przeiwnum przypadku jeśli nie określono oczekiwanego typu
			else if (empty($expect_type)) {
				return $data;
			}
			
		}
		
	}	
}








