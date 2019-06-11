<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class slaytlar extends CI_Controller {
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
		
		
		$query=$this->db->query("select * from slaytlar order by Id");
		$data["veriler"]=$query->result();
		
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_slaytlarliste');
		$this->load->view('admin/_footer');
		
		
		
		
	}
	
	public function ekle()
	{
		
		$query=$this->db->query("SELECT * FROM slaytlar order by Id");
		$data["slaytlar"]=$query->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_slaytlarekle',$data);
		//$this->load->view('admin/_footer');
	}
	
	public function eklekaydet()
	{
		/*$data["Id"]=$id;
		
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('resim'))
                {
                        $error =  $this->upload->display_errors();
						$this->session->set_flashdata("mesaj","Yüklemede Hata Oluştu :".$error);

                        	$this->load->view('admin/_header');
							$this->load->view('admin/_sidebar');
							$this->load->view('admin\_slaytlar_esim_yukle',$data);
							$this->load->view('admin/_footer');
                }
                else
                {
							$upload_data=$this->upload->data();

								
							$data=array (
								'resim' =>$upload_data["file_name"]
								
								);
								$this->load->model("Database_Model");
								$this->Database_Model->update_data("slaytlar",$data,$id);
						
								$this->session->set_flashdata("sonuc","Güncelleme İşlemi Başarı İle Gerçekleştirildi");
								redirect (base_url()."admin/slaytlar");
							
						
                }
		*/
		$data=array(
		'adi' => $this->input->post('adi'),
		'aciklama' => $this->input->post('aciklama'),
		'resim' => $this->input->post('resim'),
		);
		$this->Database_Model->insert_data("slaytlar",$data);
		$this->session->set_flashdata("sonuc","Ekleme İşlemi Başarı İle Gerçekleştirildi");
		
		redirect(base_url()."admin/slaytlar");
	}
	
	public function guncellekaydet($id)
	{
		$data=array(
		'adi' => $this->input->post('adi'),
		'aciklama' => $this->input->post('aciklama'),
		'resim' => $this->input->post('resim'),
		);
		$this->Database_Model->update_data("slaytlar",$data,$id);
		$this->session->set_flashdata("sonuc","Güncelle İşlemi Başarı İle Gerçekleştirildi");
		
		redirect(base_url()."admin/slaytlar");
	}
	
	function sil($id)
	 {
		 $this->db->query("DELETE FROM slaytlar WHERE Id=$id");
		 $this->session->set_flashdata("sonuc","Kayıt Silme İşlemi Başarı ile Gerçekleştirildi");
		 redirect (base_url()."admin/slaytlar");
	 }	 
	 
	public function duzenle($id)
	 {
		 
		
		$sorgu=$this->db->query("SELECT *  FROM slaytlar WHERE id=$id");
		$data["veriler"]=$sorgu->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_slaytlarduzenle',$data);
		
		
		 
	 }
	 
	/* public function incele($id)
	 {
		$sorgu=$this->db->query("SELECT *  FROM urunler WHERE Id=$id");
		$data["veriler"]=$sorgu->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_urunlergoster',$data);
		
		
		 
	 }*/
	 
	/* public function galeri_yukle($id)
		{
		$sorgu=$this->db->query("SELECT *  FROM urunler_resimler WHERE urunler_id=$id");
		$data["veriler"]=$sorgu->result();
			
			$data["id"]=$id;
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
	    $this->load->view('admin\_urunler_galeri_yukle',$data);
		
		
		}*/

		/*public function galeri_kaydet($id)
		{
			$data["id"]=$id;
		
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('resim'))
                {
                        $error =  $this->upload->display_errors();
						$this->session->set_flashdata("mesaj","Yüklemede Hata Oluştu :".$error);

                        	$this->load->view('admin/_header');
							$this->load->view('admin/_sidebar');
							$this->load->view('admin\_urunler_resim_yukle',$data);
							$this->load->view('admin/_footer');
							
							redirect (base_url()."admin/urunler/galeri_yukle/$id");
                }
                else
                {
							$upload_data=$this->upload->data();

								
							$data=array (
								
								'resim' =>$upload_data["file_name"]
								
								);
								$this->load->model("Database_Model");
								$this->Database_Model->insert_data("urunler_resimler",$data);
						
								$this->session->set_flashdata("sonuc","Güncelleme İşlemi Başarı İle Gerçekleştirildi");
								redirect (base_url()."admin/urunler/galeri_yukle/$id");
							
						
                }
				
		
	
	    }*/
		
					function resimsil($id,$resim_id)
	 {
		 $this->db->query("DELETE FROM slayt_resim WHERE Id=$resim_id");
		 $this->session->set_flashdata("sonuc","Resim Silme İşlemi Başarı ile Gerçekleştirildi");
		 redirect (base_url()."admin/urunler/galeri_yukle/$id");
	 }
		
		public function resim_yukle($id)
		{
			$query=$this->db->query("SELECT * From slaytlar WHERE Id= $id");
			$data["veri"]=$query->result();
			
			$data["id"]=$id;
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
	    $this->load->view('admin\_slaytlar_resim_yukle',$data);
		
		
		}

		public function resim_kaydet($id)
		{
			$data["Id"]=$id;
		
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('resim'))
                {
                        $error =  $this->upload->display_errors();
						$this->session->set_flashdata("mesaj","Yüklemede Hata Oluştu :".$error);

                        	$this->load->view('admin/_header');
							$this->load->view('admin/_sidebar');
							$this->load->view('admin\_slaytlar_resim_yukle',$data);
							$this->load->view('admin/_footer');
                }
                else
                {
							$upload_data=$this->upload->data();

								
							$data=array (
								'resim' =>$upload_data["file_name"]
								
								);
								$this->load->model("Database_Model");
								$this->Database_Model->update_data("slaytlar",$data,$id);
						
								$this->session->set_flashdata("sonuc","Güncelleme İşlemi Başarı İle Gerçekleştirildi");
								redirect (base_url()."admin/slaytlar");
							
						
                }
	
	    }
		
		
		
	
	
	
}
