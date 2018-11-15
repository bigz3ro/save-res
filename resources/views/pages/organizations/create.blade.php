@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Doanh nghiệp
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
                      <h3 class="box-title">Tạo doanh nghiệp mới</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('organization.postCreate') }}">
                      {!! csrf_field() !!}
                      <div class="box-body">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Tên doanh nghiệp</label>

                          <div class="col-sm-6">
                            <input type="text" name="name" value="{{ old('name') }}"" class="form-control"placeholder="Tên doanh nghiệp">
                            @if($errors->has('name'))
                              <p style="color:red">{{$errors->first('name')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Địa chỉ</label>

                          <div class="col-sm-6">
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Địa chỉ">
                            @if($errors->has('address'))
                              <p style="color:red">{{$errors->first('address')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Số điện thoại</label>

                          <div class="col-sm-6">
                            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại">
                            @if($errors->has('phone'))
                              <p style="color:red">{{$errors->first('phone')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group date">
                          <label class="col-sm-2 control-label">Ngày thành lập</label>
                          <div class="col-sm-6">
                            <input type="text" name="start_time" id="datepicker" class="form-control" placeholder="Ngày thành lập">
                            @if($errors->has('start_time'))
                              <p style="color:red">{{$errors->first('start_time')}}</p>
                            @endif
                          </div>
                        </div>

                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-info">Tạo mới</button>
                        <a href="{{ route('organization.getCreate') }}" class="btn btn-default pull-right">Hủy</a>
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
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'd/m/yyyy'
    })
  </script>
@endsection