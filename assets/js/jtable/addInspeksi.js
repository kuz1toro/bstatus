$(document).ready(function () {
	var dataLHP, gridLHP;
    dataLHP = [{ 'No': 1, 'Keterangan': ''}];
	
	
	function Delete(e) {
        if (confirm('yakin?')) {
            gridLHP.removeRow(e.data.id);
        }
    }
	
	gridLHP = $('#gridLHP').grid({
        dataKey: "No",
		dataSource: dataLHP,
		columns: [
            { field: 'No', width: 32, align: 'center' },
            { field: 'Keterangan', editor: true },
            { width: 40, tmpl: '<button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>', align: 'center', events: { 'click': Delete } }
        ]
    });
	
	$('#btnAdd').on('click', function () {
        gridLHP.addRow({ 'No': gridLHP.count() + 1, 'Keterangan': ''});
    });
	
	/*
	$('#btnCalc').on('click', function () {
        var records = gridLHP.getAll();
		myObjString = JSON.stringify(records);
		$('#tempLHP').val(myObjString);
		//alert(eDataLHP);
	}); */
	
	gridLHP.on('cellDataChanged', function (e, $cell, column, record, oldValue, newValue) {
        var records = gridLHP.getAll();
		myObjString = JSON.stringify(records);
		$('#tempLHP').val(myObjString);
     });
	 
	 
});