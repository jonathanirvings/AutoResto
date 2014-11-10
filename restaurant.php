<?php
    include "constant.php";
    Class Restaurant
    {
        private static $dbOperation;
        
        public function Restaurant()
        {
            self::$dbOperation = new DBOperation("restaurant");
        }
        
        public static function addRestaurant($arrayData)
        {
            global $restaurant_contact_no;
            global $empty_string;
            $arrCondition = array();
            $arrCondition[$restaurant_contact_no] = $arrayData[$restaurant_contact_no];
            $rows = self::$dbOperation->get($arrCondition,$empty_string);
            if(count($rows)>0){
                return "Error! Restaurant already exists!";
            }
            
            self::$dbOperation->insertData($arrayData);
            
            return "Restaurant added successfully!";
        }
        
        public static function deleteRestaurant($arrQuery)
        {
            return self::$dbOperation->deleteData($arrQuery);
        }
        
        public static function editRestaurant($contact_no,$arrayNew)
        {
            global $restaurant_contact_no;
            global $empty_string;
            
            $arrValidation = array();
            $arrValidation[$restaurant_contact_no] = $arrayNew[$restaurant_contact_no];
            $rows = self::$dbOperation->get($arrValidation,$empty_string);
            if((count($rows)>0)&&($contact_no!=$arrayNew[$restaurant_contact_no])){
                return "Error! Restaurant contact number already exists!";
            }
                        
            $arrCondition = array();
            $arrCondition[$restaurant_contact_no] = $contact_no;
            self::$dbOperation->updateData($arrCondition,$arrayNew);
            
            return "Restaurant updated successfully!";
        }
        
        public static function listOfRestaurants()
        {
            return self::$dbOperation->getAll();
        }
        
        public static function listOfRestaurantsSorted($sortBy)
        {
            $arrQuery = array();
            return self::$dbOperation->get($arrQuery,$sortBy);
        }
        
        public static function listOfRestaurantsSearch($keyword_name,$keyword_address,$keyword_cuisine,$orderBy)
        {
            global $restaurant_name;
            global $restaurant_address;
            global $restaurant_cuisine;
            $arrQuery[$restaurant_name] = trim($keyword_name);
            $arrQuery[$restaurant_address] = trim($keyword_address);
            $arrQuery[$restaurant_cuisine] = trim($keyword_cuisine);
            return self::$dbOperation->getSearch($arrQuery,$orderBy);
        }
        
        public static function getRestaurantDetails($resto_contact_number)
        {
            global $restaurant_contact_no;
            global $empty_string;
            $arrQuery = array();
            $arrQuery[$restaurant_contact_no] = $resto_contact_number;
            $rows = self::$dbOperation->get($arrQuery,$empty_string);
            if(count($rows) == 1){
                return $rows[0];
            }
            return false;
        }
        
        public static function getRestaurantCapacity($resto_contact_number)
        {
            global $restaurant_contact_no;
            global $restaurant_total1seaters;
            global $restaurant_total2seaters;
            global $restaurant_total4seaters;
            global $empty_string;
            $condition2 = array();
            $condition2[$restaurant_contact_no] = $resto_contact_number;
            $rows2 = self::$dbOperation->get($condition2,$empty_string);
            $row2 = $rows2[0];
            $seatCapacity = array();
            $seatCapacity[$restaurant_total1seaters] = $row2[$restaurant_total1seaters];
            $seatCapacity[$restaurant_total2seaters] = $row2[$restaurant_total2seaters];
            $seatCapacity[$restaurant_total4seaters] = $row2[$restaurant_total4seaters];
            return $seatCapacity;
        }
        
        public static function isValidRestaurant($contact_no)
        {
            global $restaurant_contact_no;
            global $empty_string;
            $arrQuery = array();
            $arrQuery[$restaurant_contact_no] = $contact_no;
            $rows = self::$dbOperation->get($arrQuery,$empty_string);
            $totalRows = count($rows);
            if ($totalRows == 1){
               return true;
            }
            return false;
        }

    };
?>