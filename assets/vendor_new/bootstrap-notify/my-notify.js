$.notify({
    // options
    icon: 'glyphicon glyphicon-warning-sign',
	title: 'Perhatian',
	message: 'Untuk Menghindari duplikasi data, pastikan bahwa data yang akan diinput belum terdapat pada database ini'
},{
	// settings
    type: 'info',
    placement: {
		from: "bottom",
		align: "center"
    },
    delay: 10000,
    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<div class="align-center">' +
		'<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '</div>' +
        '<br>' +
		'<span data-notify="message">{2}</span>' +
		'<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
		'</div>' +
		'<a href="{3}" target="{4}" data-notify="url"></a>' +
	'</div>'
});

