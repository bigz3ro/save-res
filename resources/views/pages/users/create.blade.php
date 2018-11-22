@extends('layouts.master')

@section('content')
    {{-- <section class="content-header">
      <h1>
          Users
      </h1>
    </section> --}}
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @include('includes.message')
          <div class="clearfix"></div>
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tạo người dùng mới</h3>
            </div>

            <form role="form" method="post" action="{{ route('user.postCreate') }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Họ và tên <span class="text-danger">*</span></label>
                      <div>
                        <input type="text" name="fullname" value="{{ old('fullname') }}"" class="form-control">
                        @if($errors->has('fullname'))
                          <p style="color:red">{{$errors->first('fullname')}}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Email <span class="text-danger">*</span></label>
                      <div>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                        @if($errors->has('email'))
                          <p style="color:red">{{$errors->first('email')}}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Role <span class="text-danger">*</span></label>
                      <div>
                        <select class="form-control" name="roles[]" id="role">
                          <option value=""></option>
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
                      <label class="control-label">
                        Doanh nghiệp <span class="text-danger">*</span>
                      </label>
                      <div>
                        <select class="form-control" name="organization" id="organization">
                          <option value=""></option>
                          @foreach($organizations as $organization)
                            <option value="{{ $organization->id }}" @if (old('organization') == $organization->id) selected @endif>{{ $organization->name }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('organization'))
                          <p style="color:red">{{$errors->first('organization')}}</p>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Ảnh đại diện </label>
                      <div>
                        <input type="file" name="avatar" class="form-control">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Nhập mật khẩu <span class="text-danger">*</span></label>
                      <div>
                        <input type="password" name="password" class="form-control">
                        @if($errors->has('password'))
                          <p style="color:red">{{$errors->first('password')}}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Nhập lại mật khẩu <span class="text-danger">*</span></label>
                      <div>
                        <input type="password" name="confirm_password" class="form-control">
                        @if($errors->has('confirm_password'))
                          <p style="color:red">{{$errors->first('confirm_password')}}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-info btn-fixed-size">Tạo mới</button>
                <a href="{{ route('user.getCreate') }}" class="pull-right btn btn-default btn-fixed-size">Hủy</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>
@endsection