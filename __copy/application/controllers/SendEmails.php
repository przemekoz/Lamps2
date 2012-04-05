<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SendEmails extends CI_Controller {
 
    public function __construct() {
      parent::__construct();
    }

    /**
     * pobiera adresy i zapisuje do bufora
     * 
     * @return bool
     */
    public function fetch() {
        echo ' fetch addresses... ';
        
        $this->db->select('email, username');
        $query = $this->db->get('contact');
        
        $aItems = array();
        foreach($query->result() as $row) {
           $aItems[] = array('email'=>$row->email, 'username'=>$row->username); 
        }        
        
        if (!isset($aItems[0])) { //zamiast !count($aItems)
            return false;
        } 
        
        $this->db->insert_batch('send_buffor', $aItems);
        return true;
    }

    /**
     * wyświetla stronę informacyja że będzie wysyłka odbywała się automatycznie - ajax
     */
    public function pre_send() {
        
        $this->load->view('pre_send', $data);
    }
    
    
    
    /**
     * wysyła paczkę wiadomości  - pobiera dane z bufora i zapisuje wynik czy wysłano poparwnie
     * @return string
     */
    public function ajax_send_pack($cronTime) {
        
        
        $pack = 10; //default value
        
        /*
         * zczytanie koniguracji - testowej wysylki lub czasu porzedniego wykonania skryptu
         */
        $this->db->select('duration, pack');
        $query = $this->db->get('send_param');
        $row = $query->row_array();
        
        
        if (isset($row['duration']) && round($row['duration']) == -1 && $row['pack'] > 0) {
            /*
             * kolejne wysyłki 
             */
            $durationTime = $this->send($row['pack']);
            echo 'pack-send';
            die;
        }
        else if (isset($row['duration']) && $row['duration'] > 0) {
           /*
            * pierwsze uruchomienie po testowej wysyłce
            */
           
           // czas wysyłki testowej paczki * czas crona - 20%
           $nPack = ($row['pack'] * $cronTime / $row['duration']);
           $pack = round( $nPack - ($nPack * 1/5) ); //nowa paczka - 20%
           
           $this->send($pack);
                   
           $data = array('duration'=>-1, 'pack'=>$pack);
           $this->db->update('send_param', $data);
           echo 'fist-run-after-test-pack';
           die;
        } 
        
       /*
        * pierwsze uruchomienie skryptu - testowa wysyłka paczki maili
        */ 
       $durationTime = $this->send($pack);

       $data = array('duration'=>$durationTime, 'pack'=>$pack);
       $this->db->update('send_param', $data);
       echo 'test-pack-send';
    }
    
    
    /*
     * Wysyłka paczki mali
     * zwaraca czas trwania wysyłki
     * @param db res
     * @return float
     */
    private function send($pack) {
        $startTime = microtime(true);
        
        $this->db->select('id, email, username');
        $this->db->where('send', -1);
        $query = $this->db->get('send_buffor', $pack);
        
        //pusty bufor
        if (!count($query->result())) {
           echo 'no-email-to-send'; 
           die;
        }
        
        $aRes[0] = array(); //id rekordow dla niepoprawnej wysylki
        $aRes[1] = array(); //id rekordow dla poprawnej wysylki
        
        /*
         * wysyłka maili i  zapamiętanie wyniku opeacji mail()
         */
        foreach($query->result() as $row) {
            $res = $this->mail($row->username.'<'.$row->email.'>');
            $aRes[$res][] = $row->id;
        }
        
        /*
         * update odpowiednich statusów wysyłki
         */
        for ($i=0; $i<2; $i++) {

            if (!isset($aRes[$i][0])) {
                continue;
            }
            
            $data = array('send'=>$i);
            $this->db->where_in('id', $aRes[$i]);
            $this->db->update('send_buffor', $data);
        }
        
        return microtime(true) - $startTime;
    }
    
    
    
    public function ajax_show_progress() {
        
        $query = $this->db->get('send_buffor');
        $all = $query->num_rows();
        
        if ($all == 0) {
           return 0; 
        }
        
        $this->db->where('send >', -1);
        $query = $this->db->get('send_buffor');
        $send = $query->num_rows(); 
        
        $percent = round(100 * ($send / $all));
        
        echo '<div style="width:'.$percent.'%; height:100%;background: green"></div>';
        die;
    }
    
    public function show_report() {
        echo 'show report...';
    }

    private function clear_buffor($clear) {
        if ($clear) {
            $this->db->truncate('send_buffor');
            echo 'clear buffor';
        } else {
            echo 'not clear buffor';
        }
    }

    
    public function upload() {
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size']	= '2048'; //KB
        $config['max_width']  = '1799';
        $config['max_height']  = '999';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);    
        
        if ( ! $this->upload->do_upload('fileId'))
        {
                $error = array('error' => $this->upload->display_errors());
                echo $this->upload->display_errors();    
                print_r( $this->upload->data() );    
                //$this->load->view('upload_form', $error);
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());
                print_r( $this->upload->data() );    
                //$this->load->view('upload_success', $data);
        }
    }
    
    
    
    /**
     * 0 - nie wyslano
     * 1 - wyslano
     * @param string $to
     * @return int  
     */
    private function mail($to) {
        //echo "wysyłam mail do: $to<br>";
        //@todo - ma zwrocic wynik dzialania funcki mail()
        sleep(rand(0,3));
        return rand(0,1);
    }
}


