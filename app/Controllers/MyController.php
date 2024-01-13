<?php
namespace App\Controllers;
use App\Models\MyModel;

class MyController extends BaseController {
    protected $myModel;
    public function __construct() {
        $this->myModel = new MyModel();
    }
    public function myView(){
        $data['rows'] = $this->myModel->getData();
        $data['title'] = 'My App';
        return view('header/header', $data)
        .view('body/product', $data)
        .view('footer/script')
        .view('footer/product_footer', $data);
    }
    public function insertData() {
        $data = $this->myModel->insertData();
        echo json_encode($data);
    }
    public function deleteData() {
        $data = $this->myModel->deleteData();
        echo json_encode($data);
    }
    public function getData($id = false) {
        $data = $this->myModel->getData($id);
        echo json_encode($data);
    }
    public function updateData() {
        $data = $this->myModel->updateData();
        echo json_encode($data);
    }

}