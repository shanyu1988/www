

/*
* 仪表盘
* @parameter: data=>[实际产出，计划产出]  ,
* */
var color01 = ['#36b5df', '#e25151'];
function Meter(data) {
    this.series = [{
        center: ['50%', '58%'],
        name: '刻度',
        type: 'gauge',
        radius: '80%',
        min: 0,//最小刻度
        max: data[1],//最大刻度
        splitNumber: 10, //刻度数量
        startAngle: 225,
        endAngle: -45,
        axisLine: {
            show: false,
            lineStyle: {
                width: 1,
                color: [[1, 'rgba(0,0,0,0.1)']]
            }
        },//仪表盘轴线
        axisLabel: {
            show: true,
            color: '#4d5bd1',
            fontSize: 10,
            distance: -20,
            formatter: function (v) {  //刻度数值
                return v
            }
        },//刻度标签。
        axisTick: {
            show: true,
            splitNumber: 5,
            lineStyle: {
                // color: '#fff',
                width: 1,
            },
            length: -8
        },//刻度样式
        splitLine: {
            show: true,
            length: -12,//白色外部刻度线
            lineStyle: {
                color: 'rgba(255,255,255)'
            }
        },//分隔线样式
        detail: {
            show: false
        },
        pointer: {
            show: false
        }
    }, {
        type: 'gauge',
        radius: '70%',
        center: ['50%', '58%'],
        splitNumber: 0, //刻度数量
        startAngle: 225,
        endAngle: -45,
        axisLine: {
            show: true,
            lineStyle: {
                width: 12,
                color: [
                    [
                        data[0] / data[1], new echarts.graphic.LinearGradient(
                        0, 0, 1, 0, [{
                            offset: 0,
                            color: '#5c53de'
                        },
                            {
                                offset: 1,
                                color: '#18c8ff'
                            }
                        ]
                    )
                    ],
                    [
                        1, '#413e54'
                    ]
                ]
            }
        },
        //分隔线样式。
        splitLine: {
            show: false,
        },
        axisLabel: {
            show: false
        },
        axisTick: {
            show: false
        },
        pointer: {
            show: false
        },
        title: {
            show: true,
            offsetCenter: [0, '-26%'], // x, y，单位px
            textStyle: {
                color: '#fff',
                fontSize: 14
            }
        },
        //仪表盘详情，用于显示数据。
        detail: {
            show: true,
            offsetCenter: [0, '16%'],
            color: '#ffffff',
            formatter: function (params) {
                return params
            },
            textStyle: {
                fontSize: 20
            }
        },
        data: [{
            name: "实际产出",
            value: data[0]
        }]
    }
    ]
}

/*
* 产量完成率   柱状和折线
*
* */
var productionChartOption = {
    "color": "#384757",
    "tooltip": {
        "trigger": "axis",
        "axisPointer": {
            "type": "cross",
            "crossStyle": {
                "color": "#384757"
            }
        }
    },
    "legend": {
        "data": [
            {
                "name": "良品",
                "icon": "circle",
                "textStyle": {
                    "color": "#7d838b"
                }
            },{
                "name": "不良品",
                "icon": "circle",
                "textStyle": {
                    "color": "#7d838b"
                }
            }, {
                "name": "不良率",
                "icon": "circle",
                "textStyle": {
                    "color": "#7d838b"
                }
            }
        ],
        "top": "0",
        "textStyle": {
            "color": "#fff"
        }
    },
    "xAxis": [
        {
            "type": "category",
            "data": [
                "131567",
                "131568",
                "131569",
                "131570",
                "131571",
                "131572",
                "131573",
                "131574",
                "131575",
                "131576",
                "131577",
                "131578",
                "131579"
            ],
            "axisPointer": {
                "type": "shadow"
            },
            "axisLabel": {
                "show": true,
                "textStyle": {
                    "color": "#7d838b"
                }
            }
        }
    ],
    "yAxis": [
        {
            "type": "value",
            "name": "output / hour",
            "nameTextStyle": {
                "color": "#7d838b"
            },
            "min": 0,
            "max": 50,
            "interval": 10,
            "axisLabel": {
                "show": true,
                "textStyle": {
                    "color": "#7d838b"
                }
            },
            "axisLine": {
                "show": true
            },
            "splitLine": {
                show:false,
            }
        },
        {
            "type": "value",
            "name": "不良率",
            "show": true,
            "axisLabel": {
                "show": true,
                "textStyle": {
                    "color": "#7d838b"
                }
            },
            "splitLine": {
                show:false,
            }
        }
    ],
    "grid": {
        top:'11%',
        left:'5%',
        width:'90%',
        height:'80%',
        backgroundColor:'rgba(0,0,0,0.4)'
    },
    "series": [
        {
            "name": "良品",
            "type": "bar",
            "data": [
                4,
                6,
                36,
                6,
                8,
                12,
                24,
                36,
                21,
                13,
                36,
                24,
                6
            ],
            "barWidth": "auto",
            "itemStyle": {
                "normal": {
                    "color": {
                        "type": "linear",
                        "x": 0,
                        "y": 0,
                        "x2": 0,
                        "y2": 1,
                        "colorStops": [
                            {
                                "offset": 0,
                                "color": "rgba(5,117,230,0.6)"
                            },
                            {
                                "offset": 1,
                                "color": "rgba(0,242,96,0.6)"
                            }
                        ],
                        "globalCoord": false
                    }
                }
            }
        },{
            "name": "不良品",
            "type": "bar",
            "data": [
                0,
                0,
                1,
                0,
                1,
                0,
                0,
                1,
                0,
                0,
                2,
                1,
                0
            ],
            "barWidth": "auto",
            "itemStyle": {
                "normal": {
                    "color": {
                        "type": "linear",
                        "x": 0,
                        "y": 0,
                        "x2": 0,
                        "y2": 1,
                        "colorStops": [
                            {
                                "offset": 0,
                                "color": "rgba(241,39,17,0.6)"
                            },
                            {
                                "offset": 1,
                                "color": "rgba(245,175,25,0.6)"
                            }
                        ],
                        "globalCoord": false
                    }
                }
            }
        },{
            "name": "不良率",
            "type": "line",
            "yAxisIndex": 1,
            "data": [
                3,
                4,
                6,
                1,
                3,
                7,
                8,
                4,
                5,
                3,
                7,
                6,
                1
            ],
            "itemStyle": {
                "normal": {
                    color: "#ff9d0b",
                    width: 2,
                    shadowColor: 'rgba(0,0,0,0.8)',
                    shadowBlur: 10,
                    shadowOffsetY: 10
                }
            },
            "smooth": true
        },
    ]
};
var productionChart = echarts.init($('#production')[0]);
productionChart.setOption(productionChartOption);


//良率 、 运行时间饼图

var pieChartOption = {
    color:['#7dc43f', '#ff9d0b'],
    title : {
        text: '良品 / 不良品',
        x:'center',
        y:'44%',
        textStyle:{
            color:'#fff'
        }
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        x : '20',
        y : '20',
        orient:'vertical',
        data:[ '良品','不良品'],
        textStyle:{
            color:'#ccc'
        }
    },
    animationType: 'scale',
    animationEasing: 'elasticOut',
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {
                show: true,
                type: ['funnel']
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'良品/不良品',
            label: {
                normal: {
                    fontSize:14,
                    textStyle: {
                        color: 'rgba(255, 255, 255, 1)'
                    }
                }
            },
            labelLine: {
                normal: {
                    lineStyle: {
                        color: 'rgba(255, 255, 255, 0.4)'
                    },
                    smooth: 0.2,
                }
            },
            type:'pie',
            radius : [70, 100],
            center : ['50%', '50%'],
            data:[
                {
                    value:2956,
                    name:'良品',
                },{
                    value:44,
                    name:'不良品',
                }
            ]
        }
    ]
};
/*************************                时间占比                 *********************/
var pieChartOption2 = {
    title : {
        text: '运行时间',
        x:'center',
        y:'44%',
        textStyle:{
            color:'#fff'
        }
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        x : '20',
        y : '20',
        orient:'vertical',
        data:[ '良品','不良品'],
        textStyle:{
            color:'#ccc'
        }
    },
    animationType: 'scale',
    animationEasing: 'elasticOut',
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {
                show: true,
                type: ['funnel']
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'运行时间',
            label: {
                normal: {
                    fontSize:14,
                    textStyle: {
                        color: 'rgba(255, 255, 255, 1)'
                    }
                }
            },
            labelLine: {
                normal: {
                    lineStyle: {
                        color: 'rgba(255, 255, 255, 0.4)'
                    },
                    smooth: 0.2,
                }
            },
            type:'pie',
            radius : [70, 100],
            center : ['50%', '50%'],
            data:[
                {
                    value:295625,
                    name:'正常',
                },{
                    value:4561,
                    name:'报警',
                },{
                    value:26598,
                    name:'停机',
                }
            ]
        }
    ]
};

/*
* 散点图构造函数
* @parameter :
*       data:[[x,y],.....] ,
*       color:['#36d1dc',...] ,
*       scaleX:[min,max] ,
*       scaleY:[min,max] ,
*       visualMap:true/false
* @return : object
* */
function Scatter(data,color,scaleX,scaleY,visualMap,title) {
    this.title={
        text:title,
        top:'middle',
        left:10,
        textStyle:{
            fontSize:20,
            color:'#6b83b2'
        }
    };
    this.color=visualMap?'':color;

    if(visualMap){
        this.visualMap = [{    //x
            dimension: 1,
            right: 'right',
            top: 'top',
            calculable: true,
            itemWidth: 10,
            min:scaleX[0],
            max:scaleX[1],
            textStyle: {
                color: '#3259B8',
                height: 56,
                fontSize: 10,
                lineHeight: 60,
            },
            inRange: {
                color: ['#6595ff', '#36D1DC', '#6595ff']
            },
            orient: 'vertical',
        }];
    }
    this.grid = {
        show:true,
        containLabel: false,
        width: '240',
        height: '240',
        right:20,
        top: 16,
        borderWidth:0,
        backgroundColor: 'rgba(0,0,0,0.3)'
    };
    this.tooltip = {
        trigger: 'item',
        showDelay: 0,
        formatter: function (params) {
            return 'A1 bottom camera X[um]:'
                + params.value[0]
                + '<br/>'
                + 'A1 bottom camera Y[um]:'
                + params.value[1]
        },
        axisPointer: {
            show: true,
            type: 'cross',
            lineStyle: {
                type: 'dashed',
                width: 1
            }
        }
    };
    this.xAxis = [{
        type: 'value',
        scale: true,
        min:scaleX[0],
        max:scaleX[1],
        axisLabel: {
            formatter: '{value}'
        },
        nameTextStyle: {
            color: '#cccccc',
            fontSize: 14,
        },
        axisTick: {
            show: true,
        },
        axisLine: {
            lineStyle: {
                color: '#3259B8',
            },
            symbol: ['none', 'arrow']
        },
        splitLine: {
            show: true,
            lineStyle: {
                type: 'dotted',
                color: '#384154'
            }
        }
    }];
    this.yAxis = [{
        type: 'value',
        scale: true,
        min: scaleY[0],
        max: scaleY[1],
        axisLabel: {
            formatter: '{value}'
        },
        nameTextStyle: {
            color: '#3259B8',
            fontSize: 14
        },
        axisTick: {
            show: true,
        },
        axisLine: {
            lineStyle: {
                color: '#3259B8',
            },
            symbol: ['none', 'arrow']
        },
        splitLine: {
            show: true,
            lineStyle: {
                type: 'dotted',
                color: '#384154'
            }
        }
    }];
    this.series = [{
        type: 'scatter',
        data:data,
        dimension: ['x', 'y', 'size'],
        symbolSize: 6,
        itemStyle:{
            color:'rgba(255,255,255,0.6)',
            shadowColor: 'rgba(255, 255, 255, 0.4)',
            shadowBlur: 12,
            opacity:0.8
        }
    }];
}

//调用  echarts option 对象
$(function ($) {
    //仪表盘
    var meter1=echarts.init($('#meter1')[0]);
    var num=100;
    meter1.setOption(new Meter([num,1500]));
    var timeTicket = setInterval(function() {
        num=num<1500?num+=1:num;
        meter1.setOption(new Meter([num,1500]),true);
    }, 2120);

    /**
     * 饼图
     * 良品：goodProduct    运行事件：runningTime
     *  option:pieChartOption
     **/
    var goodProduct=echarts.init($('#goodProduct')[0]);
    var runningTime=echarts.init($('#runningTime')[0]);
    goodProduct.setOption(pieChartOption);
    runningTime.setOption(pieChartOption2);


    /*
    * 散点图测试
    * */
    function RandomNumBoth(Min, Max) {
        var Range = Max - Min;
        var Rand = Math.random();
        var num2 = parseInt(Rand * 1000);
        var num = Min + Math.round(Rand * Range); //四舍五入
        num = num2 % 2 === 0 ? num : num * -1;
        return num;
    }

    function arrA() {
        var dataA = [];
        for (var i = 0; i < 50; i++) {
            dataA[i] = [];
            dataA[i][0] = RandomNumBoth(0, 300);
            dataA[i][1] = RandomNumBoth(0, 300);
        }
        return dataA;
    }
    //详情
    var data1=arrA();
    var data2=arrA();
    var data3=arrA();
    var data4=arrA();
    var chart1 = echarts.init($('.row-3 .layui-card-body .layui-col-sm3')[0]);
    var chart2 = echarts.init($('.row-3 .layui-card-body .layui-col-sm3')[1]);
    var chart3 = echarts.init($('.row-3 .layui-card-body .layui-col-sm3')[2]);
    var chart4 = echarts.init($('.row-3 .layui-card-body .layui-col-sm3')[3]);
    var option1 = new Scatter(data1,['#6595ff', '#36D1DC', '#6595ff'], [-300, 300],[-300,300], false,'N1');
    var option2 = new Scatter(data2,['#6595ff', '#36D1DC', '#6595ff'], [-300, 300],[-300,300], false,'N2');
    var option3 = new Scatter(data3,['#6595ff', '#36D1DC', '#6595ff'], [-300, 300],[-300,300], false,'N3');
    var option4 = new Scatter(data4,['#6595ff', '#36D1DC', '#6595ff'], [-300, 300],[-300,300], false,'N4');
    chart1.setOption(option1);
    chart2.setOption(option2);
    chart3.setOption(option3);
    chart4.setOption(option4);
});