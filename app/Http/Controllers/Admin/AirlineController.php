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
        $count_err=0;

        $data = [
            'name' => trim($request->input('name')),
            'logo_path' => $_FILES['logo_path'],
        ];

        $checkNameUnique = $this->airlineRepository->isNameUnique($data['name']);
        if(count($checkNameUnique) > 0) {
            Session::set('err_name', 'Tên hãng đã tồn tại');
            $count_err++;;
        }


        $rules = AirlineRequest::rules();
        $messages = AirlineRequest::messages();

        $validator = new Validator($data, $rules, $messages);


        if ($validator->validate() && $count_err == 0) {

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

    public function updateAirline() {
        Session::set('title_page', 'Cập nhật sân bay');

        $request = new Request();
        $airlineId = $request->get('id');

        $checkIdExists = $this->airlineRepository->checkIdExists($airlineId);

        if(count($checkIdExists) < 1) {
            $this->redirect('404');
        }

        $this->data['main']= 'admin/airline/update';

        $this->data['content']= [
            'title' => 'Cập nhật hãng hàng không',
            'airline_detail' => $this->airlineRepository->getAirlineById($airlineId),
        ];

        $this->render('layouts/admin_layout', $this->data);
    }

    public function handleUpdateAirline()
    {
        $request = new Request();
        $airlineId = $request->get('id');
        $count_err = 0;

        if(!empty($_FILES['logo_path']['name'])) {
            $data = [
                'name' => $request->input('name'),
                'logo_path' => $_FILES['logo_path'],
            ];
        }else {
            $data = [
                'name' => $request->input('name'),
            ];
        }

        $checkNameUnique = $this->airlineRepository->isNameUniqueExcludeCurrent($data['name'], $airlineId);
        if(count($checkNameUnique) > 0) {
            Session::set('err_name', 'Tên hãng đã tồn tại');
            $count_err++;;
        }

        $rules = AirlineRequest::rulesUpdate();
        $messages = AirlineRequest::messagesUpdate();

        $validator = new Validator($data, $rules, $messages);


        if ($validator->validate() && $count_err == 0) {

            // Nếu có cập nhật ảnh
            if(!empty($_FILES['logo_path']['name'])) {

                $uploadDirectory = 'public/uploads';
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $uploader = new Upload($_FILES['logo_path'], $uploadDirectory, $allowedExtensions);
                if(!$uploader->upload()) {
                    $errors = $uploader->errors();
                    $err= '';
                    foreach ($errors as $error) {
                        $err .= $error;
                        Session::set('not-success', $err);
                        $this->redirect('admin/hang-khong/cap-nhat/'. $airlineId);
                    }
                }

                $data['logo_path'] = $data['logo_path']['name'];
            }

            // Handle update
            $result = $this->airlineRepository->updateAirline($airlineId, $data);

            if($result !== false && $result !== null) {
                Session::set('success', 'Cập nhật thành công');
                $this->redirect('admin/hang-khong/cap-nhat/'. $airlineId);

            }else {
                Session::set('not-success', 'Cập nhật không thành công !');
                $this->redirect('admin/hang-khong/cap-nhat/'. $airlineId);
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


            Session::set('not-success', 'Cập nhật thành công vui lòng kiểm tra lại !');
            $this->redirect('admin/hang-khong/cap-nhat/' .$airlineId);
        }

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