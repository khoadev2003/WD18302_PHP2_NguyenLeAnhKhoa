<?php


namespace App\Http\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Http\Requests\FlightRequest;
use App\Models\Flight;
use App\Repositories\AirlineRepository;
use App\Repositories\AirportRepository;
use App\Repositories\FlightsRepository;
use App\Repositories\UserRepository;
use App\Validator\TicketValidator;
use App\Validator\Validator;
use DateTime;

class TicketController extends Controller{
    public $data = [];
    public $request;
    public $FlightModel;
    public $validator;
    public $flightRepository;
    public $airlineRepository;
    public $airportRepository;


    public function __construct()
    {
        $this->request = new Request();
        $this->FlightModel = new Flight();
        $this->validator = new TicketValidator();
        $this->flightRepository = new FlightsRepository();
        $this->airlineRepository = new AirlineRepository();
        $this->airportRepository = new AirportRepository();

//        Check login
        UserRepository::checkLogin();

    }

    public function index() {
        Session::set('title_page', 'Danh sách vé máy bay');


        $this->data['main']= 'admin/tickets/list';

        $this->data['content'] = [
            'title' => 'Danh sách vé máy bay',
            'list_flight' => $this->FlightModel->getAllFilght(),
        ];


        $this->render('layouts/admin_layout', $this->data);
    }

    public function add() {
        Session::set('title_page', 'Thêm vé máy bay');

        $this->data['main']= 'admin/tickets/add';

        $this->data['content'] = [
            'title' => 'Thêm vé máy bay',
            'list_airline' => $this->airlineRepository->getAllAirline(),
            'list_airport' => $this->airportRepository->getAllAirport(),
        ];

        $this->render('layouts/admin_layout', $this->data);
    }

    public function testAddHandle()
    {
        $data = [
            'name' => trim($this->request->input('name')),
            'airline_id' => $this->request->input('airline'),
            'seat' => trim($this->request->input('seat')),
            'price' => trim($this->request->input('price')),
            'departure_airport_id' => $this->request->input('departure_airport'),
            'arrival_airport_id' => $this->request->input('arrival_airport'),
            'departure_datetime' => $this->request->input('departure_date'),
            'arrival_datetime' => $this->request->input('arrival_date'),
        ];


        //Ngày đến không được nhỏ hơn ngày xuất phát
        $arrivalDateTime = new DateTime($data['arrival_datetime']);
        $departureDateTime = new DateTime($data['departure_datetime']);

        if($arrivalDateTime < $departureDateTime->modify('+2 hours')) {
            Session::set('err_arrival_datetime', 'Thời gian đến phải cách thời gian khởi hành ít nhất 2 giờ.');
        }


        $rules = FlightRequest::rules();
        $messages = FlightRequest::messages();

        $validator = new Validator($data, $rules, $messages);

        if ($validator->validate()) {

            $result = $this->flightRepository->createFlight($data);

            if($result !== false && $result !== null) {
                Session::set('success', 'Thêm vé thành công.');
                $this->redirect('admin/ve');

            }else {
                Session::set('not-success', 'Thêm vé thất bại.!');
                $this->redirect('admin/ve');
            }


        }else {
            $errors = $validator->errors();
            foreach ($errors as $field => $errorMessages) {
                foreach ($errorMessages as $errorMessage) {
                    Session::set('err_'.$field, $errorMessage);

                }
            }

            // Lưu lại value của input sau khi thông báo lỗi
            foreach ($data as $field => $msg) {
//                dd($field, $this->request->input($field));
                with(
                    $field,
                    $this->request->input($field)
                );
            }

            with('departure_date', $data['departure_datetime']);
            with('arrival_date', $data['arrival_datetime']);
            with('airline_id', $data['airline_id']);


            $this->redirect('admin/them-ve');
        }


    }

    public function handleAddTicket() {

        $count_error = 0;

        $airline = trim($this->request->input('airline'));
        $departure_date = $this->request->input('departure_date');
        $arrival_date = $this->request->input('arrival_date');
        $price = $this->request->input('price');
        $departure_airport = $this->request->input('departure_airport');
        $arrival_airport = $this->request->input('arrival_airport');
        $seat = $this->request->input('seat');
        $name = $this->request->input('name');
        


        // Ngày khởi hành
        if (!preg_match( $this->validator->pattern_datetime(), $departure_date)) {
            Session::set('err_departure_date', 'Định dạng ngày giờ không hợp lệ!');
            $count_error++;
        }

        if (!$this->validator->isValidFutureDateTime($departure_date)) {
            Session::set('err_departure_date', 'Ngày không hợp lệ. Không được nhập ngày giờ quá khứ.');
            $count_error++;
        } 

        // Ngày đến
        if (!preg_match( $this->validator->pattern_datetime(), $arrival_date)) {
            Session::set('err_arrival_date', 'Định dạng ngày giờ không hợp lệ!');
            $count_error++;
        }

        if (!$this->validator->isValidFutureDateTime($arrival_date)) {
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

        if(!empty($arrival_airport) &&
            $arrival_airport == $departure_airport)
        {
            Session::set('err_arrival_airport', 'Điểm đến không được trùng điểm khởi hành!');
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
            $this->redirect('admin/them-ve');

        }else {
            $data = [
                'name' => $name,
                'airline_id' => $airline,
                'seat' => $seat,
                'price' => $price,
                'departure_airport_id' => $departure_airport,
                'arrival_airport_id' => $arrival_airport,
                'departure_datetime' => $departure_date,
                'arrival_datetime' => $arrival_date,
            ];

            $result = $this->flightRepository->createFlight($data);

            if($result !== false && $result !== null) {
                Session::set('success', 'Thêm vé máy bay thành công.');
                $this->redirect('admin/them-ve');

            }else {
                Session::set('not-success', 'Thêm vé không thành công.');
                $this->redirect('admin/them-ve');
            }


        }

        
        
    }

    public function updateTicket()
    {
        Session::set('title_page', 'Cập nhật vé máy bay');

        $flightId = $this->request->get('id');

        $this->data['main']= 'admin/tickets/update';

        $this->data['content']= [
            'title' => 'Cập nhật vé máy bay',
            'list_airline' => $this->airlineRepository->getAllAirline(),
            'list_airport' => $this->airportRepository->getAllAirport(),
            'flight_detail' => $this->flightRepository->getFlightById($flightId),
        ];

        $this->render('layouts/admin_layout', $this->data);


    }

    public function handleDeleteTicket()
    {
        $flightId = $this->request->get('id');

        $result = $this->flightRepository->removeFlight($flightId);
        if($result) {
            Session::set('success', 'Xóa vé máy bay thành công!');
            $this->redirect('admin/ve');
        }else {
            Session::set('not-success', 'Xóa vé máy bay thất bại!');
            $this->redirect('admin/ve');
        }
    }


}