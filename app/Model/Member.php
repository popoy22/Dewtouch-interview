<?php
    
	class Member extends AppModel{
		
        var $hasOne = array(
            
            'Transaction' => array(),
    
            'TransactionItem' => array(
                'className' => 'TransactionItem',
                'foreignKey' => 'transaction_id'
            )
    
        );
        

        



	}