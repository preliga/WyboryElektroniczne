'use strict';
define(
    [
        '/scripts/app/js/action/Base.js',
        '/scripts/lib/PigOrmJS/DataTemplate.js'
    ],
    function (Base, DateTemplate) {
        return class results extends Base {

            initAction() {
            }

            afterRender() {
                super.afterRender();

                let voteTemplate = new DateTemplate('Vote');

                let column = [];
                column['amountVotes'] = 'v.id';
                voteTemplate.count({'amountVotes': 'v.id'}, null, ['v.candidateId'], ['amountVotes DESC', 'name']).then(function(results){

                    let amountAllVotes = 0;
                    results.forEach(function (item, index) {
                        amountAllVotes += item.amountVotes;
                    });

                    generateChart(results, amountAllVotes);
                });
                

            }
        };

        function generateChart(results, amountAllVotes) {

            let defaultBackgroundColor = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ];
            let defaultBorderColor = [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]

            let labels = [];
            let data = [];
            let backgroundColor = [];
            let borderColor = [];


            results.forEach(function (item, index) {
                labels.push(item.name + " " + item.lastName);
                data.push(  parseInt((item.amountVotes / amountAllVotes) * 100 ));
                backgroundColor.push(defaultBackgroundColor[index]);
                borderColor.push(defaultBorderColor[index]);

            });

            let ctx = document.getElementById("voteChart").getContext('2d');
            let myChart = new Chart(ctx, {
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