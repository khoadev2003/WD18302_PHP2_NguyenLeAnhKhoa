<?php


namespace App\Http\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Repositories\AirlineRepository;
use App\Repositories\FlightsRepository;
use App\Repositories\UserRepository;
use App\Validator\Validator;
use App\Http\Requests\AirlineRequest;
use App\Helpers\Upload;

class AirlineController extends Controller{
    public $airlineRepository;
    public $flightRepository;
    public $data = [];


    public function __construct()
    {
        // Check login
        UserRepository::checkLogin();

        $this->airlineRepository = new AirlineRepository();
        $this->flightRepository = new FlightsRepository();
    }

    public function index() {
        Session::set('title_page', 'Danh sách hãng hàng không');

        $this->data['main']= 'admin/airline/list';

        $this->data['content'] = [
            'title' => 'Danh sách hãng hàng không',
            'list_airline' => $this->airlineRepository->getAllAirline(),
        ];
        $this->render('layouts/admin_layout', $this->data);
    }

    public function addAirline()
    {
        Session::set('title_page', 'Thêm hãng hàng không');

        $this->data['main']= 'admin/airline/add';
        $this->data['content']['title']= "Thêm hãng hàng không";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function handleAddAirline()
    {
        $request = new Request();

        $data = [
            'name' => trim($request->input('name')),
            'logo_path' => $_FILES['logo_path'],
        ];


        $rules = AirlineRequest::rules();
        $messages = AirlineRequest::messages();

        $validator = new Validator($data, $rules, $messages);


        if ($validator->validate()) {

            $uploadDirectory = 'public/uploads';
//            dd($uploadDirectory);
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $uploader = new Upload($_FILES['logo_path'], $uploadDirectory, $allowedExtensions);
            if(!$uploader->upload()) {
                $errors = $uploader->errors();
                $err= '';
                foreach ($errors as $error) {
                    $err .= $error;
                    Session::set('not-success', $err);
                    $this->redirect('admin/them-hang-hang-khong');
                }
            }

            $data['logo_path'] = $data['logo_path']['name'];


            // Logic
            $result = $this->airlineRepository->createAirline($data);

            if($result !== false && $result !== null) {
                Session::set('success', 'Thêm hãng thành công');
                $this->redirect('admin/hang-hang-khong');

            }else {
                Session::set('not-success', 'Thêm hãng thất bại!!!');
                $this->redirect('admin/hang-hang-khong');
            }


        }
        else {
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


            Session::set('not-success', 'Thêm hãng không thành công vui lòng kiểm tra lại !');
            $this->redirect('admin/them-hang-hang-khong');
        }






    }

    public function update() {
        
    }

    public function handleDeleteAirline() {
        $request = new Request();
        $airline_id = $request->get('id');

        //Kiểm tra airline_id có tồn tại trong flights không truước khi xóa
        $checkAirlineExistFlight = $this->flightRepository->getFlightsByAirlineId($airline_id);
        if(count($checkAirlineExistFlight) > 0) {
            Session::set('not-success', 'Không thể xóa hãng đã tồn tại trong vé máy bay!!!');
            $this->redirect('admin/hang-hang-khong');
            exit();
        }

        $result = $this->airlineRepository->removeAirline($airline_id);
        if($result) {
            Session::set('success', 'Xóa hãng hàng không thành công!');
            $this->redirect('admin/hang-hang-khong');
        }else {
            Session::set('not-success', 'Xóa hãng hàng không thất bại!');
            $this->redirect('admin/hang-hang-khong');
        }


    }
}