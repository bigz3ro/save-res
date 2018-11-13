@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Users
        </h1>
    </section>
    <section class="content">
      <div class="row">
          <div class="col-xs-12">
              <div class="box">
                  @include('includes.message')
                  <div class="clearfix"></div>
                  <!-- /.box-header -->
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Tạo người dùng mới</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('user.postCreate') }}">
                      {!! csrf_field() !!}
                      <div class="box-body">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Họ và tên</label>

                          <div class="col-sm-8">
                            <input type="text" name="fullname" value="{{ old('fullname') }}"" class="form-control"placeholder="Fullname">
                            @if($errors->has('fullname'))
                              <p style="color:red">{{$errors->first('fullname')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Email</label>

                          <div class="col-sm-8">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                            @if($errors->has('email'))
                              <p style="color:red">{{$errors->first('email')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nhập mật khẩu</label>

                          <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                            @if($errors->has('password'))
                              <p style="color:red">{{$errors->first('password')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nhập lại mật khẩu</label>

                          <div class="col-sm-8">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu">
                            @if($errors->has('confirm_password'))
                              <p style="color:red">{{$errors->first('confirm_password')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Role</label>

                          <div class="col-sm-8">
                            <select class="form-control" name="role" id="role">
                              <option value="">Chọn role</option>
                              @foreach($roles as $role)
                              <option value="{{ $role->id }}" @if (old('role') == $role->id) selected @endif>{{ $role->name }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('role'))
                              <p style="color:red">{{$errors->first('role')}}</p>
                            @endif
                          </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-info">Tạo mới</button>
                        <a href="{{ route('user.getCreate') }}" class="pull-right btn btn-default">Hủy</a>
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