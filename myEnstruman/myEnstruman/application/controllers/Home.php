<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
      public function __construct()
	  {
		  parent::__construct();
		  
		   $this->load->database();
		  $this->load->helper('url');
		  $this->load->library('session');
		   $this->load->model('Database_Model');
	  }
	public function index()
	{
		$query=$this->db->query("select * from ayarlar limit 1"); 
		$data["veriler"]=$query->result();
		
		$query=$this->db->query("select * from slaytlar limit 4"); 
		$data["slider"]=$query->result();
		
		$query=$this->db->query("SELECT * fROM urunler LIMIT 12 "); 
		$data["urunler"]=$query->result();
		
		
		$this->load->view('_header',$data);
		$this->load->view('_slider');
		$this->load->view('_sidebar');
		$this->load->view('_content');
		$this->load->view('_footer');
		
		
		
		
	}
	
	public function iletisim()
	{
		$query=$this->db->query("select * from ayarlar limit 1"); 
		$data["veriler"]=$query->result();
		
		
		
		
		$this->load->view('iletisim',$data);
		
		
		
		
	}

	public function hakkimizda()
	{
		$query=$this->db->query("select * from ayarlar limit 1"); 
		$data["veriler"]=$query->result();
		
		
		
		
		$this->load->view('hak',$data);
		
		
		
		
	}

	public function ilet()
	{
		$query=$this->db->query("select * from ayarlar limit 1"); 
		$data["veriler"]=$query->result();
		
		
		
		
		$this->load->view('ilet',$data);
		
		
		
		
	}
	public function uyelik()
	{
		$query=$this->db->query("select * from ayarlar limit 1"); 
		$data["veriler"]=$query->result();
		
		   
			
		
		
		
		$this->load->view('uyelik',$data);
		
		
		
		
	}
	
	public function uyepanel()
	{
		//üyeye ait
		  if(!$this->session->userdata("uye_session"))
		  {
			  
			  $this->session->set_flashdata("login_hata","Önce Giriş Yapınız");
			  redirect(base_url().'home/uyelik');  
		  }	
		
		
		$query=$this->db->query("select * from ayarlar limit 1"); 
		$data["veriler"]=$query->result();
		
		$id=$this->session->uye_session["id"];
		$query=$this->db->query("select * from musteriler WHERE Id=$id"); 
		
		$data["veriler2"]=$query->result();
		
		
		
		$this->load->view('uyepanel',$data);
		
		
		
		
	}
	
		public function uyegiris_yap()
	{
		$email=$this->input->post('email');
		$sifre=$this->input->post('sifre');
		
		$email=$this->security->xss_clean($email);
		$sifre=$this->security->xss_clean($sifre);
		
		if( $email and $sifre )
		{
			
			$result=$this->Database_Model->login("musteriler",$email,$sifre);
			if($result)
			{
							
					$sess_array=array(
					'id' => $result[0]->Id,
					'adsoyad' => $result[0]->adsoyad,
					'email' => $result[0]->email,
					
					
					);
					
					$this->session->set_userdata("uye_session",$sess_array);
					
					redirect(base_url()."home/uyepanel");
				
				
		
			}
			
			else
			{
				$this->session->set_flashdata("mesaj","Geçersiz Email ya da Şifre");
				redirect(base_url()."home/uyelik");
			}
			
			
			
			
		}	
		
	}
	
	
		public function mesajkaydet()
	{
			$data=array(
		'adsoy' => $this->input->post('adsoy'),
		'email' => $this->input->post('email'),
		'tel' => $this->input->post('tel'),
		'mesaj' => $this->input->post('mesaj'),
		'Ip' => $_SERVER['REMOTE_ADDR']
		);
		$this->Database_Model->insert_data("mesajlar",$data);

        $adsoy = $this->input->post('adsoy');
		$email = $this->input->post('email');

			$query=$this->db->get("ayarlar");
		    $data["veri"]=$query->result();

		    $config =Array(
		    	'protocol' => 'smtp',
		    	'smtp_host' => $data["veri"][0]->smtpserver,
		    	'smtp_port' => $data["veri"][0]->smtpport,
		    	'smtp_user' => $data["veri"][0]->smtpemail,
		    	'smtp_pass' => $data["veri"][0]->smtpsifre,
		    	'mailtype' => 'html',
		    	'charset' => 'utf-8',
		    	'wordwrap' => TRUE
			 );

		    $mesaj="Sayın : ".$adsoy."<br> Göndermiş olduğunuz mesaj alınmıştır.<br>Teşekkür ederiz.<br>";
		    $mesaj.="===========================================================<br>";
		    $mesaj.= $data["veri"][0]->name."<br>";
		    $mesaj.= $data["veri"][0]->adres."<br>";
		    $mesaj.= $data["veri"][0]->sehir."<br>";
		    $mesaj.= $data["veri"][0]->tel."<br>";
		    $mesaj.= $data["veri"][0]->fax."<br>";
		    $mesaj.= $data["veri"][0]->email."<br>";
		    $mesaj.="Göndermiş olduğunuz mesaj aşağıdaki gibidir.<br>===========================================================<br>";
		    $mesaj.=$this->input->post('mesaj');

		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from($data["veri"][0]->smtpemail);
		    $this->email->to($email);
		    $this->email->subject($data["veri"][0]->name." Mail Sistemi");
		    $this->email->message($mesaj);

		    if ($this->email->send()) {
		    		$this->session->set_flashdata("sonuc","Email Başarı İle Gönderilmiştir.");
		    }
		    else
		    {
		    		$this->session->set_flashdata("sonuc","Email gönderilirken bir hata oluştu!");
		    		show_error($this->email->print_debugger());
		    }

		$this->session->set_flashdata("mesaj","Mesajınız Başarı İle Alındı");
		
		redirect(base_url()."home/iletisim");
		
		
	}

		public function yorumkaydet($id)
	{
			$data=array(
		'urun_id'=> $id,		
		'adsoy' => $this->input->post('adsoy'),
		'email' => $this->input->post('email'),
	
		'mesaj' => $this->input->post('mesaj'),
		'Ip' => $_SERVER['REMOTE_ADDR']
		);
		$this->Database_Model->insert_data("yorumlar",$data);

       $query=$this->db->query("SELECT * from yorumlar  where onay='Onaylandı' and urun_id=$id ORDER BY tarih desc"); 
		$data["yorumlar"]=$query->result();

		$this->session->set_flashdata("mesaj","Mesajınız Başarı İle Alındı");
		
		redirect(base_url()."home");
		
		
	}
	
	public function urundetay($id)
	
	{
		


		$data["tekurun"]=$this->Database_Model->urun_get($id);
		
		$query=$this->db->query("select * from ayarlar limit 1"); 
		$data["veriler"]=$query->result();
		
		$query=$this->db->query("select * from urunler_resimler WHERE urunler_id=$id"); 
		$data["resimler"]=$query->result();
		
		
		$query=$this->db->query("select * from urunler WHERE Id= $id"); 
		$data["veri"]=$query->result();

		$query=$this->db->query("select * from urunler WHERE Id= $id"); 
		$data["urun"]=$query->result();
		
		$query=$this->db->query("SELECT * from yorumlar  where onay='onaylandı' and urun_id=$id ORDER BY tarih desc"); 
		$data["yorumlar"]=$query->result();
		
		
		$this->load->view('urun_detay',$data);
		
		
		
		
	}
	
	public function uyeguncelle($id)
	{
		$data=array(
		'adsoyad' => $this->input->post('adsoyad'),
		'email' => $this->input->post('email'),
		'telefon' => $this->input->post('telefon'),
		'adres' => $this->input->post('adres'),
		'sehir' => $this->input->post('sehir'),
		);
		$this->Database_Model->update_data("musteriler",$data,$id);
		$this->session->set_flashdata("sonuc","Güncelle İşlemi Başarı İle Gerçekleştirildi");
		
		redirect(base_url()."home");
	}
	
	public function cikis_yap()
	{
		$this->session->unset_userdata("uye_session");
		
		redirect(base_url()."home/uyelik");
		
		
	}
	
		public function siparislerim()
	{
		  if(!$this->session->userdata("uye_session"))
		  {
			  
			  $this->session->set_flashdata("login_hata","Önce Giriş Yapınız");
			  redirect(base_url().'home/uyelik');  
		  }	
		
		
			$query=$this->db->query("select * from ayarlar limit 1"); 
		    $data["veriler"]=$query->result();
			
		    $musteri_id=$this->session->uye_session["id"];
			$query=$this->db->query("SELECT * FROM siparisler WHERE musteri_id=$musteri_id");
		
		    $data["sepetler"]=$query->result();
		
			//$id=$this->session->uye_session["id"];
		   
/*		   $query=$this->db->query("select * from siparisler WHERE Id=$id"); 
			
				$data["siparisler"]=$query->result();
				*/
				
		$this->load->view('uye_siparisler',$data);
	}
	
	public function sepete_ekle($id)
	{
		    $data=array (
			
			'musteri_id' => $this->session->uye_session["id"],
			'urun_id' => $id,
			'adet' => $this->input->post('adet'),
		
			);
			
			$this->Database_Model->insert_data("sepet",$data);
	
			$this->session->set_flashdata("sonuc","Ürün Sepete Eklendi");
			redirect (base_url()."home/urundetay/$id");
		
		
	}
	
		public function sepetim()
	{
		 if(!$this->session->userdata("uye_session"))
		  {
			  
			  $this->session->set_flashdata("login_hata","Önce Giriş Yapınız");
			  redirect(base_url().'home/uyelik');  
		  }	
		
		    $musteri_id=$this->session->uye_session["id"];
			
			$query=$this->db->query("select * from ayarlar limit 1"); 
		    $data["veriler"]=$query->result();
			
			
			
			
			$query=$this->db->query("SELECT sepet.*,urunler.UrunAd as urunadi,urunler.Fiyat as urunfiyat,urunler.MevcutRenkler as urunrenk,urunler.resim as urunresim,sepet.adet as urunadet,
			urunler.MevcutRenkler as urunrenk
			FROM sepet
			INNER JOIN urunler ON urunler.id=sepet.urun_id
			WHERE sepet.musteri_id=$musteri_id
			order by urunadi"); 
		    $data["veri"]=$query->result();
		
		    $this->load->view('uye_sepet',$data);
	}
	
	function sil($id)
	 {
		 $this->db->query("DELETE FROM sepet WHERE Id=$id");
		 $this->session->set_flashdata("sonuc","Kayıt Silme İşlemi Başarı ile Gerçekleştirildi");
		 redirect (base_url()."home/sepetim");
	 }	
	 
	 
		public function odeme()
	{
		 if(!$this->session->userdata("uye_session"))
		  {
			  
			  $this->session->set_flashdata("login_hata","Önce Giriş Yapınız");
			  redirect(base_url().'home/uyelik');  
		  }	
		
		    $musteri_id=$this->session->uye_session["id"];
			
			$query=$this->db->query("select * from ayarlar limit 1"); 
		    $data["veriler"]=$query->result();
			
			$query=$this->db->query("select * from musteriler WHERE Id=$musteri_id"); 
		    $data["musteri"]=$query->result();
			 
			
			$query=$this->db->query("SELECT sepet.*,urunler.UrunAd as urunadi,urunler.Fiyat as urunfiyat,urunler.MevcutRenkler as urunrenk,urunler.resim as urunresim,sepet.adet as urunadet,
			urunler.MevcutRenkler as urunrenk
			FROM sepet
			INNER JOIN urunler ON urunler.id=sepet.urun_id
			WHERE sepet.musteri_id=$musteri_id
			order by urunadi"); 
		    $data["veri"]=$query->result();
		
		    $this->load->view('odeme',$data);
	}
	
	 
		public function siparis_tamamla()
	{
		     $musteri_id=$this->session->uye_session["id"];
		
		      $data=array (
			
			'adsoy' => $this->input->post('adsoyad'),
			'email' => $this->input->post('email'),
			'adres' => $this->input->post('adres'),
			'telefon' => $this->input->post('telefon'),
			'sehir' => $this->input->post('sehir'),
			'tutar' => $this->input->post('tutar'),
			'musteri_id' => $musteri_id,
			'Ip' => $_SERVER['REMOTE_ADDR']
			);
			
			$siparis_id=$this->Database_Model->insert_data("siparisler",$data);
			
			if($siparis_id)
			{	
			$query=$this->db->query("SELECT sepet.*,urunler.UrunAd as urunadi,urunler.Fiyat as urunfiyat,urunler.resim as urunresim,sepet.adet as urunadet,
			urunler.MevcutRenkler as urunrenk
			FROM sepet
			INNER JOIN urunler ON urunler.Id=sepet.urun_id
			WHERE sepet.musteri_id=$musteri_id
			order by urunadi"); 
			$veriler=$query->result();
			
			      foreach($veriler as $rs)
				  {
					 
						
						$data=array (
						
						'musteri_id' => $this->session->uye_session["id"],
						'siparis_id' => $siparis_id,
						'urun_id' => $rs->Id,
						'adi' => $rs->urunadi,
						'adet' => $rs->urunadet,
						'fiyat' => $rs->urunfiyat,
						'birim' => $rs->urunadi,
						'tutar' => $rs->urunadet* $rs->urunfiyat,
						
			              ); 
					  $this->Database_Model->insert_data("siparis_urunler",$data);
				  }
			
			
	        }
	
	
	        $this->db->query("DELETE FROM sepet WHERE musteri_id=$musteri_id");
	       
			$this->session->set_flashdata("sonuc","Siparişiniz Alınmıştır");
			redirect (base_url()."home/siparislerim");
	}
	
		public function siparis_detay($id)
	{
		if(!$this->session->userdata("uye_session"))
		  {
			  
			  $this->session->set_flashdata("login_hata","Önce Giriş Yapınız");
			  redirect(base_url().'home/uyelik');  
		  }	
		
		    $musteri_id=$this->session->uye_session["id"];
			
			$query=$this->db->query("select * from ayarlar limit 1"); 
		    $data["veriler"]=$query->result();
		
		    $musteri_id=$this->session->uye_session["id"];
			$query=$this->db->query("SELECT * FROM siparisler WHERE Id=$id");
			 $data["siparis"]=$query->result();
			
			$query=$this->db->query("SELECT * FROM siparis_urunler WHERE siparis_id=$id");
			 $data["urunler"]=$query->result();
			 
			 $this->load->view('uye_siparis_detay',$data);
			
	}

	public function kategori($kategori)
		{

				$data["urun_kategori"]=$this->Database_Model->urun_get_kategori($kategori);

				$query=$this->db->query("select * from kategoriler WHERE Id=$kategori"); 
				$data["kategoriler"]=$query->result();


				$query=$this->db->query("select * from ayarlar limit 1");
				$data["veriler"]=$query->result();

				
                $this->load->view('_header',$data);
                $this->load->view('_sidebar');
				$this->load->view('_kategori',$data);


				
		
				
		}

		public function kategori1($kategori)
		{

				$data["urun_kategori"]=$this->Database_Model->urunler_get_kategori($kategori);

				$query=$this->db->query("select * from kategoriler WHERE Id=$kategori"); 
				$data["kategoriler"]=$query->result();


				$query=$this->db->query("select * from ayarlar limit 1");
				$data["veriler"]=$query->result();

				
                $this->load->view('_header',$data);
                $this->load->view('_sidebar');
				$this->load->view('_kategori',$data);


				
		
				
		}

		public function search()
		{




				$sorgu=$this->input->post('sorgu');
			

				$query=$this->db->query("SELECT * FROM urunler
           	    WHERE UrunAd LIKE '%"."$sorgu"."%' OR UrunAciklama LIKE '%"."$sorgu"."%'"); 



				$data["urunler"]=$query->result();


				$query=$this->db->query("SELECT * from ayarlar limit 1");
				$data["veriler"]=$query->result();

				

				$musteri_id=$this->session->uye_session["id"];

		

				

				


				
				

					$this->load->view('_header',$data);
					$this->load->view('_sidebar');
					$this->load->view('_aramaSonuclar',$data);
					
					
				
			
		}
	
}
