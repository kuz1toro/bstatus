DROP TABLE IF EXISTS `test`;

#
# Table structure for table 'test'
#

CREATE TABLE `gedung_dinas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_gedung` varchar(10) NOT NULL,
  `nama_gedung` varchar(100) NOT NULL,
  'alamat_gedung' varchar(255)  DEFAULT NULL,
  'wilayah' varchar(100)  DEFAULT NULL,
  'kecamatan' varchar(100)  DEFAULT NULL,
  'kodepos' varchar(6)  DEFAULT NULL,
  'peruntukan' varchar(100)  DEFAULT NULL,
  'kepemilikan' varchar(100)  DEFAULT NULL,
  'jml_tower' tinyint(5)  unsigned DEFAULT NULL,
  'jml_lantai' tinyint(5)  unsigned DEFAULT NULL,
  'jml_basement' tinyint(3)  unsigned DEFAULT NULL,
  'pokja' tinyint(2)  DEFAULT NULL,
  'latitude' varchar(100)  DEFAULT NULL,
  'altitude' varchar(100)  DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pemeriksaan_dinas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_gedung` varchar(10) NOT NULL,
  `nama_gedung` varchar(100) NOT NULL,
  'jalur_info' varchar(255)  DEFAULT NULL,
  'hasil_pemeriksaan' varchar(100)  DEFAULT NULL,
  'status_gedung' varchar(100)  DEFAULT NULL,
  'tgl_berlaku' varchar(6)  DEFAULT NULL,
  'tgl_expired' varchar(100)  DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pokja_dinas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pokja` varchar(10) NOT NULL,
  `ketua_pokja` varchar(100) NOT NULL,
  'anggota_1' varchar(255)  DEFAULT NULL,
  'anggota_2' varchar(100)  DEFAULT NULL,
  'anggota_3' varchar(100)  DEFAULT NULL,
  'anggota_4' varchar(6)  DEFAULT NULL,
  'anggota_5' varchar(100)  DEFAULT NULL,
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