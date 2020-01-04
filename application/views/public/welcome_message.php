<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/damkar.ico">
    <title>Informasi Status Gedung Tinggi - Dinas Penanggulangan Kebakaran dan Penyelamatan Provinsi DKI Jakarta</title>
    <link href="<?php echo base_url(); ?>assets/vendor_new/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!--<link href="<?php echo base_url();?>assets/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet">-->
    <link href="<?php echo base_url();?>assets/vendor_new/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/home/style.css" rel="stylesheet">
    <style>
        #footer-textbox {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <section class="slider" id="features">
        <div class="container">
            <div class="inner-page">
                <div style="text-align:center;margin-top:15px;"><img src="<?php echo base_url();?>assets/home/images/logo-damkar.png" alt="Gulkar DKI" /></div>
                <h3 class="page-headline large text-center">Dinas Penanggulangan Kebakaran dan Penyelamatan Provinsi DKI Jakarta<br><strong>B-STATUS</strong></h3>
                <p class="text-center" id="infotext"><!--Informasi Status Gedung Tinggi <br>--> Anda dapat menemukan informasi status keselamatan kebakaran bangunan gedung tinggi dengan memasukkan Nama Gedung atau Alamat Gedung</p>
            </div>    
        </div>
    </section>

    <section class="pricing" id="search_table" style="margin-bottom:100px">
        <div class="container">
            <form id="search_data" role="form" action="#" method="post">
                <input type="hidden" id="xurl" value="<?php echo site_url('search/find');?>">
                <div class="form-group">
                    <h4 class="text-center">Ketik Nama Gedung atau Alamat Gedung disini </h4>
                    <input type="search" name="search" id="search_text" autofocus  class="form-control input-lg" required>
                </div>
                <p class="text-center">
                    <button class="btn btn-primary btn-xlg" id="btn_search" type="button"> Cari Info Status Gedung </button>
                </p>        
            </form>
        </div>
    </section>

    <section class="pricing" id="result_table" data-display="hide" style="margin-bottom:100px"></section>

    <div id="footer">
        <section class="orange" style="padding:10px 0 0 0">
            <div id="footer-textbox">
                <p class="alignleft">&nbsp;</p>
                <p class="aligncenter">
                    B-STATUS : http://b-status.jakartafire.net
                </p>
                <p class="alignright" style="padding-right:10px;">
                    <a href="<?php echo site_url('login');?>" >
                        <i class="fa fa-sign-in fa-lg fa-pull-right fa-border" aria-hidden="true"></i>
                    </a>
                </p>
            </div>
            <div style="clear: both;"></div>

        </section>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color:#DC4B08;color:#fff">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Selamat Datang</h4>
            </div>
            <div class="modal-body">
                Terima kasih telah mengunjungi halaman informasi Status Keselamatan Kebakaran Bangunan Gedung Tinggi.<br><br>
                Informasi yang kami sajikan disini terkait Status pemeriksaan bangunan gedung tinggi dengan beberapa diantara data masih dalam proses pembaharuan.<br><br>
                Kami akan berterima kasih apabila pihak yang berkepentingan dalam hal ini pengelola bangunan gedung tinggi yang statusnya belum sesuai bisa menginformasikan kepada kami 
                melalui email <a style="color:#fff;" href="mailto:bidangpencegahan@gmail.com"><strong><u>bidangpencegahan@gmail.com</u></strong></a> disertai dengan data pendukung, agar dapat kami perbarui sesuai hasil pemeriksaan yang terbaru.

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
    </div>
    
    <div class="modal fade" id="exampleModalStatusLive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color:#DC4B08;color:#fff">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Status Gedung</h3>
            </div>
            <div class="modal-body">
                <strong>Memenuhi</strong>.<br>
                Memenuhi Standar Keselamatan Kebakaran.<br><br>
                
                <strong>Tidak Memenuhi</strong>.<br>
                Tidak Memenuhi Standar Keselamatan Kebakaran.<br><br>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
    </div>
    
    <div class="modal fade" id="exampleModalKeteranganLive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color:#DC4B08;color:#fff">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Keterangan</h3>
            </div>
            <div class="modal-body">
                <strong>SLF</strong>.<br>
                Rekomendasi Sertifikat Laik Fungsi<br><br>
                
                <strong>SKK</strong>.<br>
                Rekomendasi Sertifikat Keselamatan Kebakaran<br><br>
                
                <strong>LHP</strong>.<br>
                Laporan hasil pemeriksaan / pengawasan<br><br>
                
                <strong>SP1</strong>.<br>
                Surat Peringatan Ke 1<br><br>
                
                <strong>SP2</strong>.<br>
                Surat Peringatan Ke 2 (Pemasangan stiker “BANGUNAN INI TIDAK MEMENUHI KESELAMATAN KEBAKARAN”)<br><br>
                
                <strong>SP3</strong>.<br>
                Pencabutan rekomendasi Damkar<br><br>
                
                <strong>SP4</strong>.<br>
                Pencabutan Ijin<br><br>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
    </div>
<script src="<?php echo base_url(); ?>assets/vendor_new/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor_new/bootstrap/js/bootstrap.js"></script>
<!--<script src="<?php echo base_url();?>assets/bootstrap-modal/js/bootstrap-modal.js"></script>-->
<script src="<?php echo base_url();?>assets/home/main.js"></script>
</body> 
</html>
