
$( "#report_button" ).click(function() {
    var tglStart = $('#tglStart').val();
    var tglEnd = $('#tglEnd').val();
    //var tglStart = '01-Januari-2019';
    //var tglEnd = '31-Januari-2019';
    loadData(tglStart,tglEnd);
});

function loadData(tglStart,tglEnd){
	var dataString = 'tglStart='+ tglStart +'&tglEnd='+ tglEnd;
	$.ajax({
        type: "POST",
        dataType: "json",
		url: base_url + "dinas/loadReportP",
        //data: "tglStart=" + tglStart + ",tglEnd=" + tglEnd ,
        data: dataString ,
		cache: false,
		success: function(result){
			handleResponse(result);
		}
	});
}
function handleResponse(data) {
    //addressPoints = JSON.parse(data);
    var addressPoints =JSON.stringify(data);
    //addressPoints = '{ "data" :' + addressPoints + '}';
    console.log(addressPoints);
    if ( $.fn.DataTable.isDataTable( '.example' ) ) {
        $('.example').DataTable().destroy();
        $('.example').empty();
    }
    $('.example').dataTable( {
        "columnDefs": [
          { "title": "No", "targets": 0 },
          { "title": "No Gedung", "targets": 1 },
          { "title": "Nama Gedung", "targets": 2 },
          { "title": "No Permohonan", "targets": 3 },
          { "title": "Tgl Permohonan", "targets": 4 },
          { "title": "Tgl Berlaku", "targets": 5 },
          { "title": "Hasil", "targets": 6 },
          { "title": "Jenis", "targets": 7 },
          { "title": "Pokja", "targets": 8 }
        ],
        "data": data,
        "columns": [
            { "data": "no" },
            { "data": "no_gedungP" },
            { "data": "nama_gedung" },
            { "data": "no_permh" },
            { "data": "tgl_permh" },
            { "data": "tgl_berlaku" },
            { "data": "nama_kolom_hslPemeriksaan" },
            { "data": "nama_kolom_statusGedung" },
            { "data": "nama_pokja" }
        ],
        "dom" : 'Bfrtip',
        "buttons": [{
            extend: 'pdfHtml5',
            title: 'Laporan Pemeriksaan --byBSTATUS',
            className: "btn-primary",
            text: 'pdf',
            buttons:
                [{
                extend: "pdf", className: "btn-primary"
                }],
        },{
            extend: 'excelHtml5',
            title: 'Laporan Pemeriksaan --byBSTATUS',
            className: "btn-primary",
            text: 'excel',
            buttons:
                [{
                extend: "excel", className: "btn-primary"
                }],
        },{
            extend: 'print',
            className: "btn-primary",
            text: 'print',
            buttons:
                [{
                extend: "print", className: "btn-primary"
                }],
        }
        ]
    }
    );
}



//loadData();
/*
function loadContent(){
    var xhr = new XMLHttpRequest();
    var url = base_url+"dinas/loadReportP";
    
    xhr.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        handleResponse(this.responseText);
      }
    };
    xhr.open("GET", url, true);
    xhr.send();
    };

function handleResponse(data) {
    //addressPoints = JSON.parse(data);
    console.log(data);
}

    loadContent();*/