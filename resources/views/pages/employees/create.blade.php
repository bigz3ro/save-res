@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            {{ $moduleName }}
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
                      <h3 class="box-title">Tạo {{$moduleName}} mới</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('employee.postCreate') }}" enctype="multipart/form-data">
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
                          <label class="col-sm-2 control-label">Địa chỉ <span class="text-danger">*</span></label>

                          <div class="col-sm-6">
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Địa chỉ">
                            @if($errors->has('address'))
                              <p style="color:red">{{$errors->first('address')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Phone <span class="text-danger">*</span></label>

                          <div class="col-sm-6">
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Phone">
                            @if($errors->has('phone'))
                              <p style="color:red">{{$errors->first('phone')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">CMND <span class="text-danger">*</span></label>

                          <div class="col-sm-6">
                            <input type="text" name="cmnd" value="{{ old('cmnd') }}" class="form-control" placeholder="Cmnd">
                            @if($errors->has('cmnd'))
                              <p style="color:red">{{$errors->first('cmnd')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Ngày sinh <span class="text-danger">*</span></label>

                          <div class="col-sm-6">
                            <input type="text" name="birthday" value="{{ old('birthday') }}" class="form-control datepicker" placeholder="Ngày sinh">
                            @if($errors->has('birthday'))
                              <p style="color:red">{{$errors->first('birthday')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Giới tính <span class="text-danger">*</span></label>

                          <div class="col-sm-6">
                            <select class="form-control" name="gender" id="gender">
                              <option value="">Chọn giới tính</option>
                              @foreach(config('user.gender_str') as $genderId => $genderName)
                              <option value="{{ $genderId }}">{{ $genderName }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('gender'))
                              <p style="color:red">{{$errors->first('gender')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Doanh nghiệp</label>
                          <div class="col-sm-6">
                            <select class="form-control" name="organization" id="organization">
                              <option value="">Chọn doanh nghiệp</option>
                              @foreach($organizations as $organization)
                                <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('organization'))
                              <p style="color:red">{{$errors->first('organization')}}</p>
                            @endif
                          </div>
                          @if($errors->has('organization'))
                            <p style="color:red">{{$errors->first('organization')}}</p>
                          @endif
                        </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-info">Tạo mới</button>
                        <a href="{{ route('employee.getCreate') }}" class="pull-right btn btn-default">Hủy</a>
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
@section('js')
  <script>
    $(document).ready(function () {
      $('.datepicker').datepicker({
        autoclose: true,
        format: 'd/m/yyyy'
      });
    })
  </script>
@endsection