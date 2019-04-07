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
  `fungsi` SMALLINT(6) UNSIGNED NULL DEFAULT NULL,
  `kepemilikan` varchar(100)  DEFAULT NULL,
  `jml_tower` tinyint(5)  unsigned DEFAULT NULL,
  `jml_lantai` tinyint(5)  unsigned DEFAULT NULL,
  `jml_basement` tinyint(3)  unsigned DEFAULT NULL,
  `tinggi_gedung` tinyint(3)  unsigned DEFAULT NULL,
  `mkkg` int(11)  unsigned DEFAULT NULL,
  `pokja` tinyint(2)  DEFAULT NULL,
  `latitude` varchar(100)  DEFAULT NULL,
  `longitude` varchar(100)  DEFAULT NULL,
  `catatan_gedung` varchar(255)  DEFAULT NULL,
  `deleted` BOOLEAN NOT NULL DEFAULT FALSE,
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
  `tgl_berlaku` varchar(50)  DEFAULT NULL,
  `tgl_expired` varchar(50)  DEFAULT NULL,
  `next_status` varchar(100)  DEFAULT NULL,
  `tgl_ptsp` varchar(50)  DEFAULT NULL,
  `nama_pengelola` varchar(150) DEFAULT NULL,
  `alamat_pengelola` varchar(255)  DEFAULT NULL,
  `no_telp_pengelola` varchar(50) DEFAULT NULL,
  `catatan` varchar(255)  DEFAULT NULL,
  PRIMARY KEY (`id_pemeriksaan_dinas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# fill table pemeriksaan_dinas
INSERT INTO pemeriksaan_dinas (no_gedung,jalur_info,hasil_pemeriksaan,status_gedung,tgl_berlaku,tgl_expired,next_status,catatan)
SELECT no_gedung,jalur_info,hasil_pemeriksaan,status_gedung,tgl_berlaku,tgl_expired,next_status,catatan FROM import;

CREATE TABLE `tabel_kolom_fungsi_gedung` (
  `id_fungsi_gedung` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fungsi_gedung` varchar(100) NOT NULL,
  `keterangan_fungsiGdg` varchar(255)  DEFAULT NULL,
  PRIMARY KEY (`id_fungsi_gedung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# fill tabel_kolom_fungsi_gedung
INSERT INTO `tabel_kolom_fungsi_gedung` (`fungsi_gedung`, `keterangan_fungsiGdg`) VALUES
('Apartemen',NULL),
('Bisnis Lainnya',NULL),
('Hotel',NULL),
('Hunian lainnya',NULL),
('Kesehatan',NULL),
('Mall',NULL),
('Pendidikan',NULL),
('Perkantoran',NULL),
('Pusat Perdagangan',NULL),
('Rumah Susun',NULL),
('SosBud Lainnya',NULL);

CREATE TABLE `tabel_kolom_kepemilikkan_gedung` (
  `id_kepemilikkan_gedung` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kepemilikkan_gedung` varchar(100) NOT NULL,
  `keterangan_kepemilikkan_gedung` varchar(255)  DEFAULT NULL,
  `deleted` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`id_kepemilikkan_gedung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# fill tabel_kolom_kepemilikkan_gedung
INSERT INTO `tabel_kolom_kepemilikkan_gedung` (`kepemilikkan_gedung`, `keterangan_kepemilikkan_gedung`) VALUES
('Pemda DKI',NULL),
('Pemerintah Non-DKI',NULL),
('Swasta',NULL);

CREATE TABLE `tabel_kolom_jalurInfo` (
  `id_kolom_jalurInfo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kolom_jalurInfo` varchar(100) NOT NULL,
  `keterangan_kolom_jalurInfo` varchar(255)  DEFAULT NULL,
  PRIMARY KEY (`id_kolom_jalurInfo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# fill tabel_kolom_jalurInfo
INSERT INTO `tabel_kolom_jalurInfo` (`nama_kolom_jalurInfo`, `keterangan_kolom_jalurInfo`) VALUES
('Permintaan Gedung','Berdasarkan permohonan rekomtek PTSP'),
('Pemeriksaan DAMKAR','Pemeriksaan sewaktu-waktu');

CREATE TABLE `tabel_kolom_hslPemeriksaan` (
  `id_kolom_hslPemeriksaan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kolom_hslPemeriksaan` varchar(100) NOT NULL,
  `keterangan_kolom_hslPemeriksaan` varchar(255)  DEFAULT NULL,
  PRIMARY KEY (`id_kolom_hslPemeriksaan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# fill tabel_kolom_hslPemeriksaan
INSERT INTO `tabel_kolom_hslPemeriksaan` (`nama_kolom_hslPemeriksaan`, `keterangan_kolom_hslPemeriksaan`) VALUES
('Memenuhi','Memenuhi persyaratan keselamatan kebakaran'),
('Tidak memenuhi','Tidak memenuhi persyaratan keselamatan kebakaran');

CREATE TABLE `tabel_kolom_statusGedung` (
  `id_kolom_statusGedung` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kolom_statusGedung` varchar(100) NOT NULL,
  `kategori_kolomHslPemeriksaan` varchar(100) NOT NULL,
  `keterangan_kolom_statusGedung` varchar(255)  DEFAULT NULL,
  PRIMARY KEY (`id_kolom_statusGedung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# fill tabel_kolom_statusGedung
INSERT INTO `tabel_kolom_statusGedung` (`id_kolom_statusGedung`, `nama_kolom_statusGedung`, `kategori_kolomHslPemeriksaan`, `keterangan_kolom_statusGedung`) VALUES
(NULL, 'LHP Min', 'Tidak Memenuhi', NULL), 
(NULL, 'LHP Plus', 'Memenuhi', NULL),
(NULL,'Penangguhan SKK','Tidak Memenuhi',NULL),
(NULL,'Penangguhan SLF','Tidak Memenuhi',NULL),
(NULL,'Pengawasan','Tidak memenuhi',NULL),
(NULL,'SKK','Memenuhi',NULL),
(NULL,'SLF','Memenuhi',NULL),
(NULL,'SP1','Tidak Memenuhi',NULL),
(NULL,'SP2','Tidak Memenuhi',NULL),
(NULL,'SP3','Tidak Memenuhi',NULL)

CREATE TABLE `tabel_kolom_penyebabFire` (
  `id_penyebabFire` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `penyebab` varchar(100) NOT NULL,
  `keterangan_penyebab` varchar(255)  DEFAULT NULL,
  `deleted` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`id_penyebabFire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# fill tabel_kolom_penyebabFire
INSERT INTO `tabel_kolom_penyebabFire` (`id_penyebabFire`, `penyebab`, `keterangan_penyebab`, `deleted`) VALUES
(NULL, 'Listrik', NULL, 0), 
(NULL, 'Gas', NULL, 0),
(NULL, 'Arson', NULL, 0)

CREATE TABLE `FSM_dinas` (
  `id_FSM` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_FSM` varchar(150) DEFAULT NULL,
  `alamat_FSM` varchar(255)  DEFAULT NULL,
  `no_telp_FSM` varchar(50) DEFAULT NULL,
  `no_sert_FSM` varchar(50) DEFAULT NULL,
  `tgl_sert_berlaku` date  DEFAULT NULL,
  `tgl_sert_expired` date  DEFAULT NULL,
  `no_gedung` varchar(10) DEFAULT NULL,
  `deleted` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`id_FSM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pokja_dinas` (
  `id_pokja` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pokja` varchar(50) NOT NULL,
  `ketua_pokja` varchar(100) NOT NULL,
  `anggota_1` varchar(100)  DEFAULT NULL,
  `anggota_2` varchar(100)  DEFAULT NULL,
  `anggota_3` varchar(100)  DEFAULT NULL,
  `anggota_4` varchar(100)  DEFAULT NULL,
  `anggota_5` varchar(100)  DEFAULT NULL,
  `anggota_6` varchar(100)  DEFAULT NULL,
  `deleted` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`id_pokja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `riwayat_kebakaran_gdd_dinas` (
  `id_fireHistDinas` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_gedung` varchar(10) NOT NULL,
  `tgl_kejadian` DATE NULL DEFAULT NULL,
  `waktu_kejadian` VARCHAR(5) NULL DEFAULT NULL,
  `dugaan_penyebab` TINYINT UNSIGNED NULL DEFAULT NULL,
  `jumlah_unit` varchar(255)  DEFAULT NULL,
  `keterangan` VARCHAR(255) DEFAULT NULL
  `deleted` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`id_fireHistDinas`)
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

