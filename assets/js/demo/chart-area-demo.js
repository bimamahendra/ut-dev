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