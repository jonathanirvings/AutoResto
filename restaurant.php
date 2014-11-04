<?php
    Class Restaurant
    {
        private static $dbOperation;
        
        public function Restaurant()
        {
            self::$dbOperation = new DBOperation("restaurant");
        }
        
        public function addRestaurant($arrayData)
        {
            return self::$dbOperation->insertData($arrayData);
        }
        
        public function editRestaurant($arrayOld,$arrayNew)
        {
            $bool1 = self::$dbOperation->deleteData($arrayOld);
            $bool2 = self::$dbOperation->insertData($arrayNew);
            return ($bool1&&$bool2);
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
        
        public static function listOfRestaurantsSearch($keyword,$orderBy)
        {
            $arrQuery["restaurant_name"] = $keyword;
            return self::$dbOperation->getSearch($arrQuery,$orderBy);
        }
        
        public static function getRestaurantDetails($resto_contact_number){
            $arrQuery["contact_no"] = $resto_contact_number;
            return self::$dbOperation->get($arrQuery,"")[0];
        }
        
        public static function getRestaurantCapacity($resto_contact_number){
            $condition2 = [];
            $condition2["contact_no"] = $resto_contact_number;
            $rows2 = self::$dbOperation->get($condition2,"");
            $row2 = $rows2[0];
            $totalSeatCapacity = $row2["total1seaters"] + (2*$row2["total2seaters"]) + (4*$row2["total4seaters"]);
            return $totalSeatCapacity;
        }

    };
?>