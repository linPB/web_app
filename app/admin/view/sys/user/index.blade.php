@extends('app_tpl.app')

@section('links')
@stop

@section('content')
  <div class="wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard v3</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v3</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Projects</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped projects">
                <thead>
                <tr>
                  <th style="width: 1%">
                    #
                  </th>
                  <th style="width: 20%">
                    Project Name
                  </th>
                  <th style="width: 30%">
                    Team Members
                  </th>
                  <th>
                    Project Progress
                  </th>
                  <th style="width: 8%" class="text-center">
                    Status
                  </th>
                  <th style="width: 20%">
                  </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    <a>
                      AdminLTE v3
                    </a>
                    <br/>
                    <small>
                      Created 01.01.2019
                    </small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar2.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar3.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar04.png">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: 57%">
                      </div>
                    </div>
                    <small>
                      57% Complete
                    </small>
                  </td>
                  <td class="project-state">
                    <span class="badge badge-success">Success</span>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    <a>
                      AdminLTE v3
                    </a>
                    <br/>
                    <small>
                      Created 01.01.2019
                    </small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar2.png">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-volumenow="47" aria-volumemin="0" aria-volumemax="100" style="width: 47%">
                      </div>
                    </div>
                    <small>
                      47% Complete
                    </small>
                  </td>
                  <td class="project-state">
                    <span class="badge badge-success">Success</span>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    <a>
                      AdminLTE v3
                    </a>
                    <br/>
                    <small>
                      Created 01.01.2019
                    </small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar2.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar3.png">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-volumenow="77" aria-volumemin="0" aria-volumemax="100" style="width: 77%">
                      </div>
                    </div>
                    <small>
                      77% Complete
                    </small>
                  </td>
                  <td class="project-state">
                    <span class="badge badge-success">Success</span>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    <a>
                      AdminLTE v3
                    </a>
                    <br/>
                    <small>
                      Created 01.01.2019
                    </small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar2.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar3.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar04.png">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-volumenow="60" aria-volumemin="0" aria-volumemax="100" style="width: 60%">
                      </div>
                    </div>
                    <small>
                      60% Complete
                    </small>
                  </td>
                  <td class="project-state">
                    <span class="badge badge-success">Success</span>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    <a>
                      AdminLTE v3
                    </a>
                    <br/>
                    <small>
                      Created 01.01.2019
                    </small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar04.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar5.png">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-volumenow="12" aria-volumemin="0" aria-volumemax="100" style="width: 12%">
                      </div>
                    </div>
                    <small>
                      12% Complete
                    </small>
                  </td>
                  <td class="project-state">
                    <span class="badge badge-success">Success</span>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    <a>
                      AdminLTE v3
                    </a>
                    <br/>
                    <small>
                      Created 01.01.2019
                    </small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar2.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar3.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar04.png">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-volumenow="35" aria-volumemin="0" aria-volumemax="100" style="width: 35%">
                      </div>
                    </div>
                    <small>
                      35% Complete
                    </small>
                  </td>
                  <td class="project-state">
                    <span class="badge badge-success">Success</span>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    <a>
                      AdminLTE v3
                    </a>
                    <br/>
                    <small>
                      Created 01.01.2019
                    </small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar04.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar5.png">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-volumenow="87" aria-volumemin="0" aria-volumemax="100" style="width: 87%">
                      </div>
                    </div>
                    <small>
                      87% Complete
                    </small>
                  </td>
                  <td class="project-state">
                    <span class="badge badge-success">Success</span>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    <a>
                      AdminLTE v3
                    </a>
                    <br/>
                    <small>
                      Created 01.01.2019
                    </small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar3.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar04.png">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-volumenow="77" aria-volumemin="0" aria-volumemax="100" style="width: 77%">
                      </div>
                    </div>
                    <small>
                      77% Complete
                    </small>
                  </td>
                  <td class="project-state">
                    <span class="badge badge-success">Success</span>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    <a>
                      AdminLTE v3
                    </a>
                    <br/>
                    <small>
                      Created 01.01.2019
                    </small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar3.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar04.png">
                      </li>
                      <li class="list-inline-item">
                        <img alt="Avatar" class="table-avatar" src="/adminlte/dist/img/avatar5.png">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-volumenow="77" aria-volumemin="0" aria-volumemax="100" style="width: 77%">
                      </div>
                    </div>
                    <small>
                      77% Complete
                    </small>
                  </td>
                  <td class="project-state">
                    <span class="badge badge-success">Success</span>
                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </a>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
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
@stop