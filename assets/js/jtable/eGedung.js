$(document).ready(function () {
	var dataLHP, gridLHP, eDataLHP, eGridLHP, tempData;
    dataLHP = [{ 'No': 1, 'Keterangan': ''}];
	//eDataLHP = JSON.parse($('#eTempLHP').val());
	try {
		eDataLHP = JSON.parse($('#eTempLHP').val());
	}catch(error){
		eDataLHP = dataLHP;
	}
	
	function eDelete(e) {
        if (confirm('yakin?')) {
            eGridLHP.removeRow(e.data.id);
        }
    }
	
	/*
	function onSuccessFunc(LHP) {
         //you can modify the response here if needed
		 if (jQuery.isEmptyObject(LHP)){
			 return dataLHP;
		 } else {
			 return LHP;
		 }
         
     }
	
	tempData = onSuccessFunc(eDataLHP); */
	//tempData = eDataLHP;
	
	eGridLHP = $('#eGridLHP').grid({
        dataKey: "No",
		dataSource: eDataLHP,
		columns: [
            { field: 'No', width: 32, align: 'center' },
            { field: 'Keterangan', editor: true },
            { width: 40, tmpl: '<button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>', align: 'center', events: { 'click': eDelete } }
        ]
    });
	
	$('#ebtnAdd').on('click', function () {
        eGridLHP.addRow({ 'No': eGridLHP.count() + 1, 'Keterangan': ''});
    });
	
	/*
	$('#ebtnCalc').on('click', function () {
        var records = eGridLHP.getAll();
		myObjString = JSON.stringify(records);
		$('#eTempLHP').val(myObjString);
		//alert(typeof(eDataLHP));
	}); */
	
	eGridLHP.on('cellDataChanged', function (e, $cell, column, record, oldValue, newValue) {
        var records = eGridLHP.getAll();
		myObjString = JSON.stringify(records);
		$('#eTempLHP').val(myObjString);
     });
});