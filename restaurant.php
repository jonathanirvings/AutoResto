<?php
    Class Restaurant
    {
        private static $dbOperation;
        
        public function Restaurant()
        {
            self::$dbOperation = new DBOperation("restaurant");
        }
        
        public function add($arrayData)
        {
            self::$dbOperation->insertData($arrayData);
        }
        
        public static function listOfRestaurants()
        {
            return self::$dbOperation->getAll();
        }
        
        public static function listOfRestaurantsSorted($sortBy)
        {
            $arrQuery = [];
            return self::$dbOperation->get($arrQuery,$sortBy);
        }
        
        public static function getRestaurantDetails($resto_contact_number){
            $arrQuery["contact_no"] = $resto_contact_number;
            return self::$dbOperation->get($arrQuery,"")[0];
        } 

    };
?>