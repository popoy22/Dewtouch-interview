<?php
	class Transaction extends AppModel{
		
		var $hasOne = array('TransactionItem' => array());

	}