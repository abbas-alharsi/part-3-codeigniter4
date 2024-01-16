<?php
namespace App\Controllers;
use App\Models\MyModel;
use CodeIgniter\Files\File;

class MyController extends BaseController {
    protected $myModel;
    protected $input;
    public function __construct() {
        $this->myModel = new MyModel();
        $this->input = \Config\Services::request();
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
        $validationRule = [
            'image'=> [
                'label'=> 'Image File',
                'rules' => [
                    'uploaded[image]',
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png]',
                    'max_size[image,100]'
                ]
            ]
        ];
        if(!$this->validate($validationRule)) {
            $error = $this->validator->getErrors();
            $res = array(
                'msg'=>'error',
                'err_msg'=>$error['image']
            );
            echo json_encode($res);
        } else {
            $img = $this->input->getFile('image');
            $img->move(ROOTPATH.'public/images');
            $fileName = $img->getName();
            $data = $this->myModel->insertData($fileName);
            $res = array(
                'msg'=>'success',
                'data'=>$data
            );
            echo json_encode($res);
        }
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
    public function updateImage() {
        $id = $this->input->getPost('editImageId');
        $data = $this->myModel->getData($id);
        $fileName = $data[0]->image;

        $validationRule = [
            'newImage'=> [
                'label'=> 'New Image File',
                'rules' => [
                    'uploaded[newImage]',
                    'is_image[newImage]',
                    'mime_in[newImage,image/jpg,image/jpeg,image/png]',
                    'max_size[newImage,100]'
                ]
            ]
        ];
        if(!$this->validate($validationRule)) {
            $error = $this->validator->getErrors();
            $res = array(
                'msg'=>'error',
                'err_msg'=>$error['newImage']
            );
            echo json_encode($res);
        } else {
            $id = $this->input->getPost('editImageId');
            $img = $this->input->getFile('newImage');
            $img->move(ROOTPATH.'public/images');
            $newImage = $img->getName();
            $data = $this->myModel->updateImageData($id, $newImage);
            $res = array(
                'msg'=>'success',
                'data'=>$data
            );
            echo json_encode($res);
        }
    }
}