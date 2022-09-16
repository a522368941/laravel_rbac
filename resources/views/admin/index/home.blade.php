
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('layuiMini/lib/layui-v2.6.3/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('layuiMini/lib/font-awesome-4.7.0/css/font-awesome.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('layuiMini/css/public.css') }}" media="all">
    <style>
        .top-panel {
            border: 1px solid #eceff9;
            border-radius: 5px;
            text-align: center;
        }
        .top-panel > .layui-card-body{
            height: 60px;
        }
        .top-panel-number{
            line-height:60px;
            font-size: 30px;
            border-right:1px solid #eceff9;
        }
        .top-panel-tips{
            line-height:30px;
            font-size: 12px
        }

    </style>
    <style>
    .layui-top-box {padding:40px 20px 20px 20px;color:#fff}
    .panel {margin-bottom:17px;background-color:#fff;border:1px solid transparent;border-radius:3px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05)}
    .panel-body {padding:15px;box-shadow: 2px 2px 2px #eee inset;}
    .panel-title {margin-top:0;margin-bottom:0;font-size:14px;color:inherit}
    .label {display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em;margin-top: .3em;    margin-top: -1.3em;
    margin-right: -1.4em;}
    .layui-red {color:red}
    .main_btn > p {height:40px;}
</style>
</head>
<body>
<!--<div class="layuimini-container">-->
<div class="layuimini-main layui-top-box">

    
   

    <div class="layui-row layui-col-space10">   


        <div class="layui-col-md3">
            <div class="col-xs-6 col-md-3">
                <div class="panel layui-bg-cyan">
                        <div class="panel-body">
                            <div class="panel-title">
                                <span class="label pull-right layui-bg-red">实时</span>
                                <h5>本月量()</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins">1236</h1>
                              
                            </div>
                        </div>
                </div>
            </div>
        </div>

            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-blue">
                        <div class="panel-body">
                            <div class="panel-title">
                                <span class="label pull-right  layui-bg-red">实时</span> 
                                <h5>本年量(吨)</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins">56892</h1>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-green">
                        <div class="panel-body">
                            <div class="panel-title">
                                <span class="label pull-right layui-bg-red ">实时</span>
                                <h5>订单总数（个）</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins">569</h1>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-orange">
                        <div class="panel-body">
                            <div class="panel-title">
                                <span class="label pull-right  layui-bg-red">实时</span>
                                <h5>总量(吨)</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins">895423</h1>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </div>

    <div class="layui-row layui-col-space15">
        <div class="layui-col-xs12 layui-col-md9">
            <div id="echarts-records" style="background-color:#ffffff;min-height:400px;padding: 10px"></div>
        </div>
        <div class="layui-col-xs12 layui-col-md3">
            <div id="echarts-pies" style="background-color:#ffffff;min-height:400px;padding: 10px"></div>
        </div>
    </div>


    <div class="layui-row layui-col-space15">
        <div class="layui-col-xs12 layui-col-md12">
            <div id="echarts-dataset" style="background-color:#ffffff;min-height:300px;padding: 10px"></div>
        </div>
       <!--  <div class="layui-col-xs12 layui-col-md6">
            <div id="echarts-map" style="background-color:#ffffff;min-height:300px;padding: 10px"></div>
        </div> -->
    </div>


</div>
<!--</div>-->
<script src="{{ asset('layuiMini/lib/layui-v2.6.3/layui.js') }}" charset="utf-8"></script>
<script src="{{ asset('layuiMini/js/lay-config.js?v=1.0.4') }}" charset="utf-8"></script>
<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script>
   

    function init(url){
        var index = layer.load(0, {
          shade: [0.7,'#e5e5e5'] //0.1透明度的白色背景
        });
       
        $.ajax({
            type:'get',
            url:url,
            success:function(data){
                layer.close(index);
               layer.msg('已更新!',{icon:1,time:1000});

            }
        });
        
    }


    function uploadCode(url){
          layer.open({
            type: 2,
            title: '导出excel',
            shadeClose: true,
            shade: 0.5,
            area: ['40%', '40%'],
            
            content: url//iframe的url
          }); 
        }
    layui.use(['layer', 'echarts'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            echarts = layui.echarts;

        
        /**
         * 报表功能
         */
        var echartsRecords = echarts.init(document.getElementById('echarts-records'), 'walden');

        var optionRecords = {
            title: {
                text: '每月总量（）'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    label: {
                        backgroundColor: '#6a7985'
                    }
                }
            },
            legend: {
                data: ['']
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [
                {
                    type: 'category',
                    boundaryGap: false,
                    data: [ 
                        1,2,3,4,5,6,7,8,9,10,11,12
                    ]
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                {
                    name: '',
                    type: 'line',
                    stack: '总量',
                    areaStyle: {},
                    data: [100,200,300,400,500,600,700,800,952,680,156,235]
                }
                
                
            ]
        };
        echartsRecords.setOption(optionRecords);


        /**
         * 玫瑰图表
         */
        var echartsPies = echarts.init(document.getElementById('echarts-pies'), 'walden');
        var optionPies = {
            title: {
                text: '分类',
                left: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b} : {c} ({d}%)'
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: [100,100]
            },
            series: [
                {
                    name: '',
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', '60%'],
                    roseType: 'radius',
                    data: [
                       '100','100'
                       
                    ],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        echartsPies.setOption(optionPies);


        /**
         * 柱状图
         */
        var echartsDataset = echarts.init(document.getElementById('echarts-dataset'), 'walden');

        var optionDataset = {
          title: {
                text: '每月量',
                y: 'top', 
                x: 'center'
               
            },
            legend: {
                data:[''],
                x:'center',

                y:'bottom'
            },
            grid: {
                top: '15%',
                right: '10%',
                left: '10%',
                bottom: '10%',
                containLabel: true
            },
            tooltip: {
                trigger: 'axis'
            },
            xAxis: {
                type: 'category',

                data: [
               
                    1,2,3,4,5,6
                ]

            },
            yAxis: {
                type: 'value'
            },
            series: [
              {
                  name:'',
                  data: [
                    250,360,120,560,420,320
                  ],
                  type: 'line',
                  markPoint: {
                        data: [
                            {type: 'max', name: '最大值'},
                            {type: 'min', name: '最小值'}
                        ]
                    },
                  // smooth: true
              }
              

            ]
        };

        echartsDataset.setOption(optionDataset);




        // echarts 窗口缩放自适应
        window.onresize = function () {
            echartsRecords.resize();
        }

    });
</script>
</body>
</html>
