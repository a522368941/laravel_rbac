//上月站点排行榜
(() => {
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.querySelector(".ranking"));
  
    var data = [70, 34, 60, 78, 69];
    var titlename = ["镜园站", "水沟营站", "燕甸园站", "银城站", "北海街道站"];
    var valdata = [702, 350, 610, 793, 664];
    var myColor = ["#1089E7", "#F57474", "#56D0E3", "#F8B448", "#8B78F6"];
    option = {
      //图标位置
      grid: {
        top: "10%",
        left: "22%",
        bottom: "10%"
      },
      xAxis: {
        show: false
      },
      yAxis: [
        {
          show: true,
          data: titlename,
          inverse: true,
          axisLine: {
            show: false
          },
          splitLine: {
            show: false
          },
          axisTick: {
            show: false
          },
          axisLabel: {
            color: "#fff",
            rich: {
              lg: {
                backgroundColor: "#339911",
                color: "#fff",
                borderRadius: 15,
                padding: 5,
                align: "center",
                width: 15,
                height: 15
              }
            }
          }
        },
        {
          show: true,
          inverse: false,
          data: valdata,
          axisLabel: {
            textStyle: {
              fontSize: 12,
              color: "#fff"
            }
          }
        }
      ],
      series: [
        {
          name: "条",
          type: "bar",
          yAxisIndex: 0,
          data: data,
          barCategoryGap: 50,
          barWidth: 10,
          // itemStyle: {
          //   normal: {
          //     barBorderRadius: 20,
          //     color: function(params) {
          //       var num = myColor.length;
          //       return myColor[params.dataIndex % num];
          //     }
          //   }
          // },
          // label: {
          //   normal: {
          //     show: true,
          //     position: "inside",
          //     formatter: "{c}%"
          //   }
          // }
        },
        {
          name: "框",
          type: "bar",
          yAxisIndex: 1,
          barCategoryGap: 50,
          data: [100, 100, 100, 100, 100],
          barWidth: 15,
          itemStyle: {
            normal: {
              color: "none",
              borderColor: "#00c1de",
              borderWidth: 3,
              barBorderRadius: 15
            }
          }
        }
      ]
    };
  
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
    window.addEventListener("resize", function() {
      myChart.resize();
    });
  })();
//折线图
(function() {
  // 基于准备好的dom，初始化echarts实例
  var myChart = echarts.init(document.querySelector(".no-foot"));

  option = {
    tooltip: {
      trigger: "axis",
      axisPointer: {
        lineStyle: {
          color: "#dddc6b"
        }
      }
    },
    legend: {
      top: "0%",
      textStyle: {
        color: "rgba(255,255,255,.5)",
        fontSize: "12"
      }
    },
    grid: {
      left: "10",
      top: "30",
      right: "10",
      bottom: "10",
      containLabel: true
    },

    xAxis: [
      {
        type: "category",
        boundaryGap: false,
        axisLabel: {
          textStyle: {
            color: "rgba(255,255,255,.6)",
            fontSize: 12
          }
        },
        axisLine: {
          lineStyle: {
            color: "rgba(255,255,255,.2)"
          }
        },

        data: [
          "01",
          "02",
          "03",
          "04",
          "05",
          "06",
          "07",
          "08",
          "09",
          "11",
          "12",
          "13",
          "14",
          "15",
          "16",
          "17",
          "18",
          "19",
          "20",
          "21",
          "22",
          "23",
          "24",
          "25",
          "26",
          "27",
          "28",
          "29",
          "30"
        ]
      },
      {
        axisPointer: { show: false },
        axisLine: { show: false },
        position: "bottom",
        offset: 20
      }
    ],

    yAxis: [
      {
        type: "value",
        axisTick: { show: false },
        axisLine: {
          lineStyle: {
            color: "rgba(255,255,255,.1)"
          }
        },
        axisLabel: {
          textStyle: {
            color: "rgba(255,255,255,.6)",
            fontSize: 12
          }
        },

        splitLine: {
          lineStyle: {
            color: "rgba(255,255,255,.1)"
          }
        }
      }
    ],
    series: [
      {
        type: "line",
        smooth: true,
        symbol: "circle",
        symbolSize: 5,
        showSymbol: false,
        lineStyle: {
          normal: {
            color: "#00d887",
            width: 2
          }
        },
        areaStyle: {
          normal: {
            color: new echarts.graphic.LinearGradient(
              0,
              0,
              0,
              1,
              [
                {
                  offset: 0,
                  color: "rgba(0, 216, 135, 0.4)"
                },
                {
                  offset: 0.8,
                  color: "rgba(0, 216, 135, 0.1)"
                }
              ],
              false
            ),
            shadowColor: "rgba(0, 0, 0, 0.1)"
          }
        },
        itemStyle: {
          normal: {
            color: "#00d887",
            borderColor: "rgba(221, 220, 107, .1)",
            borderWidth: 12
          }
        },
        data: [
          50,
          30,
          50,
          60,
          10,
          50,
          30,
          50,
          60,
          40,
          60,
          40,
          80,
          30,
          50,
          60,
          10,
          50,
          30,
          70,
          20,
          50,
          10,
          40,
          50,
          30,
          70,
          20,
          50,
          10,
          40
        ]
      }
    ]
  };

  // 使用刚指定的配置项和数据显示图表。
  myChart.setOption(option);
  window.addEventListener("resize", function() {
    myChart.resize();
  });
})();
//回收重量
(() => {
    var myChart = echarts.init(document.querySelector(".recovery-all"))
    option = {
        legend: {
            top: '5%',
            right: 'right',
            textStyle:{
                fontSize:12,
                color:'#fff'
            }
        },
        series: [
            {
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                left: '-50%',
                itemStyle: {
                    borderWidth: 2
                },
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '16',
                        fontWeight: 'bold',
                        color:'#fff'
                    }
                },
                labelLine: {
                    show: false
                },
                data: [
                    {value: 55, name: '纸类55%'},
                    {value: 15, name: '玻璃15%'},
                    {value: 9, name: '金属9%'},
                    {value: 9, name: '塑料9%'},
                    {value: 7, name: '纺织7%'},
                    {value: 4, name: '橡胶4%'},
                    {value: 2,name: '电器2%'}
                ]
            }
        ]
    };
    myChart.setOption(option)
})();