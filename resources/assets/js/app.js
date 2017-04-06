
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery');
require('chart.js');

$(document).ready(function () {
    setInterval( function () {
        poll();
    }, 2000);
});

function poll() {
    $.get('/gender').then(function (data) {
        var ctx = document.getElementById("genderChart");
        console.log(data);
        $("#ageSpan").html(data.age);
        var genderChart = new Chart(ctx, {
            type : 'pie',
            data : {
                labels: [
                    'Male',
                    'Female'
                ],
                datasets: [
                    {
                        data: [data.male, data.female],
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56"
                        ],
                        hoverBackgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56"
                        ]
                    }
                ]
            },
            options: {
                animation: {
                    duration: 0
                }
            }});
    });
}

