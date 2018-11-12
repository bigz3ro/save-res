@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Users
        </h1>
    </section>
    <section class="content">
      <div class="row">
          <div class="col-xs-6">
              <div class="box">
                  @include('includes.message')
                  <div class="clearfix"></div>
                  <!-- /.box-header -->
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Tạo user</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('user.postCreate') }}">
                      {!! csrf_field() !!}
                      <div class="box-body">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Họ và tên</label>

                          <div class="col-sm-9">
                            <input type="text" name="fullname" class="form-control"placeholder="Fullname">
                            @if($errors->has('fullname'))
                              <p style="color:red">{{$errors->first('fullname')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Email</label>

                          <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                            @if($errors->has('email'))
                              <p style="color:red">{{$errors->first('email')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Password</label>

                          <div class="col-sm-9">
                            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                            @if($errors->has('password'))
                              <p style="color:red">{{$errors->first('email')}}</p>
                            @endif
                          </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <a href="{{ route('user.getCreate') }}" class="btn btn-default">Hủy</a>
                        <button type="submit" class="btn btn-info pull-right">Đăng kí</button>
                      </div>
                      <!-- /.box-footer -->
                    </form>
                  </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
          </div>
      </div>
    </section>
@endsection