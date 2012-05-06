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
    	if ($src == 'column' && $dst == 'crown') {
	    	$this->db->where('(street=1 OR garden=1)');
    	} else {
	    	$this->db->where('(`mode`=\''.$main->mode.'\') AND (street=1 OR garden=1)');
    	}
    	
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
	    		$link = ' <a href="/konfigurator.php/'.$this->module_url.'/set_params_crown_fitting?cid='.$mainId.'&fid='.$row['id'].'">ustaw łączenie</a>';
    		}
    		elseif ($src == 'column' && $dst == 'crown') {
	    		$link = ' <a href="/konfigurator.php/'.$this->module_url.'/set_params_column_crown?cid='.$mainId.'&crid='.$row['id'].'">ustaw łączenie</a>';
    		}
    		
    		$elements[ $row['street'].$row['garden'] ][] = '<td>'.form_checkbox('element['.$row['id'].']', 1, $checked). '</td><td><b>'. $row['title'].'</b></td><td>'.$row['width'].'x'.$row['height'].$link.'</td>';
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
    	//@todo - zmienic usuwanie tak, zeby usuwal tylko takie ktorych nie am w aId
    	
    	if (is_array($aId)) {
	    	$aW = array();
	    	foreach ($aId as $value => $one) {
	    		$aW[] = $value;
	    	}
	    	$this->db->where('id_'.$dst.' NOT IN ('.implode(',',$aW).')');
	    	$this->db->delete($tablename, array('id_'.$src=>$id));
    	}
    	else {
	    	$this->db->delete($tablename, array('id_'.$src=>$id));
    	}
    	
    	
    	/* dla kazdego zaznaczonego elementu dodanie wpisu */
    	foreach ($aId as $value => $one) {
    		
    		$this->db->query("INSERT INTO `".$tablename."` (".'id_'.$src.",`".'id_'.$dst."`) VALUES (".$id.",".$value.") ON DUPLICATE KEY UPDATE ".'id_'.$dst.'='.$value);
    		
    		//$this->db->insert($tablename, array('id_'.$src=>$id, 'id_'.$dst=>$value));
    	}
    	
    	redirect($this->module_url.'/choose/'.$src.'/'.$dst);
    }

    
    /*
    | wyswietla parametry dodatkoe -- przesuniecie oprawy X i Y względem korony
		| konieczne do ustalenie prawidłowego łączenia lampy
    */
    public function set_params_crown_fitting() {
    	$data = array();
    	$crownId = $this->input->get('cid');
    	$fittingId = $this->input->get('fid');
    	
    	/* odczytanie aktualnych ustawien */
    	$this->db->select('width, height, number, title, mode');
    	$query = $this->db->get_where('crown', array('id'=>$crownId));
    	$row = $query->result_array();
    	/* szerokosc korony */
    	$data['X'] = $row[0]['width'];
    	/* wysokosc korony */
    	$data['Y'] = $row[0]['height'];
    	/*jesli dla korony jest jedna oprawa nie wysiwetlaj prawej */
    	$data['show_right_fitting'] = $row[0]['number'] == 1 ? 'display:none' : '';
    	$data['crown_title'] = $row[0]['title'];
    	$data['mode'] = $row[0]['mode'];
    	
    	
    	$this->db->select('width, height, title');
    	$query = $this->db->get_where('fitting', array('id'=>$fittingId));
    	$row = $query->result_array();
    	/* szerokosc oprawy */
    	$data['A'] = $row[0]['width'];
    	/* wysokosc oprawy */
    	$data['B'] = $row[0]['height'];
    	$data['fitting_title'] = $row[0]['title'];

    	/* wartosc x od ktorej ustawiana jest oprawa lewa */
    	$data['K'] = 0;
    	/* wartosc x od ktorej ustawiana jest oprawa prawa */
    	$data['N'] = $data['X'] - $data['A'];

    	/* odczytanie i wyswietleni obrazkow w defaultowych pozycjach */
    	$this->db->select('lambda_x, lambda_y');
    	$query = $this->db->get_where('merge_crown_fitting', array('id_crown'=>$crownId, 'id_fitting'=>$fittingId));
    	$row = $query->result_array();
    	/* przesuniecie wzgledem osi X */
    	$data['LAMBDA_X'] = $row[0]['lambda_x'];
    	/* przesuniecie wzgledem osi Y */
    	$data['LAMBDA_Y'] = $row[0]['lambda_y'];

    	/* ulożenie dla opraw stojących - oprawy na górze, korona na dole */
    	$data['top_crown'] = $data['B'];
    	$data['top_fitting'] = 0;
    	/* ulożenie dla opraw wiszących - oprawy na dole, korona na górze */
    	if ($data['mode'] == 'hang') {
	    	$data['top_crown'] = 0;
	    	$data['top_fitting'] = $data['Y'];
    	}
    	
    	$data['cid'] = $this->input->get('cid');
    	$data['fid'] = $this->input->get('fid');
    	$data['url'] = $this->module_url;
    	$data['dir_relative'] = '/uploads/';
    	
    	$data['templateContent'] = $this->load->view($this->module_url.'/set_params_crown_fitting', $data, true);
			$this->load->view('main_panel', $data);
    }

    /*
    | wyswietla parametry dodatkoe -- przesuniecie oprawy X i Y względem korony
		| konieczne do ustalenie prawidłowego łączenia lampy
    */
    public function save_params() {
    	$crownId = $this->input->post('id_crown');
    	$fittingId = $this->input->post('id_fitting');
    	
			/* usuniecie starego */
    	$this->db->where(array('id_crown'=>$crownId, 'id_fitting'=>$fittingId));
    	$this->db->delete('merge_crown_fitting');
    	//echo $this->db->last_query();
    	//die;
    	
			/* insert nowego */
    	$this->db->insert('merge_crown_fitting', $_POST);
    	
			/* przekierownaie do ekranu wyboru */
    	redirect($this->module_url.'/merge?src=crown&dst=fitting&id='.$crownId);
    }

    
    /*
    | wyswietla parametry dodatkoe -- przesuniecie korony wzgledem kolumny (X)
    */
    public function set_params_column_crown() {
    	$data = array();
    	$crownId = $this->input->get('crid');
    	$columnId = $this->input->get('cid');
    	
    	/* odczytanie aktualnych ustawien */
    	$this->db->select('width, height, title');
    	$query = $this->db->get_where('column', array('id'=>$columnId));
    	$row = $query->result_array();
    	/* szerokosc kolumny */
    	$data['X'] = $row[0]['width'];
    	/* wysokosc kolumny */
    	$data['Y'] = $row[0]['height'];
    	$data['column_title'] = $row[0]['title'];
    	
    	
    	$this->db->select('width, height, title');
    	$query = $this->db->get_where('crown', array('id'=>$crownId));
    	$row = $query->result_array();
    	/* szerokosc corony */
    	$data['A'] = $row[0]['width'];
    	/* wysokosc corony */
    	$data['B'] = $row[0]['height'];
    	$data['crown_title'] = $row[0]['title'];

    	/* wartosc x od ktorej ustawiana jest oprawa lewa */
    	$data['K'] = 0;

    	/* odczytanie i wyswietleni obrazkow w defaultowych pozycjach */
    	$this->db->select('lambda_x');
    	$query = $this->db->get_where('merge_column_crown', array('id_crown'=>$crownId, 'id_column'=>$columnId));
    	$row = $query->result_array();
    	/* przesuniecie wzgledem osi X */
    	$data['LAMBDA_X'] = $row[0]['lambda_x'];
    	
    	$data['cid'] = $this->input->get('cid');
    	$data['crid'] = $this->input->get('crid');
    	$data['url'] = $this->module_url;
    	$data['dir_relative'] = '/uploads/';
    	
    	$data['templateContent'] = $this->load->view($this->module_url.'/set_params_column_crown', $data, true);
			$this->load->view('main_panel', $data);
    }
    
    
    
    // do laczenia kolumn z koronami (porblem jednostronnych)
    public function save_params2() {
    	$crownId = $this->input->post('id_crown');
    	$columnId = $this->input->post('id_column');
    	
			/* usuniecie starego */
    	$this->db->where(array('id_crown'=>$crownId, 'id_column'=>$columnId));
    	$this->db->delete('merge_column_crown');
    	//echo $this->db->last_query();
    	//die;
    	
			/* insert nowego */
    	$this->db->insert('merge_column_crown', $_POST);
    	
			/* przekierownaie do ekranu wyboru */
    	redirect($this->module_url.'/merge?src=column&dst=crown&id='.$columnId);
    }
    
    
    
}
