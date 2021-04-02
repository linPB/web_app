@extends('app_tpl.app')

@section('links')
@stop

@section('content')
  <div class="wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">系统配置</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
{{--              <li class="breadcrumb-item active"><a class="btn btn-primary btn-sm" href="#">添加</a></li>--}}
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">添加用户</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i></button>
              </div>
            </div>
            <form role="form" class="form-horizontal" action="{{session('url.path')}}" method="GET">
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-form-label">页数</label>
                  <div class="col-sm-0.5">
                    <select class="custom-select" name="page_size">
                      <option value="5" @if(session('url.params')['page_size'] == 5) selected @endif>5</option>
                      <option value="10" @if(session('url.params')['page_size'] == 10) selected @endif>10</option>
                      <option value="50" @if(session('url.params')['page_size'] == 50) selected @endif>50</option>
                      <option value="100" @if(session('url.params')['page_size'] == 100) selected @endif>100</option>
                      <option value="200" @if(session('url.params')['page_size'] == 200) selected @endif>200</option>
                      <option value="300" @if(session('url.params')['page_size'] == 300) selected @endif>300</option>
                    </select>
                  </div>
                  <label class="col-form-label">姓名</label>
                  <div class="col-sm-1">
                    <input name="user_name" type="text" class="form-control" value="{{session('url.params')['user_name']}}">
                  </div>
                  <label class="col-form-label">邮箱</label>
                  <div class="col-sm-1">
                    <input name="email" type="text" class="form-control" value="{{session('url.params')['email']}}">
                  </div>
                  <label class="col-form-label">手机</label>
                  <div class="col-sm-1">
                    <input name="phone" type="text" class="form-control" value="{{session('url.params')['phone']}}">
                  </div>
                  <div class="btn-group">
                    <button type="submit" class="btn btn-info">搜索</button>
                    <button type="button" class="btn btn-info"><a style="color: white" href="/admin/sys/user/store">添加</a></button>
                  </div>
                </div>
              </div>
            </form>
            <div class="card-body p-0">
              <table class="table table-striped projects table-hover">
                <thead>
                <tr>
                  <th style="width: 1%">#ID</th>
                  <th>姓名</th>
                  <th>手机</th>
                  <th>邮箱</th>
                  <th>头像</th>
                  <th>登陆次数</th>
                  <th>最近登陆</th>
                  <th class="text-right">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rets as $ret)
                <tr>
                  <td>{{$ret->id}}</td>
                  <td>{{$ret->user_name}}</td>
                  <td>{{$ret->phone}}</td>
                  <td>{{$ret->email}}</td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="{{$ret->avatar_url}}">
                      </li>
                    </ul>
                  </td>
                  <td>{{$ret->login_num}}</td>
                  <td>
                    <a>{{$ret->last_login_at}}</a>
                    <br/>
                    <small>{{$ret->last_login_ip}}</small>
                  </td>
                  <td class="project-actions text-right">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary btn-sm"><a style="color: white" href="#">查看</a></button>
                      <button type="button" class="btn btn-info btn-sm"><a style="color: white" href="#">编辑</a></button>
                      <button type="button" class="btn btn-danger btn-sm del_one"><a style="color: white" href="javascript:;" target-id="{{$ret->id}}">删除</a></button>
                    </div>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              @include('layout.paginator')
            </div>
          </div>
        </div>
        <!-- /.row -->

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
    $(".del_one").click(function (event) {
      target = $(event.target);
      var id = target.attr("target-id");
      console.log(id);

      $.ajax({
        url: "/admin/sys/user/del",
        method: "POST",
        data: { "id": id },
        dataType: "json",
        success: function success(data) {
          console.log(data)
          alert(data.msg);
          if (data.code !== 0) {
            return;
          }

          //target.parent().parent().remove();
          target.parent().parent().parent().parent().remove();
        }
      });
    });
  </script>
@stop