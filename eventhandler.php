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
        
        public function addRestaurant($array)
        {
            Restaurant::addRestaurant($array);
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
         
        public function book($array, $pax )
        {
            global $booking_restaurant_key;
            //counts the number of seat capacity
            $totalSeatCapacity = Restaurant::getRestaurantCapacity($array[$booking_restaurant_key]);
            Booking::book($array,$pax,$totalSeatCapacity);
        }
        
        public function getListOfBooking($ic_no){
            return Booking::listOfBookingsPersonal($ic_no);
        }
    };
?>