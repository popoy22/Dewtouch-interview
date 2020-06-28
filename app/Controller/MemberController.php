<?php


class MemberController extends AppController {
    
    
    public $components = ['FileUploader','FileToModel']; 
    
    public function index() {
        
        $message = "";
        
        if ($this->request->is('post')){
            $uploadedFile = $this->FileUploader->upload();
           
            if($uploadedFile['error'] == 0){
               $uplodedRecords = $this->FileToModel->convert($uploadedFile['file'],"Member",array(),true);
               $message['type']   =   "success";
               $message['content'] =  $uplodedRecords." Uploaded Records";
            }else{
                $message['type']   =   "danger";
                $message['content'] =  $uploadedFile['message'];
              
            }
        }
        
        $this->loadModel('Member');
        $members = $this->Member->find('all');
        
        $this->set('title', __('Migrate Members'));
        $this->set('members',$members);
        $this->set('message',$message);
        
	 }
    
    
    public function reset(){
        $this->redirect('/Member/index');
    }



}