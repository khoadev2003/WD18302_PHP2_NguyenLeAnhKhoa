<?php

namespace App\Http\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Http\Requests\AirportRequest;
use App\Models\Airport;
use App\Repositories\AirportRepository;
use App\Repositories\FlightsRepository;
use App\Repositories\UserRepository;
use App\Validator\AirportValidator;
use App\Validator\Validator;

class AirportController extends Controller{
    public $airportRepository;
    public $flightRepository;
    public $airportValidator;
    public $request;
    public $data = [];

    public function __construct()
    {
        // Check login
        UserRepository::checkLogin();

        $this->request = new Request();
        $this->airportRepository = new AirportRepository();
        $this->flightRepository = new FlightsRepository();
        $this->airportValidator = new AirportValidator();
    }

    public function index() {
        Session::set('title_page', 'Danh sách sân bay');

        $airport = new Airport();

        // View
        $this->data['main']= 'admin/airports/list';

        $this->data['content'] = [
            'title' => 'Danh sách sân bay',
            'list_airport' => $this->airportRepository->getAllAirport(),
        ];
        $this->render('layouts/admin_layout', $this->data);
    }




    public function addAirport() {
        Session::set('title_page', 'Thêm sân bay');


        $this->data['main']= 'admin/airports/add';
        $this->data['content']['title']= "Thêm sân bay";
        $this->render('layouts/admin_layout', $this->data);
    }



    public function handleAddAirport()
    {
        $request = new Request();

        $data = [
            'name' => trim($request->input('name')),
            'location' => trim($request->input('location')),
        ];

        $rules = AirportRequest::rules();
        $messages = AirportRequest::messages();

        $validator = new Validator($data, $rules, $messages);

        if ($validator->validate()) {

            $result = $this->airportRepository->createAirport($data);

            if($result !== false && $result !== null) {
                Session::set('success', 'Thêm sân bay thành công.');
                $this->redirect('admin/san-bay');

            }else {
                Session::set('not-success', 'Thêm sân bay thất bại.!');
                $this->redirect('admin/san-bay');
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

                with(
                    $field,
                    $request->input($field)
                );
            }


            Session::set('not-success', 'Thêm sân bay thất bại vui lòng kiểm tra lại !');
            $this->redirect('admin/them-san-bay');
        }
    }

    public function updateAirport() {
        Session::set('title_page', 'Cập nhật sân bay');

        $id_airport = $this->request->get('id');

        $checkIdExists = $this->airportRepository->checkIdExists($id_airport);

        if(count($checkIdExists) < 1) {
            $this->redirect('404');
        }

        $this->data['main']= 'admin/airports/update';

        $this->data['content']= [
            'title' => 'Cập nhật sân bay',
            'airport_detail' => $this->airportRepository->getAirportById($id_airport),
        ];

        $this->render('layouts/admin_layout', $this->data);
    }


    public function handleUpdateAirport()
    {
        $request = new Request();
        $airportId = $this->request->get('id');

        $data = [
            'name' => trim($request->input('name')),
            'location' => trim($request->input('location')),
        ];

        $rules = AirportRequest::rules();
        $messages = AirportRequest::messages();

        $validator = new Validator($data, $rules, $messages);

        if ($validator->validate()) {

            $result = $this->airportRepository->updateAirport($airportId, $data);

            if($result !== false && $result !== null) {
                Session::set('success', 'Cập nhật thành công');
                $this->redirect('admin/san-bay/cap-nhat/' .$airportId);

            }else {
                Session::set('not-success', 'Cập nhật thất bại!');
                $this->redirect('admin/san-bay/cap-nhat/' .$airportId);
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

                with(
                    $field,
                    $request->input($field)
                );
            }


            Session::set('not-success', 'Cập nhật không thành công vui lòng kiểm tra lại !');
            $this->redirect('admin/san-bay/cap-nhat/' .$airportId);
        }
    }

    private function validateAirport($name, $location)
    {
        $count_err = 0;

        if ($this->airportValidator->checkNameExists($name)) {
            Session::set('err_name', 'Tên sân bay đã tồn tại');
            $count_err++;
        }

        if (empty($name)) {
            Session::set('err_name', 'Tên sân bay không được để trống');
            $count_err++;
        } elseif (strlen($name) > 255) {
            Session::set('err_name', 'Tên sân bay tối đa 255 ký tự');
            $count_err++;
        }

        if (empty($location)) {
            Session::set('err_location', 'Địa điểm không được để trống');
            $count_err++;
        } elseif (strlen($location) > 255) {
            Session::set('err_location', 'Địa điểm tối đa 255 ký tự');
            $count_err++;
        }

        return $count_err;
    }

    private function handleResult($result): bool
    {
        if ($result !== false && $result !== null) {
            return true;
        } else {
            return false;
        }
    }

    public function handleDeleteAirport() {
        $id_airport = $this->request->get('id');

        $departureExist = $this->flightRepository->getFlightsByDepartureId($id_airport);
        $arrivalExist = $this->flightRepository->getFlightsByArrivalId($id_airport);

        if(count($departureExist) > 0
            && count($arrivalExist) > 0)
        {
            Session::set('not-success', 'Không thể xóa sân bay vì sân bay đã tồn tại trong vé máy bay!!!');
            $this->redirect('admin/san-bay');
        }

        $result = $this->airportRepository->removeAirport($id_airport);
        if($result) {
            Session::set('success', 'Xóa sân bay thành công!');
            $this->redirect('admin/san-bay');
        }else {
            Session::set('not-success', 'Xóa sân bay thất bại!');
            $this->redirect('admin/san-bay');
        }
    }
}