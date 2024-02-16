<?php


namespace App\Http\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Repositories\AirlineRepository;
use App\Repositories\UserRepository;

class AirlineController extends Controller{
    public $airlineRepository;
    public $data = [];


    public function __construct()
    {
        // Check login
        UserRepository::checkLogin();

        $this->airlineRepository = new AirlineRepository();
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
        $count_err =0;

        $name_airline = $request->input('name');
        $logo = $request->input('logo');

        $nameExists = $this->airlineRepository->getAirportByName('name','name', $name_airline);
        if(count($nameExists) > 0) {
            Session::set('err_name', 'Tên hãng hàng không đã tồn tại');
        }

        if(empty($name_airline)) {
            Session::set('err_name', 'Tên hãng hông được để trống');
            $count_err++;
        }elseif (strlen($name_airline) > 255) {
            Session::set('err_name', 'Tên hãng tối đa 255 ký tự');
            $count_err++;
        }

        if(empty($logo)) {
            Session::set('err_logo', 'Không được để trống');
            $count_err++;
        }else {
            // Check if $logo is a valid uploaded file
            if (!isset($_FILES[$logo]) || $_FILES[$logo]['error'] !== UPLOAD_ERR_OK || !getimagesize($_FILES[$logo]['tmp_name'])) {
                Session::set('err_logo', 'Vui lòng chọn một tệp tin ảnh hợp lệ (PNG,JPG)');
                $count_err++;
            }
        }

        if($count_err > 0) {
            with('name', $name_airline);
            with('logo', $logo);

            $request->redirect('admin/them-hang-hang-khong');
        }

//        dd($request->all());
    }

    public function update() {
        
    }

    public function delete() {

        $this->data['main']= 'admin/tickets/list2';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }
}