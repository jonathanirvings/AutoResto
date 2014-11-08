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
        
        public function editRestaurant($contact_no,$arrayNew)
        {
            Restaurant::editRestaurant($contact_no,$arrayNew);
        }

        public function getListOfRestaurants($keyword_name,$keyword_address,$keyword_cuisine,$sortedKey)
        {
            global $empty_string;
            global $restaurant_name;
            
            if ($sortedKey == $empty_string){
                return Restaurant::listOfRestaurantsSearch($keyword_name,$keyword_address,$keyword_cuisine,$restaurant_name);
            }
            else{
                return Restaurant::listOfRestaurantsSearch($keyword_name,$keyword_address,$keyword_cuisine,$sortedKey);
            }
        }
        
        public function getRestaurantDetails($resto_contact_number)
        {  
            return Restaurant::getRestaurantDetails($resto_contact_number);
        }
        
        public function isValidRestaurant($contact_no)
        {
            return Restaurant::isValidRestaurant($contact_no);
        }
        
        //RESTAURANT METHODS END
        
        
        
        
        //BOOKING METHODS BEGIN
        
        // $arrQuery here contains the primary keys of the booking table
        // i.e. need to have the following 4 information
        // $arrQuery["booker_ic_no"] = "G0000000X";
        // $arrQuery["restaurant_contact_no"] = "99999999";
        // $arrQuery["date"] = "xxxx-xx-xx";
        // $arrQuery["session"] = "lunch";
        public function book($condition, $pax )
        {
            global $booking_restaurant_key;
            global $booking_booker_key;
            global $booking_date;
            global $booking_session;
            
            $arrQuery = [];
            $arrQuery[$booking_restaurant_key] = $condition[$booking_restaurant_key];
            $arrQuery[$booking_booker_key] = $condition[$booking_booker_key];
            $arrQuery[$booking_date] = $condition[$booking_date];
            $arrQuery[$booking_session] = $condition[$booking_session];
            
            $seatCapacity = Restaurant::getRestaurantCapacity($arrQuery[$booking_restaurant_key]);
          
            return Booking::book($arrQuery,$pax,$seatCapacity);
        }
        
        public function sortBookings($listOfBookings,$sortKey)
        {
            for ($i = 0; $i < count($listOfBookings); ++$i) {
                for ($j = $i; $j < count($listOfBookings); ++$j) {
                    if ($listOfBookings[$j][$sortKey] < $listOfBookings[$i][$sortKey]) {
                        $temp = $listOfBookings[$i];
                        $listOfBookings[$i] = $listOfBookings[$j];
                        $listOfBookings[$j] = $temp;
                    }
                }
            }
            return $listOfBookings;
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
        public function editBookings($conditionOld, $conditionNew, $new_no_of_pax)
        {
            global $booking_restaurant_key;
            global $booking_booker_key;
            global $booking_date;
            global $booking_session;
            
            $arrQueryOld = $conditionOld;
            
            $arrQueryNew = [];
            $arrQueryNew[$booking_restaurant_key] = $conditionNew[$booking_restaurant_key];
            $arrQueryNew[$booking_booker_key] = $conditionNew[$booking_booker_key];
            $arrQueryNew[$booking_date] = $conditionNew[$booking_date];
            $arrQueryNew[$booking_session] = $conditionNew[$booking_session];
            
            $seatCapacity = Restaurant::getRestaurantCapacity($arrQueryNew[$booking_restaurant_key]);
            return Booking::editBookings($arrQueryOld, $arrQueryNew, $new_no_of_pax, $seatCapacity);
        }
                   
        public function getBookingsByIC($ic_no)
        {
            return Booking::getBookingsByIC($ic_no);
        }
        
        public function getBookings($arrQuery)
        {
            return Booking::getBookings($arrQuery);
        }
        
        public function getBookingsSearch($keyword_booker_ic)
        {
            return Booking::getBookingsSearch($keyword_booker_ic);
        }
        
        public function getAllBookings()
        {
            return Booking::getAllBookings();
        }
        
        public function isValidBooking($arrQuery)
        {
            return Booking::isValidBooking($arrQuery);
        }
        
        //BOOKING METHODS END
        
        
        
        //CUSTOMER METHODS BEGIN
        
        public function getCustomerName($ic_number)
        {
            return Customer::getCustomerName($ic_number);
        }
        
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
        
        public function getCustomers()
        {
            Customer::getAllCustomers();
        }
        // $id is customer_ic_no, $password is customer_password
        public function login($id,$password)
        {
            return Customer::isLoginSuccessful($id,$password);
        }
        
        public function isAdmin($ic_no)
        {
            return Customer::isAdmin($ic_no);
        }
        
        public function isValidIC($ic_no)
        {
            return Customer::isValidIC($ic_no);
        }
        
        
        //CUSTOMER METHODS END
        
    };
?>