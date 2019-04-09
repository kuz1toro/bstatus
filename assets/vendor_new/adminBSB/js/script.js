// kecamatan kelurahan dropdown
$('#Wilayah').on('change', function(e){
	//console.log(this.value,this.options[this.selectedIndex].value,$(this).find("option:selected").val(),);
	selectKec(this.options[this.selectedIndex].value);
});

$('#kecamatan_dropdown').on('change', function(e){
	selectKel(this.options[this.selectedIndex].value);
});

$('#kelurahan_dropdown').on('change', function(e){
	showKodepos(this.options[this.selectedIndex].value);
});

function selectKec(wil_id){
	if(wil_id!=""){
		loadData('kecamatan',wil_id);
		$("#kelurahan_dropdown").html("<option value=''>Pilih Kelurahan</option>").selectpicker('refresh');
	}else{
		$("#kecamatan_dropdown").html("<option value=''>Pilih Kecamatan</option>").selectpicker('refresh');
		$("#kelurahan_dropdown").html("<option value=''>Pilih Kelurahan</option>").selectpicker('refresh');
	}
}
function selectKel(kec_id){
	if(kec_id!=""){
		loadData('kelurahan',kec_id);
	}else{
		$("#kelurahan_dropdown").html("<option value=''>Pilih Kelurahan</option>").selectpicker('refresh');
	}
}
function loadData(loadType,loadId){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$.ajax({
		type: "POST",
		url: base_url + "dinas/loaddata",
		data: dataString,
		cache: false,
		success: function(result){
			if (loadType=="kodepos"){
				$("#"+loadType+"_dropdown").val($.trim(result));
			}else{
				$("#"+loadType+"_dropdown").html("<option value=''>Pilih "+loadType+"</option>").selectpicker('refresh');
				//$("#"+loadType+"_dropdown").append(result);
				$("#"+loadType+"_dropdown").append(result).selectpicker('refresh');
			}
		}
	});
}
function showKodepos(kel_id){
	if(kel_id!=""){
		loadData('kodepos',kel_id);
	}else{
		$("#kodepos_dropdown").val("tidak diketahui").selectpicker('refresh');
	}
}

$('#btnReset').click(function() {
    window.location.reload();
});

// status gedung dropdown
$('#hslPeriksa').on('change', function(e){
	//console.log(this.value,this.options[this.selectedIndex].html,$(this).find("option:selected").html(),);
	selectStatGedung($(this).find("option:selected").html());
});

function selectStatGedung(stat_id){
	if(stat_id!="Silahkan Pilih"){
		loadStat('statGdg',stat_id);
	}else{
		$("#statGdg").html("<option value=''>Pilih Hasil Pemeriksaan Terlebih Dahulu</option>").selectpicker('refresh');
	}
}

function loadStat(loadType,loadId){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$.ajax({
		type: "POST",
		url: base_url + "dinas/loadStatus",
		data: dataString,
		cache: false,
		success: function(result){
			if (loadType=="kodepos"){
				$("#"+loadType+"_dropdown").val($.trim(result));
			}else{
				$("#"+loadType).html("<option value=''>Silahkan Pilih</option>").selectpicker('refresh');
				//$("#"+loadType+"_dropdown").append(result);
				$("#"+loadType).append(result).selectpicker('refresh');
			}
		}
	});
}
