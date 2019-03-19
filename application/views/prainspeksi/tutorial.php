<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="blog-header blog-masthead">
		<h1 class="blog-title">Panduan Penggunaan</h1>
	   <p class="lead blog-description">Sistem Informasi Bidang Pencegahan.</p>
	</div>
	<div class="box" style="padding-top:30px;">

		<div class="container">

	 <div class="row blog" >

	   <div class="col-sm-8 blog-main" >

		 <div class="blog-post" id="pendahuluan">
		   <h2 class="blog-post-title">Pendahuluan</h2>
		   <p class="blog-post-meta">April 12, 2017 by <a href="#">Admin</a></p>
		   <p>Panduan ini berisi penjelasan mengenai bagaimana menggunakan aplikasi Sistem Informasi Bidang Pencegahan dengan benar. Sistem Informasi Bidang Pencegahan merupakan aplikasi database berbasis website dimana ia dapat diakses melalui komputer, tablet dan handphone yang terkoneksi internet. Sistem ini digunakan untuk menyimpan data kegiatan tupoksi bidang pencegahan yang bertujuan mempermudah penyimpanan, akses dan pengolahan data untuk keperluan dinas.</p>

		   <h3 class="kapital" id="user">Pembagian user</h3>
		   <p>Pada Sistem ini user/ pengguna dibagi menjadi 6 tipe, diantaranya ialah :</p>
		   <ul>
			 <li>admin, memiliki fungsi utama mengelola user</li>
			 <li>kabid, memiliki fungsi untuk monitoring seluruh data pada sistem</li>
			 <li>kasie, memiliki fungsi untuk monitoring seluruh data pada sistem</li>
			 <li>prainspeksi, memiliki fungsi untuk mengelola data permohonan dan data gedung</li>
			 <li>disposisi, memiliki fungsi monitoring permohonan dan disposisi permohonan</li>
			 <li>pokja, memiliki fungsi untuk mengelola data pemeriksaan gedung</li>
			 <li>public, memiliki fungsi untuk melihat data yang bersifat umum</li>
		   </ul>

		   <h3 class="kapital" id="flowchart">Diagram alir berkas permohonan</h3>
		   <p>Sesuai dengan instruksi kasie inspeksi, sistem ini dikembangkan dengan mainset flow/ aliran yaitu setiap berkas permohonan akan mengalir dan diproses oleh beberapa user terkait. Setiap berkas permohonan dimulai dari user prainspeksi yang melakukan input data awal berupa data gedung (bila gedung tersebut belum ada datanya di database), data pengelola, dan data permohonan. Setelah user prainspeksi selesai menginput data, user disposisi akan mengecek kelengkapan data, apabila ada yang belum lengkap dapat dikembalikan ke user prainspeksi untuk dilengkapi atau apabila telah lengkap user disposisi dapat memilih pokja yang akan memeriksa gedung tersebut sesuai dengan tipe permohonannya. User pokja yang didisposisi untuk memeriksa gedung tertentu kemudian dapat membuat jadwal pemeriksaan dan dapat melakukan input data hasil pemeriksaan setelahnya. Data hasil pemeriksaan oelh pokja kemudian akan dicek kelengkapannya oleh user disposisi. Diagram alir untuk proses ini dapat dilihat pada gambar berikut :</p>
		   <a href="<?php echo base_url();?>/assets/tutorial/img/flowPermohonan.png" data-lightbox="image-1" data-title="Diagram alir" class="image-link">
			   	<img src="<?php echo base_url();?>/assets/tutorial/img/flowPermohonan.png" class="img-responsive" alt="Responsive image">
			</a>
		   <p class="text-center"><small>Gambar 1, Diagram alir berkas permohonan</small></p>
		   <h3>Sub-heading</h3>
		   <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
		   <pre><code>Example code block</code></pre>
		   <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
		   <h3>Sub-heading</h3>
		   <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
		   <ul>
			 <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
			 <li>Donec id elit non mi porta gravida at eget metus.</li>
			 <li>Nulla vitae elit libero, a pharetra augue.</li>
		   </ul>
		   <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
		   <ol>
			 <li>Vestibulum id ligula porta felis euismod semper.</li>
			 <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
			 <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
		   </ol>
		   <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
		 </div><!-- /.blog-post -->
		 <hr>

		 <div class="blog-post" id="panduan">
		   <h2 class="blog-post-title">Panduan Input Data Gedung</h2>
		   <p class="blog-post-meta">April 12, 2017 by <a href="#panduan">Admin</a></p>
		   <p>Data Gedung merupakan data terpenting dalam sistem ini dikarenakan ia merupakan objek tupoksi dari bidang pencegahan. Oleh karena itu dalam melakukan input data gedung baru tolong <strong>dicek kembali</strong> untuk dipastikan bahwa gedung baru yang akan diinput datanya memang belum ada di sistem.</p>
		   <blockquote>
			 <p>Dalam melakukan penambahan gedung baru tolong <strong>dicek kembali</strong> untuk dipastikan bahwa gedung baru yang akan diinput datanya memang belum ada di sistem.</p>
		   </blockquote>

		   <h3 class="kapital" id="daftargedung">cara menampilkan daftar gedung</h3>
		   <p>Arahkan mouse ke sisi sebelah kiri sehingga muncul menu utama kemudian click <code>Gedung</code> kemudian click <code>Lihat/ edit</code> sebagaimana terlihat pada gambar (2) dibawah</p>
			 <a href="<?php echo base_url();?>/assets/tutorial/img/daftargedung.gif" data-lightbox="image-2" data-title="cara melihat daftar gedung" class="image-link">
			   	<img src="<?php echo base_url();?>/assets/tutorial/img/daftargedung.gif" class="img-responsive" alt="Responsive image">
				</a>
		   <p class="text-center"><small>Gambar 2, cara melihat daftar gedung</small></p>

		   <h3 class="kapital" id="editgedung">cara mengedit data gedung</h3>
		   <ol>
			   <li>Arahkan mouse ke sisi sebelah kiri sehingga muncul menu utama</li>
			   <li>click <code>Gedung</code> kemudian click <code>Lihat/ edit</code></li>
			   <li>setelah muncul daftar gedung, pilih gedung yang akan diedit dengan click edit pada baris gedung yang dimaksud (untuk mencari gedung dapat menggunakan menu pencarian)</li>
			   <li>Setelah muncul halaman detail gedung, edit data gedung yang diinginkan dan click <code>simpan</code>(akan muncul konfirmasi ketika tombol simpan ditekan, pilih <code>ya</code> bila ingin menyimpan dan pilih <code>tidak</code> bila ingin membatalkan)</li>
		   </ol>
		   <p>Contoh : misalkan kita ingin merubah data luas pada gedung Mega Plaza, caranya seperti terilustrasi pada gambar (3) dibawah</p>
			 <a href="<?php echo base_url();?>/assets/tutorial/img/editgedung.gif" data-lightbox="image-3" data-title="cara merubah data gedung" class="image-link">
			   	<img src="<?php echo base_url();?>/assets/tutorial/img/editgedung.gif" class="img-responsive" alt="Responsive image">
				</a>
		   <p class="text-center"><small>Gambar 3, cara merubah data gedung</small></p>

		   <h3 class="kapital" id="tambahgedung">cara menambah data gedung</h3>
			 <blockquote>
			 <p>Sebelum melakukan penambahan gedung baru mohon untuk <strong>dicek kembali</strong> bahwa gedung yang akan diinput memang belum ada di sistem, hal ini untuk menghindari adanya double catat.</p>
		   </blockquote>
			 <p>contoh: misalkan kita ingin mencek apakah gedung La Mainson sudah ada atau belum di sistem, caranya dilustrasikan pada gambar (4) dibawah</p>
			 <a href="<?php echo base_url();?>/assets/tutorial/img/cekgedung.gif" data-lightbox="image-4" data-title="cara cek gedung" class="image-link">
			   	<img src="<?php echo base_url();?>/assets/tutorial/img/cekgedung.gif" class="img-responsive" alt="Responsive image">
				</a>
		   <p class="text-center"><small>Gambar 4, cara cek gedung</small></p>
		   <p>Sesuai dengan instruksi</p>
		   <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
		   <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
		 </div><!-- /.blog-post -->

		 <div class="blog-post">
		   <h2 class="blog-post-title">New feature</h2>
		   <p class="blog-post-meta">December 14, 2013 by <a href="#">Chris</a></p>

		   <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
		   <ul>
			 <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
			 <li>Donec id elit non mi porta gravida at eget metus.</li>
			 <li>Nulla vitae elit libero, a pharetra augue.</li>
		   </ul>
		   <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
		   <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
		 </div><!-- /.blog-post -->

		 <nav>
		   <ul class="pager">
			 <li><a href="#">Previous</a></li>
			 <li><a href="#">Next</a></li>
		   </ul>
		 </nav>

	   </div><!-- /.blog-main -->

	   <div class="col-sm-3 col-sm-offset-1" id="scrollspy" >
		   <nav class="bs-docs-sidebar hidden-sm hidden-xs daftarisi">
			   <ul class="nav bs-docs-sidenav kapital">
				   <li> <a class="page-scroll" href="#pendahuluan">Pendahuluan</a>
					   <ul class="nav">
						   <li><a class="page-scroll" href="#user">Pembagian User</a></li>
						   <li><a class="page-scroll" href="#flowchart">Diagram Alir</a></li>
					   </ul>
				   </li>
				   <li> <a class="page-scroll" href="#panduan">Panduan Data Gedung</a>
					   <ul class="nav">
						   <li><a class="page-scroll" href="#daftargedung">cara menampilkan daftar gedung</a></li>
						   <li><a class="page-scroll" href="#editgedung">cara mengedit data gedung</a></li>
						   <li><a class="page-scroll" href="#tambahgedung">cara menambah data gedung</a></li>
					   </ul>
				   </li>
				   <li> <a class="page-scroll" href="#type">Typography</a></li>
			   </ul>
		   </nav>
	   </div><!-- /.blog-sidebar -->

	 </div><!-- /.row -->

   </div><!-- /.container -->

	</div>
</div>
<!-- /.content-wrapper -->
