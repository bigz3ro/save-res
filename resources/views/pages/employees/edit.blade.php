@extends('layouts.master')

@section('content')
  {{-- <section class="content-header">
    <h1>
      {{ $moduleName }}
    </h1>
  </section> --}}
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @include('includes.message')
        <div class="clearfix"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tạo {{$moduleName}} mới</h3>
          </div>
          <form method="post" action="{{ route('employee.postEdit') }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <input type="hidden" value="{{ $employee->id }}" name="id">
                    <div class="form-group">
                      <label class="control-label">Họ và tên <span class="text-danger">*</span></label>
                      <div>
                        <input type="text" name="fullname" value="{{ $employee->fullname }}"" class="form-control"placeholder="Fullname">
                        @if($errors->has('fullname'))
                          <p style="color:red">{{$errors->first('fullname')}}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Địa chỉ <span class="text-danger">*</span></label>
                      <div>
                        <input type="text" name="address" value="{{ $employee->address }}" class="form-control" placeholder="Địa chỉ">
                        @if($errors->has('address'))
                          <p style="color:red">{{$errors->first('address')}}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Phone <span class="text-danger">*</span></label>
                      <div>
                        <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control" placeholder="Phone">
                        @if($errors->has('phone'))
                          <p style="color:red">{{$errors->first('phone')}}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">CMND <span class="text-danger">*</span></label>
                      <div>
                        <input type="text" name="cmnd" value="{{ $employee->cmnd }}" class="form-control" placeholder="Cmnd">
                        @if($errors->has('cmnd'))
                          <p style="color:red">{{$errors->first('cmnd')}}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Ngày sinh <span class="text-danger">*</span></label>

                      <div>
                        <input type="text" name="birthday" value="{{ date('d/m/Y', strtotime($employee->birthday)) }}" class="form-control datepicker" placeholder="Ngày sinh">
                        @if($errors->has('birthday'))
                          <p style="color:red">{{$errors->first('birthday')}}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Giới tính <span class="text-danger">*</span></label>
                      <div>
                        <select class="form-control" name="gender" id="gender">
                          <option value="">Chọn giới tính</option>
                          @foreach(config('user.gender_str') as $genderId => $genderName)
                          <option value="{{ $genderId }}" @if($employee->gender === $genderId) selected @endif>{{ $genderName }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('gender'))
                          <p style="color:red">{{$errors->first('gender')}}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Doanh nghiệp</label>
                      <div>
                        <select class="form-control" name="organization" id="organization">
                          <option value="">Chọn doanh nghiệp</option>
                          @foreach($organizations as $organization)
                            <option value="{{ $organization->id }}" @if($organization->id == $employee->organization->id) selected @endif>{{ $organization->name }}</option>
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
                    <div class="form-group">
                      <label class="control-label">Mật khẩu</label>
                      <div>
                        <input type="text" name="password" class="form-control"placeholder="Mật khẩu mới">
                        @if($errors->has('password'))
                          <p style="color:red">{{$errors->first('password')}}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-info btn-fixed-size pull-right">Lưu</button>
                <a href="{{ route('employee.getCreate') }}" class="btn btn-default btn-fixed-size">Hủy</a>
              </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection