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
                return self::$dbOperation->insertData($arrayData);
            }

            public static function deleteCustomer($arrQuery)
            {
                return self::$dbOperation->deleteData($arrQuery);
            }

            public static function editCustomer($arrayOld,$arrayNew)
            {
                $bool1 = self::$dbOperation->deleteData($arrayOld);
                $bool2 = self::$dbOperation->insertData($arrayNew);
                return ($bool1&&$bool2);
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