
/* Generate 52 week chart by default */
if($(document).hasClass("performance-section")) {
    generateChartQuarterly();
}


function generateChartMonthly() {
    var chartDataMonthly = {
        "x": ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
        "y1": [10000, 10500, 13000, 31000, 27600, 32000, 30200, 54200, 34200, 36500, 38500, 41500],
        "y2": [10000, 10500, 12000, 20000, 15000, 20000, 15000, 24200, 18000, 16000, 18500, 21500]
    };
    generateChart(chartDataMonthly);
}

function generateChartQuarterly() {
    // var chartDataWeekly = {
    //     "x": ['APR/1', 'APR/5', 'APR/12', 'APR/19', 'APR/26', 'MAY/3', 'MAY/10', 'MAY/17', 'MAY/24', 'MAY/31', 'JUN/7', 'JUN/14', 'JUN/21'],
    //     "y1": [100, 101.6, 102, 103, 109.6, 109.5, 109.5, 111.7, 112.4, 111.3, 111.3, 111.3, 111.3],
    //     "y2": [100, 101.1, 102.4, 103.5, 104, 104.6, 104.9, 104.6, 103, 105.1, 105.5, 105.8, 105.2]
    // };
    
    var chartDataWeekly = {
        // "x": ['JAN/1', 'JAN/2', 'JAN/3', 'JAN/4', 'FEB/1', 'FEB/2', 'FEB/3', 'FEB/4', 'MAR/1', 'MAR/2', 'MAR/3', 'MAR/4'],
        "x": ['APR/1', 'APR/6', 'APR/13', 'APR/20', 'APR/27', 'MAY/4', 'MAY/11', 'MAY/18', 'MAY/25', 'JUN/1', 'JUN/8', 'JUN/15', 'JUN/22', 'JUN/29', 'JUL/6', 'JUL/13', 'JUL/20', 'JUL/27', 'AUG/3', 'AUG/10', 'AUG/17', 'AUG/24', 'AUG/31', 'SEP/7', 'SEP/14', 'SEP/21', 'SEP/28', 'OCT/5', 'OCT/12', 'OCT/19', 'OCT/26', 'NOV/2', 'NOV/9', 'NOV/16', 'NOV/23', 'NOV/30', 'DEC/7', 'DEC/14', 'DEC/21', 'DEC/28', 'JAN/4', 'JAN/11', 'JAN/18', 'JAN/25', 'FEB/1', 'FEB/8', 'FEB/15', 'FEB/22' , 'MAR/1', 'MAR/8', 'MAR/15', 'MAR/22', 'MAR/29', 'APR/5', 'APR/12', 'APR/19', 'APR/26', 'MAY/3', 'MAY/10', 'MAY/17', 'MAY/24', 'MAY/31'],
        "y1": [
            10000, 10067, 10135, 10202, 10270, 10329, 10389, 10484, 10507, 10561, 10615, 10669, 10723, 10776, 10822, 10867, 10913, 10959, 11021, 11083, 11145, 11207, 11269, 11353, 11438, 11523, 11608, 11709, 11810, 11911, 12011, 12109, 12206, 12303, 12400, 12497, 12579, 12661, 12742, 12824, 12811, 12798, 12784, 12771, 12921, 13072, 13222, 13373, 13417, 13461, 13504, 13548, 13592, 13673, 13693, 13743, 14062, 14057, 14057, 14158, 14188, 14139
        ],
        "y2": [
            10000, 10026, 9905, 9890, 10112, 10132, 10199, 10207, 10294, 10409, 10443, 10368, 10424, 10288, 10472, 10707, 10687, 10847, 10839, 10630, 10721, 10670, 10736, 10749, 10918, 10956, 10574, 10704, 10929, 10983, 11197, 11283, 11159, 11057, 11202, 11070, 11005, 11097, 11301, 11342, 11371, 11529, 11709, 11982, 11925, 11449, 11415, 11239, 11321, 11087, 11214, 10949, 11054, 11177, 11321, 11436, 11493, 11560, 11600, 11564, 11381, 11621,
        ]
    };
    generateChart(chartDataWeekly);
}

/* generate quarterly chart on click */
$('#quarterly-chart').click(function() {
    generateChartQuarterly();
});

/* generate 52 week chart on click */
// $('#yearly-chart').click(function() {
//     generateChartMonthly();
// });

/* function to generate chart */
function generateChart(data) {
    var json = {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: ''
        },
        legend: {
            layout: 'horizontal',
            align: 'right',
            verticalAlign: 'top',
            x: 0,
            y: -10,
            floating: true,
            borderWidth: 0,
            backgroundColor: '#FFFFFF',
            symbolHeight: 10,
            symbolWidth: 12,
            symbolRadius: 0

        },
        xAxis: {
            categories: data.x,
            gridLineWidth: 0,
            crosshair: {
                width: 1,
                color: '#999',
                dashStyle: 'dash',
                zIndex: 99
            }
        },
        yAxis: {
            title: {
                text: ''
            },
            gridLineWidth: 0,
            labels: {
                formatter: function() {
                    return this.value / 100;
                }
            },
            min: 9500,
            tickInterval: 100,
        },
        tooltip: {
            shared: true,
            valuePrefix: 'touched NAV',
            backgroundColor: '#f2f1f1',          
            borderRadius: 5,
            borderWidth: 0
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 1, //Opacity of chart area
                marker: {
                    enabled: false,
                    fillColor: '#333333',
                    lineColor: '#333333',
                    symbol: 'circle',
                    radius: 2,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            }
        },
        series: [{
            name: 'RAIN Fund',
            data: data.y1,
            color: '#5a00ff'
        }, {
            name: 'Nifty',
            data: data.y2,
            color: '#47ebff'
        }]
    };
    Highcharts.chart('chart-container', json);
}

$(".graph-option").on("click", function() {
    $(".graph-option").removeClass("active");
    $(this).addClass("active");
});
