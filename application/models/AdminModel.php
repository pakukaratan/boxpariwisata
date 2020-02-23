<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
    }

    // check admin login
    public function checkAdminLogin($username, $password)
    {
        $query = $this->db->query("SELECT * FROM admins WHERE username='$username' AND password='$password'")->row();

        if ($query && $query->id)
            return $query;
        return false;
    }

    public function getAdminById($id)
    {
        $query = $this->db->query("SELECT * FROM admins WHERE id='$id'")->row();
        return $query;
    }

    //==================================================== Tourist =====================================================//

    public function createTourist($image)
    {
        $this->load->helper('security');

        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $nationality = $this->input->post('nationality');
        $birthday = $this->input->post('birthday');
        $birth_place = $this->input->post('birth_place');
        $passport_no = $this->input->post('passport_no');
        $visa_no = $this->input->post('visa_no');
        $passport_expire = $this->input->post('passport_expire');
        $visa_expire = $this->input->post('visa_expire');
        $purpose = $this->input->post('purpose');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $sql = "INSERT INTO tourists (username, fname, lname, nationality, birthday, birth_place, passport_no, visa_no, passport_expire, visa_expire, purpose, password, image) VALUES ('$username','$fname', '$lname', '$nationality', '$birthday', '$birth_place', '$passport_no', '$visa_no', '$passport_expire', '$visa_expire', '$purpose', '$password', '$image')";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function getTourists()
    {
        $result = $this->db->query("SELECT * FROM tourists ORDER BY id DESC")->result();
        return $result;
    }

    public function getTourist($id)
    {
        $result = $this->db->query("SELECT * FROM tourists WHERE id='$id'")->row();
        return $result;
    }

    public function updateTourist($id, $image)
    {
        $this->load->helper('security');

        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $nationality = $this->input->post('nationality');
        $birthday = $this->input->post('birthday');
        $birth_place = $this->input->post('birth_place');
        $passport_no = $this->input->post('passport_no');
        $visa_no = $this->input->post('visa_no');
        $passport_expire = $this->input->post('passport_expire');
        $visa_expire = $this->input->post('visa_expire');
        $purpose = $this->input->post('purpose');

        $sql = "UPDATE tourists SET fname= '$fname', lname = '$lname', nationality = '$nationality', birthday = '$birthday', birth_place = '$birth_place', passport_no = '$passport_no', visa_no = '$visa_no', passport_expire = '$passport_expire', visa_expire = '$visa_expire', purpose = '$purpose', image = '$image' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function deleteTourist($id)
    {
        $this->db->query("DELETE FROM tourists WHERE id='$id'");
        return TRUE;
    }
    //========================================================= end Tourist ============================================//

    //================================================= Tourist Spot ===========================================//
    public function createTouristSpot($image)
    {
        $this->load->helper('security');

        $name = $this->db->escape_str($this->input->post('name'));
        $type = $this->db->escape_str($this->input->post('type'));
        $location = $this->db->escape_str($this->input->post('location'));
        $division = $this->db->escape_str($this->input->post('division'));
        $district = $this->db->escape_str($this->input->post('district'));
        $area = $this->db->escape_str($this->input->post('area'));
        $open_time = $this->db->escape_str($this->input->post('open_time'));
        $close_time = $this->db->escape_str($this->input->post('close_time'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "INSERT INTO tourist_spots (name, type, location, division, district, area, description, image, open_time, close_time) VALUES ('{$name}', '{$type}', '{$location}', '{$division}', '{$district}', '{$area}', '{$description}', '{$image}', '{$open_time}', '{$close_time}')";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function getTouristSpots()
    {
        $result = $this->db->query("SELECT * FROM tourist_spots ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristSpot($id)
    {
        $result = $this->db->query("SELECT * FROM tourist_spots WHERE id='$id'")->row();
        return $result;
    }

    public function updateTouristSpot($id, $image)
    {
        $this->load->helper('security');

        $name = $this->db->escape_str($this->input->post('name'));
        $type = $this->db->escape_str($this->input->post('type'));
        $location = $this->db->escape_str($this->input->post('location'));
        $division = $this->db->escape_str($this->input->post('division'));
        $district = $this->db->escape_str($this->input->post('district'));
        $area = $this->db->escape_str($this->input->post('area'));
        $open_time = $this->db->escape_str($this->input->post('open_time'));
        $close_time = $this->db->escape_str($this->input->post('close_time'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "UPDATE tourist_spots SET name= '{$name}', type = '{$type}', location = '{$location}', division = '{$division}', district = '{$district}', area = '{$area}', description = '{$description}', image = '$image', open_time = '$open_time', close_time = '$close_time' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function deleteTouristSpot($id)
    {
        $this->db->query("DELETE FROM tourist_spots WHERE id='$id'");
        return TRUE;
    }
    public function getTouristSpotTickets($id)
    {
        $query = $this->db->select('*')
            ->where('spot_id = ', $id)
            ->get('tourist_spot_tickets')
            ->result();

        return $query;
    }

    public function insertSpotTicket(array $data)
    {
        $this->db->insert('tourist_spot_tickets', $data);
    }

    public function getTouristSpotTicket($id)
    {
        $query = $this->db->select('*')
            ->where('id = ', $id)
            ->get('tourist_spot_tickets')
            ->row();

        return $query;
    }

    public function updateSpotTicket($id, array $data)
    {
        $this->db->where('id = ', $id)
            ->update('tourist_spot_tickets', $data);
    }

    public function deleteSpotTicket($id)
    {
        $this->db->where('id = ', $id)->delete('tourist_spot_tickets');
    }

    public function getTouristSpotBookingHistory()
    {
        $query = $this->db->select('tourist_spot_books.id, tourist_spot_books.booking_count, tourist_spot_books.rate, tourist_spot_books.total_price, tourist_spot_books.date, tourist_spot_books.status , tourist_spots.name as name, tourist_spots.image as spot_image, tourists.fname as tourist_name')
            ->join('tourist_spots', 'tourist_spots.id = tourist_spot_books.tourist_spot_id')
            ->join('tourists', 'tourists.id = tourist_spot_books.tourist_id')
            ->get('tourist_spot_books')
            ->result();

        return $query;
    }

    public function updateBookSpotStatus($id, $status)
    {
        $this->db->where('id = ', $id)
            ->set('status', $status)
            ->update('tourist_spot_books');
    }
    //=============================================== end Tousidt Spot =========================================//

    //================================================= Tourist Restaurant ===========================================//
    public function createTouristRestaurant($image)
    {
        $this->load->helper('security');

        $name = $this->db->escape_str($this->input->post('name'));
        $type = $this->db->escape_str($this->input->post('type'));
        $location = $this->db->escape_str($this->input->post('location'));
        $division = $this->db->escape_str($this->input->post('division'));
        $district = $this->db->escape_str($this->input->post('district'));
        $area = $this->db->escape_str($this->input->post('area'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "INSERT INTO tourist_restaurants (name, type, location, division, district, area, description, image) VALUES ('{$name}', '{$type}', '{$location}', '{$division}', '{$district}', '{$area}', '{$description}', '{$image}')";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function getTouristRestaurants()
    {
        $result = $this->db->query("SELECT * FROM tourist_restaurants ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristRestaurant($id)
    {
        $result = $this->db->query("SELECT * FROM tourist_restaurants WHERE id='$id'")->row();
        return $result;
    }

    public function updateTouristRestaurant($id, $image)
    {
        $this->load->helper('security');

        $name = $this->db->escape_str($this->input->post('name'));
        $type = $this->db->escape_str($this->input->post('type'));
        $location = $this->db->escape_str($this->input->post('location'));
        $division = $this->db->escape_str($this->input->post('division'));
        $district = $this->db->escape_str($this->input->post('district'));
        $area = $this->db->escape_str($this->input->post('area'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "UPDATE tourist_restaurants SET name= '{$name}', type = '{$type}', location = '{$location}', division = '{$division}', district = '{$district}', area = '{$area}', description = '{$description}', image = '$image' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function deleteTouristRestaurant($id)
    {
        $this->db->query("DELETE FROM tourist_restaurants WHERE id='$id'");
        return TRUE;
    }
    public function getTouristRestaurantTables($id)
    {
        $query = $this->db->select('*')
            ->where('restaurant_id = ', $id)
            ->get('tourist_restaurant_tables')
            ->result();

        return $query;
    }

    public function insertRestaurantTable(array $data)
    {
        $this->db->insert('tourist_restaurant_tables', $data);
    }

    public function getTouristRestaurantTable($id)
    {
        $query = $this->db->select('*')
            ->where('id = ', $id)
            ->get('tourist_restaurant_tables')
            ->row();

        return $query;
    }

    public function updateRestaurantTable($id, array $data)
    {
        $this->db->where('id = ', $id)
            ->update('tourist_restaurant_tables', $data);
    }

    public function deleteRestaurantTable($id)
    {
        $this->db->where('id = ', $id)->delete('tourist_restaurant_tables');
    }

    public function getTouristRestaurantBookingHistory()
    {
        $query = $this->db->select('tourist_restaurant_books.id, tourist_restaurant_books.booking_count, tourist_restaurant_books.rate, tourist_restaurant_books.total_price, tourist_restaurant_books.date, tourist_restaurant_books.status, tourist_restaurant_books.booking_no, tourist_restaurants.name as name, tourist_restaurants.image as restaurant_image, tourists.fname as tourist_name')
            ->join('tourist_restaurants', 'tourist_restaurants.id = tourist_restaurant_books.tourist_restaurant_id')
            ->join('tourists', 'tourists.id = tourist_restaurant_books.tourist_id')
            ->get('tourist_restaurant_books')
            ->result();

        return $query;
    }

    public function updateBookRestaurantStatus($id, $status)
    {
        $this->db->where('id = ', $id)
            ->set('status', $status)
            ->update('tourist_restaurant_books');
    }

    //=============================================== end Tousidt Restaurant =========================================//

    //================================================= Tourist Hotel ===========================================//
    public function createTouristHotel($image)
    {
        $this->load->helper('security');

        $name = $this->db->escape_str($this->input->post('name'));
        $type = $this->db->escape_str($this->input->post('type'));
        $location = $this->db->escape_str($this->input->post('location'));
        $division = $this->db->escape_str($this->input->post('division'));
        $district = $this->db->escape_str($this->input->post('district'));
        $area = $this->db->escape_str($this->input->post('area'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "INSERT INTO tourist_hotels (name, type, location, division, district, area, description, image) VALUES ('{$name}', '{$type}', '{$location}', '{$division}', '{$district}', '{$area}', '{$description}', '{$image}')";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function getTouristHotels()
    {
        $result = $this->db->query("SELECT * FROM tourist_hotels ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristHotel($id)
    {
        $result = $this->db->query("SELECT * FROM tourist_hotels WHERE id='$id'")->row();
        return $result;
    }

    public function updateTouristHotel($id, $image)
    {
        $this->load->helper('security');

        $name = $this->db->escape_str($this->input->post('name'));
        $type = $this->db->escape_str($this->input->post('type'));
        $location = $this->db->escape_str($this->input->post('location'));
        $division = $this->db->escape_str($this->input->post('division'));
        $district = $this->db->escape_str($this->input->post('district'));
        $area = $this->db->escape_str($this->input->post('area'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "UPDATE tourist_hotels SET name= '{$name}', type = '{$type}', location = '{$location}', division = '{$division}', district = '{$district}', area = '{$area}', description = '{$description}', image = '$image' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function deleteTouristHotel($id)
    {
        $this->db->query("DELETE FROM tourist_hotels WHERE id='$id'");
        return TRUE;
    }

    public function getTouristHotelRooms($id)
    {
        $query = $this->db->select('*')
            ->where('hotel_id = ', $id)
            ->get('tourist_hotel_rooms')
            ->result();

        return $query;
    }

    public function insertHotelRoom(array $data)
    {
        $this->db->insert('tourist_hotel_rooms', $data);
    }

    public function getTouristHotelRoom($id)
    {
        $query = $this->db->select('*')
            ->where('id = ', $id)
            ->get('tourist_hotel_rooms')
            ->row();

        return $query;
    }

    public function updateHotelRoom($id, array $data)
    {
        $this->db->where('id = ', $id)
            ->update('tourist_hotel_rooms', $data);
    }

    public function deleteHotelRoom($id)
    {
        $this->db->where('id = ', $id)->delete('tourist_hotel_rooms');
    }

    public function getTouristHotelBookingHistory()
    {
        $query = $this->db->select('*, tourist_hotels.name as hotel_name, tourist_hotels.image as hotel_image, tourists.fname as tourist_name')
            ->join('tourist_hotels', 'tourist_hotels.id = tourist_hotel_books.tourist_hotel_id')
            ->join('tourists', 'tourists.id = tourist_hotel_books.tourist_id')
            ->get('tourist_hotel_books')
            ->result();

        return $query;
    }
    //=============================================== end Tousidt Hotel =========================================//

    //================================================= Tourist Etiquette ===========================================//
    public function createTouristEtiquette($image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "INSERT INTO tourist_etiquettes (title, description, image) VALUES ('{$title}', '{$description}', '{$image}')";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function getTouristEtiquettes()
    {
        $result = $this->db->query("SELECT * FROM tourist_etiquettes ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristEtiquette($id)
    {
        $result = $this->db->query("SELECT * FROM tourist_etiquettes WHERE id='$id'")->row();
        return $result;
    }

    public function updateTouristEtiquette($id, $image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "UPDATE tourist_etiquettes SET title= '{$title}', description = '{$description}', image = '$image' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function deleteTouristEtiquette($id)
    {
        $this->db->query("DELETE FROM tourist_etiquettes WHERE id='$id'");
        return TRUE;
    }
    //=============================================== end Tourist Etiquette =========================================//


    //================================================= Tourist Tipping ===========================================//
    public function createTouristTipping($image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "INSERT INTO tourist_tippings (title, description, image) VALUES ('{$title}', '{$description}', '{$image}')";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function getTouristTippings()
    {
        $result = $this->db->query("SELECT * FROM tourist_tippings ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristTipping($id)
    {
        $result = $this->db->query("SELECT * FROM tourist_tippings WHERE id='$id'")->row();
        return $result;
    }

    public function updateTouristTipping($id, $image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "UPDATE tourist_tippings SET title= '{$title}', description = '{$description}', image = '$image' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function deleteTouristTipping($id)
    {
        $this->db->query("DELETE FROM tourist_tippings WHERE id='$id'");
        return TRUE;
    }
    //=============================================== end Tourist Tipping =========================================//


    //================================================= Tourist Precaution ===========================================//
    public function createTouristPrecaution($image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "INSERT INTO tourist_precautions (title, description, image) VALUES ('{$title}', '{$description}', '{$image}')";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function getTouristPrecautions()
    {
        $result = $this->db->query("SELECT * FROM tourist_precautions ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristPrecaution($id)
    {
        $result = $this->db->query("SELECT * FROM tourist_precautions WHERE id='$id'")->row();
        return $result;
    }

    public function updateTouristPrecaution($id, $image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "UPDATE tourist_precautions SET title= '{$title}', description = '{$description}', image = '$image' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function deleteTouristPrecaution($id)
    {
        $this->db->query("DELETE FROM tourist_precautions WHERE id='$id'");
        return TRUE;
    }
    //=============================================== end Tourist Precaution =========================================//


    //================================================= Tourist LatestNews ===========================================//
    public function createTouristLatestNews($image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "INSERT INTO tourist_latestnewss (title, description, image) VALUES ('{$title}', '{$description}', '{$image}')";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function getTouristLatestNewss()
    {
        $result = $this->db->query("SELECT * FROM tourist_latestnewss ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristLatestNews($id)
    {
        $result = $this->db->query("SELECT * FROM tourist_latestnewss WHERE id='$id'")->row();
        return $result;
    }

    public function updateTouristLatestNews($id, $image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "UPDATE tourist_latestnewss SET title= '{$title}', description = '{$description}', image = '$image' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function deleteTouristLatestNews($id)
    {
        $this->db->query("DELETE FROM tourist_latestnewss WHERE id='$id'");
        return TRUE;
    }
    //=============================================== end Tourist LatestNews =========================================//

    //================================================= Tourist Traffic ===========================================//
    public function createTouristTraffic($image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "INSERT INTO tourist_traffics (title, description, image) VALUES ('{$title}', '{$description}', '{$image}')";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function getTouristTraffics()
    {
        $result = $this->db->query("SELECT * FROM tourist_traffics ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristTraffic($id)
    {
        $result = $this->db->query("SELECT * FROM tourist_traffics WHERE id='$id'")->row();
        return $result;
    }

    public function updateTouristTraffic($id, $image)
    {
        $this->load->helper('security');

        $title = $this->db->escape_str($this->input->post('title'));
        $description = $this->db->escape_str($this->input->post('description'));

        $sql = "UPDATE tourist_traffics SET title= '{$title}', description = '{$description}', image = '$image' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }

    public function deleteTouristTraffic($id)
    {
        $this->db->query("DELETE FROM tourist_traffics WHERE id='$id'");
        return TRUE;
    }
    //=============================================== end Tourist Traffic =========================================//


}
