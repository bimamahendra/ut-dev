// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var overdueChart = document.getElementById("overdueChart");
var overdue = new Chart(overdueChart, {
    type: 'pie',
    data: {
        labels: ["Overdue", "Received"],
        datasets: [{
            data: [32, 68],
            backgroundColor: ['#858796', '#f8b500'],
            hoverBackgroundColor: ['#858796', '#f8b500'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        }
    },
});

var sewaBangunanChart = document.getElementById("sewaBangunanChart");
var sewaBangunan = new Chart(sewaBangunanChart, {
    type: 'pie',
    data: {
        labels: ["Not yet", "Done"],
        datasets: [{
            data: [32, 68],
            backgroundColor: ['#858796', '#f8b500'],
            hoverBackgroundColor: ['#858796', '#f8b500'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        }
    },
});

var utilityChart = document.getElementById("utilityChart");
var utility = new Chart(utilityChart, {
    type: 'pie',
    data: {
        labels: ["Not yet", "Done"],
        datasets: [{
            data: [0, 100],
            backgroundColor: ['#858796', '#f8b500'],
            hoverBackgroundColor: ['#858796', '#f8b500'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 0,
        },
        legend: {
            display: false
        }
    },
});