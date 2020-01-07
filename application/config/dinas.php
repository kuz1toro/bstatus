<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['nama_database'] = 'bstatus_ng';
$config['nama_tabel_gedung'] = 'gedung_dinas';
$config['nama_tabel_pemeriksaan'] = 'pemeriksaan_dinas';
$config['nama_tabel_pokja'] = 'pokja_dinas';
$config['nama_tabel_fire_hist'] = 'riwayat_kebakaran_gdd_dinas';
$config['nama_tabel_fsm'] = 'fsm_dinas';
$config['file_time'] = 'application/logs/time.txt';



/*suggested variable name

$namaDB = $this->config->item('nama_database');
$tabelGedung = $this->config->item('nama_tabel_gedung');
$tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
$tabelPokja = $this->config->item('nama_tabel_pokja');
$tabelFireHist = $this->config->item('nama_tabel_fire_hist');
$tabelFsm = $this->config->item('nama_tabel_fsm');
$myFile = $this->config->item('file_time');

*/