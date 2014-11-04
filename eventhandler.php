<?php
    Class EventHandler
    {
        
        private $restaurant;
        private $customer;
        private $booking;
        
        public function EventHandler()
        {
            $this->restaurant = new Restaurant();
            $this->customer = new Customer();
            $this->booking = new Booking();
        }
        
        //RESTAURANT METHODS BEGIN
        
        public function addRestaurant($arrQuery)
        {
            Restaurant::addRestaurant($arrQuery);
        }
        
        // $arrQuery here contains all information in the table
        // e.g. $arrQuery["restaurant_name"] = "xxxx"; and all the information
        public function deleteRestaurant($arrQuery)
        {
            Restaurant::deleteRestaurant($arrQuery);
        }
        
        public function editRestaurant($arrayOld,$arrayNew)
        {
            Restaurant::editRestaurant($arrayOld,$arrayNew);
        }

        public function getListOfRestaurants($keyword,$sortedKey)
        {
            global $empty_string;
            if(($sortedKey == $empty_string)&&($keyword == $empty_string)){
                return Restaurant::listOfRestaurants();
            }
            else if (($sortedKey != $empty_string)&&($keyword != $empty_string)){
                return Restaurant::listOfRestaurantsSearch($keyword,$sortedKey);
            }
            else if ($keyword != $empty_string){
                return Restaurant::listOfRestaurantsSearch($keyword,$empty_string);
            }
            else if ($sortedKey != $empty_string){
                return Restaurant::listOfRestaurantsSearch($empty_string,$sortedKey);
            }
        }
        
        public function getRestaurantDetails($resto_contact_number)
        {  
            return Restaurant::getRestaurantDetails($resto_contact_number);
        }
        
        //RESTAURANT METHODS END
        
        
        
        
        //BOOKING METHODS BEGIN
        
        // $arrQuery here contains the primary keys of the booking table
        // i.e. need to have the following 4 information
        // $arrQuery["booker_ic_no"] = "G0000000X";
        // $arrQuery["restaurant_contact_no"] = "99999999";
        // $arrQuery["date"] = "xxxx-xx-xx";
        // $arrQuery["session"] = "lunch";
        public function book($arrQuery, $pax )
        {
            global $booking_restaurant_key;
            //counts the number of seat capacity
            $totalSeatCapacity = Restaurant::getRestaurantCapacity($arrQuery[$booking_restaurant_key]);
            return Booking::book($arrQuery,$pax,$totalSeatCapacity);
        }
        
        // $arrQuery here contains the primary keys of the booking table
        // i.e. need to have the following 4 information
        // $arrQuery["booker_ic_no"] = "G0000000X";
        // $arrQuery["restaurant_contact_no"] = "99999999";
        // $arrQuery["date"] = "xxxx-xx-xx";
        // $arrQuery["session"] = "lunch";
        public function deleteBookings($arrQuery)
        {
            return Booking::deleteBookings($arrQuery);
        }
        
        // $arrQuery here contains all information in the table
        public function editBookings($arrQueryOld, $arrQueryNew)
        {
            return Booking::editBookings($arrQueryOld, $arrQueryNew);
        }
           
        public function getBookings($ic_no)
        {
            return Booking::getBookings($ic_no);
        }
        
        //BOOKING METHODS END
        
        
        
        //CUSTOMER METHODS BEGIN
        
        public function addCustomer($arrQuery)
        {
            Customer::addCustomer($arrQuery);
        }
        
        // $arrQuery here contains all information in the table
        // e.g. $arrQuery["restaurant_name"] = "xxxx"; and all the information
        public function deleteCustomer($arrQuery)
        {
            Customer::deleteCustomer($arrQuery);
        }
        
        public function editCustomer($arrayOld,$arrayNew)
        {
            Customer::editCustomer($arrayOld,$arrayNew);
        }
        
        public function getCustomers(){
            Customer::getAllCustomers();
        }
        // $id is customer_ic_no, $password is customer_password
        public function login($id,$password){
            return Customer::isLoginSuccessful($id,$password);
        }
        
        public function isAdmin($ic_no){
            return Customer::isAdmin($ic_no);
        }
        
        //CUSTOMER METHODS END
        
    };
?>