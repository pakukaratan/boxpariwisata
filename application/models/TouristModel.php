<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class TouristModel extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
    }

    // check admin login
    public function checkTouristLogin($username, $password) {
        $query = $this->db->query("SELECT * FROM tourists WHERE username='$username' AND password='$password'")->row();

        if($query && $query->id)
            return $query;
        return false;
    }

    public function getTouristById($id){
        $query = $this->db->query("SELECT * FROM tourists WHERE id='$id'")->row();
        return $query;
    }

    //==================================================== Tourist =====================================================//

    public function getTourist($id){
        $result = $this->db->query("SELECT * FROM tourists WHERE id='$id'")->row();
        return $result;
    }

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
        $password = '12345';
        if($this->input->post('password')){
            $password = $this->input->post('password');
        }

        $sql = "UPDATE tourists SET fname= '$fname', lname = '$lname', nationality = '$nationality', birthday = '$birthday', birth_place = '$birth_place', passport_no = '$passport_no', visa_no = '$visa_no', passport_expire = '$passport_expire', visa_expire = '$visa_expire', purpose = '$purpose', password = '$password', image = '$image' WHERE id='$id'";
        // insert into database
        $query = $this->db->query($sql);

        return TRUE;
    }
    //========================================================= end Tourist ============================================//

    //================================================= Tourist Restaurant ===========================================//
    public function getTouristRestaurants(){
        $result = $this->db->query("SELECT * FROM tourist_restaurants ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristRestaurantsBy($location){
        $result = $this->db->query("SELECT * FROM tourist_restaurants WHERE location LIKE '%$location%' ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristRestaurant($id){
        $result = $this->db->query("SELECT * FROM tourist_restaurants WHERE id='$id'")->row();
        return $result;
    }

    public function getDivisionRestaurants(){
        $result = $this->db->query("SELECT division, COUNT(id) AS total_restaurant FROM tourist_restaurants GROUP BY(division)")->result();
        return $result;
    }
    public function getLocationRestaurants(){
        $result = $this->db->query("SELECT location, COUNT(id) AS total_restaurant FROM tourist_restaurants GROUP BY(location)")->result();
        return $result;
    }
    public function getTouristRestaurantTables($restaurant_id)
    {
        $query = $this->db->select('*')
                ->where('restaurant_id = ', $restaurant_id)
                ->get('tourist_restaurant_tables')
                ->result();

        return $query;
    }
    public function touristBookRestaurantTable($data)
    {
        $this->db->insert('tourist_restaurant_books', $data);
    }
    public function getTouristRestaurantBookHistory($tourist_id)
    {
        $query = $this->db->select('tourist_restaurant_books.id, tourist_restaurant_books.booking_count, tourist_restaurant_books.rate, tourist_restaurant_books.total_price, tourist_restaurant_books.date, tourist_restaurant_books.status    , tourist_restaurants.name as restaurant_name, tourist_restaurants.image as restaurant_image')
                    ->join('tourist_restaurants', 'tourist_restaurants.id = tourist_restaurant_books.tourist_restaurant_id')
                    ->where('tourist_id', $tourist_id)
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
    //=============================================== end Tourist Restaurant =========================================//


    //================================================= Tourist Spot ===========================================//
    public function getTouristSpots(){
        $result = $this->db->query("SELECT * FROM tourist_spots ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristSpotsBy($location){
        $result = $this->db->query("SELECT * FROM tourist_spots WHERE location LIKE '%$location%' ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristSpot($id){
        $result = $this->db->query("SELECT * FROM tourist_spots WHERE id='$id'")->row();
        return $result;
    }

    public function getDivisionSpots(){
        $result = $this->db->query("SELECT division, COUNT(id) AS total_spot FROM tourist_spots GROUP BY(division)")->result();
        return $result;
    }
    public function getLocationSpots(){
        $result = $this->db->query("SELECT location, COUNT(id) AS total_spot FROM tourist_spots GROUP BY(location)")->result();
        return $result;
    }
    public function getTouristSpotTickets($spot_id)
    {
        $isWeekend = date('D') == 'Sat' || date('D') == 'Sun' ? 1 : 0;
        $query = $this->db->select('*')
                ->where('spot_id = ', $spot_id)
                ->where('is_weekend = ', $isWeekend)
                ->get('tourist_spot_tickets')
                ->result();

        return $query;
    }
    public function touristBookSpotTicket($data)
    {
        $this->db->insert('tourist_spot_books', $data);
    }
    public function getTouristSpotBookHistory($tourist_id)
    {
        $query = $this->db->select('tourist_spot_books.id, tourist_spot_books.booking_count, tourist_spot_books.rate, tourist_spot_books.total_price, tourist_spot_books.date, tourist_spot_books.status , tourist_spots.name as spot_name, tourist_spots.image as spot_image')
                    ->join('tourist_spots', 'tourist_spots.id = tourist_spot_books.tourist_spot_id')
                    ->where('tourist_id', $tourist_id)
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
    //=============================================== end Tourist Spot =========================================//


    //================================================= Tourist Hotel ===========================================//
    public function getTouristHotels(){
        $result = $this->db->query("SELECT * FROM tourist_hotels ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristHotelsBy($division){
        $result = $this->db->query("SELECT * FROM tourist_hotels WHERE division='$division' ORDER BY id DESC")->result();
        return $result;
    }

    public function getTouristHotel($id){
        $result = $this->db->query("SELECT * FROM tourist_hotels WHERE id='$id'")->row();
        return $result;
    }

    public function getDivisionHotels(){
        $result = $this->db->query("SELECT division, COUNT(id) AS total_hotel FROM tourist_hotels GROUP BY(division)")->result();
        return $result;
    }

    public function getTouristHotelRooms($hotel_id)
    {
        $query = $this->db->select('*')
                ->where('hotel_id = ', $hotel_id)
                ->where('availability = ', 1)
                ->get('tourist_hotel_rooms')
                ->result();

        return $query;
    }

    public function touristBookHotelRoom($data)
    {
        $this->db->insert('tourist_hotel_books', $data);
        $this->db->set('availability', 0)
                ->where('id = ', $data['tourist_hotel_room_id'])
                ->update('tourist_hotel_rooms');
    }

    public function getTouristHotelBookHistory($tourist_id)
    {
        $query = $this->db->select('*, tourist_hotels.name as hotel_name, tourist_hotels.image as hotel_image')
                    ->join('tourist_hotels', 'tourist_hotels.id = tourist_hotel_books.tourist_hotel_id')
                    ->where('tourist_id', $tourist_id)
                    ->get('tourist_hotel_books')
                    ->result();

        return $query;
    }

    public function cancelTouristHotelRoomBook($tourist_hotel_id, $tourist_hotel_room_id)
    {
        $this->db->where('tourist_hotel_id = ', $tourist_hotel_id)
                ->where('tourist_hotel_room_id = ', $tourist_hotel_room_id)
                ->delete('tourist_hotel_books');

        $this->db->set('availability', 1)
                ->where('id = ', $tourist_hotel_room_id)
                ->update('tourist_hotel_rooms');
    }
    
    //=============================================== end Tourist Hotel =========================================//
    public function getTouristDayTripsBy($location){
        $result = $this->db->query("SELECT * FROM view_daytrips WHERE location LIKE '%$location%'")->result();
        return $result;
    }
    public function getTouristDayTrips(){
        $result = $this->db->query("SELECT * FROM view_daytrips")->result();
        return $result;
    }

    public function getTouristEtiquette(){
        $result = $this->db->query("SELECT * FROM tourist_etiquettes")->result();
        return $result;
    }
    public function getTouristEtiquetteBy($id){
        $result = $this->db->query("SELECT * FROM tourist_etiquettes WHERE id = '$id'")->result();
        return $result;
    }
    public function getTouristTipping(){
        $result = $this->db->query("SELECT * FROM tourist_tippings")->result();
        return $result;
    }
    public function getTouristTippingBy($id){
        $result = $this->db->query("SELECT * FROM tourist_tippings WHERE id = '$id'")->result();
        return $result;
    }
    public function getTouristPrecaution(){
        $result = $this->db->query("SELECT * FROM tourist_precautions")->result();
        return $result;
    }
    public function getTouristPrecautionBy($id){
        $result = $this->db->query("SELECT * FROM tourist_precautions WHERE id = '$id'")->result();
        return $result;
    }
    public function getTouristLatestNews(){
        $result = $this->db->query("SELECT * FROM tourist_latestnewss")->result();
        return $result;
    }
    public function getTouristLatestNewsBy($id){
        $result = $this->db->query("SELECT * FROM tourist_latestnewss WHERE id = '$id'")->result();
        return $result;
    }
    public function getTouristTraffic(){
        $result = $this->db->query("SELECT * FROM tourist_traffics")->result();
        return $result;
    }
    public function getTouristTrafficBy($id){
        $result = $this->db->query("SELECT * FROM tourist_traffics WHERE id = '$id'")->result();
        return $result;
    }
}
