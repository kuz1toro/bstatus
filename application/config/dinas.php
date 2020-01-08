<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['nama_database'] = 'bstatus_ng';
$config['nama_tabel_gedung'] = 'gedung_dinas';
$config['nama_tabel_pemeriksaan'] = 'pemeriksaan_dinas';
$config['nama_tabel_pokja'] = 'pokja_dinas';
$config['nama_tabel_fire_hist'] = 'riwayat_kebakaran_gdd_dinas';
$config['nama_tabel_fsm'] = 'fsm_dinas';
$config['file_time'] = 'application/logs/time.txt';
$config['rekap_gdg_pdf'] = 'pdf/dinas/rekap.pdf';
$config['data_gdg_pdf'] = 'pdf/dinas/gedung.pdf';
$config['skpd'] = 'Dinas Penanggulangan Kebakaran dan Penyelamatan Provinsi DKI Jakarta';


/*suggested variable name

$namaDB = $this->config->item('nama_database');
$tabelGedung = $this->config->item('nama_tabel_gedung');
$tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
$tabelPokja = $this->config->item('nama_tabel_pokja');
$tabelFireHist = $this->config->item('nama_tabel_fire_hist');
$tabelFsm = $this->config->item('nama_tabel_fsm');
$myFile = $this->config->item('file_time');
$file_pdfRekapGdg = $this->config->item('rekap_gdg_pdf');
$file_pdfDataGdg = $this->config->item('data_gdg_pdf');
$skpd = $this->config->item('skpd');
*/