**FullCalendar** 

这是一款基于jQuery的日历插件，适用于各种日程安排、工作计划等场景。

查看待办事项，标记重要事项以及绑定点击和拖动事件，能快速的整合到您的项目中。

**官网**

    http://arshaw.com/fullcalendar/

    https://github.com/arshaw/fullcalendar

**HTML**

    <style type="text/css">
    #script-warning {
        display: none;
        background: #eee;
        border-bottom: 1px solid #ddd;
        padding: 0 10px;
        line-height: 40px;
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        color: red;
    }
    #loading {
        display: none;
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .rank_none{
       font-size: .85em;
       cursor: default;
       background: #FB9337 !important;
       color: #333;
       border: 0;
    }
    .rank_s{
       font-size: .85em;
       cursor: default;
       background: #F00000 !important;
       color: #333;
       border: 0;
    }
    .rank_a{
       font-size: .85em;
       cursor: default;
       background: #669933 !important;
       color: #333;
       border: 0;
    }
    .rank_b{
       font-size: .85em;
       cursor: default;
       background: #0099CC !important;
       color: #333;
       border: 0;
    }
    </style>
    <link href='css/fullcalendar.css' rel='stylesheet' />

    <div class="contenttitle2"><h3>上线日历</h3></div>
    <div id='loading'>loading...</div>
    <div id='calendar' style='width:100%;margin:20px auto 0;'></div>

    <script src="js/jquery-1.9.1.min.js"></script> 
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script> 
    <script src='js/moment.min.js' type="text/javascript"></script>
    <script src='js/fullcalendar.js' type="text/javascript"></script>
    <script src='js/zh-cn.js' type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next day',
                center: 'title',
                right: ''
            },
            buttonText:{
                prev: '上一月',
                next: '下一月',
                today:'今天',
                month:'月',
                week: '周',
                day:  '日'
            },
            lang: 'zh-cn', // 中文语言包
            defaultDate: '<!--{$currentDay}-->', // 默认日期
            editable: true,
            selectable: true,
            events: {
                url: 'AjaxGetCalendar.php', // AJAX获取数据
                error: function() {
                    // TODO
                }
            },
            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url); // 赋予点击事件
                    return false;
                }
            },
            loading: function(bool) {
                $('#loading').toggle(bool);
            }
        });
    });
    </script>

**字段说明**

AjaxGetCalendar 接口返回的Json数据格式。

    url：点击时，触发的链接请求地址。

    className：每个日历格子内的事件的样式类。

    borderColor：每个事件的边框颜色。

    title：内容。

    start：开始时间。
    

**JSON**

![AJAX返回的JSON数据][1]


**DEMO**

通过上述配置，我们可以看到很炫的日历展示效果。

![日历展示DEMO][2]


  [1]: http://segmentfault.com/img/bVcDDT
  [2]: http://segmentfault.com/img/bVcDDU