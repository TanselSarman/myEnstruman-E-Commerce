<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class urunler extends CI_Controller {
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
		
		
		$data["veriler"]=$this->Database_Model->urunler_get();
		
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_urunlerliste');
		$this->load->view('admin/_footer');
		
		
		
		
	}
	
	public function ekle()
	{
		
		$query=$this->db->query("SELECT * FROM kategoriler order by Id");
		$data["kategoriler"]=$query->result();

		$query=$this->db->query("SELECT * FROM kategoriler WHERE parent_id=0 order by Id");
		$data["ust_kategoriler"]=$query->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_urunlerekle',$data);
		//$this->load->view('admin/_footer');
	}
	
	public function eklekaydet()
	{
		/*$data["id"]=$id;
		
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
                }
                else
                {
							$upload_data=$this->upload->data();

								
							$data=array (
								'resim' =>$upload_data["file_name"]
								
								);
								$this->load->model("Database_Model");
								$this->Database_Model->update_data("urunler",$data,$id);
						
								$this->session->set_flashdata("sonuc","Güncelleme İşlemi Başarı İle Gerçekleştirildi");
								redirect (base_url()."admin/urunler");
							
						
                }*/
		
		$data=array(
		'UrunAd' => $this->input->post('UrunAd'),
		'Fiyat' => $this->input->post('Fiyat'),
		'UrunAciklama' => $this->input->post('UrunAciklama'),
		'MevcutRenkler' => $this->input->post('MevcutRenkler'),
		'UrunMevcut' => $this->input->post('UrunMevcut'),
		'resim' => $this->input->post('resim'),
		'kategori_id' => $this->input->post('kategori_id'),
		
		'Marka' => $this->input->post('Marka'),
		'Indirim' => $this->input->post('Indirim'),
		);
		$this->Database_Model->insert_data("urunler",$data);
		$this->session->set_flashdata("sonuc","Ekleme İşlemi Başarı İle Gerçekleştirildi");
		
		redirect(base_url()."admin/urunler");
	}
	
	public function guncellekaydet($id)
	{
		$data=array(
		'UrunAd' => $this->input->post('UrunAd'),
		'Fiyat' => $this->input->post('Fiyat'),
		'UrunAciklama' => $this->input->post('UrunAciklama'),
		'MevcutRenkler' => $this->input->post('MevcutRenkler'),
		'UrunMevcut' => $this->input->post('UrunMevcut'),
		
		'kategori_id' => $this->input->post('kategori_id'),
		);
		$this->Database_Model->update_data("urunler",$data,$id);
		$this->session->set_flashdata("sonuc","Güncelle İşlemi Başarı İle Gerçekleştirildi");
		
		redirect(base_url()."admin/urunler");
	}
	
	function sil($id)
	 {
		 $this->db->query("DELETE FROM urunler WHERE Id=$id");
		 $this->session->set_flashdata("sonuc","Kayıt Silme İşlemi Başarı ile Gerçekleştirildi");
		 redirect (base_url()."admin/urunler");
	 }	 
	 
	public function duzenle($id)
	 {

	 	$query=$this->db->query("SELECT * FROM kategoriler WHERE parent_id=0 order by Id");
		$data["ust_kategoriler"]=$query->result();
		 
		$query=$this->db->query("SELECT * FROM kategoriler order by Id");
		$data["kategoriler"]=$query->result();
		
		$sorgu=$this->db->query("SELECT *  FROM urunler WHERE Id=$id");
		$data["veriler"]=$sorgu->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_urunlerduzenle',$data);
		
		
		 
	 }
	 
	 public function incele($id)
	 {
		$sorgu=$this->db->query("SELECT *  FROM urunler WHERE Id=$id");
		$data["veriler"]=$sorgu->result();
		
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
		$this->load->view('admin/_urunlergoster',$data);
		
		
		 
	 }
	 
	 public function galeri_yukle($id)
		{
		$sorgu=$this->db->query("SELECT *  FROM urunler_resimler WHERE urunler_id=$id");
		$data["veriler"]=$sorgu->result();
			
			$data["id"]=$id;
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
	    $this->load->view('admin\_urunler_galeri_yukle',$data);
		
		
		}

		public function galeri_kaydet($id)
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
								'urunler_id' => $id,
								'resim' =>$upload_data["file_name"]
								
								);
								$this->load->model("Database_Model");
								$this->Database_Model->insert_data("urunler_resimler",$data);
						
								$this->session->set_flashdata("sonuc","Güncelleme İşlemi Başarı İle Gerçekleştirildi");
								redirect (base_url()."admin/urunler/galeri_yukle/$id");
							
						
                }
				
		
	
	    }
		
					function resimsil($id,$resim_id)
	 {
		 $this->db->query("DELETE FROM urunler_resimler WHERE Id=$resim_id");
		 $this->session->set_flashdata("sonuc","Resim Silme İşlemi Başarı ile Gerçekleştirildi");
		 redirect (base_url()."admin/urunler/galeri_yukle/$id");
	 }
		
		public function resim_yukle($id)
		{
			$query=$this->db->query("SELECT * From urunler WHERE Id= $id");
			$data["veri"]=$query->result();
			
			$data["id"]=$id;
		$this->load->view('admin/_header');
		$this->load->view('admin/_sidebar');
	    $this->load->view('admin\_urunler_resim_yukle',$data);
		
		
		}

		public function resim_kaydet($id)
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
                }
                else
                {
							$upload_data=$this->upload->data();

								
							$data=array (
								'resim' =>$upload_data["file_name"]
								
								);
								$this->load->model("Database_Model");
								$this->Database_Model->update_data("urunler",$data,$id);
						
								$this->session->set_flashdata("sonuc","Güncelleme İşlemi Başarı İle Gerçekleştirildi");
								redirect (base_url()."admin/urunler");
							
						
                }
	
	    }
		
		
		
	
	
	
}
