<?php
namespace App\Controllers;
use CodeIgniter\Files\File;

class UploadController extends BaseController {
    public function uploadView() {
        $data['path'] = base_url();
        return view('upload-view', $data);
    }
}