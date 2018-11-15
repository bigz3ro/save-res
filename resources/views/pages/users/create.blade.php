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
            @include('includes.message')
            <div class="clearfix"></div>
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Tạo người dùng mới</h3>
              </div>

              <form class="form-horizontal" method="post" action="{{ route('user.postCreate') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Họ và tên <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                      <input type="text" name="fullname" value="{{ old('fullname') }}"" class="form-control"placeholder="Fullname">
                      @if($errors->has('fullname'))
                        <p style="color:red">{{$errors->first('fullname')}}</p>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                      <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                      @if($errors->has('email'))
                        <p style="color:red">{{$errors->first('email')}}</p>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Role <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
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

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Ảnh đại diện </label>
                    <div class="col-sm-6">
                      <input type="file" name="avatar" class="form-control" placeholder="Ảnh đại diện">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nhập mật khẩu <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                      <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                      @if($errors->has('password'))
                        <p style="color:red">{{$errors->first('password')}}</p>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nhập lại mật khẩu <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                      <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu">
                      @if($errors->has('confirm_password'))
                        <p style="color:red">{{$errors->first('confirm_password')}}</p>
                      @endif
                    </div>
                  </div>

                <div class="box-footer">
                  <button type="submit" class="btn btn-info">Tạo mới</button>
                  <a href="{{ route('user.getCreate') }}" class="pull-right btn btn-default">Hủy</a>
                </div>

              </form>
            </div>
          </div>
      </div>
    </section>
@endsection