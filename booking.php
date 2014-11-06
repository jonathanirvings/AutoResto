<?php
Class Booking
	{
            private static $dbOperation;
        
            public function Booking()
            {
                self::$dbOperation = new DBOperation("booking");
            }
            
            
            /**
             * Book Restaurant 
             * 
             * Pre-condition:
             *      $dbOperation has information on booking table
             *      $dpOperationResto has informatin on restaurant table
             * Steps:
             *      checks all the necessary conditions (e.g. check whether the restaurant is full)
             *      and decides on the appropriate table/n-seater to allocate
             * 
             * @param type $cust_nric - customer's NRIC (primary key)
             * @param type $resto_contact - restaurant's contact number (primary key)
             * @param type $date - the date of booking
             * @param type $session = meal session, lunch or dinner
             * @param type $no_of_pax = number of pax
             * 
             * Post-condition:
             *      if restaurant is booked succesfully, store information in booking table
             *      else return error message string.
             */
            public static function book($arrQuery,$no_of_pax,$seatCapacity)
            {
                global $booking_booked1seaters;
                global $booking_booked2seaters;
                global $booking_booked4seaters;
                global $restaurant_total1seaters;
                global $restaurant_total2seaters;
                global $restaurant_total4seaters;
                global $booking_restaurant_key;
                global $booking_date;
                global $booking_session;
                global $empty_string;
                
                //assuming all table 1,2,and 4 seaters are mobile and can be moved around conveniently 
                
                //counts the number of seats taken
                $condition1 = [];
                $condition1[$booking_restaurant_key] = $arrQuery[$booking_restaurant_key];
                $condition1[$booking_date] = $arrQuery[$booking_date];
                $condition1[$booking_session] = $arrQuery[$booking_session];
                
                $rows = self::$dbOperation->get($condition1,$empty_string);
                $totalSeatTaken = 0;
                for ($i = 0; $i < sizeof($rows); ++$i){
                    $row = $rows[$i];
                    $totalSeatTaken = $row[$booking_booked1seaters] + (2*$row[$booking_booked2seaters]) + (4*$row[$booking_booked4seaters]);
                }
                
                $totalSeatCapacity = $seatCapacity[$restaurant_total1seaters] + (2*$seatCapacity[$restaurant_total2seaters]) + (4*$seatCapacity[$restaurant_total4seaters]);
                
                //checks whether there are enough seats for booking
                if($totalSeatTaken + $no_of_pax > $totalSeatCapacity){
                    $feedback = $empty_string;
                    if(($totalSeatCapacity-$totalSeatTaken)==0){
                        $feedback = "Sorry! The restaurant is fully booked for this date and session!";
                    }
                    else {
                        $feedback = "ERROR! Only ".($totalSeatCapacity-$totalSeatTaken)." seats left!";
                    }
                    return $feedback;
                }
             
               
                if ($no_of_pax >= 4) {
                    $arrQuery[$booking_booked4seaters] = $no_of_pax / 4;
                    $no_of_pax = $no_of_pax - (4* ($no_of_pax / 4));
                } 
                if ($no_of_pax >= 2) {
                    $arrQuery[$booking_booked2seaters] = $no_of_pax / 2;
                    $no_of_pax = $no_of_pax - (2* ($no_of_pax / 2));
                }
                
                $arrQuery[$booking_booked1seaters] = $no_of_pax;
                
                self::$dbOperation->insertData($arrQuery);
                return "Booking successful!";
            }
            
            public static function deleteBookings($arrQuery)
            {
                return self::$dbOperation->deleteData($arrQuery);
            }
            
            public static function editBookings($arrQueryOld,$arrQueryNew)
            {
                $bool1 = self::$dbOperation->deleteData($arrQueryOld);
                $bool2 = self::$dbOperation->insertData($arrQueryNew);
                return ($bool1&&$bool2);
            }
            
            public static function getBookingsByIC($ic_no)
            {
                global $booking_booker_key;
                global $booking_date;
                $arrQuery = [];
                $arrQuery[$booking_booker_key] = $ic_no;
                return self::$dbOperation->get($arrQuery,$booking_date);
            }
            
            public static function getBookings($arrQuery)
            {
                return self::$dbOperation->get($arrQuery);
            }
	};
        
        
?>