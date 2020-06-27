<?php
	class FormatController extends AppController{
		
		public function initialize(Controller $controller) {
			$this->controller = $controller;
			
		}

		public function q1(){
			
			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
			$alert = "";
			
			if ($this->request->is('post')){
				
				$type = $this->request->data['Type']['type'];

				if(!$type){
					$type = 'Please Select Type';
					$alert = '<div class="alert alert-danger">'.$type.'</div>';
				}else{
					$type = 'You Submitted "'.$type.'" value from radio button';
					$alert = '<div class="alert alert-success">'.$type.'</div>';
				}
				
			


			}

			$this->set('alert',$alert);
			
			//$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_detail(){

			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
	}