DROP TABLE IF EXISTS `gedung_dinas`;

#
# Table structure for table 'gedung_dinas'
#

CREATE TABLE `gedung_dinas` (
  `id_gdg_dinas` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_gedung` varchar(10) NOT NULL,
  `nama_gedung` varchar(150) NOT NULL,
  `alamat_gedung` varchar(255)  DEFAULT NULL,
  `wilayah` varchar(100)  DEFAULT NULL,
  `kecamatan` varchar(100)  DEFAULT NULL,
  `kelurahan` varchar(100)  DEFAULT NULL,
  `kodepos` varchar(6)  DEFAULT NULL,
  `peruntukan` varchar(100)  DEFAULT NULL,
  `kepemilikan` varchar(100)  DEFAULT NULL,
  `jml_tower` tinyint(5)  unsigned DEFAULT NULL,
  `jml_lantai` tinyint(5)  unsigned DEFAULT NULL,
  `jml_basement` tinyint(3)  unsigned DEFAULT NULL,
  `pokja` tinyint(2)  DEFAULT NULL,
  `latitude` varchar(100)  DEFAULT NULL,
  `longitude` varchar(100)  DEFAULT NULL,
  `catatan_gedung` varchar(255)  DEFAULT NULL,
  PRIMARY KEY (`id_gdg_dinas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# fill table gedung_dinas
INSERT INTO gedung_dinas (no_gedung,nama_gedung,alamat_gedung,wilayah,kecamatan,kelurahan,kodepos,peruntukan,kepemilikan,jml_lantai,jml_basement)
SELECT no_gedung,nama_gedung,alamat_gedung,wilayah,kecamatan,kelurahan,kodepos,peruntukan,kepemilikan,jml_lantai,jml_basement FROM import;

CREATE TABLE `pemeriksaan_dinas` (
  `id_pemeriksaan_dinas` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_gedung` varchar(10) NOT NULL,
  `jalur_info` varchar(255)  DEFAULT NULL,
  `hasil_pemeriksaan` varchar(100)  DEFAULT NULL,
  `status_gedung` varchar(100)  DEFAULT NULL,
  `tgl_berlaku` date  DEFAULT NULL,
  `tgl_expired` date  DEFAULT NULL,
  `tgl_ptsp` date  DEFAULT NULL,
  `nama_pengelola` varchar(150) DEFAULT NULL,
  `alamat_pengelola` varchar(255)  DEFAULT NULL,
  `no_telp_pengelola` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pemeriksaan_dinas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `FSM` (
  `id_FSM` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_FSM` varchar(150) DEFAULT NULL,
  `alamat_FSM` varchar(255)  DEFAULT NULL,
  `no_telp_FSM` varchar(50) DEFAULT NULL,
  `no_sert_FSM` varchar(50) DEFAULT NULL,
  `tgl_sert_berlaku` date  DEFAULT NULL,
  `tgl_sert_expired` date  DEFAULT NULL,
  `no_gedung` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_FSM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pokja_dinas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pokja` varchar(10) NOT NULL,
  `ketua_pokja` varchar(100) NOT NULL,
  `anggota_1` varchar(100)  DEFAULT NULL,
  `anggota_2` varchar(100)  DEFAULT NULL,
  `anggota_3` varchar(100)  DEFAULT NULL,
  `anggota_4` varchar(100)  DEFAULT NULL,
  `anggota_5` varchar(100)  DEFAULT NULL,
  `anggota_6` varchar(100)  DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `riwayat_kebakaran` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_gedung` varchar(10) NOT NULL,
  `nama_gedung` varchar(100) NOT NULL,
  'tgl_kejadian' varchar(255)  DEFAULT NULL,
  'dugaan_penyebab' varchar(100)  DEFAULT NULL,
  'jam_kejadian' varchar(100)  DEFAULT NULL,
  'jumlah_unit_pompa' varchar(6)  DEFAULT NULL,
  'jumlah_unit_tangga' varchar(100)  DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#  'jalur_info' varchar(100) NULL,
#  'hasil_pemeriksaan' varchar(100) NULL,
#  'status_gedung' varchar(100) NULL,
#  'tgl_berlaku' varchar(100) NULL,



CREATE TABLE `import` (
  `id` int(11) NOT NULL,
  `no_gedung` varchar(10) NOT NULL,
  `nama_gedung` varchar(255) NOT NULL,
  `alamat_gedung` varchar(255) DEFAULT NULL,
  `wilayah` varchar(100)  DEFAULT NULL,
  `kecamatan`varchar(100)  DEFAULT NULL,
  `kelurahan`varchar(100)  DEFAULT NULL,
  `kodepos` varchar(5)  DEFAULT NULL,
  `peruntukan` varchar(100)  DEFAULT NULL,
  `kepemilikan` varchar(100)  DEFAULT NULL,
  `jml_lantai` tinyint(5)  unsigned DEFAULT NULL,
  `jml_basement` tinyint(3)  unsigned DEFAULT NULL,
  `jalur_info` varchar(100) NULL,
  `hasil_pemeriksaan` varchar(100) NULL,
  `status_gedung` varchar(100) NULL,
  `tgl_berlaku` varchar(100) NULL,
  `tgl_expired` varchar(100) NULL,
  `next_status` varchar(100) NULL,
  `catatan` varchar(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

