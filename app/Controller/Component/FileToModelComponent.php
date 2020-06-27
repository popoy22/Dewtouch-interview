<?php 

App::import('Vendor', 'simple-xlsx-reader/SimpleXLSX');
App::import('Vendor', 'simple-xls-reader/SimpleXLS');
App::import('Vendor', 'simple-csv-reader/SimpleCSV');


class FileToModelComponent extends Component{
    
    public $model;
    public $file;
    public $xlsx;
    public $headers;
    public $options;
    public $data;
    public $formattedData;
    public $ctr;
    public $ext;
    
    public function convert($file,$modelName,$options = array(),$customize = false){
        
        $this->file = $file;
        $this->model = ClassRegistry::init($modelName);;
        $this->options = $options;
        $this->ctr = 1;
        
        
        $this->ext = end((explode(".", $this->file)));
        
        if($this->ext == "xls"){
            $xlsx = SimpleXLS::parse($this->file);
        }elseif($this->ext == "xlsx"){
            $xlsx = SimpleXLSX::parse($this->file);
        }elseif($this->ext == "csv"){
            $xlsx = SimpleCSV::import($this->file);
        }

       
       
        if ($xlsx) {
            $this->xlsx = $xlsx;
            if($customize == true){
                return $this->customizeParseToModel();
            }else{
                return $this->parseToModel();
            }
           
        }
        
    }
    
    
    

    public function parseToModel(){
        
        if($this->ext == "csv"){
            $rows = $this->xlsx;
        }else{
            $rows = $this->xlsx->rows();
        }

        foreach($rows as $row){
            if($this->ctr == 1){
                $this->headers = $row;
            }else{
                $this->data[] = $row;
            }
            $this->ctr++;
        }
        
        foreach($this->data as $key => $val ){
            foreach($this->headers as $headerKey => $headerVal){
                if(!empty($this->options)){
                    if(array_key_exists($headerVal,$this->options)){
                        $newKey = $this->options[$headerVal];
                        $this->formattedData[$key][strtolower($newKey)] = $val[$headerKey];
                   }
                }else{
                    $this->formattedData[$key][strtolower($headerVal)] = $val[$headerKey];
                }
                
            }
        }
        $this->model->saveMany($this->formattedData);
        return $this->ctr - 1;
    }


    public function customizeParseToModel(){
        
        $counter = array();
        
        if($this->ext == "csv"){
            $rows = $this->xlsx;
        }else{
            $rows = $this->xlsx->rows();
        }

       

        foreach($rows as $row){
           
            if($this->ctr != 1 && $row[0] != ""){           
              
                $date             = date("Y-m-d",strtotime($row[0]));
                $refNo            = $row[1];
                $memberName       = $row[2];
                $memberNo         = $row[3];
                $memberPayType    = $row[4];
                $memberCompany    = $row[5];
                $paymentBy        = $row[6];
                $batchNo          = $row[7];
                $receiptNo        = $row[8];
                $chequeNo         = $row[9];
                $paymentDesc      = $row[10];
                $renewalYear      = $row[11];
                $subTotal         = $row[12];
                $totalTax         = $row[13];
                $total            = $row[14];
                
              
                $unitPrice = ($total - $totalTax);
                $qty = ($total - $totalTax) / $subTotal;
                $sum = $unitPrice * $qty;
                $memberFormat = explode(" ",$memberNo);

                 // Members Model
                 $members = array(
                    "type"    =>  $memberFormat[0],
                    "no"      =>  preg_replace("/[^0-9]/", "",$memberFormat[1]),
                    "name"    =>  $memberName,
                    "company" =>  $memberCompany,
                );

                    // Transaction Model

                    $transactions = array(
                        "member_name" => $memberName,
                        "member_paytype" => $memberPayType,
                        "member_company" => $memberCompany,
                        "date" => $date,
                        "year" => date("Y",strtotime($date)),
                        "month" => date("m",strtotime($date)),
                        "ref_no" => $refNo,
                        "receipt_no" => $receiptNo,
                        "payment_method" => $paymentBy,
                        "batch_no" => $batchNo,
                        "cheque_no" => $chequeNo,
                        "payment_type" => $paymentDesc,
                        "renewal_year" => $renewalYear,
                        "remarks" => "",
                        "subtotal" => $subTotal,
                        "tax" => $totalTax,
                        "total" => $total,
                    );

                    // Transaction Item
                    
                    $items = array(
                        "description" => "Being Payment For : ".$paymentDesc." : ".$renewalYear,
                        "unit_price" =>  $unitPrice,
                        "quantity" => $qty,
                        "sum" => $sum,
                        "table" => "Member",
                        "table_id" => "1",
                    );

                    $data = array(
                        'Member' => $members,
                        'Transaction' => $transactions,
                        "TransactionItem" => $items,
                    );
                    
                    $this->model->saveAssociated($data, array('deep' => true));
                    $counter[] = $memberName;
                }
                $this->ctr++;
            
           
        }
        return sizeof($counter);   

    }





}



?>