var dataset = JSON.parse(dataChart);
//console.log(obj);
Highcharts.chart('allPemeriksaan', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Pemeriksaan Bangunan Gedung per Tahun'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Jumlah'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: dataset
});
