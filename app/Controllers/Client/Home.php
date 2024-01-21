<?php
use App\Core\Controller;

class Home extends Controller {
    public $model_home;
    public function __construct() {
        //$this->model của core/Controller
       $this->model_home = $this->model('HomeModel');
    }
    public function index() {
      
        echo "<h2>This is main page lê lê</h2>";
        echo '<h1>Trang chủ</h1>';
        echo '<a href="chi-tiet-san-pham">CTSP</a>';

        var_dump($this->model_home);
    }


}

?>


