<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

abstract class Elements {

    protected $img;

    public function getImg() {
        return $this->img;
    }

}

class Fitting extends Elements {

    public function __construct() {
        $this->img = 'test_fitting_1.png';
    }

}

class Crown extends Elements {

    private $type; //typ korony oprawy na: gorze|dole, liczba opraw: pojedyncza|podwojna

    public function __construct() {
        $this->img = 'test_crown_1.png';
        $this->type = array('orientation' => 'bottom', 'count' => 1);
    }

    public function getTypeOrientation() {
        return $this->type['orientation'];
    }

    public function getTypeCount() {
        return $this->type['count'];
    }

}

class Column extends Elements {

    public function __construct() {
        $this->img = 'test_column_2.png';
    }

}

class Element {

    /**
     *
     * @var Column 
     */
    private $column = null;
    /**
     *
     * @var Crown 
     */
    private $crown = null;
    private $aFitting = array();

    public function __construct() {
        ;
    }

    public function addColumn($column) {
        $this->column = $column;
    }

    public function addCrown($crown) {
        $this->crown = $crown;
    }

    public function addFitting($fitting) {

        if (count($this->aFitting) == 2) {
            return;
        }

        $this->aFitting[] = $fitting;
    }

    public function create() {
        $dir = './uploads/';

        // narysuj obrazek tła (w zaleznosci od typu korony) o wymiarach 200 x 600 (oprawy na gorze) lub 200 x 500 (oprawy na dole)
        $height = 500;
        $setColumnY = 100;
        if ($this->crown->getTypeOrientation() == 'top') {
            $height = 600;
            $setColumnY = 200;
        }

        // Create image
        $im = imagecreatetruecolor(200, $height);

        $black = imagecolorallocate($im, 0, 0, 0);

        // Make the background transparent
        imagecolortransparent($im, $black);


        //na dole dodaj słup
        $column = imagecreatefrompng($dir . $this->column->getImg());
        imagecopy($im, $column, 0, $setColumnY, 0, 0, 200, 400);

        //naloz korone na slupie
        $crown = imagecreatefrompng($dir . $this->crown->getImg());
        imagecopy($im, $crown, 0, $setColumnY - 100, 0, 0, 200, 100);


        //w zaleznosci od typu korony naloz oprawe/y
        $y = ($height == 600) ? 0 : 100;
        for ($i = 0; $i < $this->crown->getTypeCount(); $i++) {
            $x = $i * 100;
            $fitting = imagecreatefrompng($dir . $this->aFitting[$i]->getImg());
            imagecopy($im, $fitting, $x, $y, 0, 0, 100, 100);
            imagedestroy($fitting);
        }


        // Save the image
        imagepng($im, './uploads/test_element.png');
        //lustrzane odbicie
        $this->flip($im);

        imagedestroy($im);
        imagedestroy($column);
        imagedestroy($crown);
    }

    public function flip($imgsrc, $mode = 2) {
        $width = imagesx($imgsrc);
        $height = imagesy($imgsrc);

        $src_x = 0;
        $src_y = 0;
        $src_width = $width;
        $src_height = $height;

        switch ($mode) {

            case '1': //vertical
                $src_y = $height - 1;
                $src_height = -$height;
                break;

            case '2': //horizontal
                $src_x = $width - 1;
                $src_width = -$width;
                break;

            case '3': //both
                $src_x = $width - 1;
                $src_y = $height - 1;
                $src_width = -$width;
                $src_height = -$height;
                break;

            default:
                return $imgsrc;
        }

        $imgdest = imagecreatetruecolor($width, $height);

        $black = imagecolorallocate($imgdest, 0, 0, 0);

        // Make the background transparent
        imagecolortransparent($imgdest, $black);

        imagecopyresampled($imgdest, $imgsrc, 0, 0, $src_x, $src_y, $width, $height, $src_width, $src_height);
        
        imagepng($imgdest, './uploads/test_element_invert.png');
        imagedestroy($imgdest);
        return $imgdest;
    }

}

$crown = new Crown();
$column = new Column();
$fitting = new Fitting();

$element = new Element();
$element->addColumn($column);
$element->addCrown($crown);
$element->addFitting($fitting);
$element->addFitting($fitting);
$element->create();
?>