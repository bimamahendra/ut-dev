// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["2020", "2021"],
        datasets: [{
            label: 'Listrik',
            data: [200000000, 0],
            backgroundColor: 'rgba(41, 128, 185,1.0)',
            borderColor: 'rgba(41, 128, 185,1.0)',
            borderWidth: 1
        }, {
            label: 'Rent',
            data: [650000000, 0],
            backgroundColor: 'rgba(230, 126, 34,1.0)',
            borderColor: 'rgba(230, 126, 34,1.0)',
            borderWidth: 1
        }, {
            label: 'Service',
            data: [0, 400000000],
            backgroundColor: 'rgba(127, 140, 141,1.0)',
            borderColor: 'rgba(127, 140, 141,1.0)',
            borderWidth: 1
        }],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

var monthlyDetailChart = document.getElementById("monthlyDetailChart");
var monthlyDetail = new Chart(monthlyDetailChart, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May"],
        datasets: [{
            label: 'DN Terbit',
            data: [452223, 409200, 409200, 0, 0],
            backgroundColor: 'rgba(211, 84, 0,1.0)',
            borderColor: 'rgba(211, 84, 0,1.0)',
            borderWidth: 1
        }, {
            label: 'Payment Received',
            data: [0, 452223, 409200, 204600, 204600],
            backgroundColor: 'rgba(241, 196, 15,1.0)',
            borderColor: 'rgba(241, 196, 15,1.0)',
            borderWidth: 1
        }],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

var dnAgingChart = document.getElementById("dnAgingChart");
var dnAging = new Chart(dnAgingChart, {
    type: 'bar',
    data: {
        labels: [">60 Hari", "<30 Hari"],
        datasets: [{
            label: 'Total',
            data: [1, 5],
            backgroundColor: 'rgba(41, 128, 185,1.0)',
            borderColor: 'rgba(41, 128, 185,1.0)',
            borderWidth: 1
        }],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    min: 0
                }
            }]
        }
    }
});

var topTenantChart = document.getElementById("topTenantChart");
var topTenant = new Chart(topTenantChart, {
    type: 'bar',
    data: {
        labels: ["PT KOMATSU ASTRA FINANCE"],
        datasets: [{
            label: 'Total',
            data: [250000000],
            backgroundColor: 'rgba(41, 128, 185,1.0)',
            borderColor: 'rgba(41, 128, 185,1.0)',
            borderWidth: 1
        }],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});