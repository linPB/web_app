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
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>菜单名</th>
                    <th>PATH</th>
                    <th>排序</th>
                    <th>操作</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($menus as $menu)
                  <tr>
                      <td>#{{$menu['id']}}</td>
                      <td>{{$menu['permission']['name']}}</td>
                      <td>{{$menu['permission']['path']}}</td>
                      <td>{{$menu['sort']}}</td>
                      <td>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                          <label class="btn btn-secondary">
                            <input type="radio" name="options" onclick="store('{{$menu['id']}}')"> 添加
                          </label>
                          <label class="btn btn-secondary">
                            <input type="radio" name="options" onclick="upd('{{$menu['id']}}', '{{$menu['pid']}}', '{{$menu['sort']}}', '{{$menu['permission_id']}}')"> 编辑
                          </label>
                          <label class="btn btn-secondary">
                            <input type="radio" name="options" onclick="del('{{$menu['id']}}', '{{$menu['pid']}}')"> 删除
                          </label>
                        </div>
                      </td>
                  </tr>
                    @foreach($menu['child'] as $child)
                    <tr>
                      <td>#{{$child['id']}}</td>
                      <td style="text-align: right">{{$child['permission']['name']}}</td>
                      <td style="text-align: right">{{$child['permission']['path']}}</td>
                      <td>{{$child['sort']}}</td>
                      <td style="text-align: right">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                          <label class="btn btn-secondary">
                            <input type="radio" name="options" onclick="upd('{{$child['id']}}', '{{$child['pid']}}', '{{$child['sort']}}', '{{$child['permission_id']}}')"> 编辑
                          </label>
                          <label class="btn btn-secondary">
                            <input type="radio" name="options" onclick="del('{{$child['id']}}', '{{$child['pid']}}')"> 删除
                          </label>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
    function store(type) {
      $.ajax({
        url: '/admin/sys/menu/show',
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
            //Swal.fire({title: 'Emm...', text: data.msg, icon: 'success', timer: 3000});
            //$('#addModal').modal('hide');
            location.reload();
          } else {
            Swal.fire({title: 'Emm...', text: data.msg, icon: 'error', timer: 3000});
          }
        }
      });
    }

    //getData方法获取全部页面数据后，将data转为json对象，使用index当前行号作为下标获取对应数据
    function upd(id, pid, sort, permission_id){
      $.ajax({
        url: '/admin/sys/menu/show',
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
            //Swal.fire({title: 'Emm...', text: data.msg, icon: 'success', timer: 3000});
            //$('#updModal').modal('hide')
            location.reload();
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
                //Swal.fire({title: 'Emm...', text: data.msg, icon: 'success', timer: 3000});
                location.reload();
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