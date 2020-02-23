<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public $site_name = "Tourist";
    public $admin;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel', 'adminModel');

        date_default_timezone_set('Asia/Dhaka');
    }

    //============================ Tourist ==============================//
    public function dashboard($error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist';
        $data['active'] = 'tourist';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['tourists'] = $this->adminModel->getTourists();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createTourist()
    {
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if (strlen($filename) > 4) {
            $image_name = $this->_imageUpload();
        } else {
            $image_name = NULL;
        }

        $this->adminModel->createTourist($image_name);
        redirect('admin');
    }

    private function _imageUpload()
    {

        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = '*';

        $filename = $_FILES['image']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $new_name = time() . '.' . $extension;
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            $this->dashboard("Something went wrong with the image.");
        } else {
            return $new_name;
        }
    }

    public function editTourist($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist';
        $data['active'] = 'tourist';
        $data['admin'] = $this->admin;
        $data['tourist'] = $this->adminModel->getTourist($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateTourist()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $filename = $_FILES['image']['name'];
        $tourist = $this->adminModel->getTourist($this->input->post('id'));
        if (strlen($filename) > 4) {
            if ($tourist->image != $filename) {
                unlink('./assets/img/' . $tourist->image);
                $image_name = $this->_imageUpload();
            } else
                $image_name = $tourist->image;
        } else
            $image_name = $tourist->image;
        $this->adminModel->updateTourist($this->input->post('id'), $image_name);
        redirect('admin');
    }

    public function deleteTourist($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $tourist = $this->adminModel->getTourist($id);
        if ($tourist->image) {
            unlink('./assets/img/' . $tourist->image);
        }
        $this->adminModel->deleteTourist($id);
        redirect('admin');
    }

    //=========================== end Tourist ============================//

    //============================ Tourist Spot ===============================//
    public function touristSpot($error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Spot';
        $data['active'] = 'spot';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['spots'] = $this->adminModel->getTouristSpots();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_spot', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createTouristSpot()
    {
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if (strlen($filename) > 4) {
            $image_name = $this->_imageUpload();
        } else {
            $image_name = NULL;
        }

        $this->adminModel->createTouristSpot($image_name);
        redirect('admin/tourist-spot');
    }

    public function editTouristSpot($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Spot';
        $data['active'] = 'spot';
        $data['admin'] = $this->admin;
        $data['spot'] = $this->adminModel->getTouristSpot($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_spot', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateTouristSpot()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $filename = $_FILES['image']['name'];
        $spot = $this->adminModel->getTouristSpot($this->input->post('id'));
        if (strlen($filename) > 4) {
            if ($spot->image != $filename) {
                unlink('./assets/img/' . $spot->image);
                $image_name = $this->_imageUpload();
            } else
                $image_name = $spot->image;
        } else
            $image_name = $spot->image;
        $this->adminModel->updateTouristSpot($this->input->post('id'), $image_name);
        redirect('admin/tourist-spot');
    }

    public function deleteTouristSpot($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $spot = $this->adminModel->getTouristSpot($id);
        if ($spot->image) {
            unlink('./assets/img/' . $spot->image);
        }
        $this->adminModel->deleteTouristSpot($id);
        redirect('admin/tourist-spot');
    }

    public function createSpotTicket($id, $error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Spot';
        $data['active'] = 'spot';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['spot_id'] = $id;
        $data['spot_tickets'] = $this->adminModel->getTouristSpotTickets($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_spot_ticket', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function insertSpotTicket()
    {
        $data = $this->input->post();

        $string = $this->input->post('rate');
        $pieces = explode(' ', $string);
        $dataToInsert['spot_id'] = $this->input->post('spot_id');
        $dataToInsert['is_weekend'] = $this->input->post('day');
        $dataToInsert['rate'] = $pieces[0];

        $this->adminModel->insertSpotTicket($dataToInsert);
        redirect('admin/tourist-spot');
    }

    public function editSpotTicket($id, $error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Spot';
        $data['active'] = 'spot';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['spot_ticket'] = $this->adminModel->getTouristSpotTicket($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_spot_ticket', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateSpotTicket($id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data = $this->input->post();

        $string = $this->input->post('rate');
        $pieces = explode(' ', $string);
        $dataToInsert['spot_id'] = $this->input->post('spot_id');
        $dataToInsert['is_weekend'] = $this->input->post('day');
        $dataToInsert['rate'] = $pieces[0];

        $this->adminModel->updateSpotTicket($id, $dataToInsert);
        redirect('admin/tourist-spot');
    }

    public function deleteSpotTicket($id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $this->adminModel->deleteSpotTicket($id);
        redirect('admin/tourist-spot');
    }

    public function touristSpotBookingHistory($error = '')
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Spot';
        $data['active'] = 'spot-booking-history';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['spot_bookings'] = $this->adminModel->getTouristSpotBookingHistory();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_spot_ticket_history', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateSpotStatus($booking_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $this->adminModel->updateBookSpotStatus($booking_id, 'Paid');
        return redirect('admin/tourist-spot-booking-history');
    }

    //========================== end Tourist Spot =============================//

    //============================ Tourist Restaurant ===============================//
    public function touristRestaurant($error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Restaurant';
        $data['active'] = 'restaurant';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['restaurants'] = $this->adminModel->getTouristRestaurants();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_restaurant', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createTouristRestaurant()
    {
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if (strlen($filename) > 4) {
            $image_name = $this->_imageUpload();
        } else {
            $image_name = NULL;
        }

        $this->adminModel->createTouristRestaurant($image_name);
        redirect('admin/tourist-restaurant');
    }

    public function editTouristRestaurant($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Restaurant';
        $data['active'] = 'restaurant';
        $data['admin'] = $this->admin;
        $data['restaurant'] = $this->adminModel->getTouristRestaurant($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_restaurant', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateTouristRestaurant()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $filename = $_FILES['image']['name'];
        $restaurant = $this->adminModel->getTouristRestaurant($this->input->post('id'));
        if (strlen($filename) > 4) {
            if ($restaurant->image != $filename) {
                unlink('./assets/img/' . $restaurant->image);
                $image_name = $this->_imageUpload();
            } else
                $image_name = $restaurant->image;
        } else
            $image_name = $restaurant->image;
        $this->adminModel->updateTouristRestaurant($this->input->post('id'), $image_name);
        redirect('admin/tourist-restaurant');
    }

    public function deleteTouristRestaurant($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $restaurant = $this->adminModel->getTouristRestaurant($id);
        if ($restaurant->image) {
            unlink('./assets/img/' . $restaurant->image);
        }
        $this->adminModel->deleteTouristRestaurant($id);
        redirect('admin/tourist-restaurant');
    }

    public function createRestaurantTable($id, $error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Restaurant';
        $data['active'] = 'restaurant';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['restaurant_id'] = $id;
        $data['restaurant_tables'] = $this->adminModel->getTouristRestaurantTables($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_restaurant_table', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function insertRestaurantTable()
    {
        $data = $this->input->post();

        $string = $this->input->post('rate');
        $pieces = explode(' ', $string);
        $dataToInsert['restaurant_id'] = $this->input->post('restaurant_id');
        $dataToInsert['table_no'] = $this->input->post('type');
        $dataToInsert['rate'] = $pieces[0];

        $this->adminModel->insertRestaurantTable($dataToInsert);
        redirect('admin/tourist-restaurant');
    }

    public function editRestaurantTable($id, $error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Restaurant';
        $data['active'] = 'restaurant';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['restaurant_table'] = $this->adminModel->getTouristRestaurantTable($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_restaurant_table', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateRestaurantTable($id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data = $this->input->post();

        $string = $this->input->post('rate');
        $pieces = explode(' ', $string);
        $dataToInsert['restaurant_id'] = $this->input->post('restaurant_id');
        $dataToInsert['table_no'] = $this->input->post('type');
        $dataToInsert['rate'] = $pieces[0];


        $this->adminModel->updateRestaurantTable($id, $dataToInsert);
        redirect('admin/tourist-restaurant');
    }

    public function deleteRestaurantTable($id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $this->adminModel->deleteRestaurantTable($id);
        redirect('admin/tourist-restaurant');
    }

    public function touristRestaurantBookingHistory($error = '')
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Restaurant';
        $data['active'] = 'restaurant-booking-history';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['restaurant_bookings'] = $this->adminModel->getTouristRestaurantBookingHistory();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_restaurant_table_history', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateRestaurantStatus($booking_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $this->adminModel->updateBookRestaurantStatus($booking_id, 'Paid');
        return redirect('admin/tourist-restaurant-booking-history');
    }

    //========================== end Tourist Restaurant =============================//


    //============================ Tourist Hotel ===============================//
    public function touristHotel($error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Hotel';
        $data['active'] = 'hotel';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['hotels'] = $this->adminModel->getTouristHotels();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_hotel', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createTouristHotel()
    {
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if (strlen($filename) > 4) {
            $image_name = $this->_imageUpload();
        } else {
            $image_name = NULL;
        }

        $this->adminModel->createTouristHotel($image_name);
        redirect('admin/tourist-hotel');
    }

    public function editTouristHotel($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Spot';
        $data['active'] = 'hotel';
        $data['admin'] = $this->admin;
        $data['hotel'] = $this->adminModel->getTouristHotel($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_hotel', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateTouristHotel()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $filename = $_FILES['image']['name'];
        $hotel = $this->adminModel->getTouristHotel($this->input->post('id'));
        if (strlen($filename) > 4) {
            if ($hotel->image != $filename) {
                unlink('./assets/img/' . $hotel->image);
                $image_name = $this->_imageUpload();
            } else
                $image_name = $hotel->image;
        } else
            $image_name = $hotel->image;
        $this->adminModel->updateTouristHotel($this->input->post('id'), $image_name);
        redirect('admin/tourist-hotel');
    }

    public function deleteTouristHotel($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $hotel = $this->adminModel->getTouristHotel($id);
        if ($hotel->image) {
            unlink('./assets/img/' . $hotel->image);
        }
        $this->adminModel->deleteTouristHotel($id);
        redirect('admin/tourist-hotel');
    }

    public function createHotelRoom($id, $error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Hotel';
        $data['active'] = 'hotel';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['hotel_id'] = $id;
        $data['hotel_rooms'] = $this->adminModel->getTouristHotelRooms($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_hotel_room', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function insertHotelRoom()
    {
        $data = $this->input->post();

        $string = $this->input->post('rate');
        $pieces = explode(' ', $string);
        $data['rate'] = $pieces[0];

        $this->adminModel->insertHotelRoom($data);
        redirect('admin/tourist-hotel');
    }

    public function editHotelRoom($id, $error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Hotel';
        $data['active'] = 'hotel';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['hotel_room'] = $this->adminModel->getTouristHotelRoom($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_hotel_room', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateHotelRoom($id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data = $this->input->post();

        $string = $this->input->post('rate');
        $pieces = explode(' ', $string);
        $data['rate'] = $pieces[0];

        $this->adminModel->updateHotelRoom($id, $data);
        redirect('admin/tourist-hotel');
    }

    public function deleteHotelRoom($id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $this->adminModel->deleteHotelRoom($id);
        redirect('admin/tourist-hotel');
    }

    public function touristHotelBookingHistory($error = '')
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Hotel';
        $data['active'] = 'hotel-booking-history';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['hotel_bookings'] = $this->adminModel->getTouristHotelBookingHistory();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_hotel_room_history', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    //========================== end Tourist Hotel =============================//

    public function getlogin($error = '')
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }
        $data['title'] = $this->site_name . ' | Admin Panel | Login';
        $data['error'] = $error;
        $this->load->view('admin/login', $data);
    }

    public function postLogin()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $result = $this->adminModel->checkAdminLogin($username, $password);
        if ($result) {
            $data = array(
                'id' => $result->id,
                'name' => $result->name,
                'email' => $result->email
            );
            $this->session->set_userdata('admin_logged_in', $data);
            redirect('admin');
        } else {
            $this->getlogin("Wrong email or password");
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('admin_logged_in');
        return redirect('admin');
    }


    //============================ Tourist Etiquette ===============================//
    public function touristEtiquette($error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Etiquette';
        $data['active'] = 'etiquette';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['etiquettes'] = $this->adminModel->getTouristEtiquettes();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_etiquette', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createTouristEtiquette()
    {
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if (strlen($filename) > 4) {
            $image_name = $this->_imageUpload();
        } else {
            $image_name = NULL;
        }

        $this->adminModel->createTouristEtiquette($image_name);
        redirect('admin/tourist-etiquette');
    }

    public function editTouristEtiquette($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Etiquette';
        $data['active'] = 'etiquette';
        $data['admin'] = $this->admin;
        $data['etiquette'] = $this->adminModel->getTouristEtiquette($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_etiquette', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateTouristEtiquette()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $filename = $_FILES['image']['name'];
        $etiquette = $this->adminModel->getTouristEtiquette($this->input->post('id'));
        if (strlen($filename) > 4) {
            if ($etiquette->image != $filename) {
                unlink('./assets/img/' . $etiquette->image);
                $image_name = $this->_imageUpload();
            } else
                $image_name = $etiquette->image;
        } else
            $image_name = $etiquette->image;
        $this->adminModel->updateTouristEtiquette($this->input->post('id'), $image_name);
        redirect('admin/tourist-etiquette');
    }

    public function deleteTouristEtiquette($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $etiquette = $this->adminModel->getTouristEtiquette($id);
        if ($etiquette->image) {
            unlink('./assets/img/' . $etiquette->image);
        }
        $this->adminModel->deleteTouristEtiquette($id);
        redirect('admin/tourist-etiquette');
    }

    //============================ Tourist Etiquette ===============================//


    //============================ Tourist Tipping ===============================//
    public function touristTipping($error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Tipping';
        $data['active'] = 'tipping';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['tippings'] = $this->adminModel->getTouristTippings();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_tipping', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createTouristTipping()
    {
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if (strlen($filename) > 4) {
            $image_name = $this->_imageUpload();
        } else {
            $image_name = NULL;
        }

        $this->adminModel->createTouristTipping($image_name);
        redirect('admin/tourist-tipping');
    }

    public function editTouristTipping($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Tipping';
        $data['active'] = 'tipping';
        $data['admin'] = $this->admin;
        $data['tipping'] = $this->adminModel->getTouristTipping($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_tipping', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateTouristTipping()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $filename = $_FILES['image']['name'];
        $tipping = $this->adminModel->getTouristTipping($this->input->post('id'));
        if (strlen($filename) > 4) {
            if ($tipping->image != $filename) {
                unlink('./assets/img/' . $tipping->image);
                $image_name = $this->_imageUpload();
            } else
                $image_name = $tipping->image;
        } else
            $image_name = $tipping->image;
        $this->adminModel->updateTouristTipping($this->input->post('id'), $image_name);
        redirect('admin/tourist-tipping');
    }

    public function deleteTouristTipping($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $tipping = $this->adminModel->getTouristTipping($id);
        if ($tipping->image) {
            unlink('./assets/img/' . $tipping->image);
        }
        $this->adminModel->deleteTouristTipping($id);
        redirect('admin/tourist-tipping');
    }

    //============================ Tourist Tipping ===============================//


    //============================ Tourist Precaution ===============================//
    public function touristPrecaution($error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Precaution';
        $data['active'] = 'precaution';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['precautions'] = $this->adminModel->getTouristPrecautions();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_precaution', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createTouristPrecaution()
    {
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if (strlen($filename) > 4) {
            $image_name = $this->_imageUpload();
        } else {
            $image_name = NULL;
        }

        $this->adminModel->createTouristPrecaution($image_name);
        redirect('admin/tourist-precaution');
    }

    public function editTouristPrecaution($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Precaution';
        $data['active'] = 'precaution';
        $data['admin'] = $this->admin;
        $data['precaution'] = $this->adminModel->getTouristPrecaution($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_precaution', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateTouristPrecaution()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $filename = $_FILES['image']['name'];
        $precaution = $this->adminModel->getTouristPrecaution($this->input->post('id'));
        if (strlen($filename) > 4) {
            if ($precaution->image != $filename) {
                unlink('./assets/img/' . $precaution->image);
                $image_name = $this->_imageUpload();
            } else
                $image_name = $precaution->image;
        } else
            $image_name = $precaution->image;
        $this->adminModel->updateTouristPrecaution($this->input->post('id'), $image_name);
        redirect('admin/tourist-precaution');
    }

    public function deleteTouristPrecaution($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $precaution = $this->adminModel->getTouristPrecaution($id);
        if ($precaution->image) {
            unlink('./assets/img/' . $precaution->image);
        }
        $this->adminModel->deleteTouristPrecaution($id);
        redirect('admin/tourist-precaution');
    }

    //============================ Tourist Precaution ===============================//


    //============================ Tourist Latest News ===============================//
    public function touristLatestNews($error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Latest News';
        $data['active'] = 'latestnews';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['latestnewss'] = $this->adminModel->getTouristLatestNewss();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_latestnews', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createTouristLatestNews()
    {
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if (strlen($filename) > 4) {
            $image_name = $this->_imageUpload();
        } else {
            $image_name = NULL;
        }

        $this->adminModel->createTouristLatestNews($image_name);
        redirect('admin/tourist-latestnews');
    }

    public function editTouristLatestNews($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Latest News';
        $data['active'] = 'latestnews';
        $data['admin'] = $this->admin;
        $data['latestnews'] = $this->adminModel->getTouristLatestNews($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_latestnews', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateTouristLatestNews()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $filename = $_FILES['image']['name'];
        $latestnews = $this->adminModel->getTouristLatestNews($this->input->post('id'));
        if (strlen($filename) > 4) {
            if ($latestnews->image != $filename) {
                unlink('./assets/img/' . $latestnews->image);
                $image_name = $this->_imageUpload();
            } else
                $image_name = $latestnews->image;
        } else
            $image_name = $latestnews->image;
        $this->adminModel->updateTouristLatestNews($this->input->post('id'), $image_name);
        redirect('admin/tourist-latestnews');
    }

    public function deleteTouristLatestNews($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $latestnews = $this->adminModel->getTouristLatestNews($id);
        if ($latestnews->image) {
            unlink('./assets/img/' . $latestnews->image);
        }
        $this->adminModel->deleteTouristLatestNews($id);
        redirect('admin/tourist-latestnews');
    }

    //============================ Tourist Latest News ===============================//


    //============================ Tourist Traffic ===============================//
    public function touristTraffic($error = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Traffic';
        $data['active'] = 'traffic';
        $data['admin'] = $this->admin;
        $data['error'] = $error;
        $data['traffics'] = $this->adminModel->getTouristTraffics();
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/tourist_traffic', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function createTouristTraffic()
    {
        // image upload if exists
        $filename = $_FILES['image']['name'];
        if (strlen($filename) > 4) {
            $image_name = $this->_imageUpload();
        } else {
            $image_name = NULL;
        }

        $this->adminModel->createTouristTraffic($image_name);
        redirect('admin/tourist-traffic');
    }

    public function editTouristTraffic($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $admin_id = $this->session->userdata('admin_logged_in')['id'];
        $this->admin = $this->adminModel->getAdminById($admin_id);

        $data['title'] = $this->site_name . ' | Tourist Traffic';
        $data['active'] = 'traffic';
        $data['admin'] = $this->admin;
        $data['traffic'] = $this->adminModel->getTouristTraffic($id);
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/partials/navbar', $data);
        $this->load->view('admin/edit_tourist_traffic', $data);
        $this->load->view('admin/partials/bottom', $data);
    }

    public function updateTouristTraffic()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $filename = $_FILES['image']['name'];
        $traffic = $this->adminModel->getTouristTraffic($this->input->post('id'));
        if (strlen($filename) > 4) {
            if ($traffic->image != $filename) {
                unlink('./assets/img/' . $traffic->image);
                $image_name = $this->_imageUpload();
            } else
                $image_name = $traffic->image;
        } else
            $image_name = $traffic->image;
        $this->adminModel->updateTouristTraffic($this->input->post('id'), $image_name);
        redirect('admin/tourist-traffic');
    }

    public function deleteTouristTraffic($id = NULL)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $traffic = $this->adminModel->getTouristTraffic($id);
        if ($traffic->image) {
            unlink('./assets/img/' . $traffic->image);
        }
        $this->adminModel->deleteTouristTraffic($id);
        redirect('admin/tourist-traffic');
    }

    //============================ Tourist Traffic ===============================//
}
