<?php
    Class Restaurant
    {
        private static $dbOperation;
        
        public static function listOfRestaurants()
        {
            return self::$dbOperation->getAll();
        }
        
        public static function getRestaurantDetails($resto_contact_number){
            $arrQuery["contact_no"] = $resto_contact_number;
            return self::$dbOperation->get($arrQuery)[0];
        }

        public function Restaurant()
        {
            self::$dbOperation = new DBOperation("restaurant");
        }
        
        public function add()
        {
            
        }
        

    };
?>