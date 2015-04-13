**DataTables**

`DataTables` 是一个 `jQuery` 的表格插件。

这是一个高度灵活的工具，对任何 `HTML` 表格，提供高级的交互控制功能。

官方网站：`http://www.datatables.net/`

**使用方式**

这里采用的是 `Server-Side` 方式，其他的方式可以自行阅读文档。

见链接：`http://www.datatables.net/examples/data_sources/server_side.html`

**前端页面**

    <link rel="stylesheet" type="text/css" href="./jquery.dataTables.min.css">
    <script type="text/javascript" src="./jquery.min.js"></script>
    <script type="text/javascript" src="./jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        jQuery('#dyntable').dataTable({
            "bPaginate": true, //支持分页
            "bStateSave": true,
            "aLengthMenu": [[50, 100, 150, 200], [50, 100, 150, 200]], //每页显示数量，类似于key => value，一一对应。
            "sPaginationType": "full_numbers",
            "sInfoEmtpy": "没有数据",
            "sInfo": "显示 _START_ 至 _END_ 条 &nbsp;&nbsp;共 _TOTAL_ 条",
            "oLanguage": {
                "sProcessing":   "处理中...",
                "sLengthMenu":   "显示 _MENU_ 项结果",
                "sZeroRecords":  "没有匹配结果",
                "sInfo":         "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "sInfoEmpty":    "显示第 0 至 0 项结果，共 0 项",
                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                "sInfoPostFix":  "",
                "sSearch":       "搜索:",
                "sUrl":          "",
                "sEmptyTable":     "表中数据为空",
                "sLoadingRecords": "载入中...",
                "sInfoThousands":  ",",
                "oPaginate": {
                    "sFirst":    "首页",
                    "sPrevious": "上页",
                    "sNext":     "下页",
                    "sLast":     "末页"
                },
                "oAria": {
                    "sSortAscending":  ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                }
            },
            "bProcessing": true,
            "bServerSide": true, //采用通过服务器获取数据的方式
            "sAjaxSource": "./ajaxGetList.php" //动态请求脚本
        });
    });
    </script>

**服务端脚本**

需要处理这些参数，并且生成 `Json` 数据，返回给前端页面。

    iDisplayStart：偏移量

    iDisplayLength：返回限制的记录数

    iTotalRecords：总记录数

    iTotalDisplayRecords：展示的总记录数

    sEcho：页面自动传的，不用管，直接返回即可。

    aaData：返回的数据记录。

**返回Json数据**

    {
      "sEcho": 1,
      "iTotalRecords": 57,
      "iTotalDisplayRecords": 57,
      "aaData": [
        [
          "Airi",
          "Satou",
          "Accountant",
          "Tokyo",
          "28th Nov 08",
          "$162,700"
        ],
        [
          "Angelica",
          "Ramos",
          "Chief Executive Officer (CEO)",
          "London",
          "9th Oct 09",
          "$1,200,000"
        ],
        [
          "Ashton",
          "Cox",
          "Junior Technical Author",
          "San Francisco",
          "12th Jan 09",
          "$86,000"
        ],
        [
          "Bradley",
          "Greer",
          "Software Engineer",
          "London",
          "13th Oct 12",
          "$132,000"
        ],
        [
          "Brenden",
          "Wagner",
          "Software Engineer",
          "San Francisco",
          "7th Jun 11",
          "$206,850"
        ],
        [
          "Brielle",
          "Williamson",
          "Integration Specialist",
          "New York",
          "2nd Dec 12",
          "$372,000"
        ],
        [
          "Bruno",
          "Nash",
          "Software Engineer",
          "London",
          "3rd May 11",
          "$163,500"
        ],
        [
          "Caesar",
          "Vance",
          "Pre-Sales Support",
          "New York",
          "12th Dec 11",
          "$106,450"
        ],
        [
          "Cara",
          "Stevens",
          "Sales Assistant",
          "New York",
          "6th Dec 11",
          "$145,600"
        ],
        [
          "Cedric",
          "Kelly",
          "Senior Javascript Developer",
          "Edinburgh",
          "29th Mar 12",
          "$433,060"
        ]
      ]
    }

**表格效果图**

![请输入图片描述][1]


  [1]: http://segmentfault.com/img/bVcR6T

上下箭头，可以点击进行排序。

具体排序的实现，可以参考文档。