<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merge extends CI_Controller {
 
		private $msg;
		private $module_url;
		private $aTextDict;
    
    
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
        
        $this->aTextDict = array(
    		'crownstand'=>'dla opraw stojących',
    		'crownhang'=>'dla opraw wiszących',
    		'fittingstand'=>'stojąca',
    		'fittinghang'=>'wisząca',
    	);
        
        $this->module_url = __CLASS__;
        $this->msg = array(
             'insert_success'   => 'Użytkownik został dodany'
            ,'edit_success'     => 'Użytkownik został zmieniony'
            ,'delete_success'   => 'Użytkownik został usunięty'
        );
        
    }

    
    
    
    /**
    | Funkcja wyswietla liste elementów głownych
    |	@param $src string - tekstowy parametr określający co jest elementem głownym (słup, korona)
    */
    public function choose($src,$dst) {
    	
    	$data['msg'] = '';
    	$data['src'] = $src;
    	$data['dst'] = $dst;
    	$data['msg_css'] = '';
    	/* url modułu */
    	$data['url'] = $this->module_url;
    	
    	$query = $this->db->select('id, title, width, height, mode')->order_by('title')->get($src);
    	$result = $query->result_array();
    	

    	$data['options'] = array();
    	foreach ($result as $row) {
				/* ustalenie typu elementu */    		
    		$mode = !empty($this->aTextDict[ $src.$row['mode'] ]) ? ' /'.$this->aTextDict[ $src.$row['mode'] ].'/' : '';
    		
	    	$data['options'][ $row['id'] ] = $row['title'].' ['.$row['width'].'x'.$row['height'].']'.$mode;
    	}

    	//szablon roboczy metody - domyślnie budowany na zasadzie {nazwa_klasy}/{nazwa_metody}
    	$data['templateContent'] = $this->load->view($this->module_url.'/choose', $data, true);
			$this->load->view('main_panel', $data);
    }
    
    
    /**
    | Funkcja wyswietla ekran łączenia elementów
    |	@param $reqId int - parametr elementu głównego
    |	@param $src string - tekstowy parametr określający co jest elementem głownym (słup, korona)
    |	@param $dst string - tekstowy parametr określający co jest elementami łączonymi do głownego (korona, oprawa)
    */
    //public function merge($mainId, $src, $dst) {
    public function merge() {
    	
    	$mainId = $this->input->get('id'); 
    	$src = $this->input->get('src'); 
    	$dst = $this->input->get('dst');
    	
    	$aText = array('columncrown'=>'kolumna - korony', 'columnfitting'=>'kolumna - oprawy', 'crownfitting'=>'korona - oprawy');
    	
    	$textSrc = array('column'=>'Słup', 'crown'=>'Korona');
    	$textDst = array('crown'=>'koronami', 'fitting'=>'oprawami');
    	
    	/*                                                                                  
    	 * odczytanie istniejacych połączeń dla wybranego elementu głwównego (słup, korona) 
    	 */    
    	$merge = array();                                                                             
    	//$this->db->select('id_'.$dst);
    	//wybierz tabelę: merge_column_crown, merge_column_fitting lub merge_crown_fitting; parametr może być: id_column lub id_crown 
    	//odczytaj pole id_crown, lub id_fitting
    	$query = $this->db->select('id_'.$dst)->get_where('merge_'.$src.'_'.$dst, array('id_'.$src=>$mainId));
    	$result = $query->result_array();
    	//dla każdego odczytanego rekordu
    	foreach ($result as $row) {
    		$merge[] = $row['id_'.$dst];
    	}
    	
    	/* odczytanie typu (mode) głównego elementu.  Na tej podstawie wyświetlenie tylko pasujących rekordów. stand->stand, for_hang->hang, itd. */
    	$query = $this->db->select('mode')->get_where($src, array('id'=>$mainId));
    	$main = $query->row();
    	
    	/*                                                                                  
    	 * Wyświetlenie wszystkich elementów do połączenia (podzielone na grupy, all, street, garden)
    	 * pokazanie chceckbox-a dla kazdego elementu oraz zaznaczenie jest element byl wczesniej wybrany 
    	 */    
    	$elements = array();                                                                              
    	$this->db->select('id, title, street, garden, width, height');
    	$this->db->where('(`mode`=\''.$main->mode.'\') AND (street=1 OR garden=1)');
    	$this->db->order_by('title');
    	//wybierz tabelę: crown lub fitting 
    	$query = $this->db->get($dst);
    	
    	$result = $query->result_array();
    	
    	//dla każdego odczytanego rekordu
    	foreach ($result as $row) {
    		
    		//jesli istnieje polaczenie miedzy elementem głównym a łączonym
    		$checked = in_array($row['id'], $merge) ? true : false;
    		
    		//dodanie elementu : elements[11][] = '<input checkbox> text'
    		
    		$link = '';
    		/* jeśli łączenie korona oprawa -> wyświetl link dodatkowych pcji */
    		if ($src == 'crown' && $dst == 'fitting') {
	    		$link = '<a href="/index.php/'.$this->module_url.'/set_params_crown_fitting?cid='.$mainId.'&fid='.$row['id'].'">ustaw parametry dodatkowe</a>';
    		}
    		
    		$elements[ $row['street'].$row['garden'] ][] = '<td>'.form_checkbox('element['.$row['id'].']', 1, $checked). '</td><td><b>'. $row['title'].'</b></td><td>'.$row['width'].'x'.$row['height'].'</td>';
    	}
    	$data['list'] = $elements;

    	$data['id'] = $mainId;
    	/* kod elementu glownego: column, crown */
    	$data['src'] = $src;
    	/* kod elementu łączonego: crown, fittind */
    	$data['dst'] = $dst;
    	/* url modułu */
    	$data['url'] = $this->module_url;
    	
    	$data['text'] = $aText[$src.$dst];
    	$data['text_src'] = $textSrc[$src];
    	$data['text_dst'] = $textDst[$dst];
    	$query = $this->db->select('title, width, height')->get_where($src,array('id'=>$mainId));
    	
    	$row = $query->row();
    	$data['main'] = $row;
    	$data['msg_css'] = '';
    	$data['msg'] = '';
    	
    	$data['templateContent'] = $this->load->view($this->module_url.'/list', $data, true);
			$this->load->view('main_panel', $data);
    }
    
    /*
    | Funkcja zapisuje mergowane elementy
    */
    public function save() {
    	
    	
    	$id  = $this->input->post('id');
    	$src = $this->input->post('src');
    	$dst = $this->input->post('dst');
    	$aId = $this->input->post('element');
    	
    	/* utworzene nazwy tabeli merge_column_crown, merge_column_fitting, merge_crown_fitting */
    	$tablename = 'merge_'.$src.'_'.$dst;
    	/* usuniecie starych powiazań */

    	
    	
    	// !!!!!!!!!!!!!!!!! //
    	//@todo - zmienic usuwanie tak, zeby usuwal tylko takie ktorych nie am w aId
    	$this->db->delete($tablename, array('id_'.$src=>$id));
    	// !!!!!!!!!!!!!!!!! //
    	
    	
    	
    	/* dla kazdego zaznaczonego elementu dodanie wpisu */
    	foreach ($aId as $value => $one) {
    		$this->db->insert($tablename, array('id_'.$src=>$id, 'id_'.$dst=>$value));
    	}
    	
    	redirect($this->module_url.'/choose/'.$src.'/'.$dst);
    }

    
    /*
    | wyswietla parametry dodatkoe -- przesuniecie oprawy X i Y względem korony
		| konieczne do ustalenie prawidłowego łączenia lampy
    */
    public function set_params_crown_fitting() {
    	/* odczytanie aktualnych ustawien */
    	
			/* jesli nie ma ustawien insert do bazy */
    	
    	/* odczytanie i wyswietleni obrazkow w defaultowych pozycjach */
    	$data = array();
    	/* szerokosc korony */
    	$data['X'] = 120;
    	/* wysokosc korony */
    	$data['Y'] = 50;
    	/* szerokosc oprawy */
    	$data['A'] = 20;
    	/* wysokosc oprawy */
    	$data['B'] = 40;
    	/* wartosc x od ktorej ustawiana jest oprawa lewa */
    	$data['K'] = 0;
    	/* wartosc x od ktorej ustawiana jest oprawa prawa */
    	$data['N'] = $data['X'] - $data['A'];

    	/* przesuniecie wzgledem osi X */
    	$data['LAMBDA_X'] = 0;
    	/* przesuniecie wzgledem osi Y */
    	$data['LAMBDA_Y'] = 0;
    	
    	$data['templateContent'] = $this->load->view($this->module_url.'/set_params_crown_fitting', $data, true);
			$this->load->view('main_panel', $data);
    }

    /*
    | wyswietla parametry dodatkoe -- przesuniecie oprawy X i Y względem korony
		| konieczne do ustalenie prawidłowego łączenia lampy
    */
    public function save_params() {
    	/* usuniecie starego */
    	
			/* insert nowego */
    	
    	/* przekierownaie do ekranu wyboru */
    }
    
    
    
}
