<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class siparisler extends CI_Controller {
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
		
	    $query=$this->db->query("select * from siparisler order by Id");
		$data["veriler"]=$query->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_siparisler',$data);
		$this->load->view('admin/_footer');
		
		
		
		
	}

	 public function incele($id)
	 {
		$sorgu=$this->db->query("SELECT *  FROM siparis_urunler WHERE siparis_id=$id");
		$data["veri"]=$sorgu->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_siparisgoster',$data);
		
		
		 
	 }

	 function sil($id)
	 {
		 $this->db->query("DELETE FROM siparisler WHERE Id=$id");
		 $this->session->set_flashdata("sonuc","Kayıt Silme İşlemi Başarı ile Gerçekleştirildi");
		 redirect (base_url()."admin/siparisler");
	 }
}