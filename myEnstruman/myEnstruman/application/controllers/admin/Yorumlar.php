<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yorumlar extends CI_Controller {
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
		$query=$this->db->query("select * from yorumlar order by ID");
		$data["veriler"]=$query->result();
		
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/yorumlar');
		$this->load->view('admin/_footer');
		
		
		
		
	}
	
	public function ekle()
	{
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_yorumekle');
		//$this->load->view('admin/_footer');
	}
	
	public function eklekaydet()
	{
             $data=array (
			
			'adsoy' => $this->input->post('adsoy'),
			'email' => $this->input->post('email'),
			'sifre' => $this->input->post('sifre'),
			'yetki' => $this->input->post('yetki'),
			'durum' => $this->input->post('durum'),
			'tarih' => $this->input->post('tarih'),
			);
			
			$this->Database_Model->insert_data("yorumlar",$data);
	
			$this->session->set_flashdata("sonuc","Ekleme İşlemi Başarı İle Gerçekleştirildi");
			redirect (base_url()."admin/yorumlar_listesi");
	}
	
	public function guncelle($id)
	{
		$data=array(
		'adminnotu' => $this->input->post('adminnotu'),
		'onay'=> "onaylandı",
		
		);
		$this->Database_Model->update_data("yorumlar",$data,$id);
		$this->session->set_flashdata("sonuc","Notunuz Eklendi");
		
		redirect(base_url()."admin/yorumlar/detay/$id");
	}
	
	function sil($id)
	 {
		 $this->db->query("DELETE FROM yorumlar WHERE Id=$id");
		 $this->session->set_flashdata("sonuc","Kayıt Silme İşlemi Başarı ile Gerçekleştirildi");
		 redirect (base_url()."admin/yorumlar");
	 }	 
	 
	public function detay($id)
	 {
		$this->db->query("UPDATE yorumlar SET durum='Okundu' WHERE Id=$id");
		$sorgu=$this->db->query("SELECT *  FROM yorumlar WHERE Id=$id");
		$data["veriler"]=$sorgu->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/yorumlar_detay',$data);
		
		
		 
	 }
	 
	 public function incele($id)
	 {
		$sorgu=$this->db->query("SELECT *  FROM yorumlar WHERE Id=$id");
		$data["veriler"]=$sorgu->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_yorumlargoster',$data);
		
		
		 
	 }
	
	
	
	
	
}
