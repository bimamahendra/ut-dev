<script>
    var transaksiChart = document.getElementById("transaksiChart");
    var transaksi = new Chart(transaksiChart, {
        plugins: [ChartDataLabels],
        type: 'pie',
        data: {
            labels: ["Belum Selesai", "Selesai"],
            datasets: [{
                data: [20, 80],
                backgroundColor: ['rgba(237, 42, 33, 1)', 'rgba(49, 176, 87, 1)'],
                datalabels: {
                    anchor: 'center'
                }
            }],
        },
        options: {
            plugins: {
                datalabels: {
                    backgroundColor: function(context) {
                        return context.dataset.backgroundColor;
                    },
                    borderColor: 'white',
                    borderRadius: 25,
                    borderWidth: 2,
                    color: 'white',
                    display: function(context) {
                        var dataset = context.dataset;
                        var count = dataset.data.length;
                        var value = dataset.data[context.dataIndex];
                        return value > count * 1.5;
                    },
                    font: {
                        weight: 'bold'
                    },
                    padding: 6,
                    formatter: (val) => {
                        return val + ' %';
                    }
                },
                tooltip: {
                    enabled: false
                }
            },

            // Core options
            aspectRatio: 3,
            cutoutPercentage: 32,
            layout: {
                padding: 10
            },
            elements: {
                line: {
                    fill: false
                },
                point: {
                    hoverRadius: 7,
                    radius: 5
                }
            },
        }
    });
</script>