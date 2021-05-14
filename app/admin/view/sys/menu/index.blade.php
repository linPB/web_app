@extends('app_tpl.app')

@section('links')
@stop

@section('content')
  <div class="wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">菜单列表</h1>
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

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">菜单管理</h3>
              </div>

              <div class="card-body">
                <div class="form-group row">
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary">
                      <input type="radio" name="options" onclick="store(0)"> 添加父级菜单
                    </label>
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="table" class="table text-nowrap"></table>
                </div>

              </div>

            </div>
            <!-- /.card -->
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
              <input id="store_pid" type="hidden" value="">
              <form id="store_form">
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
                    <input id="upd_id" type="hidden" value="">
                    <input id="upd_pid" type="hidden" value="">
                    <form id="upd_form">
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
      url: '/admin/sys/menu/show',  //请求后台的url（*）
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
        return {  //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
          page_num: params.pageNumber,
          page_size: params.pageSize,
          sort: params.sortName,
          sort_order: params.sortOrder,
          user_name:$('#user_name').val(),
          email:$('#email').val(),
          phone:$('#phone').val()
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

      columns: [
        {
          field: 'id',
          title: '序号',
          align: 'center',
          formatter: function (value, row, index) {return '#' + row.id;},
        }, {
          field: 'permission_id',
          title: '权限ID',
          align: 'left',
        }, {
          field: 'name',
          title: '菜单名',
          align: 'left',
        }, {
          field: 'pid',
          title: '菜单类型',
          align: 'left',
          formatter: function (value, row, index) {
            if (row.pid === 0) {
              return "<span style='color: blue'>父级</span>";
            } else {
              return "<span style='color: grey'>子级</span>";
            }
          }
        }, {
          field: 'path',
          title: 'PATH',
          align: 'left',
        }, {
          field: 'sort',
          title: '排序',
          align: 'left',
        }, {
          field: 'operation',
          title: '操作',
          align: 'left',
          formatter: function (value, row, index) {
            var btntext = '';
            btntext += "<div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">";
            if(row.pid === 0) {
              btntext += "<label class=\"btn btn-secondary\"> <input type=\"radio\" name=\"options\" onclick=\"store('" + row.id + "')\" autocomplete=\"off\" checked=\"\"> 添加 </label>";
            }
            btntext += "<label class=\"btn btn-secondary\"> <input type=\"radio\" name=\"options\" onclick=\"upd('" + row.id + "','" + row.pid + "','" + row.sort + "','" + row.permission_id + "')\" autocomplete=\"off\"> 编辑 </label>";
            btntext += "<label class=\"btn btn-secondary\"> <input type=\"radio\" name=\"options\" onclick=\"del('" + row.id + "','" + row.pid + "')\" autocomplete=\"off\"> 删除 </label>";

            btntext += "</div>";

            return btntext;
          }//表格中增加按钮
        }
      ],
      responseHandler: function (res) { //后台返回的结果
        if(res.code === 0){
          var userinfo = res.data.data;
          var newdata = [];
          if (userinfo.length) {
            for (var i = 0; i < userinfo.length; i++) {
              var datanewobj = {
                'id': '',
                "permission_id": '',
                "name": '',
                "pid": '',
                "path": '',
                'sort': '',
                'status': ''
              };

              datanewobj.id = userinfo[i].id;
              datanewobj.permission_id = userinfo[i].permission_id;
              datanewobj.name = userinfo[i].name;
              datanewobj.pid = userinfo[i].pid;
              datanewobj.path = userinfo[i].path;
              datanewobj.sort = userinfo[i].sort;
              datanewobj.status = userinfo[i].status;
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
        Swal.fire({title: 'Emm...', text: "数据加载失败！", icon: 'error', timer: 3000});
      }
    });

    function store(type) {
      $.ajax({
        url: '/admin/sys/menu/store_or_add_show',
        method: "POST",
        data: {
          "pid": type,
        },
        dataType: "json",
        error:function(){
          Swal.fire({title: 'Emm...', text: '出错了,找管理员修理修理!', icon: 'error', timer: 3000});
        },
        success: function success(data) {
          if (data.code === 0) {

            var html = '<div class="row"> ' +
                    '<div class="form-group col-6">' +
                    '<label class="control-label" for="store_name">菜单名:</label> ' +
                    '<select class="form-control" name="type" size="8" id="store_permission_id">';
            for(var i = 0; i < data.data.length; i++) {
              html +='<option value="'+ data.data[i].id +'">'+ data.data[i].name +'</option>'
            }
            html +='</select></div>' +
                '    <div class="form-group col-6">\n' +
                '        <label class="control-label">排序:</label>\n' +
                '        <input type="text" class="form-control" name="sort" id="store_sort" required>\n' +
                '    </div>' +
                '</div>';
            $("#store_form").html(html);

            if (type === 0) {
              $("#addModalLabel").text('添加父级菜单')
            } else {
              $("#addModalLabel").text('添加子菜单')
            }

            $(" #store_pid ").val(type);
            $('#addModal').modal('show');//手动打开模态框。

          } else {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'error', timer: 3000});
          }
        }
      });
    }

    function doStore() {
      $.ajax({
        url: '/admin/sys/menu/store',
        method: "POST",
        data: {
          "permission_id": $(" #store_permission_id ").val(),
          "sort": $(" #store_sort ").val(),
          "pid": $(" #store_pid ").val(),
          // "pid": $("input[name='type_store']:checked").val(),
        },
        dataType: "json",
        error:function(){
          Swal.fire({title: 'Emm...', text: '出错了,找管理员修理修理!', icon: 'error', timer: 3000});
        },
        success: function success(data) {
          if (data.code === 0) {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'success', timer: 3000});
            $('#addModal').modal('hide');
            $('#table').bootstrapTable('refresh');
          } else {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'error', timer: 3000});
          }
        }
      });
    }

    //getData方法获取全部页面数据后，将data转为json对象，使用index当前行号作为下标获取对应数据
    function upd(id, pid, sort, permission_id){
      $.ajax({
        url: '/admin/sys/menu/store_or_add_show',
        method: "POST",
        data: {
          "pid": pid,
        },
        dataType: "json",
        error:function(){
          Swal.fire({title: 'Emm...', text: '出错了,找管理员修理修理!', icon: 'error', timer: 3000});
        },
        success: function success(data) {
          if (data.code === 0) {

            var html = '<div class="row"> ' +
                    '<div class="form-group col-6">' +
                    '<label class="control-label" for="store_name">菜单名:</label> ' +
                    '<select class="form-control" name="type" size="8" id="upd_permission_id">';
            for(var i = 0; i < data.data.length; i++) {
              html +='<option value="'+ data.data[i].id +'"';
              if(data.data[i].id === parseInt(permission_id)) {
                html += 'selected';
              }
              html += '>'+ data.data[i].name +'</option>';
            }
            html +='</select></div>' +
                    '    <div class="form-group col-6">\n' +
                    '        <label class="control-label">排序:</label>\n' +
                    '        <input type="text" class="form-control" name="sort" id="upd_sort" value="' + sort + '" required>\n' +
                    '    </div>' +
                    '</div>';
            $(" #upd_form ").html(html);

            if (parseInt(pid) === 0) {
              $("#updModalLabel").text('编辑父级菜单')
            } else {
              $("#updModalLabel").text('编辑子菜单')
            }

            $(" #upd_id ").val(id);
            $(" #upd_pid ").val(pid);
            $(" #updModal ").modal('show')
          } else {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'error', timer: 3000});
          }
        }
      });
    }

    function doUpd() {
      $.ajax({
        url: '/admin/sys/menu/upd',
        method: "POST",
        data: {
          "id": $(" #upd_id ").val(),
          "pid": $(" #upd_pid ").val(),
          "permission_id": $(" #upd_permission_id ").val(),
          "sort": $(" #upd_sort ").val(),
        },
        dataType: "json",
        error:function(){
          Swal.fire({title: 'Emm...', text: '出错了,找管理员修理修理!', icon: 'error', timer: 3000});
        },
        success: function success(data) {
          if (data.code === 0) {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'success', timer: 3000});
            $('#updModal').modal('hide')
            $('#table').bootstrapTable('refresh');
          } else {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'error', timer: 3000});
          }
        }
      });
    }

    function del(id, pid) {
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
            url: '/admin/sys/menu/del',
            method: "POST",
            data: {
              "id": id,
              "pid": pid,
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
  </script>
@stop