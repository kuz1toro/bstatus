// animsition
$(document).ready(function() {
        $('.animsition').animsition({
            inClass             : 'fade-in',
            outClass            : 'fade-out',
            inDuration          : 400,
            outDuration         : 200,
            linkElement         : 'a[href]:not([target="_blank"]):not([href^="mailto\\:"]):not([href^="\\#"])',
            loading             : true,
            loadingParentElement: 'body',
            loadingClass        : 'animsition-loading',
            unSupportCss        : ['animation-duration', '-webkit-animation-duration', '-o-animation-duration'],
            overlay             : false,
            overlayClass        : 'animsition-overlay-slide',
            overlayParentElement: 'body'
        });

				// jquery form validation
				$("#myForm").validate();

        // jquery datatable
        $('#fixheader1').DataTable( {
          "scrollY": 300,
          "scrollX": true
        } );
				$('#fixheader2').DataTable( {
          "scrollY": 300,
          "scrollX": true
        } );

		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_flat-green',
			radioClass: 'iradio_flat-green'
		});
		$('#pil_prains').on('ifChecked', function(event){
			$("#Pokja_box").fadeOut();
			$("#StatusPermhn").val("1");
			$("#Pokja").val("pokja 1");
		});
		$('#pil_pokja').on('ifChecked', function(event){
			//$( "#Pokja" ).prop( "disabled", false );
			$("#Pokja").val("");
			$("#Pokja_box").fadeIn("slow");
			$("#StatusPermhn").val("3");
			$("#KaInsp").val("");
		});

});

// bootstrap-datepicker
$(function(){
	window.prettyPrint && prettyPrint();
	$('#Datepicker').datepicker({
		format: "dd-MM-yyyy",
		todayBtn: "linked",
		autoclose: true,
		todayHighlight: true
	});
	$('#Datepicker1').datepicker({
		format: "dd-MM-yyyy",
		todayBtn: "linked",
		autoclose: true,
		todayHighlight: true
	});
	$('#Datepicker2').datepicker({
		format: "dd-MM-yyyy",
		todayBtn: "linked",
		autoclose: true,
		todayHighlight: true
	});
	$('#Datepicker3').datepicker({
		format: "dd-MM-yyyy",
		todayBtn: "linked",
		autoclose: true,
		todayHighlight: true
	});
	$('#Datepicker4').datepicker({
		format: "dd-MM-yyyy",
		todayBtn: "linked",
		autoclose: true,
		todayHighlight: true
	});
	$('#Datepicker5').datepicker({
		format: "dd-MM-yyyy",
		todayBtn: "linked",
		autoclose: true,
		todayHighlight: true
	});
	$('#Datepicker6').datepicker({
		format: "dd-MM-yyyy",
		todayBtn: "linked",
		autoclose: true,
		todayHighlight: true
	});
});

// kecamatan kelurahan dropdown
function selectKec(wil_id){
	if(wil_id!="-1"){
		loadData('kecamatan',wil_id);
		$("#kelurahan_dropdown").html("<option value='-1'>Pilih Kelurahan</option>");
	}else{
		$("#kecamatan_dropdown").html("<option value='-1'>Pilih Kecamatan</option>");
		$("#kelurahan_dropdown").html("<option value='-1'>Pilih Kelurahan</option>");
	}
}
function selectKel(kec_id){
	if(kec_id!="-1"){
		loadData('kelurahan',kec_id);
	}else{
		$("#kelurahan_dropdown").html("<option value='-1'>Pilih Kelurahan</option>");
	}
}
function loadData(loadType,loadId){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$.ajax({
		type: "POST",
		url: base_url + "pelengkap/loaddata",
		data: dataString,
		cache: false,
		success: function(result){
			if (loadType=="kodepos"){
				$("#"+loadType+"_dropdown").val($.trim(result));
			}else{
				$("#"+loadType+"_dropdown").html("<option value='-1'>Pilih "+loadType+"</option>");
				$("#"+loadType+"_dropdown").append(result);
			}
		}
	});
}
function showKodepos(kel_id){
	if(kel_id!="-1"){
		loadData('kodepos',kel_id);
	}else{
		$("#kodepos_dropdown").val("tidak diketahui");
	}
}



//bootstrap-confirmation
		$('[data-toggle=confirmation]').confirmation({
		  rootSelector: '[data-toggle=confirmation]',
		  // other options
		  singleton: 'true',
		  popout: 'true',
		});

// pilih kainspeksi
function selectKaInsp(val){
  if(val=="pokja 1"){
    $("#KaInsp").val("Udiyono");
  }else if (val=="pokja 2"){
    $("#KaInsp").val("Bambang Andanawari, SST");
  }else if (val=="pokja 3"){
    $("#KaInsp").val("Sidik, S.T.");
  }else if (val=="pokja 4"){
    $("#KaInsp").val("Miyanto, S.E.");
  }else if (val=="pokja 5"){
    $("#KaInsp").val("Suparman");
  }else{
    $("#KaInsp").val("?");
  }
}

//jquery confirmation global
//simpan
$('.tbl-simpan').on('click', function () {
	$.confirm({
		icon: 'fa fa-check-circle',
		title: 'Simpan',
		content: 'apakah anda yakin?',
		theme: 'modern',
		closeIcon: true,
		animation: 'left',
		type: 'green',
		buttons: {
			Ya: {
				action: function () {
					$( "#myForm" ).submit();
				},
				btnClass: 'btn-green'
			},
			Tidak: {
				action: function () {
				}
			},
		},
	});
});
//reset
$('.tbl-reset').on('click', function () {
	$.confirm({
		icon: 'fa fa-info-circle',
		title: 'Reset',
		content: 'Data akan dikembalikan ke semula, apakah anda yakin?',
		theme: 'modern',
		closeIcon: true,
		animation: 'left',
		type: 'orange',
		buttons: {
			Ya: {
				action: function () {
					$( "#myForm" )[0].reset();
				},
				btnClass: 'btn-orange'
			},
			Tidak: {
				action: function () {
				}
			},
		},
	});
});
//kembali
$('.tbl-back').on('click', function () {
	var halaman = $(this).attr('val');
	$.confirm({
		icon: 'fa fa-info-circle',
		title: 'Kembali ke halaman sebelumnya',
		content: 'Data tidak akan disimpan, apakah anda yakin?',
		theme: 'modern',
		closeIcon: true,
		animation: 'left',
		type: 'orange',
		buttons: {
			Ya: {
				action: function () {
					window.location = halaman;
				},
				btnClass: 'btn-orange'
			},
			Tidak: {
				action: function () {
				}
			},
		},
	});
});
//batal
$('.tbl-batal').on('click', function () {
	var halaman = $(this).attr('val');
	$.confirm({
		icon: 'fa fa-info-circle',
		title: 'Batalkan operasi',
		content: 'Data tidak akan disimpan, apakah anda yakin?',
		theme: 'modern',
		closeIcon: true,
		animation: 'left',
		type: 'orange',
		buttons: {
			Ya: {
				action: function () {
					window.location = halaman;
				},
				btnClass: 'btn-orange'
			},
			Tidak: {
				action: function () {
				}
			},
		},
	});
});
//delete
$('.t-del').on('click', function () {
	var hal_url = $(this).attr('val');
	$.confirm({
		icon: 'fa fa-warning',
		title: 'Hapus',
		content: 'apakah anda yakin?',
		theme: 'modern',
		closeIcon: true,
		animation: 'left',
		type: 'red',
		buttons: {
			Ya: {
				action: function () {
					window.location = hal_url;
				},
				btnClass: 'btn-red'
			},
			Tidak: {
				action: function () {
				},
				btnClass: 'btn-primary'
			},
		},
	});
});
//validasi
$('.t-val').on('click', function () {
	var hal_url = $(this).attr('val');
	$.confirm({
		icon: 'fa fa-info-circle',
		title: 'Validasi',
		content: 'Setuju Validasi data ini?',
		theme: 'modern',
		closeIcon: true,
		animation: 'left',
		type: 'orange',
		buttons: {
			Ya: {
				action: function () {
					window.location = hal_url;
				},
				btnClass: 'btn-orange'
			},
			Tidak: {
				action: function () {
				}
			},
		},
	});
});
