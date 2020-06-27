<?php

class FileUploadController extends AppController {
	
	public $components = ['FileUploader','FileToModel'];

	public function index() {
		$this->set('title', __('File Upload Answer'));

		
		$message = "";
        
        if ($this->request->is('post')){
            $uploadedFile = $this->FileUploader->upload();
           
            if($uploadedFile['error'] == 0){
               $uplodedRecords = $this->FileToModel->convert($uploadedFile['file'],"FileUpload",array());
               $message['type']   =   "success";
               $message['content'] =  $uplodedRecords." Uploaded Records";
            }else{
                $message['type']   =   "danger";
                $message['content'] =  $uploadedFile['message'];
              
            }
        }
		
		
		$file_uploads = $this->FileUpload->find('all');
		
		$this->set('message',$message);
		$this->set(compact('file_uploads'));
	}
}