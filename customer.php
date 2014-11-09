<?php
	Class Customer
	{
            private static $dbOperation;
        
            public function Customer()
            {
                self::$dbOperation = new DBOperation("customer");
            }
            
            public static function addCustomer($arrayData)
            {
                global $customer_ic_no;
                global $empty_string;
                $arrCondition = array();
                $arrCondition[$customer_ic_no] = $arrayData[$customer_ic_no];
                $rows = self::$dbOperation->get($arrCondition,$empty_string);
                if(count($rows)>0){
                    return "Error! User already exists!";
                }
                self::$dbOperation->insertData($arrayData);
                return "User registered successfully!";
            }

            public static function deleteCustomer($arrQuery)
            {
                return self::$dbOperation->deleteData($arrQuery);
            }

            public static function editCustomer($ic_no,$arrayNew)
            {
                global $customer_ic_no;
                global $empty_string;

                $arrValidation = array();
                $arrValidation[$customer_ic_no] = $arrayNew[$customer_ic_no];
                $rows = self::$dbOperation->get($arrValidation,$empty_string);
                if((count($rows)>0)&&($ic_no!=$arrayNew[$customer_ic_no])){
                    return "Error! User NRIC already exists!";
                }

                $arrCondition = array();
                $arrCondition[$customer_ic_no] = $ic_no;
                
                self::$dbOperation->deleteData($arrCondition);
                self::$dbOperation->insertData($arrayNew);
                
                return "User updated successfully!";
            }

            public static function getAllCustomers()
            {
                return self::$dbOperation->getAll();
            }
            
            public static function isLoginSuccessful($id,$password){
                global $customer_ic_no;
                global $customer_password;
                global $empty_string;
                $arrQuery = [];
                $arrQuery[$customer_ic_no] = $id;
                $arrQuery[$customer_password] = $password;
                $result = self::$dbOperation->get($arrQuery,$empty_string);
                
                $successful = count($result);
                if($successful == 0 ){
                    return false;
                }
                return true;
            }
            
            public static function isAdmin($ic_no){
                global $customer_ic_no;
                global $empty_string;
                global $customer_is_admin;
                $arrQuery[$customer_ic_no] = $ic_no;
                $rows = self::$dbOperation->get($arrQuery,$empty_string);
                $totalRows = count($rows);
                if ($totalRows == 1){
                    $cust = $rows[0];
                    if($cust[$customer_is_admin] == true){
                        return true;
                    }
                }
                return false;
                
            }
            
            public static function isValidIC($ic_no){
                global $customer_ic_no;
                global $empty_string;
                $arrQuery = [];
                $arrQuery[$customer_ic_no] = $ic_no;
                $rows = self::$dbOperation->get($arrQuery,$empty_string);
                $totalRows = count($rows);
                if ($totalRows == 1){
                   return true;
                }
                return false;
            }
            
            public static function getCustomerName($ic_number) {
                global $customer_name;
                global $customer_ic_no;
                $cond = array();
                $cond[$customer_ic_no] = $ic_number;
                return self::$dbOperation->get($cond)[0][$customer_name];
            }
                
	};
?>