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
            if(($sortedKey == "")&&($keyword == "")){
                return Restaurant::listOfRestaurants();
            }
            else if (($sortedKey != "")&&($keyword != "")){
                return Restaurant::listOfRestaurantsSearch($keyword,$sortedKey);
            }
            else if ($keyword != ""){
                return Restaurant::listOfRestaurantsSearch($keyword,"");
            }
            else if ($sortedKey != ""){
                return Restaurant::listOfRestaurantsSearch("",$sortedKey);
            }
        }
        
        public function getRestaurantDetails($resto_contact_number)
        {  
            return Restaurant::getRestaurantDetails($resto_contact_number);
        }
         
        public function book($array, $pax )
        {
            //counts the number of seat capacity
            $totalSeatCapacity = Restaurant::getRestaurantCapacity($array["restaurant_contact_no"]);
            Booking::book($array,$pax,$totalSeatCapacity);
        }
        
        public function getListOfBooking($ic_no){
            return Booking::listOfBookingsPersonal($ic_no);
        }
    };
?>