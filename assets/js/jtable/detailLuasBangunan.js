$(document).ready(function () {
    var dataLuas, dataKonsBang, gridTw1, gridKB1;
    dataLuas = [{ 'No': 1, 'Item': '', 'Jumlah_Item': '', 'SatLuasItem': '' }];
	dataKonsBang = [{ 'Kerangka': '', 'Dinding': '', 'Atap': '' }];
    
	function Delete(e) {
        if (confirm('yakin?')) {
            gridTw1.removeRow(e.data.id);
        }
    }
	
    gridTw1 = $('#gridTw1').grid({
        dataKey: "No",
		dataSource: dataLuas,
		title: 'Detail Luas',
		columns: [
            { field: 'No', width: 32, align: 'center' },
            { field: 'Item', editor: true },
            { field: 'Jumlah_Item', title: 'Jumlah Item', width: 80, editor: true, align: 'center' },
			{ field: 'SatLuasItem', title: 'Satuan Luas (m2)', width: 150, editor: true, align: 'right' },
			{ field: 'LuasItem', title: 'Luas Item (m2)', width: 150, align: 'right'  },
            { width: 40, tmpl: '<button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>', align: 'center', events: { 'click': Delete } }
        ]
    });
	
    $('#btnAdd').on('click', function () {
        gridTw1.addRow({ 'No': gridTw1.count() + 1, 'Item': '', 'Jumlah_Item': '', 'SatLuasItem': '', 'LuasItem': ''});
    });
	
	function thousandSep(x) {
		var parts = x.toString().split(",");
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		return parts.join(",");
	}
	
	function removeDot(x) {
		return x.replace(/\./g,'');
	}
	
	function swapCommaToDot(x) {
		return x.replace(/\,/g,'.');
	}
	
	function swapDotToComma(x) {
		return x.replace(/\./g,',');
	}
	
	function perkalian(bulat,dec) {
		dec = removeDot(dec);
		dec = swapCommaToDot(dec);
		bulat = Number(bulat);
		dec = Number(dec);
		var hasil = bulat*dec;
		return hasil.toFixed(2);
		//return hasil;
	}
	
	function finishing(x) {
		x = swapDotToComma(x.toString());
		return thousandSep(x);
	}
	
	$('#btnCalc').on('click', function () {
        var totLuas = 0;
		var noRow = gridTw1.count();
		for (i = 1; i <= noRow; i++) {
			var data = gridTw1.get(i);
			var item = data.Item;
			var jml = Math.round(data.Jumlah_Item);
			var sat = data.SatLuasItem;
			sat = removeDot(sat);
			//sat = swapCommaToDot(sat);
			//sat1 = perkalian(1,sat);
			//sat1 = Number(sat);
			var luas = perkalian(jml,sat);
			totLuas = Number(totLuas);
			luas = Number(luas)+0.000000000001;
			totLuas = totLuas+luas;
			var luas1 = finishing(luas.toFixed(2));
			var sat = finishing(sat);
			gridTw1.updateRow(i, { 'No': i, 'Item': item, 'Jumlah_Item': jml, 'SatLuasItem': sat, 'LuasItem': luas1});
		}
		totLuas = finishing(totLuas.toFixed(2));
		totLuas = totLuas.replace(/^0+/, '');
		$('#LuasLantai').val(totLuas);
		var records = gridTw1.getAll();
		myObjString = JSON.stringify(records);
		alert(myObjString);
	});
	
	gridKB1 = $('#gridKB1').grid({
        title: 'Konstruksi Bangunan',
		dataSource: dataKonsBang,
        columns: [
            { field: 'Kerangka', editor: true },
            { field: 'Dinding', editor: true },
            { field: 'Atap', editor: true }
        ]
    });
});