# Host: localhost  (Version 5.5.5-10.1.38-MariaDB)
# Date: 2019-06-10 15:52:58
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "ayarlar"
#

DROP TABLE IF EXISTS `ayarlar`;
CREATE TABLE `ayarlar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(55) COLLATE utf8_turkish_ci DEFAULT '',
  `keywords` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `aciklama` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `name` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `smtpserver` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `smtpport` int(11) DEFAULT '0',
  `smtpemail` varchar(50) COLLATE utf8_turkish_ci DEFAULT '',
  `smtpsifre` varchar(20) COLLATE utf8_turkish_ci DEFAULT '',
  `adres` varchar(200) COLLATE utf8_turkish_ci DEFAULT '',
  `sehir` varchar(20) COLLATE utf8_turkish_ci DEFAULT '',
  `tel` varchar(15) COLLATE utf8_turkish_ci DEFAULT '0',
  `fax` varchar(15) COLLATE utf8_turkish_ci DEFAULT '',
  `email` varchar(50) COLLATE utf8_turkish_ci DEFAULT '',
  `hakkimizda` text COLLATE utf8_turkish_ci,
  `iletisim` text COLLATE utf8_turkish_ci,
  `facebook` varchar(50) COLLATE utf8_turkish_ci DEFAULT '',
  `twitter` varchar(50) COLLATE utf8_turkish_ci DEFAULT '',
  `instagram` varchar(50) COLLATE utf8_turkish_ci DEFAULT '',
  `pinterest` varchar(50) COLLATE utf8_turkish_ci DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "ayarlar"
#

INSERT INTO `ayarlar` VALUES (2,'myENSTRUMENT','afadf','Ticaret Sitesi',NULL,'ssl://smtp.googlemail.com',0,'tanselsarman34@gmail.com','','KARABÜK','KARABÜK','555 555 55 55',NULL,'tan_sel_1907@hotmail.com','<p>hsfgj</p>','<p>adghagdh</p>','https://www.facebook.com/tansel.sarman','','https://www.instagram.com/tansel.sarman/','dgfhj');

#
# Structure for table "kategoriler"
#

DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE `kategoriler` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ad` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `Acıklama` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `Resim` longtext COLLATE utf8_turkish_ci,
  `Keywords` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `Tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Durum` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "kategoriler"
#

INSERT INTO `kategoriler` VALUES (1,'Gitarlar',NULL,NULL,NULL,'2019-06-10 15:13:02',NULL,0),(2,'Türk Müziği',NULL,NULL,NULL,'2019-06-10 15:13:03',NULL,0),(3,'Yaylılar',NULL,NULL,NULL,'2019-06-10 15:13:04',NULL,0),(4,'Vurmalı',NULL,NULL,NULL,'2019-06-10 15:13:05',NULL,0),(5,'Tuşlu',NULL,NULL,NULL,'2019-06-10 15:13:06',NULL,0),(6,'Nefesli',NULL,NULL,NULL,'2019-06-10 15:13:07',NULL,0),(7,'Akustik',NULL,NULL,NULL,'2018-01-06 02:19:26',NULL,1),(8,'Bas',NULL,NULL,NULL,'2019-06-10 15:19:39',NULL,1),(9,'Elektro',NULL,NULL,NULL,'2019-06-10 15:20:03',NULL,1),(10,'Klasik',NULL,NULL,NULL,'2019-06-10 15:20:16',NULL,1),(11,'Bağlama',NULL,NULL,NULL,'2019-06-10 15:20:35',NULL,2),(12,'Cura',NULL,NULL,NULL,'2019-06-10 15:20:46',NULL,2),(13,'Kemane',NULL,NULL,NULL,'2019-06-10 15:20:57',NULL,2),(14,'Keman',NULL,NULL,NULL,'2019-06-10 15:21:18',NULL,3),(15,'Çello',NULL,NULL,NULL,'2019-06-10 15:21:29',NULL,3),(16,'Kontrbas',NULL,NULL,NULL,'2019-06-10 15:21:49',NULL,3),(17,'Akustik Davullar',NULL,NULL,NULL,'2019-06-10 15:22:06',NULL,4),(18,'Ziller',NULL,NULL,NULL,'2019-06-10 15:22:17',NULL,4),(19,'Org',NULL,NULL,NULL,'2019-06-10 15:22:31',NULL,5),(20,'Piyanolar',NULL,NULL,NULL,'2019-06-10 15:22:42',NULL,5);

#
# Structure for table "kullanicilar"
#

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE `kullanicilar` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `adsoy` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `sifre` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `yetki` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `durum` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "kullanicilar"
#

INSERT INTO `kullanicilar` VALUES (1,'Tansel ŞARMAN','tansel@hotmail.com','1234','Admin','Onayl','2019-06-10 14:51:19'),(3,'göksel sarman','gok@hotmail.com','goksel123','admin','onayl','2017-11-13 20:27:17'),(10,'fatih','şentürk','12345','Admin','Onayl','2017-10-23 21:22:03');

#
# Structure for table "mesajlar"
#

DROP TABLE IF EXISTS `mesajlar`;
CREATE TABLE `mesajlar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `adsoy` varchar(50) COLLATE utf8_turkish_ci DEFAULT '',
  `email` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `tel` varchar(15) COLLATE utf8_turkish_ci DEFAULT '',
  `mesaj` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `durum` varchar(10) COLLATE utf8_turkish_ci DEFAULT 'Yeni',
  `tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `IP` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adminnotu` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "mesajlar"
#

INSERT INTO `mesajlar` VALUES (13,'fatih','at@hotmail.xbxvb','256256','afhgadgh','Okundu','2017-12-02 16:08:37','::1',NULL),(14,'asfg','afgafg@afg','asfdg134','asfgafg','Okundu','2017-12-02 18:45:13','::1',NULL),(15,'hasan güç','asan22@hotmail.com','13541354135413','adghajshfjshyjgh','Okundu','2017-12-04 16:24:24','::1','fdhjdghjcghj'),(18,'sinano','sinanomik@gmail.com','13','adfsfd','Yeni','2018-01-06 01:10:08','::1',NULL);

#
# Structure for table "musteriler"
#

DROP TABLE IF EXISTS `musteriler`;
CREATE TABLE `musteriler` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `sifre` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `yetki` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `durum` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `resim` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `cinsiyet` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `sehir` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "musteriler"
#

INSERT INTO `musteriler` VALUES (76,'asfgf asfga s','awrtaf@adfg','asfgfg','','','','2017-12-06 03:02:14','','298685656','','','',''),(77,'asfg SDGFA','AFGAFG@AFDG','AFG','','','','2017-12-04 06:40:10','','','','','',''),(78,'tansel şarman','tansel@hotmail.com','1234','','','','2019-06-10 15:30:59','','','','','',''),(79,'ssas','asda','','','','','2017-12-05 19:01:00','','','','','',''),(80,'sinan sarışen','sinanomik@gmail.com','12345','','','','2017-12-06 03:06:11','','0 538 798 1551','erkek','100.yıl Mah','ankara',''),(81,'taner merote','taner@hotmail.com','12345','','','','2017-12-18 20:41:16','','','','','',''),(82,'gökhan sara','gokhan@hotmail.com','12345','','','','2017-12-18 20:46:03','','','','','',''),(83,'ahmet sera','ahmet@hotmail.com','12345','','','','2017-12-18 20:50:08','','252 252 25 25','erkek','','','');

#
# Structure for table "sepet"
#

DROP TABLE IF EXISTS `sepet`;
CREATE TABLE `sepet` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `musteri_id` varchar(25) COLLATE utf8_turkish_ci DEFAULT '',
  `urun_id` varchar(25) COLLATE utf8_turkish_ci DEFAULT '',
  `tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `adet` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "sepet"
#

INSERT INTO `sepet` VALUES (1,NULL,'32','2018-01-07 16:49:30',1);

#
# Structure for table "siparis_urunler"
#

DROP TABLE IF EXISTS `siparis_urunler`;
CREATE TABLE `siparis_urunler` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `siparis_id` int(11) DEFAULT NULL,
  `musteri_id` int(11) DEFAULT NULL,
  `urun_id` int(11) DEFAULT NULL,
  `adi` varchar(15) COLLATE utf8_turkish_ci DEFAULT NULL,
  `fiyat` float DEFAULT NULL,
  `birim` varchar(15) COLLATE utf8_turkish_ci DEFAULT NULL,
  `tutar` float DEFAULT NULL,
  `tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `adet` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "siparis_urunler"
#

INSERT INTO `siparis_urunler` VALUES (15,27,80,30,'ADgh',356,'ADgh',356,'2017-12-09 17:04:08',1),(16,27,80,31,'sdghsgh',35625,'sdghsgh',35625,'2017-12-09 17:04:08',1),(17,28,80,1,'ADgh',356,'ADgh',356,'2017-12-09 18:58:45',1),(18,28,78,4,'piano',35625,'piano',35625,'2019-06-10 15:38:53',1),(19,28,78,3,'piano',54696900,'piano',54696900,'2019-06-10 15:38:53',1),(20,29,78,5,'piano',54696900,'piano',54696900,'2019-06-10 15:39:24',1),(21,29,78,6,'piano',35625,'piano',35625,'2019-06-10 15:39:24',1);

#
# Structure for table "siparisler"
#

DROP TABLE IF EXISTS `siparisler`;
CREATE TABLE `siparisler` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `musteri_id` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adres` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `telefon` varchar(20) COLLATE utf8_turkish_ci DEFAULT '',
  `tutar` float DEFAULT NULL,
  `sehir` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `durum` varchar(20) COLLATE utf8_turkish_ci DEFAULT 'Yeni',
  `tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Ip` varchar(15) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kargofirma` varchar(25) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kargono` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `mus_aciklama` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `admin_aciklama` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adsoy` varchar(55) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "siparisler"
#

INSERT INTO `siparisler` VALUES (27,'80','100.yıl Mah','0 538 798 1551',35981,NULL,'Yeni','2017-12-09 17:04:08','::1',NULL,NULL,NULL,NULL,'sinan sarışen','sinanomik@gmail.com'),(28,'78','','',54732500,NULL,'Yeni','2019-06-10 15:38:53','::1',NULL,NULL,NULL,NULL,'tansel şarman','tansel@hotmail.com'),(29,'78','','',54732500,NULL,'Yeni','2019-06-10 15:39:24','::1',NULL,NULL,NULL,NULL,'tansel şarman','tansel@hotmail.com');

#
# Structure for table "slaytlar"
#

DROP TABLE IF EXISTS `slaytlar`;
CREATE TABLE `slaytlar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) DEFAULT NULL,
  `aciklama` varchar(255) DEFAULT NULL,
  `resim` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "slaytlar"
#

INSERT INTO `slaytlar` VALUES (1,'slayt1','güzel slayt','7054_B_bl-vocalpack-mydukkan1.jpg'),(2,'slayt2','güzel slayt','858_B_admira2.jpg'),(3,'slayt3','güzel slayt','1966_B_Nickel-Bronze2.jpg');

#
# Structure for table "urunler"
#

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE `urunler` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SaticiUrunID` int(100) NOT NULL,
  `UrunAd` varchar(100) CHARACTER SET latin1 NOT NULL,
  `UrunAciklama` varchar(255) CHARACTER SET latin1 NOT NULL,
  `TedarikciID` int(25) NOT NULL,
  `BirimMiktar` int(20) NOT NULL,
  `BirimBoyut` int(20) NOT NULL,
  `Fiyat` int(11) DEFAULT NULL,
  `UreticiOnerilenFiyat` int(50) NOT NULL,
  `MevcutRenkler` varchar(12) COLLATE utf8_turkish_ci DEFAULT NULL,
  `Indirim` int(50) NOT NULL,
  `IndirimVarmi` bit(10) NOT NULL,
  `UrunMevcut` varchar(11) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `resim` varchar(100) CHARACTER SET latin1 DEFAULT '',
  `Notlar` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Siralama` int(50) NOT NULL,
  `BirimAgirlik` int(50) NOT NULL,
  `kategori_id` int(11) DEFAULT '0',
  `Galeri` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "urunler"
#

INSERT INTO `urunler` VALUES (32,0,'piano','<p>asgfafg</p>',0,0,0,54696874,0,'Siyah',0,b'0','Mevcut','thmb_900x900_Kawai_KawaiCN37DigitalPiano_Rosewood459401.jpg','',0,0,20,NULL),(37,0,'piano','<p>dfhjdhj</p>',0,0,0,35625,0,'Beyaz',0,b'0','Mevcut','thmb_900x900_Fender_FenderAmericanEliteJazzBassV_TobaccoBurstMaple457691.jpg','',0,0,20,NULL),(38,0,'sdghsdgh','dfhj',0,0,0,2356,0,'Siyah',0,b'0','Mevcut','thmb_900x900_pearlriver_pearlrivermv0301.jpg','',0,0,3,NULL),(39,0,'sdgh','hdjfgjk',0,0,0,5326346,0,'Siyah',0,b'0','Mevcut','thmb_900x900_ManuelRodriguez_ManuelRodriguezModelB23341.jpg','',0,0,1,NULL),(40,0,'afg','sfgh',0,0,0,256,0,'Siyah',0,b'0','Mevcut','thmb_900x900_Kozmos-KDA-20-NAT-Akustik-Gitar1.jpg','',0,0,1,NULL);

#
# Structure for table "urunler_resimler"
#

DROP TABLE IF EXISTS `urunler_resimler`;
CREATE TABLE `urunler_resimler` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `urunler_id` int(11) DEFAULT '0',
  `resim` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

#
# Data for table "urunler_resimler"
#

INSERT INTO `urunler_resimler` VALUES (4,33,'charlize_theron_38-1920x10808.jpg'),(5,33,'emilia_clarke_2016_photoshoot-1920x1080.jpg'),(6,33,'jennifer_lawrence_in_hunger_games-1920x1080.jpg'),(19,40,'Kozmos-KDA-20-NAT-Akustik-Gitar_75446_2318651.jpg'),(20,40,'Kozmos-KDA-20-NAT-Akustik-Gitar_75446_3318652.jpg'),(21,39,'Kozmos-KDA-20-NAT-Akustik-Gitar_75446_33186511.jpg'),(22,39,'6299931.jpg'),(23,38,'thmb_900x900_Almira_AlmiraCNPB01243641.jpg'),(24,38,'thmb_900x900_Almira_AlmiraCNPG01225151.jpg'),(25,38,'thmb_900x900_Amanda_AmandaAVLX1223191.jpg'),(26,32,'11717443_8003180011.jpg'),(27,32,'11717463_800318001.jpg'),(28,37,'6299932.jpg'),(29,37,'0197102752_gtr_hdstckbck_001_nr316821.jpg');

#
# Structure for table "yorumlar"
#

DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE `yorumlar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `adsoy` varchar(50) COLLATE utf8_turkish_ci DEFAULT '',
  `email` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `mesaj` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `durum` varchar(10) COLLATE utf8_turkish_ci DEFAULT 'Yeni',
  `tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `IP` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adminnotu` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `onay` varchar(255) COLLATE utf8_turkish_ci DEFAULT 'beklemede',
  `urun_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

#
# Data for table "yorumlar"
#

INSERT INTO `yorumlar` VALUES (3,'adg','tan_sel_1907@hotmail.com','afgafdgafg','Okundu','2018-01-06 04:56:24','::1','','onaylandı',32),(4,'sinan','sinanomik@gmail.com','çok beğendim :)','Okundu','2018-01-06 05:33:47','::1','','onaylandı',38);
