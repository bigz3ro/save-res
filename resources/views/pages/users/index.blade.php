@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Users
        </h1>
    </section>
    <section class="content">
      @include('includes.message')
      <div class="box box-primary" id="app">
            <div class="box-header with-border">
                <h3 class="box-title text-info">Danh sách nhân viên</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 550px;">
                        <input type="text" name="keyword" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="clearfix"></div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                  <tr>
                                    <th>ID</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Ngày tạo</th>
                                    <th class="text-right">Thao tác</th>
                                  </tr>
                                  @foreach ($users as $user)
                                  <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                      {{ date('d-m-Y', strtotime($user->created_at)) }}
                                    </td>
                                    {{-- <td><span class="label label-success">Approved</span></td> --}}
                                    <td class="text-right">
                                      <button class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-sm btn-default"><i class="fa fa-trash"></i></button>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <div class="row">
              <div class="col-md-12" class="text-right">
                {{ $users->appends([])->links() }}
              </div>
            </div>
        </div>
    </section>
@endsection