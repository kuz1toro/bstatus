<?php

class User extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not,
    * send him to the login page
    * @return void
    */
	function index()
	{
		$this->load->model('Users_model');
		if($this->session->userdata('is_logged_in')){
			$user_name = $this->session->userdata('user_name');
			$previlage = $this->Users_model->get_previlage($user_name);
			if ($previlage[0]['previlage']=='prainspeksi')
			{
				redirect('prainspeksi/home');
			}else if($previlage[0]['previlage']=='disposisi')
			{
				redirect('disposisi/home');
			}else if($previlage[0]['previlage']=='pokja')
			{
				redirect('pokja/home');
			}else if($previlage[0]['previlage']=='damkar')
			{
				redirect('damkar/home');
			}else if($previlage[0]['previlage']=='user')
			{
				redirect('maps/home');
			}
			//redirect('prainspeksi/gedung');
			//$this->load->view('prainspeksi/includes/header');
			//$this->load->view('admin/home');
			//$this->load->view('prainspeksi/includes/footer');
        }else{
        	$this->load->view('app/login');
			// redirect ('admin/login');
        }
	}

    /**
    * encript the password
    * @return mixed
    */
    // function __encrip_password($password) {
    //     return md5($password);
    // }

		private function __encrip_password($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
    * check the username and the password with the database
    * @return void
    */

	function login()
	{
		$this->load->view('admin/login');
	}

	function login_fail()
	{
		$this->load->view('app/login_fail');
	}

	function validate()
	{
		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		//$password = $this->__encrip_password($this->input->post('password'));
		$password = $this->input->post('password');
		$stored_password = $this->Users_model->get_password($user_name);
		echo $user_name ;
		echo $password ;
		print_r ($stored_password) ;



		//$is_valid = $this->Users_model->validate($user_name, $password);
		//echo $is_valid ;
		//if($is_valid)
		if($stored_password){
		if(password_verify($password, $stored_password[0]['pass_word']))
		{
			$previlage = $this->Users_model->get_previlage($user_name);
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true,
				'previlage' => $previlage[0]['previlage']
			);
			$this->session->set_userdata($data);
			if ($previlage[0]['previlage']=='prainspeksi')
			{
				redirect('prainspeksi/home');
			}else if($previlage[0]['previlage']=='disposisi')
			{
				redirect('disposisi/home');
			}else if($previlage[0]['previlage']=='pokja')
			{
				redirect('pokja/home');
			}else if($previlage[0]['previlage']=='damkar')
			{
				redirect('damkar/home');
			}else if($previlage[0]['previlage']=='user')
			{
				redirect('maps/home');
			}
			/**redirect('prainspeksi/gedung');
			$this->load->view('prainspeksi/includes/header');
			$this->load->view('admin/home');
			$this->load->view('prainspeksi/includes/footer'); */
		}
		else // incorrect username or password
		{
			//$data['message_error'] = TRUE;
			echo "password tidak cocok";
			$this->load->view('app/login');
			//redirect('login_fail');
		}
	}else{
		echo "tidak ada username tersebut";
		$this->load->view('app/login');
	}
}

    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('app/signup_form');
	}


    /**
    * Create new user and store it in the database
    * @return void
    */
	function create_member()
	{
		$this->load->library('form_validation');

		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('previlage', 'previlage', 'trim');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('app/signup_form');
		}

		else
		{
			$this->load->model('Users_model');

			if($query = $this->Users_model->create_member())
			{
				$this->load->view('app/signup_form');
			}
			else
			{
				$this->load->view('app/signup_form');
			}
		}

	}

	/**
    * Destroy the session, and logout the user.
    * @return void
    */
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

}
