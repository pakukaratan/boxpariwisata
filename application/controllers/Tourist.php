<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Tourist extends CI_Controller 
{
	public $site_name = "Box Pariwisata";
    public $tourist = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TouristModel', 'touristModel');

        date_default_timezone_set('Asia/Dhaka');
    }

    //============================ Tourist ==============================//
    public function getSignup($error = NULL)
    {
        if($this->session->userdata('tourist_logged_in')){
            redirect('/');
        }
        $data['title'] = $this->site_name.' | Signup';
        $data['error'] = $error;
        $this->load->view('tourist/signup',$data);
    }
    public function createTourist(){
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if(strlen($filename) > 4){
            $image_name = $this->_imageUpload();
        }else{
            $image_name = NULL;
        }

        $this->touristModel->createTourist($image_name);
        redirect('tourist/login');
    }

    private function _imageUpload(){

        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = '*';
          
        $filename = $_FILES['image']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);

        $new_name = time().'.'.$extension;
		$config['file_name'] = $new_name;

        $this->load->library('upload', $config);
        
        if(!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            return NULL;
        } else {
        	return $new_name;
        }
    }

    public function editTourist(){
    	if(!$this->session->userdata('tourist_logged_in')){
            redirect('tourist/login');
        }
        $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
        $this->tourist = $this->touristModel->getTouristById($tourist_id);

        $data['title'] = $this->site_name.' | Tourist';
        $data['active'] = 'tourist';
        $data['tourist'] = $this->tourist;
        $data['tourist'] = $this->touristModel->getTourist($tourist_id);
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/edit_tourist', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    public function updateTourist(){
    	if(!$this->session->userdata('tourist_logged_in')){
            redirect('tourist/login');
        }
        $filename = $_FILES['image']['name'];
        $tourist = $this->touristModel->getTourist($this->input->post('id'));
        if(strlen($filename) > 4){
            if($tourist->image != $filename){
                unlink('./assets/img/'.$tourist->image);
                $image_name = $this->_imageUpload();
            }else
                $image_name = $tourist->image;
        }else
            $image_name = $tourist->image;
        $this->touristModel->updateTourist($this->input->post('id') ,$image_name);
        redirect('/');
    }

    //=========================== end Tourist ============================//
    
    //============================ Tourist Spot ===============================//
    public function touristSpot($error = NULL){
        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id); 
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        $data['title'] = $this->site_name.' | Home';
        $data['active'] = 'home';
        $data['tourist'] = $this->tourist;
        $data['error'] = $error;
        $data['current_location'] = $details->city;
        $data['spots'] = $this->touristModel->getTouristSpotsBy($details->city);
        $data['locations'] = $this->touristModel->getLocationSpots();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/tourist_spot', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    public function getTouristSpots($error = NULL){
        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id); 
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        $data['title'] = $this->site_name.' | Spots';
        $data['active'] = 'spot';
        $data['tourist'] = $this->tourist;
        $data['error'] = $error;
        $data['current_location'] = $details->city;
        $data['spots'] = $this->touristModel->getTouristSpotsBy($details->city);
        $data['locations'] = $this->touristModel->getLocationSpots();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/tourist_spot', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    public function getTouristSpotBy($location = NULL){
        if($location == NULL){
            redirect('/');
        }

        $location = str_replace("_", " ", $location);

        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id); 
        }

        $data['title'] = $this->site_name.' | Spot';
        $data['active'] = 'spot';
        $data['tourist'] = $this->tourist;
        $data['error'] = NULL;
        $data['current_location'] = $location;
        $data['spots'] = $this->touristModel->getTouristSpotsBy($location);
        $data['locations'] = $this->touristModel->getLocationSpots();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/tourist_spot', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    public function touristBookSpot($tourist_spot_id='')
    {
        if($this->session->userdata('tourist_logged_in'))
        {
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id);

            // return redirect('tourist/spot/booking/history');

            $data['title'] = $this->site_name.' | Spot Booking';
            $data['active'] = 'spot';
            $data['tourist'] = $this->tourist;
            $data['error'] = NULL;
            $data['spot_tickets'] = $this->touristModel->getTouristSpotTickets($tourist_spot_id);
            $this->load->view('tourist/partials/head', $data);
            $this->load->view('tourist/partials/navbar', $data);
            $this->load->view('tourist/book_spot', $data);
            $this->load->view('tourist/partials/bottom', $data);
        }
        else
        {
            return redirect('tourist/login');
        }

    }

    public function touristBookSpotTicket($tourist_spot_ticket_id='')
    {
        $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
        $tourist_spot_id = $this->input->post('tourist_spot_id');
        $data =[
            'tourist_id'            => $tourist_id,
            'tourist_spot_id'      => $tourist_spot_id,
            'tourist_spot_ticket_id' => $tourist_spot_ticket_id,
            'booking_count'          => $this->input->post('booking_count'),
            'rate'                  => $this->input->post('rate'),
            'total_price'           => $this->input->post('booking_count') * $this->input->post('rate'),
            'date'                  => date("Y-m-d").' '.date("h:s a")
        ];

        $this->touristModel->touristBookSpotTicket($data);
        $this->session->set_flashdata(['message' => 'You have booked the spot successfully !', 'type' => 'success']);
    
        return redirect('tourist/spot/booking/history');
    }

    public function getTouristSpotBookHistory($error = NULL)
    {
        if($this->session->userdata('tourist_logged_in'))
        {
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id);
        }

        $data['title'] = $this->site_name.' | Spot Booking History';
        $data['active'] = 'tourist_spot_booking_history';
        $data['tourist'] = $this->tourist;
        $data['error'] = $error;
        $data['histories'] = $this->touristModel->getTouristSpotBookHistory($tourist_id);
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/spot_booking_history', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }
    //========================== end Tourist Spot =============================//

    //============================ Tourist Restaurant ===============================//
    public function touristRestaurant($error = NULL){
        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id); 
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        $data['title'] = $this->site_name.' | Home';
        $data['active'] = 'home';
        $data['tourist'] = $this->tourist;
        $data['error'] = $error;
        $data['current_location'] = $details->city;
        $data['restaurants'] = $this->touristModel->getTouristRestaurantsBy($details->city);
        $data['locations'] = $this->touristModel->getLocationRestaurants();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/tourist_restaurant', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    public function getTouristRestaurants($error = NULL){
        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id); 
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        $data['title'] = $this->site_name.' | Restaurants';
        $data['active'] = 'restaurant';
        $data['tourist'] = $this->tourist;
        $data['error'] = $error;
        $data['current_location'] = $details->city;
        $data['restaurants'] = $this->touristModel->getTouristRestaurantsBy($details->city);
        $data['locations'] = $this->touristModel->getLocationRestaurants();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/tourist_restaurant', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    public function getTouristRestaurantBy($location = NULL){
        if($location == NULL){
            redirect('/');
        }

        $location = str_replace("_", " ", $location);

        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id); 
        }

        $data['title'] = $this->site_name.' | Restaurant';
        $data['active'] = 'restaurant';
        $data['tourist'] = $this->tourist;
        $data['error'] = NULL;
        $data['current_location'] = $location;
        $data['restaurants'] = $this->touristModel->getTouristRestaurantsBy($location);
        $data['locations'] = $this->touristModel->getLocationRestaurants();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/tourist_restaurant', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }


    public function touristBookRestaurant($tourist_restaurant_id='')
    {
        if($this->session->userdata('tourist_logged_in'))
        {
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id);

            // return redirect('tourist/restaurant/booking/history');

            $data['title'] = $this->site_name.' | Restaurant Booking';
            $data['active'] = 'restaurant';
            $data['tourist'] = $this->tourist;
            $data['error'] = NULL;
            $data['restaurant_tables'] = $this->touristModel->getTouristRestaurantTables($tourist_restaurant_id);
            $this->load->view('tourist/partials/head', $data);
            $this->load->view('tourist/partials/navbar', $data);
            $this->load->view('tourist/book_restaurant', $data);
            $this->load->view('tourist/partials/bottom', $data);
        }
        else
        {
            return redirect('tourist/login');
        }

    }

    public function touristBookRestaurantTable($tourist_restaurant_table_id='')
    {
        $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
        $tourist_restaurant_id = $this->input->post('tourist_restaurant_id');
        $data =[
            'tourist_id'            => $tourist_id,
            'tourist_restaurant_id'      => $tourist_restaurant_id,
            'booking_no' => $this->input->post('booking_no'),
            'booking_count'          => $this->input->post('booking_count'),
            'rate'                  => $this->input->post('rate'),
            'total_price'           => $this->input->post('booking_count') * $this->input->post('rate'),
            'date'                  => date("Y-m-d").' '.date("h:s a")
        ];

        $this->touristModel->touristBookRestaurantTable($data);
        $this->session->set_flashdata(['message' => 'You have booked the restaurant successfully !', 'type' => 'success']);
    
        return redirect('tourist/restaurant/booking/history');
    }

    public function getTouristRestaurantBookHistory($error = NULL)
    {
        if($this->session->userdata('tourist_logged_in'))
        {
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id);
        }

        $data['title'] = $this->site_name.' | Restaurant Booking History';
        $data['active'] = 'tourist_restaurant_booking_history';
        $data['tourist'] = $this->tourist;
        $data['error'] = $error;
        $data['histories'] = $this->touristModel->getTouristRestaurantBookHistory($tourist_id);
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/restaurant_booking_history', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    //========================== end Tourist Restaurant =============================//

    
    public function getlogin($error = NULL){
    	if($this->session->userdata('tourist_logged_in')){
            redirect('/');
        }
    	$data['title'] = $this->site_name.' | Login';
    	$data['error'] = $error;
		$this->load->view('tourist/login',$data);
    }

    public function postLogin(){
    	$username = $this->input->post('username');
		$password = $this->input->post('password');
        $result = $this->touristModel->checkTouristLogin($username, md5($password));
		if($result) {
                $data = [
                    'id' => $result->id,
                    'name' => $result->fname." ".$result->lname,
                    'username' => $result->fname." ".$result->username,
                    'passport_no' => $result->passport_no
                ];
                $this->session->set_userdata('tourist_logged_in', $data);
            redirect('/');
		} else {
			$this->getlogin("Wrong username or password");
		}
    }

    public function logout(){
        $this->session->unset_userdata('tourist_logged_in');
        return redirect('/');
    }

    //========================== Tourist Hotel =============================//

    public function getTouristHotels($error = NULL)
    {
        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id);
        }

        $data['title'] = $this->site_name.' | Hotel Booking';
        $data['active'] = 'hotel';
        $data['tourist'] = $this->tourist;
        $data['error'] = $error;
        $data['hotels'] = $this->touristModel->getTouristHotels();
        $data['divisions'] = $this->touristModel->getDivisionHotels();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/hotel_book', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    public function getTouristHotelBy($division = NULL){
        if($division == NULL){
            redirect('/');
        }

        $division = str_replace("_", " ", $division);

        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id); 
        }

        $data['title'] = $this->site_name.' | Hotel Booking';
        $data['active'] = 'hotel';
        $data['tourist'] = $this->tourist;
        $data['error'] = NULL;
        $data['hotels'] = $this->touristModel->getTouristHotelsBy($division);
        $data['divisions'] = $this->touristModel->getDivisionHotels();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/hotel_book', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    public function touristBookHotel($tourist_hotel_id='')
    {
        if($this->session->userdata('tourist_logged_in'))
        {
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id);

            // return redirect('tourist/hotel/booking/history');

            $data['title'] = $this->site_name.' | Hotel Booking';
            $data['active'] = 'hotel';
            $data['tourist'] = $this->tourist;
            $data['error'] = NULL;
            $data['hotel_rooms'] = $this->touristModel->getTouristHotelRooms($tourist_hotel_id);
            $this->load->view('tourist/partials/head', $data);
            $this->load->view('tourist/partials/navbar', $data);
            $this->load->view('tourist/book_hotel', $data);
            $this->load->view('tourist/partials/bottom', $data);
        }
        else
        {
            return redirect('tourist/login');
        }

    }

    public function touristBookHotelRoom($tourist_hotel_room_id='')
    {
        $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
        $tourist_hotel_id = $this->input->post('tourist_hotel_id');
        $check_tourist_hotel_book = $this->touristModel->checkTouristBookHotelRoom($tourist_id, $tourist_hotel_id, $tourist_hotel_room_id);

        if (empty($check_tourist_hotel_book)) 
        {
            $data =[
                'tourist_id'            => $tourist_id,
                'tourist_hotel_id'      => $tourist_hotel_id,
                'tourist_hotel_room_id' => $tourist_hotel_room_id,
                'room_no'               => $this->input->post('room_no'),
                'bed'                   => $this->input->post('bed'),
                'booking_days'          => $this->input->post('booking_days'),
                'rate'                  => $this->input->post('rate'),
                'total_price'           => $this->input->post('booking_days') * $this->input->post('rate'),
                'date'                  => date("Y-m-d").' '.date("h:s a")
            ];

            $this->touristModel->touristBookHotelRoom($data);
            $this->session->set_flashdata(['message' => 'You have booked the hotel successfully !', 'type' => 'success']);
        } 
        else 
        {
            $this->session->set_flashdata(['message' => 'You have already booked this hotel !', 'type' => 'danger']);
        }
        
        return redirect('tourist/hotel/booking/history');
    }

    public function getTouristHotelBookHistory($error = NULL)
    {
        if($this->session->userdata('tourist_logged_in'))
        {
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id);
        }

        $data['title'] = $this->site_name.' | Hotel Booking History';
        $data['active'] = 'tourist_booking_history';
        $data['tourist'] = $this->tourist;
        $data['error'] = $error;
        $data['histories'] = $this->touristModel->getTouristHotelBookHistory($tourist_id);
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/hotel_booking_history', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }

    public function cancelTouristHotelRoomBook($tourist_hotel_id, $tourist_hotel_room_id)
    {
        $this->touristModel->cancelTouristHotelRoomBook($tourist_hotel_id, $tourist_hotel_room_id);

        $this->session->set_flashdata(['message' => 'Your booking has been canceled successfully !', 'type' => 'danger']);
        redirect('tourist/hotel');
    }

    //========================== end Tourist Hotel =============================//

    //========================== end Tourist Daytrips =============================//
    public function getTouristDayTrips($error = NULL){
        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id); 
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        $data['title'] = $this->site_name.' | DayTrips';
        $data['active'] = 'daytrips';
        $data['tourist'] = $this->tourist;
        $data['error'] = $error;
        $data['current_location'] = $details->city;
        $data['daytrips'] = $this->touristModel->getTouristDayTripsBy($details->city);
        $data['locations'] = $this->touristModel->getTouristDayTrips();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/tourist_daytrips', $data);
        $this->load->view('tourist/partials/bottom', $data);
        //========================== end Tourist Daytrips =============================//
    }
    public function getTouristDayTripsBy($location = NULL){
        if($location == NULL){
            redirect('/');
        }

        $location = str_replace("_", " ", $location);

        if($this->session->userdata('tourist_logged_in')){
            $tourist_id = $this->session->userdata('tourist_logged_in')['id'];
            $this->tourist = $this->touristModel->getTouristById($tourist_id); 
        }

        $data['title'] = $this->site_name.' | DayTrips';
        $data['active'] = 'daytrips';
        $data['tourist'] = $this->tourist;
        $data['error'] = NULL;
        $data['current_location'] = $location;
        $data['daytrips'] = $this->touristModel->getTouristDayTripsBy($location);
        $data['locations'] = $this->touristModel->getTouristDayTrips();
        $this->load->view('tourist/partials/head', $data);
        $this->load->view('tourist/partials/navbar', $data);
        $this->load->view('tourist/tourist_daytrips', $data);
        $this->load->view('tourist/partials/bottom', $data);
    }
}
