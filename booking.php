<?php
Class Booking
	{
            private static $dbOperation;
        
            public function Booking()
            {
                self::$dbOperation = new DBOperation("booking");
            }
            
            private static function getNumberOfSeatsTaken($arrQuery){
                global $booking_restaurant_key;
                global $booking_date;
                global $booking_session;
                global $booking_booked1seaters;
                global $booking_booked2seaters;
                global $booking_booked4seaters;
                global $one;
                global $two;
                global $four;
                global $empty_string;
                 //assuming all table 1,2,and 4 seaters are mobile and can be moved around conveniently 
                
                //counts the number of seats taken
                $condition1 = [];
                $condition1[$booking_restaurant_key] = $arrQuery[$booking_restaurant_key];
                $condition1[$booking_date] = $arrQuery[$booking_date];
                $condition1[$booking_session] = $arrQuery[$booking_session];
                
                $rows = self::$dbOperation->get($condition1,$empty_string);
             
                $seatTaken = [];
                $seatTaken[$one] = 0;
                $seatTaken[$two] = 0;
                $seatTaken[$four] = 0;
                for ($i = 0; $i < sizeof($rows); ++$i){
                    $row = $rows[$i];
                    $seatTaken[$one] = $seatTaken[$one] + $row[$booking_booked1seaters];
                    $seatTaken[$two] = $seatTaken[$two] + $row[$booking_booked2seaters];
                    $seatTaken[$four] = $seatTaken[$four] + $row[$booking_booked4seaters];
                }
                return $seatTaken;
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
                
                global $empty_string;
                global $one;
                global $two;
                global $four;
                
                //if no of pax is zero, return error message
                if($no_of_pax <= 0){
                    return "Error! Please enter a valid number of pax!";
                }
                
                $totalSeatCapacity = $seatCapacity[$restaurant_total1seaters] + (2*$seatCapacity[$restaurant_total2seaters]) + (4*$seatCapacity[$restaurant_total4seaters]);
                
                $seatTaken = self::getNumberOfSeatsTaken($arrQuery);
                $totalSeatTaken = $seatTaken[$one] + (2*$seatTaken[$two]) + (4*$seatTaken[$four]);
                
                //checks whether there are enough seats for booking
                if($totalSeatTaken + $no_of_pax > $totalSeatCapacity){
                    $feedback = $empty_string;
                    if(($totalSeatCapacity-$totalSeatTaken)==0){
                        $feedback = "Sorry! The restaurant is fully booked for this date and session!";
                    }
                    else {
                        $feedback = "Sorry, only ".($totalSeatCapacity-$totalSeatTaken)." seats available!";
                    }
                    return $feedback;
                }
                
                $seat1Left = $seatCapacity[$restaurant_total1seaters] - $seatTaken[$one];
                $seat2Left = $seatCapacity[$restaurant_total2seaters] - $seatTaken[$two];
                $seat4Left = $seatCapacity[$restaurant_total4seaters] - $seatTaken[$four];
                
             
                if ($no_of_pax >= 4) {
                    $expected4Seater = floor($no_of_pax / 4);
                    if($expected4Seater > $seat4Left){
                        $arrQuery[$booking_booked4seaters] = $seat4Left;
                        $no_of_pax = $no_of_pax - (4* $seat4Left);
                        $seat4Left = 0;
                    }
                    else{
                        $arrQuery[$booking_booked4seaters] = $expected4Seater;
                        $no_of_pax = $no_of_pax - (4* $expected4Seater);
                        $seat4Left = $seat4Left - $expected4Seater;
                    }
                } 
                if ($no_of_pax >= 2) {
                    $expected2Seater = floor($no_of_pax / 2);
                    if($expected2Seater > $seat2Left){
                        $arrQuery[$booking_booked2seaters] = $seat2Left;
                        $no_of_pax = $no_of_pax - (2* $seat2Left);
                        $seat2Left = 0;
                    }
                    else{
                        $arrQuery[$booking_booked2seaters] = $expected2Seater;
                        $no_of_pax = $no_of_pax - (2* $expected2Seater);
                        $seat2Left = $seat2Left - $expected2Seater;
                    }
                }
                
                if ($seat1Left >= $no_of_pax){
                    $arrQuery[$booking_booked1seaters] = $no_of_pax;
                }
                else{
                    $expected2Seater = ceil($no_of_pax / 2);
                    if($expected2Seater <= $seat2Left){ //if can hold with 2 seaters
                        $arrQuery[$booking_booked2seaters] = $arrQuery[$booking_booked2seaters] + $expected2Seater;
                    }
                    else{ //if cannot hold with two seater
                        $expected4Seater = ceil($no_of_pax / 4);
                        if($expected4Seater <= $seat4Left){
                            $arrQuery[$booking_booked4seaters] = $arrQuery[$booking_booked4seaters] + $expected4Seater;
                        }
                    }
                }
                
                self::$dbOperation->insertData($arrQuery);
                return "Booking successful!";
            }
            
            public static function deleteBookings($arrQuery)
            {
                return self::$dbOperation->deleteData($arrQuery);
            }
            
            public static function editBookings($arrQueryOld, $arrQueryNew, $new_no_of_pax, $seatCapacity)
            {
                global $booking_restaurant_key;
                global $booking_date;
                global $booking_session;
                global $booking_booker_key;
                global $booking_booked1seaters;
                global $booking_booked2seaters;
                global $booking_booked4seaters;
                global $restaurant_total1seaters;
                global $restaurant_total2seaters;
                global $restaurant_total4seaters;
                global $empty_string;
                global $one;
                global $two;
                global $four;
                
                //check whether booking on the same date,session and restaurant
                $cond1 = ($arrQueryNew[$booking_restaurant_key] == $arrQueryOld[$booking_restaurant_key]);
                $cond2 = ($arrQueryNew[$booking_date] == $arrQueryOld[$booking_date]);
                $cond3 = ($arrQueryNew[$booking_session] == $arrQueryOld[$booking_session]);
                $cond4 = ($arrQueryNew[$booking_booker_key] == $arrQueryOld[$booking_booker_key]);
                
                
                
                $totalSeatCapacity = $seatCapacity[$restaurant_total1seaters] + (2*$seatCapacity[$restaurant_total2seaters]) + (4*$seatCapacity[$restaurant_total4seaters]);
                $seatTaken = self::getNumberOfSeatsTaken($arrQueryNew);
                $totalSeatTaken = $seatTaken[$one] + (2*$seatTaken[$two]) + (4*$seatTaken[$four]);
                
               
                
                $totalSeatDeleted = 0;
                
                //if it is the same restaurant, corner case, need to calculate the deleted seats
                if($cond1&&$cond2&&$cond3&&$cond4){
                    $condition = [];
                    $condition[$booking_restaurant_key] = $arrQueryOld[$booking_restaurant_key];
                    $condition[$booking_date] = $arrQueryOld[$booking_date];
                    $condition[$booking_session] = $arrQueryOld[$booking_session];
                    $condition[$booking_booker_key] = $arrQueryOld[$booking_booker_key];

                    $row = self::$dbOperation->get($condition,$empty_string)[0];
                    
                    $totalSeatDeleted = $row[$booking_booked1seaters] + (2*$row[$booking_booked2seaters]) + (4*$row[$booking_booked4seaters]);
                }
                
                //checks whether there are enough seats for booking
                if($totalSeatTaken - $totalSeatDeleted + $new_no_of_pax > $totalSeatCapacity){
                    
                    $feedback = $empty_string;
                    if(($totalSeatCapacity + $totalSeatDeleted - $totalSeatTaken)==0){
                        $feedback = "Sorry! The restaurant is fully booked for this date and session!";
                    }
                    else {
                        $feedback = "Sorry, only ".($totalSeatCapacity + $totalSeatDeleted - $totalSeatTaken)." seats available!"; 
                    }
                    return $feedback;
                }
                
                self::$dbOperation->deleteData($arrQueryOld);
                self::book($arrQueryNew,$new_no_of_pax,$seatCapacity);
                return "Edit booking successful!";
                
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
            
            public static function getAllBookings()
            {
                return self::$dbOperation->getAll();
            }
            
            public static function getBookingsSearch($keyword_booker_ic){
                global $booking_booker_key;
                global $booking_date;
                $arrQuery = [];
                $arrQuery[$booking_booker_key] = $keyword_booker_ic;
                return self::$dbOperation->getSearch($arrQuery,$booking_date);
            }
            
            public static function isValidBooking($arrQuery)
            {
                global $empty_string;
                $rows = self::$dbOperation->get($arrQuery,$empty_string);
                $totalRows = count($rows);
                if ($totalRows == 1){
                   return true;
                }
                return false;
            }
	};
        
        
?>