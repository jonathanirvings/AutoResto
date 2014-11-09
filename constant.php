<?php
    $rows_each_page = 20;

    $db_location = "localhost";
    $db_name = "autoresto";
    $db_username = "root";
    $db_password = "";
    
    $db_handler_success = "";
    
    //column name for customer table
    $customer_name = "name";
    $customer_email = "email";
    $customer_ic_no = "ic_no";
    $customer_contact_no = "contact_no";
    $customer_active = "active";
    $customer_password = "password";
    $customer_is_admin = "isAdmin";
            
    //column name for restaurant table
    $restaurant_name = "restaurant_name";
    $restaurant_address = "address";
    $restaurant_contact_no = "contact_no";
    $restaurant_cuisine = "cuisine";
    $restaurant_total1seaters = "total1seaters";
    $restaurant_total2seaters = "total2seaters";
    $restaurant_total4seaters = "total4seaters";
    $restaurant_open = "open";
    
    //column name for booking table
    $booking_booker_key = "booker_ic_no";
    $booking_restaurant_key = "restaurant_contact_no";
    $booking_date = "date";
    $booking_session = "session";
    $booking_booked1seaters = "booked1seaters";
    $booking_booked2seaters = "booked2seaters";
    $booking_booked4seaters = "booked4seaters";
    
    //extra
    $pax = "pax";
    
    $one = "1";
    $two = "2";
    $four = "4";
    
    $add_customer_duplicate_message = "Error! IC already exists!";
    $add_customer_success_message = "User registered successfully!";
?>  