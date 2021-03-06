<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function index()
	{
  		if($this->users->loggedIn())
  			redirect('work');
  		
		$data['site_sub_page'] = 'Sign Up';
		$data['active_nav'] = 'signup';
		$this->load->view('includes/header', $data);
		$this->load->view('signup');
		$this->load->view('includes/footer');
		
	}
	
	public function push()
	{
		if($this->users->loggedIn())
  			redirect('work');
  		
		if($this->input->post())
		{
			$email = $this->input->post('email');
			$username = $this->input->post('name');
			$password = $this->input->post('password');
			
			// pass data to user model to do heavy lifting
			$register = $this->users->register($username, $email, $password);
			if($register['status'])
			{
				// registration successful, redirect user to work page
				redirect('work?reg=1');
				exit;
			} else {
				// display form with errors
				$data['site_sub_page'] = 'Sign Up';
				$data['active_nav'] = 'signup';
				$this->load->view('includes/header', $data);
				$this->load->view('signup', $register);
				$this->load->view('includes/footer');
				
			}
		}
	}
}