<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class EmailsTemplate extends CI_Controller {

	/**
	 * obiek klasy utilImage - klasa pomocniczych funckcji dot obazkow
	 * @var PK_UtilImage
	 */
	public $UI = null;

	/* przechowuje nazwe pliku tła */
	private $userBackgroundFile;

	/* identyfikator usera */
	private $userId;

	/* główny url modułu */
	private $module_url;

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('div');
		$this->load->helper('email');
		$this->load->library('PK_UtilImage');
		$this->load->library('session');
		$this->load->helper('buttons');
		$this->load->helper('input');
		$this->load->helper('form');
		$this->UI = new PK_UtilImage();


		$this->module_url = 'EmailsTemplate';

		/* identyfikator sesji */
		$aSess = $this->session->all_userdata();
		$this->userId = $aSess['session_id'];
		
		/* jesli user wybral predefiniowane tło */
		if ($this->input->get('bg') > 0)
		{
			$this->userBackgroundFile = "background_".$this->input->get('bg').".jpg";
		}
		/* w przeciwnym przypadku */
		else
		{
			/* ustawienie nazwy pliku ktory uploadowal user */
			$this->userBackgroundFile = 'user_background_'.$this->userId.'.jpg';
		}

	}

	public function choose_template($id) {
		$this->load->library('ajax');

		$this->load->library('xml');
		$this->load->library('parser');
		$this->load->helper('select');

		$arr = array();
		if ($this->xml->load('views_emails/'.$id.'/fields')) {
			$arr = $this->xml->parse();


			foreach ($arr['xml'][0]['items'][0]['item'] as $i) {
				$data[ $i['title'][0]]['top'] = $i['y'][0];
				$data[ $i['title'][0]]['left'] = $i['x'][0];
				$data[ $i['title'][0]] = $data[ $i['title'][0].'_textarea'] = $i['desc'][0];
			}

			$this->db->select('header, content');
			$query = $this->db->get('preview_email');
			$row = $query->row_array();
			if (isset($row['header']) && strlen($row['header'])) {
				$data['header'] = $data['header_textarea'] = nl2br($row['header']);
				$data['header_textarea'] = str_replace('<br>', '', $data['header_textarea']);
				$data['header_textarea'] = str_replace('<br />', '', $data['header_textarea']);
			}
			if (isset($row['content']) && strlen($row['content'])) {
				$data['content'] = $data['content_textarea'] = nl2br($row['content']);
				$data['content_textarea'] = str_replace('<br>', '', $data['content_textarea']);
				$data['content_textarea'] = str_replace('<br />', '', $data['content_textarea']);
			}

			$data['header_class'] = 'class="caption"';
			$data['header_action'] = 'onclick="showTextarea(\'dheader\')"';
			$data['content_class'] = 'class="caption"';
			$data['content_action'] = 'onclick="showTextarea(\'dcontent\')"';
			$data['emailTemplate'] = $this->parser->parse('../views_emails/'.$id.'/template', $data, true);

			//$arrayValuesLabels = array('val1'=>'value 1', 'val2'=>'value 2', 'val3'=>'value 3');
			//$data['select'] = select_custom($arrayValuesLabels);
			$data['select_font'] = select_custom_extra('font');
			$data['select_size'] = select_custom_extra('size');
			$data['select_color'] = select_custom_extra('color');

			$this->load->view('email_template_choose', $data);

		}//if
	}//function




	function upload_bg()
	{
			
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpg';
		$config['max_size']	= '6144';  //6MB
		$config['max_width']  = '3000';
		$config['max_height']  = '3000';
		$config['overwrite']  = TRUE;

		$config['file_name']  = $this->userBackgroundFile;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$this->upload->do_upload('file');

		//przeskalowanie obrazka
		$this->load->library('image_lib');

		$config['image_library'] = 'GD2';
		$config['width'] = 800;
		$config['height'] = 600;
		$config['quality'] = '100%';
		$config['master_dim'] = 'width';
		$config['maintain_ratio'] = TRUE;

		$config['source_image'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->userBackgroundFile;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();

		redirect($this->module_url.'/drag');
	}


	public function drag() {
		$this->load->library('session');
		$this->load->helper('context_menu');
		$this->load->helper('buttons');



		//[rzechowuje tablice JS - informacje o wygenerowanych lampach usera
		$data['JS_ELEMENTS_DATA'] = '';


		/*
		 */
		$this->db->select('id, id_column, id_crown, id_fitting, text_column, text_crown, text_fitting');
		$this->db->where('id_user', $this->userId);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('saved_element');


		//zmienna przechwuje nazwy plikow
		$aItems = array();
		foreach ($query->result() as $row) {
			$filename = "u{$this->userId}_i{$row->id}.png";
			$aItems[] = $filename;
			list($w,$h) = @getimagesize($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$filename);
			$data['JS_ELEMENTS_DATA'] .= "ELEMENTS_DATA['u{$this->userId}_i{$row->id}.png'] = {'text':'{$row->text_column} {$row->text_crown} {$row->text_fitting}', 'count':0, 'width':'{$w}', 'height':'{$h}'};\r\n";
		}

		//var_dump($data['JS_ELEMENTS_DATA']);
		
		
		/*
		 * odczytanie z katalogu obrazkow usera
		 * elementy: u{id_usera}_i{id_elementu}.png
		 * tlo: u{id_usera}bg.jpg
		 */
		/*
		 $bg = '';
		 $aItems = array();
		 if ($handle = opendir('uploads/tmp')) {
			while (false !== ($file = readdir($handle))) {
			if (preg_match('/^u'.$this->userId.'_i[0-9]+\./', $file)) {
			$aItems[] = $file;
			}
			if (preg_match('/u'.$this->userId.'bg\./', $file)) {
			$bg = $file.'?r'.rand(1,99); //dodane zeby nie bylo cachowania obrazkow w przegladare
			}
			}
			closedir($handle);
			}
			*/

		//$data['bg'] = "/uploads/tmp/u{$this->userId}bg.jpg";
		$data['bg'] = '/uploads/'.$this->userBackgroundFile;

		$bgid = $this->input->get('bg');
		/* jezeli jest pli uzytkownika */
		if (is_file($_SERVER['DOCUMENT_ROOT'].$data['bg'])) {
			$bgid = $this->userBackgroundFile;
		}
		/* w przeciwnym przypadku sprawdz czy user wybral predefionowane tlo */
		elseif(empty($bgid)) {
			$bgid = 0;
		}

		//usun z nazwy pliku kropke - > nazwa przekazywane w parametrze get
		//$bgid = str_replace('.', '_', $bgid);
		
		/* przekazanie do szablonu id backgroundu */
		$data['bgid'] = $bgid;
		$data['items'] = $aItems;
		$data['userid'] = $this->userId;


		$this->load->view('drag', $data);
	}//function



	public function pdf($type='I') {
		require('fpdf/fpdf.php');


		//@todo - trzeba sprawdzic czy obrazek zostal zapisany , jak nie to zapisa�

		$pdf = new FPDF();
		$pdf->AddPage('L', 'A4');
		$pdf->SetFont('Arial','B',16);
		$pdf->Image('uploads/u'.$this->userId.'_saved.jpg');
		$pdf->Cell(40,10,'Zapytanie z konfiguratora...');
		$pdf->Ln(10);
		//$pdf->Output();
		return $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/uploads/u'.$this->userId.'.pdf',$type);
	}


	public function choose_item() {
		$data['url'] = $this->module_url;
		$data['bgid'] = $this->input->get('bg');
		$data['inserted_element_id'] = $this->input->get('id');	
		$data['iduser'] = $this->userId;

		/* jesli zdefiniowano lampe */
		if (!empty($data['inserted_element_id'])) {
			$this->db->select('text_column, text_crown, text_fitting');
			$query = $this->db->get_where('saved_element', array('id'=>$data['inserted_element_id']));
			$query = $query->result_array();
			$data['text'] = $query[0]['text_column'].' '.$query[0]['text_crown'].' '.$query[0]['text_fitting'];
			
			list($width, $height) = @getimagesize($_SERVER['DOCUMENT_ROOT'].'/uploads/u'.$this->userId.'_i'.$data['inserted_element_id'].'.png');
			$data['width'] = $width;
			$data['height'] = $height;
		}

		
		$this->load->view('choose_item_pre', $data);
	}

	public function choose_items() {

		$this->load->helper('choose_item');
		$this->load->helper('buttons');

		$bgid 	= 		isset($_GET['bg']) 	 ? $_GET['bg'] : 0;
		$step = 			isset($_GET['step']) 	 ? intval($_GET['step']) 	 : 0;
		$columnId = 	isset($_GET['column']) ? intval($_GET['column']) : 0;
		$crownId = 		isset($_GET['crown'])  ? intval($_GET['crown'])  : 0;
		$fittingId = 	isset($_GET['fitting'])? intval($_GET['fitting']): 0;
		$street = 		isset($_GET['street']) ? intval($_GET['street']) : 0;
		$garden = 		isset($_GET['garden']) ? intval($_GET['garden']) : 0;


		$addWhere = '';
		if ($street) {
			$addWhere = ' AND street=1';
		}
		if ($garden) {
			$addWhere = ' AND garden=1';
		}
		if ($garden && $street) {
			$addWhere = ' AND (garden=1 OR street=1)';
		}


		//jesli przekroczono 3 krok - zapis
		if ($step == 3) {
			$this->save_item();
			return true;
		}

		$data['extra_info'] = '';

		if ($step == 0) {
			$res = $this->db->query("SELECT id, title, 'column' as type FROM `column` WHERE 1 ".$addWhere." ORDER BY title");
		}
		elseif ($step == 1) {
			/* wyswieltelenie tylko takich koron, jakie zostaly polaczone z kolumnami w panelu */
			$res = $this->db->query("SELECT c.id, c.title, 'crown' as type FROM crown c, merge_column_crown m WHERE c.id=m.id_crown AND m.id_column=".$columnId." ".$addWhere." ORDER BY c.title");
		}
		/* nie zostala wybrana korona */
		elseif ($step == 2 && empty($crownId)) {
			/* wyswieltelenie tylko takich opraw, jakie zostaly polaczone ze slupami w panelu */
			$res = $this->db->query("SELECT f.id, f.title, 'fitting' as type FROM fitting f, merge_column_fitting m WHERE f.id=m.id_fitting AND m.id_column=".$columnId." ".$addWhere." ORDER BY f.title");
		}
		/* zostala wybrana korona */
		elseif ($step == 2 && $crownId) {
			/* wysiwetlenie opraw polaczonych z koronami */
			$res = $this->db->query("SELECT f.id, f.title, 'fitting' as type FROM fitting f, merge_crown_fitting m WHERE f.id=m.id_fitting AND m.id_crown=".$crownId." ".$addWhere." ORDER BY f.title");
		}


		$aType = array('column', 'crown', 'fitting');

		$data['bgid'] = $bgid;
		$data['header'] = 'Step '.($step+1);
		$data['columnId'] = $columnId;
		$data['crownId'] = $crownId;
		$data['fittingId'] = $fittingId;
		$data['street'] = $street;
		$data['garden'] = $garden;
		$data['type'] = $aType[$step];
		$data['step'] = $step+1;
		$data['list'] = $res->result();
		$data['userid'] = $this->userId;


		if ($step == 1) {
			$query = $this->db->select('id_fitting')->get_where('merge_column_fitting', array('id_column'=>$columnId));

			/* jezeli istnoieja powiazania wybranej kolumny z oprawami wyswietlenie info */
			if ($query->num_rows()) {
				$data['extra_info'] = 1;
			}

		}



		$this->load->view('choose_item', $data);
	}




	/* ekran wyboru tla predefioniownego lub upload przez usera */
	public function choose_background() {


		$this->load->helper('buttons');
		$this->load->helper('form');


		$this->db->select('id');
		$this->db->order_by('id', 'desc');
		$res = $this->db->get('background');

		$data['list'] = $res->result();
		$data['userid'] = $this->userId;
		$data['url'] = $this->module_url;

		$this->load->view('choose_background', $data);
	}




	/**
	 *
	 * Funckcja pobiera dane o elementacg z bazy, width, height, mode
	 * @return array - zwraza tablice 2 wymiarową
	 */
	private function get_data_elelemnts($p) {
		$v = array();
		$a = array('column', 'crown', 'fitting');
		//odczytanie parametrów z bazy
		for ($i=0; $i<count($a); $i++) {
			if ($a[$i] == 'crown') {
				$q = $this->db->select('id, width, height, mode, number')->get_where($a[$i], array('id'=>$p[$i]));
			} else {
				$q = $this->db->select('id, width, height, mode')->get_where($a[$i], array('id'=>$p[$i]));
			}
			$r = $q->result_array();
			$v[$i] = !empty($r[0]) ? $r[0] : array('id'=>0, 'width'=>0, 'height'=>0, 'mode'=>'');
		}

		//odczytanie obrzków z dysku
		for ($i=0; $i<count($a); $i++) {
			//wczytaj obrazek
			$img = $this->UI->getimage('uploads/'.$a[$i].'_'.$p[$i].'.png');
			$v[$i+3] = !empty($img) ? $img : null;
		}

		return $v;
	}


	public function test() {
		/* -------------------------- */
		/* utworzenie pustego obrazka */
		/* -------------------------- */
		//$img = $this->UI->createimage(100, 100, true);


		//zapisz obrazek oraz jego lustrzane odbicie
		//$this->UI->imagesaveflip($img, 'test', 'PNG');

		$this->load->view('test');
	}


	/* funkcja pomocnicza zapisanie wygenerowanej lampy */
	/* korona dla opraw wiszących */
	/* KORONA :: OPRAWA */
	private function save_item_crown_fitting_hang($column, $crown, $fitting, $imgColumn, $imgCrown, $imgFitting) {
		/* odczytanie parametrów łączenia korony z oprawą */
		$this->db->select('lambda_x, lambda_y');
		$query = $this->db->get_where('merge_crown_fitting', array('id_crown'=>$crown['id'],'id_fitting'=>$fitting['id']));
		$opt = $query->result();
		$opt = $opt[0];

		/* szerokosc obrazka zalezny od szerszego elementu */
		$tmpWidth = $column['width'] > $crown['width'] ? $column['width'] : $crown['width'];
		if ($opt->lambda_x >= 0) {
			$width = $tmpWidth;
		}
		elseif ($opt->lambda_x < 0) {
			$width = $crown['width'] - (2 * $opt->lambda_x); //szerokosc korony + 2*lambda
			$width = $width > $tmpWidth ? $width : $tmpWidth; //sprawdzenie czy nowa szerokosc nie jest mniejsza niz szerokosc kolumny
		}

		$height = $column['height'] + $crown['height'];

		/* -------------------------- */
		/* utworzenie pustego obrazka */
		/* -------------------------- */
		$img = $this->UI->createimage($width, $height, true);





		/* umieszczenie na obrazku korony  - umieszczenie na środku (x) */
		$this->UI->imagecopy($img, $imgCrown, floor(($width-$crown['width'])/2), 0, 0, 0, $crown['width'], $crown['height']);
			
		/* dodanie opraw */
		$top = $crown['height'] - $opt->lambda_y;
		$leftFitingX = 0;
		$rightFitingX = $width-$fitting['width'];

		if ($opt->lambda_x > 0) {
			$leftFitingX = $opt->lambda_x;
			$rightFitingX = $rightFitingX - $opt->lambda_x;
		}

		/* dodanie lewej kolumny */
		$this->UI->imagecopy($img, $imgFitting, $leftFitingX, $top, 0, 0, $fitting['width'], $fitting['height']);
		if ($crown['number'] == 2) {
			/* dodanie prawej kolumny */
			$this->UI->imagecopy($img, $imgFitting, $rightFitingX, $top, 0, 0, $fitting['width'], $fitting['height']);
		}

		//dodaj do nowego obrazka kolumne - umieszczenie na środku (x)
		$this->UI->imagecopy($img, $imgColumn, floor(($width-$column['width'])/2), $crown['height'], 0, 0, $column['width'], $column['height']);

		return $img;
	}


	/* funkcja pomocnicza zapisanie wygenerowanej lampy */
	/* KOLUMNA :: OPRAWA */
	private function save_item_column_fitting($column, $fitting, $imgColumn, $imgFitting) {
		/* szerokosc obrazka zalezny od szerszego elementu */
		$width = $column['width'] > $fitting['width'] ? $column['width'] : $fitting['width'];
		$height = $column['height'] + $fitting['height'];

		/* -------------------------- */
		/* utworzenie pustego obrazka */
		/* -------------------------- */
		$img = $this->UI->createimage($width, $height, true);

		//dodaj do nowego obrazka kolumne - umieszczenie na środku (x)
		$this->UI->imagecopy($img, $imgColumn, floor(($width-$column['width'])/2), $fitting['height'], 0, 0, $column['width'], $column['height']);

		//dodaj oprawę na środku
		$this->UI->imagecopy($img, $imgFitting, floor(($width-$fitting['width'])/2), 0, 0, 0, $fitting['width'], $fitting['height']);

		return $img;
	}

	/* funkcja pomocnicza zapisanie wygenerowanej lampy */
	/* korona dla opraw stojących */
	/* KORONA :: OPRAWA */
	private function save_item_crown_fitting_stand($column, $crown, $fitting, $imgColumn, $imgCrown, $imgFitting) {

		/* odczytanie parametrów łączenia korony z oprawą */
		$this->db->select('lambda_x, lambda_y');
		$query = $this->db->get_where('merge_crown_fitting', array('id_crown'=>$crown['id'],'id_fitting'=>$fitting['id']));
		$opt = $query->result();
		$opt = $opt[0];

		/* szerokosc obrazka zalezny od szerszego elementu */
		$tmpWidth = $column['width'] > $crown['width'] ? $column['width'] : $crown['width'];
		if ($opt->lambda_x >= 0) {
			$width = $tmpWidth;
		}
		elseif ($opt->lambda_x < 0) {
			$width = $crown['width'] - (2 * $opt->lambda_x); //szerokosc korony + 2*lambda
			$width = $width > $tmpWidth ? $width : $tmpWidth; //sprawdzenie czy nowa szerokosc nie jest mniejsza niz szerokosc kolumny
		}

		$height = $column['height'] + $fitting['height'] + $crown['height'];
		if ($opt->lambda_y > 0) {
			$height = $height - $opt->lambda_y;
		}

		/* -------------------------- */
		/* utworzenie pustego obrazka */
		/* -------------------------- */
		$img = $this->UI->createimage($width, $height, true);


		//dodaj do nowego obrazka kolumne - umieszczenie na środku (x)
		$top = $fitting['height'] + $crown['height'] - $opt->lambda_y;
		$this->UI->imagecopy($img, $imgColumn, floor(($width-$column['width'])/2), $top, 0, 0, $column['width'], $column['height']);

		/* umieszczenie na obrazku korony  - umieszczenie na środku (x) */
		/* odejmowane tylko jak lambda > 0 (lambda_y nie moze byc ujemna) */
		$top = $fitting['height'] - $opt->lambda_y;
		$this->UI->imagecopy($img, $imgCrown, floor(($width-$crown['width'])/2), $top, 0, 0, $crown['width'], $crown['height']);
			
		/* dodanie opraw */
		$leftFitingX = 0;
		$rightFitingX = $width-$fitting['width'];

		if ($opt->lambda_x > 0) {
			$leftFitingX = $opt->lambda_x;
			$rightFitingX = $rightFitingX - $opt->lambda_x;
		}

		/* dodanie lewej kolumny */
		$this->UI->imagecopy($img, $imgFitting, $leftFitingX, 0, 0, 0, $fitting['width'], $fitting['height']);
		if ($crown['number'] == 2) {
			/* dodanie prawej kolumny */
			$this->UI->imagecopy($img, $imgFitting, $rightFitingX, 0, 0, 0, $fitting['width'], $fitting['height']);
		}
		return $img;
	}

	/*
	 |
	 CREATE TABLE IF NOT EXISTS saved_element (
	 id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	 id_user INT NOT NULL DEFAULT 0,
	 id_column INT NOT NULL DEFAULT 0,
	 id_crown INT NOT NULL DEFAULT 0,
	 id_fitting INT NOT NULL DEFAULT 0,
	 text_column VARCHAR(255) NOT NULL DEFAULT '',
	 text_crown VARCHAR(255) NOT NULL DEFAULT '',
	 text_fitting VARCHAR(255) NOT NULL DEFAULT ''
	 );

	 |
	 */
	public function save_item() {

		$idColumn = 	isset($_GET['column']) ? intval($_GET['column']) : 0;
		$idCrown = 		isset($_GET['crown'])  ? intval($_GET['crown'])  : 0;
		$idFitting = 	isset($_GET['fitting'])? intval($_GET['fitting']): 0;
		$bgid = 			isset($_GET['bg'])	 	 ? $_GET['bg'] : 0;

		/* pobranie danych kolumny, oprawy, korony oraz zapisanie do zmiennych tablicowych. Tablica: np. $column['width'], $column['height'], $column['mode'] */
		list($column, $crown, $fitting, $imgColumn, $imgCrown, $imgFitting) = $this->get_data_elelemnts(array($idColumn, $idCrown, $idFitting));

		/* jezeli nie ma korony -> kolumna :: oprawa */
		if (empty($idCrown)) {
			$img = $this->save_item_column_fitting($column, $fitting, $imgColumn, $imgFitting);
		}
		/* jezeli jest korona dla stojacych opraw */
		elseif (!empty($idCrown) && $crown['mode'] == 'stand') {
			$img = $this->save_item_crown_fitting_stand($column, $crown, $fitting, $imgColumn, $imgCrown, $imgFitting);
		}
		/* jezeli jest korona dla wiszących opraw */
		elseif (!empty($idCrown) && $crown['mode'] == 'hang') {
			$img = $this->save_item_crown_fitting_hang($column, $crown, $fitting, $imgColumn, $imgCrown, $imgFitting);
		}

		//zapisz do bazy id_usera, wybrane elementy, kody, tych elementów + nazwę wygenerowanego pliku

		//ustawienie jake pola nalezy zczytac
		$this->db->select('title');

		//tablica pmocnicza, przechowuje dane z bazy o elementach
		$t = array();
		$a = array('column', 'crown', 'fitting');
		//dla kazdego typu elementu zczytanie z bazy danych i zapisanie do tablicy pomocniczej
		foreach ($a as $element) {
			//dodanie do where wartosci z GET
			$this->db->where('id', $this->input->get($element));
			//ustawienie odpowiedniaj nazwy tabeli
			$query = $this->db->get($element);
			$row = $query->row_array();
			$t[$element] = $row['title'];
		}


		//zapisz calosc
		$insert = array(
			'id_user'		=>$this->userId,
			'id_column'	=>$this->input->get('column'),
			'text_column'=>$t['column'],
			'id_crown'	=>$this->input->get('crown'),
			'text_crown'=>$t['crown'],
			'id_fitting'=>$this->input->get('fitting'),
			'text_fitting'=>$t['fitting'],
			'add_date'=>date('Y-m-d')
		);
		$this->db->insert('saved_element',$insert);

		//opdczytanie dodanego idka
		$lastId = $this->db->insert_id();

		//ustawienie nazwy pliku
		$filename = 'u'.$this->userId.'_i'.$lastId;

		//zapisz obrazek oraz jego lustrzane odbicie
		$this->UI->imagesaveflip($img, $filename, 'PNG');

		//przeskalowanie wygenerowanych lamp
		$this->load->library('image_lib');

		$config['image_library'] = 'GD2';
		$config['width'] = 800;//170
		
		
		/* odczytanie wysokosci tla */
		list($bw, $bh) = @getimagesize($_SERVER[DOCUMENT_ROOT].'/uploads/'.$bgid);
		$config['height'] = empty($bh) ? 600 : $bh;//500
		
		$config['quality'] = '100%';
		//$config['master_dim'] = 'width';
		$config['maintain_ratio'] = TRUE;

		$config['source_image'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$filename.'.png';
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();

		$config['source_image'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/inv_'.$filename.'.png';
		$this->image_lib->initialize($config);
		$this->image_lib->resize();

		//czyszczene starych plików
		$this->clear_old_files();

		redirect($this->module_url.'/choose_item?id='.$lastId);
	}

	/* czyści pliki starsze niż tydzień */
	public function clear_old_files() {
		
		///////////////////////////////////////////////
		// @todo - przemyslec usuwanie starych plikow
		///////////////////////////////////////////////
		
		return true;
		
		/* odczytanie plików do usuniecia */
		$this->db->select('id_user');
		$this->db->where('add_date < NOW() + INTERVAL - 2 WEEK');
		$this->db->group_by('id_user');
		$query = $this->db->get('saved_element');
		$row = $query->result();

		foreach ($row as $row) {
				
		/* usunięcie plików */
			if ($handle = opendir($_SERVER['DOCUMENT_ROOT'].'/uploads/')) {
				while (false !== ($file = readdir($handle))) {
					if (preg_match('/^u'.$row->id_user.'_i[0-9]+\./', $file)) {
						@unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$file);
					}
					if (preg_match('/^inv_u'.$row->id_user.'_i[0-9]+\./', $file)) {
						@unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$file);
					}
					if (preg_match('/^u'.$row->id_user.'_saved\./', $file)) {
						@unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$file);
					}
					if (preg_match('/^user_background_'.$row->id_user.'\./', $file)) {
						@unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$file);
					}
					if (preg_match('/^u'.$row->id_user.'\.pdf/', $file)) {
						@unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$file);
					}
					
				}
				closedir($handle);
			}
				
			/* usunięcie rekordów w bazeie saved_element */
			$this->db->delete('saved_element', array('id_user'=>$row->id_user));	
				
		}


	}

	public function save_item__OLD() {


		$img = $this->UI->createimage(200, 550, true);

		//wczytaj i dodaj do nowego obrazka kolumne
		$column = $this->UI->getimage('uploads/column_'.intval($_GET['column']).'.png');
		$this->UI->imagecopy($img, $column, 0, 195, 0, 0, imagesx($column), imagesy($column));

		//wczytaj i dodaj do nowego obrazka korone
		$crown = $this->UI->getimage('uploads/crown_'.intval($_GET['crown']).'.png');
		$this->UI->imagecopy($img, $crown, 0, 120, 0, 0, imagesx($crown), imagesy($crown));

		//wczytaj i dodaj do nowego obrazka oprawe
		$fitting = $this->UI->getimage('uploads/fitting_'.intval($_GET['fitting']).'.png');
		$this->UI->imagecopy($img, $fitting, 0, 0, 0, 0, imagesx($fitting), imagesy($fitting));

		//zapisz do bazy id_usera, wybrane elementy, kody, tych elementów + nazwę wygenerowanego pliku

		//ustawienie jake pola nalezy zczytac
		$this->db->select('title');

		//tablica pmocnicza, przechowuje dane z bazy o elementach
		$t = array();
		$a = array('column', 'crown', 'fitting');
		//dla kazdego typu elementu zczytanie z bazy danych i zapisanie do tablicy pomocniczej
		foreach ($a as $element) {
			//dodanie do where wartosci z GET
			$this->db->where('id', $this->input->get($element));
			//ustawienie odpowiedniaj nazwy tabeli
			$query = $this->db->get($element);
			$row = $query->row_array();
			$t[$element] = $row['title'];
		}


		//zapisz calosc
		$insert = array(
			'id_user'=>$this->userId,
			'id_column'=>$this->input->get('column'),
			'text_column'=>$t['column'],
			'id_crown'=>$this->input->get('crown'),
			'text_crown'=>$t['crown'],
			'id_fitting'=>$this->input->get('fitting'),
			'text_fitting'=>$t['fitting']
		);
		$this->db->insert('saved_element',$insert);

		//opdczytanie dodanego idka
		$lastId = $this->db->insert_id();

		//ustawienie nazwy pliku
		$filename = 'u'.$this->userId.'_i'.$lastId;

		//zapisz obrazek oraz jego lustrzane odbicie
		$this->UI->imagesaveflip($img, $filename, 'PNG');

		redirect($this->module_url.'/drag');
	}



	//wczytuje obrazek dodnay przez usera
	public function get_bg_image($filename) {

		return $this->UI->getimage($filename);

		/*
		 * po testach wywalic !
		 *
		 $dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
		 $filename = $dir.strtolower($filename);

		 if (!@is_file($filename) || !extension_loaded('gd')) {
			return false;
			}

			$im = false;
			if (preg_match('/\.gif/', $filename)) {
			$im = @imagecreatefromgif($filename);
			}
			if (preg_match('/\.jpg/', $filename) || preg_match('/\.jpeg/', $filename)) {
			$im = @imagecreatefromjpeg($filename);
			}
			if (preg_match('/\.png/', $filename)) {
			$im = @imagecreatefrompng($filename);
			}

			return $im;
			*/

	}//function

	//wyswietla obrazek
	public function get_image($filename) {

		$dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';

		$img = $this->get_bg_image($filename);

		imagejpeg($img, $dir.'generated_bg[id_usera_zalogowanego].jpg');

		imagedestroy($img);
	}//function





	public function ajax_save_image()
	{
		$aProducts = json_decode($_POST['products']);
		$file = $_POST['bg'];
		
		
		if (!strlen($file) || !is_file($_SERVER['DOCUMENT_ROOT'].$file)) {
			
			echo $file;
			return false;
		}

		//wczytaj obrazek tla
		$bg = $this->UI->getimage($file);

		//iterator produktów
		$i = 1;
		$aInfo = array();
		foreach ($aProducts as $key => $row) {
			/*
			 * $filename - plik obrazka
			 * $x - wsp x na canvasie
			 * $y - wsp y na canvasie
			 * $width - szerokosc obrazka jak > 0 to trzeba skalowac
			 * $height - wysokosc obrazka jak > 0 to trzeba skalowac
			 * $type - norm, invert - normalne czy lustrane odbicie
			 */
			list($filename, $x, $y, $width, $height, $type, $param, $text) = $row;

			if (!is_file($_SERVER['DOCUMENT_ROOT'].$filename)) {
				continue;
			}

			$aInfo[] = $text;
			
			//dodaj nowy pobrazek
			$product = $this->UI->getimage($filename);

			//przeskalowany przez JS
			if ($width > 0 && $height > 0) {
				//utworzenie nowego obrazka
				$newImg = $this->UI->createimage($width, $height, true);
				$this->UI->imageresize($newImg, $product, 0, 0, 0, 0, $width, $height, imagesx($product), imagesy($product));
				$product = $newImg;
			}

			//naloz na tło
			$this->UI->imagecopy($bg, $product, $x, $y, 0, 0, imagesx($product), imagesy($product));
				
			/* dodaj opis z numerem obrazka - kwadracik z numerem */
			//$this->UI->add_product_label($bg, $product, $x, $y, $i++);

			$this->UI->imagedestroy($product);
		}
		
		$this->UI->add_header('uploads/logo.png');
		$this->UI->imagesave($bg, 'uploads/u'.$this->userId.'_saved', 'JPG', $aInfo);
		$this->UI->imagedestroy($bg);
	}


	public function download($file, $type='pdf') {

		// Set headers
		@header("Cache-Control: public");
		@header("Content-Description: File Transfer");
		@header("Content-Disposition: attachment; filename=$file");
		if ($type == 'pdf') {
			@header("Content-Type: application/pdf");
		}
		if ($type == 'jpg') {
			@header("Content-Type: image/jpeg");
		}
		@header("Content-Transfer-Encoding: binary");

		// Read the file from disk
		readfile($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$file);
	}

	public function downloadPdf() {
		$this->pdf('D');
	}

	public function downloadJpg() {


		$this->download('u'.$this->userId.'_saved.jpg', 'jpg');
	}




	public function send_form() {

		$data = array('userid'=>$this->userId, 'url'=>$this->module_url);
		$this->load->view('main_template', $data);
	}

	public function send() {

		//die('odblokuj :: wysylka maila...');

		//zapisanie pdf-a
		$filename = $this->pdf('F');

		$my_file = 'u'.$this->userId.'.pdf';
		$my_path = $_SERVER['DOCUMENT_ROOT']."/uploads/";
		//$my_path = "http://44soft.vipserv.org/uploads/";

		$my_name = $this->input->post('my_name');
		$my_mail = $this->input->post('my_email');
		$my_company = $this->input->post('my_company');
		$my_message = $this->input->post('my_text')."\r\n\r\nPozdrawiam\r\n".$my_name." - ".$my_company." - ".$my_mail;

		$my_replyto = $my_mail;
		$my_subject = "Zapytanie z aplikacji WWW";
		//biuro@promar-sj.com.pl
		//mail_attachment($my_file, $my_path, "biuro@promar-sj.com.pl", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
		mail_attachment($my_file, $my_path, "przemekoz@o2.pl", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
		redirect($this->module_url.'/send_ok');
	}

	public function send_ok() {
		$this->load->view('send_email_ok', array('userid'=>$this->userId));
	}

	public function preview() {
		echo '<html><body><img src="/uploads/u'.$this->userId.'_saved.jpg?r='.md5(microtime()).'"></body></html>';
	}

}
