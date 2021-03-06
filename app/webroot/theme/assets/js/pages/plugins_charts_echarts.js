$(function() {
    // geo lines
    altair_charts_echarts.chart_a();
    // stacked area
    altair_charts_echarts.chart_b();
    // bars
    altair_charts_echarts.chart_c();
    // area
    altair_charts_echarts.chart_d();
    // funnel
    altair_charts_echarts.chart_e();
});

altair_charts_echarts = {
    chart_a: function() {
        var dom = document.getElementById("chart_a"),
            myChart = echarts.init(dom),
            app = {};

        var option = {
            title: {
                text: 'Stacked area'
            },
            tooltip : {
                trigger: 'axis'
            },
            color: ['#00ACC1','#FB8C00','#E53935','#7CB342','#6D4C41'],
            legend: {
                data:['Email Marketing', 'Affiliate Ads', 'Video Ads', 'Direct Access', 'Search Engine'],
                bottom: '0'
            },
            toolbox: {
                right: 30,
                feature: {
                    saveAsImage: {
                        title: 'save as image'
                    }
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '10%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    data : ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name:'Email Marketing',
                    type:'line',
                    stack: 'Total',
                    lineStyle: {
                        normal: {
                            color: '#006064'
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: '#00ACC1'
                        }
                    },
                    data:[120, 132, 101, 134, 90, 230, 210]
                },
                {
                    name:'Affiliate Ads',
                    type:'line',
                    stack: 'Total',
                    lineStyle: {
                        normal: {
                            color: '#E65100'
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: '#FB8C00'
                        }
                    },
                    data:[220, 182, 191, 234, 290, 330, 310]
                },
                {
                    name:'Video Ads',
                    type:'line',
                    stack: 'Total',
                    lineStyle: {
                        normal: {
                            color: '#B71C1C'
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: '#E53935'
                        }
                    },
                    data:[150, 232, 201, 154, 190, 330, 410]
                },
                {
                    name:'Direct Access',
                    type:'line',
                    stack: 'Total',
                    lineStyle: {
                        normal: {
                            color: '#33691E'
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: '#7CB342'
                        }
                    },
                    data:[320, 332, 301, 334, 390, 330, 320]
                },
                {
                    name:'Search Engine',
                    type:'line',
                    stack: 'Total',
                    label: {
                        normal: {
                            show: true,
                            position: 'top'
                        }
                    },
                    lineStyle: {
                        normal: {
                            color: '#3E2723'
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: '#6D4C41'
                        }
                    },
                    data:[820, 932, 901, 934, 1290, 1330, 1320]
                }
            ]
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
            $window.on('debouncedresize',function() {
                myChart.resize()
            });
        }
    },
    chart_b: function() {
        var dom = document.getElementById("chart_b"),
            myChart = echarts.init(dom),
            app = {},
            geoCoordMap = {
            '??????': [121.4648,31.2891],
            '??????': [113.8953,22.901],
            '??????': [118.7073,37.5513],
            '??????': [113.4229,22.478],
            '??????': [111.4783,36.1615],
            '??????': [118.3118,35.2936],
            '??????': [124.541,40.4242],
            '??????': [119.5642,28.1854],
            '????????????': [87.9236,43.5883],
            '??????': [112.8955,23.1097],
            '??????': [115.0488,39.0948],
            '??????': [103.5901,36.3043],
            '??????': [110.3467,41.4899],
            '??????': [116.4551,40.2539],
            '??????': [109.314,21.6211],
            '??????': [118.8062,31.9208],
            '??????': [108.479,23.1152],
            '??????': [116.0046,28.6633],
            '??????': [121.1023,32.1625],
            '??????': [118.1689,24.6478],
            '??????': [121.1353,28.6688],
            '??????': [117.29,32.0581],
            '????????????': [111.4124,40.4901],
            '??????': [108.4131,34.8706],
            '?????????': [127.9688,45.368],
            '??????': [118.4766,39.6826],
            '??????': [120.9155,30.6354],
            '??????': [113.7854,39.8035],
            '??????': [122.2229,39.4409],
            '??????': [117.4219,39.4189],
            '??????': [112.3352,37.9413],
            '??????': [121.9482,37.1393],
            '??????': [121.5967,29.6466],
            '??????': [107.1826,34.3433],
            '??????': [118.5535,33.7775],
            '??????': [119.4543,31.5582],
            '??????': [113.5107,23.2196],
            '??????': [116.521,39.0509],
            '??????': [109.1052,36.4252],
            '?????????': [115.1477,40.8527],
            '??????': [117.5208,34.3268],
            '??????': [116.6858,37.2107],
            '??????': [114.6204,23.1647],
            '??????': [103.9526,30.7617],
            '??????': [119.4653,32.8162],
            '??????': [117.5757,41.4075],
            '??????': [91.1865,30.1465],
            '??????': [120.3442,31.5527],
            '??????': [119.2786,35.5023],
            '??????': [102.9199,25.4663],
            '??????': [119.5313,29.8773],
            '??????': [117.323,34.8926],
            '??????': [109.3799,24.9774],
            '??????': [113.5327,27.0319],
            '??????': [114.3896,30.6628],
            '??????': [117.1692,23.3405],
            '??????': [112.6318,22.1484],
            '??????': [123.1238,42.1216],
            '??????': [116.8286,38.2104],
            '??????': [114.917,23.9722],
            '??????': [118.3228,25.1147],
            '??????': [117.0264,36.0516],
            '??????': [120.0586,32.5525],
            '??????': [117.1582,36.8701],
            '??????': [116.8286,35.3375],
            '??????': [110.3893,19.8516],
            '??????': [118.0371,36.6064],
            '??????': [118.927,33.4039],
            '??????': [114.5435,22.5439],
            '??????': [112.9175,24.3292],
            '??????': [120.498,27.8119],
            '??????': [109.7864,35.0299],
            '??????': [119.8608,30.7782],
            '??????': [112.5439,27.7075],
            '??????': [117.8174,37.4963],
            '??????': [119.0918,36.524],
            '??????': [120.7397,37.5128],
            '??????': [101.9312,23.8898],
            '??????': [113.7305,22.1155],
            '??????': [120.2234,33.5577],
            '??????': [121.9482,41.0449],
            '?????????': [114.4995,38.1006],
            '??????': [119.4543,25.9222],
            '?????????': [119.2126,40.0232],
            '??????': [120.564,29.7565],
            '??????': [115.9167,36.4032],
            '??????': [112.1265,23.5822],
            '??????': [122.2559,30.2234],
            '??????': [120.6519,31.3989],
            '??????': [117.6526,36.2714],
            '??????': [115.6201,35.2057],
            '??????': [122.4316,40.4297],
            '?????????': [120.1575,40.578],
            '??????': [115.8838,37.7161],
            '??????': [118.6853,28.8666],
            '??????': [101.4038,36.8207],
            '??????': [109.1162,34.2004],
            '??????': [106.6992,26.7682],
            '?????????': [119.1248,34.552],
            '??????': [114.8071,37.2821],
            '??????': [114.4775,36.535],
            '??????': [113.4668,34.6234],
            '????????????': [108.9734,39.2487],
            '??????': [107.7539,30.1904],
            '??????': [120.0037,29.1028],
            '??????': [109.0393,35.1947],
            '??????': [106.3586,38.1775],
            '??????': [119.4763,31.9702],
            '??????': [125.8154,44.2584],
            '??????': [113.0823,28.2568],
            '??????': [112.8625,36.4746],
            '??????': [113.4778,38.0951],
            '??????': [120.4651,36.3373],
            '??????': [113.7964,24.7028]
        };

        var BJData = [
            [{name:'??????'}, {name:'??????',value:95}],
            [{name:'??????'}, {name:'??????',value:90}],
            [{name:'??????'}, {name:'??????',value:80}],
            [{name:'??????'}, {name:'??????',value:70}],
            [{name:'??????'}, {name:'??????',value:60}],
            [{name:'??????'}, {name:'??????',value:50}],
            [{name:'??????'}, {name:'??????',value:40}],
            [{name:'??????'}, {name:'??????',value:30}],
            [{name:'??????'}, {name:'??????',value:20}],
            [{name:'??????'}, {name:'??????',value:10}]
        ],
        SHData = [
            [{name:'??????'},{name:'??????',value:95}],
            [{name:'??????'},{name:'??????',value:90}],
            [{name:'??????'},{name:'??????',value:80}],
            [{name:'??????'},{name:'??????',value:70}],
            [{name:'??????'},{name:'??????',value:60}],
            [{name:'??????'},{name:'??????',value:50}],
            [{name:'??????'},{name:'??????',value:40}],
            [{name:'??????'},{name:'??????',value:30}],
            [{name:'??????'},{name:'??????',value:20}],
            [{name:'??????'},{name:'??????',value:10}]
        ],
        GZData = [
            [{name:'??????'},{name:'??????',value:95}],
            [{name:'??????'},{name:'??????',value:90}],
            [{name:'??????'},{name:'??????',value:80}],
            [{name:'??????'},{name:'??????',value:70}],
            [{name:'??????'},{name:'??????',value:60}],
            [{name:'??????'},{name:'??????',value:50}],
            [{name:'??????'},{name:'??????',value:40}],
            [{name:'??????'},{name:'??????',value:30}],
            [{name:'??????'},{name:'??????',value:20}],
            [{name:'??????'},{name:'??????',value:10}]
        ];

        var planePath = 'path://M1705.06,1318.313v-89.254l-319.9-221.799l0.073-208.063c0.521-84.662-26.629-121.796-63.961-121.491c-37.332-0.305-64.482,36.829-63.961,121.491l0.073,208.063l-319.9,221.799v89.254l330.343-157.288l12.238,241.308l-134.449,92.931l0.531,42.034l175.125-42.917l175.125,42.917l0.531-42.034l-134.449-92.931l12.238-241.308L1705.06,1318.313z';

        var convertData = function (data) {
            var res = [];
            for (var i = 0; i < data.length; i++) {
                var dataItem = data[i];
                var fromCoord = geoCoordMap[dataItem[0].name];
                var toCoord = geoCoordMap[dataItem[1].name];
                if (fromCoord && toCoord) {
                    res.push({
                        fromName: dataItem[0].name,
                        toName: dataItem[1].name,
                        coords: [fromCoord, toCoord]
                    });
                }
            }
            return res;
        };

        var color = ['#7CB342', '#FB8C00', '#039BE5'];
        var series = [];
        [['Beijing', BJData], ['Shanghai', SHData], ['Guangzhou', GZData]].forEach(function (item, i) {
            series.push({
                    name: item[0] + ' Top10',
                    type: 'lines',
                    zlevel: 1,
                    effect: {
                        show: true,
                        period: 6,
                        trailLength: 0.7,
                        color: '#fff',
                        symbolSize: 3
                    },
                    lineStyle: {
                        normal: {
                            color: color[i],
                            width: 0,
                            curveness: 0.2
                        }
                    },
                    data: convertData(item[1])
                },
                {
                    name: item[0] + ' Top10',
                    type: 'lines',
                    zlevel: 2,
                    symbol: ['none', 'arrow'],
                    symbolSize: 10,
                    effect: {
                        show: true,
                        period: 6,
                        trailLength: 0,
                        symbol: planePath,
                        symbolSize: 15
                    },
                    lineStyle: {
                        normal: {
                            color: color[i],
                            width: 1,
                            opacity: 0.6,
                            curveness: 0.2
                        }
                    },
                    data: convertData(item[1])
                },
                {
                    name: item[0] + ' Top10',
                    type: 'effectScatter',
                    coordinateSystem: 'geo',
                    zlevel: 2,
                    rippleEffect: {
                        brushType: 'stroke'
                    },
                    label: {
                        normal: {
                            show: true,
                            position: 'right',
                            formatter: '{b}'
                        }
                    },
                    symbolSize: function (val) {
                        return val[2] / 8;
                    },
                    itemStyle: {
                        normal: {
                            color: color[i]
                        }
                    },
                    data: item[1].map(function (dataItem) {
                        return {
                            name: dataItem[1].name,
                            value: geoCoordMap[dataItem[1].name].concat([dataItem[1].value])
                        };
                    })
                });
        });

        var option = {
            backgroundColor: '#404a59',
            title : {
                text: 'Simulated migration',
                subtext: 'The data is fictitious',
                left: 'center',
                top: 20,
                textStyle : {
                    color: '#fff'
                }
            },
            tooltip : {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                bottom: 10,
                right: 10,
                data:['Beijing Top10', 'Shanghai Top10', 'Guangzhou Top10'],
                textStyle: {
                    color: '#fff'
                },
                selectedMode: 'single'
            },
            geo: {
                map: 'china',
                label: {
                    emphasis: {
                        show: false
                    }
                },
                roam: true,
                itemStyle: {
                    normal: {
                        areaColor: '#323c48',
                        borderColor: '#404a59'
                    },
                    emphasis: {
                        areaColor: '#2a333d'
                    }
                }
            },
            series: series
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
            $window.on('debouncedresize',function() {
                myChart.resize()
            });
        }
    },
    chart_c: function() {
        var dom = document.getElementById("chart_c"),
            myChart = echarts.init(dom),
            app = {},
            dataAxis = ['???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???', '???'],
            data = [220, 182, 191, 234, 290, 330, 310, 123, 442, 321, 90, 149, 210, 122, 133, 334, 198, 123, 125, 220],
            yMax = 500,
            dataShadow = [];

        for (var i = 0; i < data.length; i++) {
            dataShadow.push(yMax);
        }

        var option = {
            title: {
                text: 'Feature Sample',
                subtext: 'Gradient Color, Shadow, Click Zoom'
            },
            xAxis: {
                data: dataAxis,
                axisLabel: {
                    inside: true,
                    textStyle: {
                        color: '#fff'
                    }
                },
                axisTick: {
                    show: false
                },
                axisLine: {
                    show: false
                },
                z: 10
            },
            yAxis: {
                axisLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    textStyle: {
                        color: '#999'
                    }
                }
            },
            dataZoom: [
                {
                    type: 'inside'
                }
            ],
            series: [
                { // For shadow
                    type: 'bar',
                    itemStyle: {
                        normal: {color: 'rgba(0,0,0,0.05)'}
                    },
                    barGap:'-100%',
                    barCategoryGap:'40%',
                    data: dataShadow,
                    animation: false
                },
                {
                    type: 'bar',
                    itemStyle: {
                        normal: {
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#F44336'},
                                    {offset: 0.5, color: '#F44336'},
                                    {offset: 1, color: '#E53935'}
                                ]
                            )
                        },
                        emphasis: {
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#C62828'},
                                    {offset: 0.7, color: '#C62828'},
                                    {offset: 1, color: '#B71C1C'}
                                ]
                            )
                        }
                    },
                    data: data
                }
            ]
        };
        // Enable data zoom when user click bar.
        var zoomSize = 6;
        myChart.on('click', function (params) {
            console.log(dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)]);
            myChart.dispatchAction({
                type: 'dataZoom',
                startValue: dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)],
                endValue: dataAxis[Math.min(params.dataIndex + zoomSize / 2, data.length - 1)]
            });
        });
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
            $window.on('debouncedresize',function() {
                myChart.resize()
            });
        }
    },
    chart_d: function() {
        var dom = document.getElementById("chart_d"),
            myChart = echarts.init(dom),
            app = {},
            base = +new Date(1968, 9, 3),
            oneDay = 24 * 3600 * 1000,
            date = [],
            data = [Math.random() * 300];

        for (var i = 1; i < 20000; i++) {
            var now = new Date(base += oneDay);
            date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('/'));
            data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
        }

        var option = {
            tooltip: {
                trigger: 'axis',
                position: function (pt) {
                    return [pt[0], '10%'];
                }
            },
            title: {
                left: '0',
                text: 'Large dataset'
            },
            toolbox: {
                right: 30,
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none',
                        title: {
                            zoom: 'zoom',
                            back: 'back'
                        }
                    },
                    restore: {
                        title: 'restore'
                    },
                    saveAsImage: {
                        title: 'save as image'
                    }
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: date
            },
            yAxis: {
                type: 'value',
                boundaryGap: [0, '100%']
            },
            dataZoom: [{
                type: 'inside',
                start: 0,
                end: 10
            }, {
                start: 0,
                end: 10,
                handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                handleSize: '80%',
                handleStyle: {
                    color: '#fff',
                    shadowBlur: 3,
                    shadowColor: 'rgba(0, 0, 0, 0.6)',
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                }
            }],
            series: [
                {
                    name: 'Data',
                    type: 'line',
                    smooth: true,
                    symbol: 'none',
                    sampling: 'average',
                    itemStyle: {
                        normal: {
                            color: '#00838F'
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                offset: 0,
                                color: '#0097A7'
                            }, {
                                offset: 1,
                                color: '#80DEEA'
                            }])
                        }
                    },
                    data: data
                }
            ]
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
            $window.on('debouncedresize',function() {
                myChart.resize()
            });
        }

    },
    chart_e: function() {
        var dom = document.getElementById("chart_e"),
            myChart = echarts.init(dom),
            app = {};

        var option = {
            title: {
                text: 'Funnel',
                subtext: 'fictitious data',
                left: 'left',
                top: 'bottom'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c}%"
            },
            toolbox: {
                orient: 'vertical',
                top: 'center',
                right: 30,
                feature: {
                    dataView: {
                        readOnly: false,
                        title: 'dataview',
                        lang: ['Data View','Close','Refresh']
                    },
                    restore: {
                        title: 'restore'
                    },
                    saveAsImage: {
                        title: 'save as image'
                    }
                }
            },
            color: ['#039BE5','#00897B','#C0CA33','#546E7A','#D81B60'],
            legend: {
                orient: 'vertical',
                left: 'left',
                data: ['Show', 'Click', 'Visit', 'Consult', 'Order']
            },
            calculable: true,
            series: [
                {
                    name: 'funnel',
                    type: 'funnel',
                    width: '40%',
                    height: '45%',
                    left: '5%',
                    top: '50%',
                    data:[
                        {value: 60, name:'Show'},
                        {value: 30, name:'Click'},
                        {value: 10, name:'Visit'},
                        {value: 80, name:'Consult'},
                        {value: 100, name:'Order'}
                    ]
                },
                {
                    name: 'pyramid',
                    type: 'funnel',
                    width: '40%',
                    height: '45%',
                    left: '5%',
                    top: '5%',
                    sort: 'ascending',
                    data:[
                        {value: 60, name:'Show'},
                        {value: 30, name:'Click'},
                        {value: 10, name:'Visit'},
                        {value: 80, name:'Consult'},
                        {value: 100, name:'Order'}
                    ]
                },
                {
                    name: 'funnel',
                    type: 'funnel',
                    width: '40%',
                    height: '45%',
                    left: '55%',
                    top: '5%',
                    label: {
                        normal: {
                            position: 'left'
                        }
                    },
                    data:[
                        {value: 60, name: 'Show'},
                        {value: 30, name: 'Click'},
                        {value: 10, name: 'Visit'},
                        {value: 80, name: 'Consult'},
                        {value: 100, name: 'Order'}
                    ]
                },
                {
                    name: 'pyramid',
                    type: 'funnel',
                    width: '40%',
                    height: '45%',
                    left: '55%',
                    top: '50%',
                    sort: 'ascending',
                    label: {
                        normal: {
                            position: 'left'
                        }
                    },
                    data:[
                        {value: 60, name: 'Show'},
                        {value: 30, name: 'Click'},
                        {value: 10, name: 'Visit'},
                        {value: 80, name: 'Consult'},
                        {value: 100, name: 'Order'}
                    ]
                }
            ]
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
            $window.on('debouncedresize',function() {
                myChart.resize()
            });
        }
    }
};