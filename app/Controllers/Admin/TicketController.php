<?php


namespace App\Controllers\Admin;

use App\Core\Session;
use App\Core\Request;
use App\Core\Response;
use DateTime;

use App\Core\Controller;

class TicketController extends Controller{
    public $data = [];
    public $request;
    public $response;


    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function index() {
        Session::set('title_page', 'Danh sách vé máy bay');

        $this->data['main']= 'admin/tickets/list';
        $this->data['content']['title']= "Danh sách vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function add() {
        
        $_SESSION['title_page'] = 'Thêm vé máy bay';

        $arr = [];
        if(isset($_POST['add_ticket'])) {

            $arr = [
                'departure_date' => $_POST['departure_date'],
                'arrival_date' => $_POST['arrival_date']
            ];
                    
            // dd($arr);
        }

        $this->data['content']['data']= $arr;

        $this->data['main']= 'admin/tickets/add';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function postAddTicket() {
        
        function isValidFutureDateTime($inputDateTime) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentDateTime = new DateTime();
            $inputDateTimeObject = new DateTime($inputDateTime);
        
            return $inputDateTimeObject->format('Y-m-d H:i:s') >= $currentDateTime->format('Y-m-d H:i:s');
        }

        $count_error = 0;

        $airline = trim($this->request->input('airline'));
        $departure_date = $this->request->input('departure_date');
        $arrival_date = $this->request->input('arrival_date');
        $price = $this->request->input('price');
        $departure_airport = $this->request->input('departure_airport');
        $arrival_airport = $this->request->input('arrival_airport');
        $seat = $this->request->input('seat');
        $name = $this->request->input('name');
        
        

        //Check ngày giờ
        $checkDate = '/^(\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])T(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9])$/';

        // Ngày khởi hành
        if (!preg_match($checkDate, $departure_date)) {
            Session::set('err_departure_date', 'Định dạng ngày giờ không hợp lệ!');
            $count_error++;
        }

        if (!isValidFutureDateTime($departure_date)) {
            Session::set('err_departure_date', 'Ngày không hợp lệ. Không được nhập ngày giờ quá khứ.');
            $count_error++;
        } 

        // Ngày đến
        if (!preg_match($checkDate, $arrival_date)) {
            Session::set('err_arrival_date', 'Định dạng ngày giờ không hợp lệ!');
            $count_error++;
        }

        if (!isValidFutureDateTime($arrival_date)) {
            Session::set('err_arrival_date', 'Ngày không hợp lệ. Không được nhập ngày giờ quá khứ.');
            $count_error++;
        } 

        //Ngày đến không được nhỏ hơn ngày xuất phát
        $arrivalDateTime = new DateTime($arrival_date);
        $departureDateTime = new DateTime($departure_date);

        if($arrivalDateTime < $departureDateTime->modify('+1 day')) {
            Session::set('err_arrival_date', 'Ngày đến phải cách ngày xuất phát 1 ngày.');
            $count_error++;
        }

        if($price < 0) {
            Session::set('err_price', 'Giá tiền phải lớn hơn 0.');
            $count_error++;
        }

        if(empty($name)) {
            Session::set('err_name', 'Không để trống.');
            $count_error++;
        }

        if($seat < 0) {
            Session::set('err_seat', 'Số ghế phải lớn hơn 0.');
            $count_error++;
        }

        if(empty($departure_airport)) {
            Session::set('err_departure_airport', 'Không để trống.');
            $count_error++;
        }

        if(empty($arrival_airport)) {
            Session::set('err_arrival_airport', 'Không để trống.');
            $count_error++;
        }

        if($airline == 0) {
            Session::set('err_airline', 'Không để trống.');
            $count_error++;
        }

        // Nếu có lỗi thì báo lỗi
        if($count_error > 0) {
            with('airline', $airline);
            with('name', $name);
            with('price', $price);
            with('seat', $seat);

            with('departure_airport', $departure_airport);
            with('departure_date', $departure_date);
            with('arrival_airport', $arrival_airport);
            with('arrival_date', $arrival_date);
            $this->response->redirect('admin/them-ve');
            return; 
        }else {

            Session::set('success', 'Thêm vé máy bay thành công.');
            $this->response->redirect('admin/them-ve');
            return; 

            //Xử lý Models Flights
             
            //Thêm dữ liệu vào database

        }

        
        
    }

    public function list() {
        $_SESSION['title_page'] = 'Danh sách vé máy bay';

        $this->data['main']= 'admin/tickets/list';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }

}