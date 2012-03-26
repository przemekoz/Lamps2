<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Controller_Abstract.php';

class Korony extends Controller_Abstract {
 
	public function __construct() {
		parent::__construct();

		/* nazwa tabeli db */
		$this->tablename = 'crown';
		/* url do modułu */
		$this->module_url = 'Korony';
		/* komunikaty */
		$this->msg['edit_success'] 		= 'Korona została dodana';
		$this->msg['insert_success'] 	= 'Korona została zmieniona';
		$this->msg['delete_success'] 	= 'Korona została usunięta';
		
	}
   
}
