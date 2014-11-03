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

        public function getListOfRestaurants($sortedKey)
        {
            $list = Restaurant::listOfRestaurants();
            if($sortedKey == ""){
                return Restaurant::listOfRestaurants();
            }
            else{
                return Restaurant::listOfRestaurantsSorted($sortedKey);
            }
        }
        
        public function getRestaurantDetails($resto_contact_number)
        {  
            return Restaurant::getRestaurantDetails($resto_contact_number);
        }
        
        public function addRestaurant($array)
        {
            $this->restaurant->addRestaurant($array);
        }
        
        public function book($array, $pax)
        {
            $this->booking->book($array,$pax);
        }
    };
?>