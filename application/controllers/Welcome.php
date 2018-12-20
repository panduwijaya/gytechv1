<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	function ceklogin(){
		if(isset($_POST['login'])){
			$user = $this->input->post('user',true);
			$pass = $this->input->post('pass',true);
			$cek = $this->gytechmodel->proseslogin($user, $pass);
			$hasil = count($cek);
			if($hasil > 0){
				$sess = array(
					'status' => TRUE,
					'level'	 => 'admin'
				);
				$yglogin = $this->db->get_where('users',array('username'=>$user, 'password' => $pass))->row();
				$data = array('udhmasuk' => true,
						'nama' => $yglogin->nama, 'email' => $yglogin->email, 'username' => $yglogin->username);
				$this->session->set_userdata($data);
				if($yglogin->level == 'admin'){
					$this->session->set_userdata($sess);
					redirect('beranda');
				}elseif($yglogin->level == 'moderator'){
					$this->session->set_userdata($sess);

					redirect('moderator');
				}elseif($yglogin->level =='member'){
					$this->session->set_userdata($sess);

					redirect('member');
				}
			}else{
				redirect('index');
			}
		}
	}
	function beranda(){
		if ($this->session->status === TRUE){
			$data["title"] = "Admin - GYTECHIM";
			$this->load->view('admin/beranda', $data);

		}else{
			redirect('index');
		}
		
	}
	function moderator(){
		if ($this->session->status === TRUE){

			$data["title"] = "Halaman Moderator";
			$this->load->view('moderator', $data);

		}else{
			redirect('index');
		}
	}
	function member(){
		if ($this->session->status === TRUE){
			$data["title"] = "Halaman Booking Member";
			$this->load->view('member/member', $data);
		}else{
			redirect('index');
		}
	}
	function keluar(){
		$this->session->sess_destroy();
		redirect('index');
	}
}

	


