'use strict';
define(
    [
        '/scripts/app/js/action/Base.js',
        '/scripts/lib/PigOrmJS/DataTemplate.js',
        '/scripts/app/js/model/ORMConfig.js'
    ],
    function (Base, DateTemplate, ORMConfig) {
        return class results extends Base {

            initAction() {
            }

            afterRender() {
                super.afterRender();
                generateChart();
            }
        };

        function generateChart() {

            var defaultBackgroundColor = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ];
            var defaultBorderColor = [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]

            var labels = [];
            var data = [];
            var backgroundColor = [];
            var borderColor = [];


            view.results.forEach(function (item, index) {
                labels.push(item.name + " " + item.lastName);
                data.push(  parseInt((item.amountVotes / view.amountAllVotes) * 100 ));
                backgroundColor.push(defaultBackgroundColor[index]);
                borderColor.push(defaultBorderColor[index]);

            })

            var ctx = document.getElementById("voteChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Votes',
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 10,
                            },
                        }]
                    },
                    legend: {
                        display: false,
                    },
                }
            });
        }
    }
);