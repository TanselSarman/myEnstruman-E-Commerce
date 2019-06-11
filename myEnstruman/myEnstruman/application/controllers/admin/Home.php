﻿<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
      public function __construct()
	  {
		  parent::__construct();
		  
		  
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->database();
		  $this->load->model('Database_Model');
		  
		  if(!$this->session->userdata("admin_session"))
		  {
			  
			  $this->session->set_flashdata("login_hata","Önce Giriş Yapınız");
			  redirect(base_url().'admin/login');  
		  }		  
		  
	  }
	  
	public function index()
	{
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_content');
		//$this->load->view('admin/_footer');
		
	}
	public function ayarlar()
	{
		$query=$this->db->query("select * from ayarlar limit 1"); //get("ayarlar") olabilir
		$data["veriler"]=$query->result();
		
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/ayarlar',$data);
		
		
	}

		public function say()
	{
		$query=$this->db->query("select count(*) from kullanicilar"); 
		$data["veriler"]=$query->result();
		

		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/content',$data);
		
		
	}
	
	public function ayarguncelle($id)
	{
		$data=array(
		'adi' => $this->input->post('adi'),
		'aciklama' => $this->input->post('aciklama'),
		'keywords' => $this->input->post('keywords'),
		'smtpserver' => $this->input->post('smtpserver'),
		'smtpport' => $this->input->post('smtpport'),
		'smtpemail' => $this->input->post('smtpemail'),
		'smtpsifre' => $this->input->post('smtpsifre'),
		'adres' => $this->input->post('adres'),
		'sehir' => $this->input->post('sehir'),
		'tel' => $this->input->post('telefon'),
		'email' => $this->input->post('email'),
		'facebook' => $this->input->post('facebook'),
		'instagram' => $this->input->post('instagram'),
		'hakkimizda' => $this->input->post('hakkimizda'),
		'iletisim' => $this->input->post('iletisim'),

		);
		$this->Database_Model->update_data("ayarlar",$data,$id);
		$this->session->set_flashdata("sonuc","Güncelle İşlemi Başarı İle Gerçekleştirildi");
		
		redirect(base_url()."admin/home/ayarlar");
		
		
	}
	
	public function login()
	{
		
		$this->load->view('admin/login_form');
		
	}

		public function slayt_yukle($id)
		{
			$query=$this->db->query("SELECT * From slayt WHERE ID= $id");
			$data["veri"]=$query->result();
			
			$data["id"]=$id;
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
	    $this->load->view('admin\slayt_yukle',$data);
		
		
		}
}
