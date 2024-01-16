<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Config\Database;

class MyModel extends Model {
    protected $db;
    protected $input;
    public function __construct() {
        $this->db = \Config\Database::connect();
        $this->input = \Config\Services::request();
    }
    public function getData($id = false) {
        if($id) {
            return $this->db->table('products')->where('id',$id)->get()->getResult();
        } else {
            return $this->db->table('products')->get()->getResult();
        }
    }
    public function insertData($fileName) {
        $data = array(
            'product'=>$this->input->getPost('product'),
            'category'=>$this->input->getPost('category'),
            'qty'=>$this->input->getPost('qty'),
            'price'=>$this->input->getPost('price'),
            'image'=>$fileName
        );
        $this->db->table('products')->insert($data);
        return $this->getData();
    }
    public function deleteData() {
        $id = $this->input->getPost('deleteId');
        $productData = $this->getData($id);
        $imageFileName = $productData[0]->image;

        //delete image
        try{
            $this->deleteImage($imageFileName);
        } finally {
            $this->db->table('products')->where('id',$id)->delete();
            return $this->getData();
        }
        
    }

    public function deleteImage($imageFileName) {
        $dir = ROOTPATH.'public/images/'.$imageFileName;
        unlink($dir);
    }

    public function updateData() {
        $id = $this->input->getPost('editId');
        $updateData = array(
            'product'=>$this->input->getPost('newProduct'),
            'category'=>$this->input->getPost('newCategory'),
            'qty'=>$this->input->getPost('newQty'),
            'price'=>$this->input->getPost('newPrice')
        );
        $this->db->table('products')->where('id', $id)->update($updateData);
        return $this->getData();
    }

    public function updateImageData($id, $newImage){
        $productData = $this->getData($id);
        $prevImage = $productData[0]->image;

        //delete image
        try{
            $this->deleteImage($prevImage);
        } finally {
            $updateData = array(
                'image'=>$newImage
            );
            $this->db->table('products')->where('id',$id)->update($updateData);
            return $this->getData();
        }
    }
}