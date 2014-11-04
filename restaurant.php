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
            return self::$dbOperation->insertData($arrayData);
        }
        
        public static function deleteRestaurant($arrQuery)
        {
            return self::$dbOperation->deleteData($arrQuery);
        }
        
        public static function editRestaurant($arrayOld,$arrayNew)
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
            global $restaurant_name;
            $arrQuery[$restaurant_name] = $keyword;
            return self::$dbOperation->getSearch($arrQuery,$orderBy);
        }
        
        public static function getRestaurantDetails($resto_contact_number)
        {
            global $restaurant_contact_no;
            global $empty_string;
            $arrQuery[$restaurant_contact_no] = $resto_contact_number;
            return self::$dbOperation->get($arrQuery,$empty_string)[0];
        }
        
        public static function getRestaurantCapacity($resto_contact_number){
            global $restaurant_contact_no;
            global $restaurant_total1seaters;
            global $restaurant_total2seaters;
            global $restaurant_total4seaters;
            $condition2 = [];
            $condition2[$restaurant_contact_no] = $resto_contact_number;
            $rows2 = self::$dbOperation->get($condition2,"");
            $row2 = $rows2[0];
            $totalSeatCapacity = $row2[$restaurant_total1seaters] + (2*$row2[$restaurant_total2seaters]) + (4*$row2[$restaurant_total4seaters]);
            return $totalSeatCapacity;
        }

    };
?>