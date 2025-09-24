<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('statistik-bar', {
        chart: { type: 'column' },
        title: { text: null },
        xAxis: {
            categories: {!! json_encode($bulan) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            allowDecimals: false,
            title: { text: 'Jumlah' }
        },
        tooltip: {
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: 'Surat Pengajuan',
                data: {!! json_encode($suratPengajuanPerBulan) !!},
                color: '#dc3545'
            },
            {
                name: 'Surat Selesai',
                data: {!! json_encode($suratSelesaiPerBulan) !!},
                color: '#0d6efd'
            },
            {
                name: 'Pajak Belum Lunas',
                data: {!! json_encode($pajakBelumBayarPerBulan) !!},
                color: '#198754'
            },
            {
                name: 'Pajak Lunas',
                data: {!! json_encode($pajakBayarPerBulan) !!},
                color: '#ffc107'
            },
        ]
    });
</script>