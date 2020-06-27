<?php
	class OrderReportController extends AppController{

		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			//debug($orders);exit;

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
			//debug($portions);exit;


			
			//Get Portions Ingridients and Quantity
			$unitQty = array();
			$orders2 = array();
			$orders3 = array();

			foreach($portions as $portionKey => $portionval){
				$itemId = $portionval['Item']['id'];
				$items[$itemId ]['name'] =  $portionval['Item']['name'];
				foreach($portionval['PortionDetail'] as $ingridientVal){
					$items[$itemId ]['ingridients'][$ingridientVal['Part']['id']] =  array(
						"ingridient_id" => $ingridientVal['Part']['id'],
						"name" => $ingridientVal['Part']['name'],
						"value" => $ingridientVal['value']
					);
				}
			}
			
			
			
			foreach($orders as $orderKey => $orderval){
				$orderID =  $orderval['Order']['id'];
				$orderName =  $orderval['Order']['name'];
				foreach($orderval['OrderDetail'] as $detail){
					$qty = $detail['quantity'];
					$itemID = $detail['Item']['id'];
					$items[$itemID]['qty'] = $qty;
					foreach($items[$itemID]['ingridients'] as $ingridID => $val){
						$orders2[$orderName][$val['name']][] = $val['value'] * $qty;
					}
					
				}	
			}
			
			$orders3 = array();
			foreach($orders2 as $orderName => $ingridients){
				ksort($ingridients);
				foreach($ingridients as $key => $val){
					$orders3[$orderName][$key] = array_sum($val);
				}
				
			}
		
			$order_reports = array('Order 1' => array(
										'Ingredient A' => 1,
										'Ingredient B' => 12,
										'Ingredient C' => 3,
										'Ingredient G' => 5,
										'Ingredient H' => 24,
										'Ingredient J' => 22,
										'Ingredient F' => 9,
									),
								  'Order 2' => array(
								  		'Ingredient A' => 13,
								  		'Ingredient B' => 2,
								  		'Ingredient G' => 14,
								  		'Ingredient I' => 2,
								  		'Ingredient D' => 6,
									  ),
									  
								);

			

			$this->set('order_reports',$orders3);

			$this->set('title',__('Orders Report'));
		}

		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
				
			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}