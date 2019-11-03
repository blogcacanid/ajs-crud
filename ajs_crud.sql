CREATE DATABASE ajs_crud;
USE ajs_crud;
 
CREATE TABLE `pegawai` (
  `pegawai_id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`pegawai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table `pegawai`
INSERT INTO `pegawai` (`nip`, `nama_pegawai`, `alamat`) VALUES
('200503', 'Ade Kartono', 'Jl. H. Azra\'i RT.007/01\r\nMenteng Dalam'),
('200505', 'Amalia', 'Jl. Ciak RT.004/01 No.18\r\nBukit Duri'),
('200506', 'Arief Budiman', 'Gg. Subur Ujung No.12 RT.012/015\r\nMenteng Atas'),
('200507', 'Balqis', 'Jl. Kampung Melayu Kecil III/14 RT.001/09');
