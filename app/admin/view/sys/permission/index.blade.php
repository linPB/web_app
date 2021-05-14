@extends('app_tpl.app')

@section('links')
@stop

@section('content')
  <div class="wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">权限列表</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="card">

            <div class="card-body table-responsive">
              <div class="form-group row">
                <label class="col-form-label">权限名</label>
                <div class="col-auto">
                  <input name="name" type="text" class="form-control" id="name">
                </div>
                <div class="col-auto">
                  <select class="form-control" name="type" id="type">
                    <option value="">所有</option>
                    <option value="1">菜单</option>
                    <option value="2">操作</option>
                  </select>
                </div>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-secondary">
                    <input type="radio" name="options" id="search_btn" autocomplete="off" checked=""> 搜索
                  </label>
                  <label class="btn btn-secondary">
                    <input type="radio" name="options" data-toggle="modal" data-target="#addModal" autocomplete="off"> 添加
                  </label>
                  <label class="btn btn-secondary">
                    <input type="radio" name="options" id="del_btn" autocomplete="off"> 删除
                  </label>
                </div>
              </div>

              <div class="table-responsive">
                <table id="table" class="table text-nowrap"></table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:900px">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="addModalLabel">添加</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label class="control-label">权限名:</label>
                  <input type="text" class="form-control" id="store_name">
                </div>
                <div class="form-group">
                  <label class="control-label">权限地址:</label>
                  <input type="text" class="form-control" id="store_path">
                </div>
                <div class="form-group">
                  <label class="control-label">权限类型:</label>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="type_store1" name="type_store" value="1">
                    <label for="type_store1" class="custom-control-label">菜单</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="type_store2" name="type_store" value="2">
                    <label for="type_store2" class="custom-control-label">操作</label>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <button type="button" class="btn btn-primary" onclick="doStore()">保存</button>
            </div>
          </div>
        </div>
      </div>

        <div class="modal fade" id="updModal" tabindex="-1" role="dialog" aria-labelledby="updModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:900px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="updModalLabel">编辑</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form>
                          <input id="update_id" type="hidden" value="">
                            <div class="form-group">
                              <label class="control-label">权限名:</label>
                              <input type="text" class="form-control" id="update_name">
                            </div>
                            <div class="form-group">
                              <label class="control-label">权限地址:</label>
                              <input type="text" class="form-control" id="update_path">
                            </div>
                            <div class="form-group">
                              <label class="control-label">权限类型:</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="type_upd1" name="type_upd" value="1">
                                    <label for="type_upd1" class="custom-control-label">菜单</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="type_upd2" name="type_upd" value="2">
                                    <label for="type_upd2" class="custom-control-label">操作</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="doUpd()">提交更改</button>
                    </div>
                </div>
            </div>
        </div>

      <!-- /.container-fluid -->
      <div class="" style="opacity: 0"><canvas id="visitors-chart" height="0"></canvas></div>
      <div class="" style="opacity: 0"><canvas id="sales-chart" height="0"></canvas></div>
    </div>
    <!-- /.content -->
  </div>
@stop

@section('scripts')
  <script>
    $('#table').bootstrapTable({
      url: '/admin/sys/permission/show',  //请求后台的url（*）
      method: 'post',               //请求方式（*）
      theadClasses:'thead-dark',    //设置表标题样式,默认undefined,可选thead-light、thead-dark
      height: 760,                  //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
      striped: true,                //是否显示行间隔色
      cache: false,                 //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
      pagination: true,             //是否显示分页（*）
      //sortable: true,                 //设置基本排序
      //sortOrder: "asc",             //排序方式
      queryParamsType: '',
      datatype: 'json',
      paginationShowPageGo: true,
      showJumpTo: true,
      pageNumber: 1,                //初始化加载第一页，默认第一页
      queryParams: function (params){
        console.log(params)
        return {  //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
          page_num: params.pageNumber,
          page_size: params.pageSize,
          sort: params.sortName,
          sort_order: params.sortOrder,
          name:$('#name').val(),
          type:$("#type option:selected").val(),
        };
      },                              //请求服务器时所传的参数
      sidePagination: 'server',       //指定服务器端分页
      pageSize: 10,                    //单页记录数
      pageList: [10, 20, 30, 40, '所有'],//分页步进值,当记录条数大于最小可选择条数时才会出现
      search: false,                  //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
      silent: true,                   //静默刷新
      uniqueId: "id",                 //每一行的唯一标识，一般为主键列
      showRefresh: true,              //是否显示刷新按钮
      showColumns: true,              //是否显示 内容列下拉框
      showToggle: true,               //是否显示详细视图和列表视图的切换按钮
      minimumCountColumns: 5,         //最少允许的列数
      clickToSelect: true,            //是否启用点击选中行
      checkboxHeader: true,           //复选框标题
      showFullscreen: true,           //复选框标题
      smartDisplay: true,             //智能显示分页或名片视图
      cardView: false,                //是否显示详细视图
      detailView: false,              //是否显示父子表

      columns: [{
        checkbox: true,
        visible: true
      }, {
        field: 'id',
        title: '序号',
        align: 'center',
        //formatter: function (value, row, index) {return index + 1;},
        sortable: true,
      },
        {
          field: 'name',
          title: '权限名',
          align: 'left',
          width: '230px',
          sortable: true,
        }, {
          field: 'path',
          title: '权限地址',
          align: 'left',
          width: '230px',
          sortable: true,
        }, {
          field: 'type',
          title: '权限类型',
          align: 'left',
          width: '230px',
          formatter: function (value, row, index) {
            switch(row.type){
              case 1:
                value='菜单';
                break;
              case 2:
                value='操作';
                break;
              default:
                value='其他';
                break;
            }
            return value;
          },
          sortable: true,
        }, {
          field: 'operation',
          title: '操作',
          align: 'center',
          formatter: option//表格中增加按钮
        }
      ],
      responseHandler: function (res) { //后台返回的结果
        if(res.code === 0){
          var datainfo = res.data.list;
          var newdata = [];
          if (datainfo.length) {
            for (var i = 0; i < datainfo.length; i++) {
              var datanewobj = {
                'id': '',
                "name": '',
                "path": '',
                "type": '',
                'status': ''
              };

              datanewobj.id = datainfo[i].id;
              datanewobj.name = datainfo[i].name;
              datanewobj.path = datainfo[i].path;
              datanewobj.type = datainfo[i].type;
              datanewobj.status = datainfo[i].status;
              newdata.push(datanewobj);
            }
          }

          return {
            total: res.data.total,
            rows: newdata
          };
        } else {
          Swal.fire({title: 'Emm...', text: res.msg, icon: 'error', timer: 3000});
          return {
            total: 0,
            rows: []
          };
        }
      },
      onLoadSuccess: function () {
      },
      onLoadError: function () {
        Swal.fire({title: 'Emm...', text: '数据加载失败!', icon: 'error', timer: 3000});
      }
    });

    // 表格中按钮
    function option(value, row, index) {
      var btntext = '';

      btntext += "<div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">";
      btntext += "<label class=\"btn btn-secondary\"> <input type=\"radio\" name=\"options\" onclick=\"upd('" + row + "','" + index + "')\" autocomplete=\"off\"> 编辑 </label>";
      btntext += "</div>";

      return btntext;
    }

    //时间格式化
    function timeFormatter(value, row, index) {
      if (value != null) {
        var json_date = new Date(value).toJSON();
        return new Date(new Date(json_date) + 8 * 3600 * 1000).toISOString().replace(/T/g, ' ').replace(/\.[\d]{3}Z/, '')
      }
    }

    //查询按钮事件
    $('#search_btn').click(function(){
      $('#table').bootstrapTable('refresh');//刷新，但页码依然为当前的页码，比如page=5依然为5
    })

    //删除按钮事件
    $("#del_btn").on("click", function () {
      // $("#table").bootstrapTable('getSelections');为bootstrapTable自带的，所以说一定要使用bootstrapTable显示表格,#table：为table的id
      var rows = $("#table").bootstrapTable('getSelections');
      if (rows.length === 0) {// rows 主要是为了判断是否选中，下面的else内容才是主要
        Swal.fire({title: 'Emm...', text: '不要瞎操作,先至少选中一条来再说咩!', icon: 'error', timer: 3000});
      } else {
        var arrays = [];// 声明一个数组
        $(rows).each(function () {// 通过获得别选中的来进行遍历
          arrays.push(this.id);// cid为获得到的整条数据中的一列
        });
        var ids = arrays.join(','); // 获得要删除的id
        Swal.fire({
          title: '您确定要执行此操作嘛?',
          text: '此操作执行后改记录将被清除!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: '是的, 删除!',
          cancelButtonText: '不, 保留',
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: '/admin/sys/permission/del',
              method: "POST",
              data: {
                "ids": ids,
              },
              dataType: "json",
              error:function(){
                Swal.fire({title: 'Emm...', text: '出错了,找管理员修理修理!', icon: 'error', timer: 3000});
              },
              success: function success(data) {
                if (data.code === 0) {
                  Swal.fire({title: 'Emm...', text: data.msg, icon: 'success', timer: 3000});

                  $('#table').bootstrapTable('refresh');
                } else {
                  Swal.fire({title: 'Emm...', text: data.msg, icon: 'error', timer: 3000});
                }
              }
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('已取消', '很好,这条记录被你保留下来了 :)', 'error')
          }
        })
      }
    })

    //getData方法获取全部页面数据后，将data转为json对象，使用index当前行号作为下标获取对应数据
    function upd(row, index){
      var data = JSON.stringify($("#table").bootstrapTable('getData')); //获取全部数据
      var data_json = JSON.parse(data); //data_json和data_json2一样都是json对象
      //根据index找到对应行数据，填充数据到修改模态框
      $("#update_id").val(data_json[index].id);
      $("#update_name").val(data_json[index].name);
      $("#update_path").val(data_json[index].path);
      if ( data_json[index].type === 1) {
        $("input[name='type_upd'][value='1']").attr("checked",true);
      } else {
        $("input[name='type_upd'][value='2']").attr("checked",true);
      }
      //弹出修改模态框，非新增模态框
      $('#updModal').modal('show')
    }

    function doUpd() {
      $.ajax({
        url: '/admin/sys/permission/upd',
        method: "POST",
        data: {
          "id": $(" #update_id ").val(),
          "name": $(" #update_name ").val(),
          "path": $(" #update_path ").val(),
          "type": $("input[name='type_upd']:checked").val(),
        },
        dataType: "json",
        error:function(){
          Swal.fire({title: 'Emm...', text: '出错了,找管理员修理修理!', icon: 'error', timer: 3000});
        },
        success: function success(data) {
          if (data.code === 0) {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'success', timer: 3000});

            $('#updModal').modal('hide')

            $(" #update_id ").val('');
            $(" #update_name ").val('');
            $(" #update_path ").val('');
            $("input[type='radio']").removeAttr('checked');

            $('#table').bootstrapTable('refresh');
          } else {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'error', timer: 3000});
          }
        }
      });
    }

    function doStore() {
      $.ajax({
        url: '/admin/sys/permission/store',
        method: "POST",
        data: {
          "name": $(" #store_name ").val(),
          "path": $(" #store_path ").val(),
          "type": $("input[name='type_store']:checked").val(),
        },
        dataType: "json",
        error:function(){
          Swal.fire({title: 'Emm...', text: '出错了,找管理员修理修理!', icon: 'error', timer: 3000});
        },
        success: function success(data) {
          if (data.code === 0) {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'success', timer: 3000});

            $(" #store_name ").val('');
            $(" #store_path ").val('');
            $("input[type='radio']").removeAttr('checked');
            $('#addModal').modal('hide');

            $('#table').bootstrapTable('refresh');
          } else {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'error', timer: 3000});
          }
        }
      });
    }
  </script>
@stop