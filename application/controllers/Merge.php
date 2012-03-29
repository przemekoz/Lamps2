<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merge extends CI_Controller {
 
    
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('buttons');
        $this->load->helper('panel_utils');
        $this->load->helper('input');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('simplelogin');

        /*
         * konfiguracja modułu
         */
        
        $this->module_url = 'Merge';
        $this->msg = array(
             'insert_success'   => 'Użytkownik został dodany'
            ,'edit_success'     => 'Użytkownik został zmieniony'
            ,'delete_success'   => 'Użytkownik został usunięty'
        );
        
    }

    
    
    
    /**
    | Funkcja wyswietla ekran łączenia elementów
    |	@param $reqId int - parametr elementu głównego
    |	@param $src string - tekstowy parametr określający co jest elementem głownym (słup, korona)
    |	@param $dst string - tekstowy parametr określający co jest elementami łączonymi do głownego (korona, oprawa)
    */
    public function merge($mainId) {
    	
    	//test
    	$src = 'column';
    	$dst = 'crown';
    	
    	/*                                                                                  
    	 * odczytanie istniejacych połączeń dla wybranego elementu głwównego (słup, korona) 
    	 */    
    	$merge = array();                                                                             
    	//odczytaj pole id_crown, lub id_fitting
    	$this->db->select('id_'.$dst);
    	//wybierz tabelę: merge_column_crown, merge_column_fitting lub merge_crown_fitting; parametr może być: id_column lub id_crown 
    	$query = $this->db->get_where('merge_'.$src.'_'.$dst, array('id_'.$src=>$mainId));
    	$result = $query->result_array();
    	//dla każdego odczytanego rekordu
    	foreach ($result as $row) {
    		$merge[] = $row['id_'.$dst];
    	}
    	
    	/*                                                                                  
    	 * Wyświetlenie wszystkich elementów do połączenia (podzielone na grupy, all, street, garden)
    	 * pokazanie chceckbox-a dla kazdego elementu oraz zaznaczenie jest element byl wczesniej wybrany 
    	 */    
    	$elements = array();                                                                              
    	$this->db->select('id, title, street, garden');
    	$this->db->or_where(array('street'=>1, 'garden'=>1));
    	$this->db->order_by('title');
    	//wybierz tabelę: crown lub fitting 
    	$query = $this->db->get($dst);
    	$result = $query->result_array();
    	
    	//dla każdego odczytanego rekordu
    	foreach ($result as $row) {
    		
    		//jesli istnieje polaczenie miedzy elementem głównym a łączonym
    		$checked = in_array($row['id'], $merge) ? true : false;
    		
    		//dodanie elementu : elements[11][] = '<input checkbox> text'
    		$elements[ $row['street'].$row['garden'] ][] = form_checkbox('element['.$row['id'].']', 1, $checked). ' '. $row['title'];
    	}

    	$data['msg_css'] = '';
    	$data['msg'] = '';
    	$data['list'] = $elements;
    	
    	$data['templateContent'] = $this->load->view($this->module_url.'/list', $data, true);
			$this->load->view('main_panel', $data);
    }
    
    /**
    | Funkcja zapisuje mergowane elementy
    |
    |
    */
    public function merge_save() {
    	
    }
    
    
    
    
    
    
    
    
}
