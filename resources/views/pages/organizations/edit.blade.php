@extends('layouts.master')

@section('content')
{{--   <section class="content-header">
    <h1>
      Doanh nghiệp
    </h1>
  </section> --}}
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @include('includes.message')
        <div class="clearfix"></div>
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Chỉnh sửa thông tin</h3>
            </div>
            <form method="post" action="{{ route('organization.postEdit') }}">
              {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{ $organization->id }}">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Tên doanh nghiệp</label>
                        <div>
                          <input type="text" name="name" value="{{ $organization->name }}" class="form-control"placeholder="Tên doanh nghiệp">
                          @if($errors->has('name'))
                            <p style="color:red">{{$errors->first('name')}}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Địa chỉ</label>
                        <div>
                          <input type="text" name="address" class="form-control" value="{{ $organization->address }}"" placeholder="Địa chỉ">
                          @if($errors->has('address'))
                            <p style="color:red">{{$errors->first('address')}}</p>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Số điện thoại</label>

                        <div>
                            <input type="text" name="phone" class="form-control" value="{{ $organization->phone }}"" placeholder="Số điện thoại">
                            @if($errors->has('phone'))
                              <p style="color:red">{{$errors->first('phone')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Ngày thành lập</label>
                        <div>
                            <input type="text" name="start_time" @if($organization->start_time) value="{{  date('d/m/Y', strtotime($organization->start_time)) }}" @endif id="datepicker" class="form-control" placeholder="Ngày thành lập">
                            @if($errors->has('start_time'))
                              <p style="color:red">{{$errors->first('start_time')}}</p>
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <a href="{{ url()->previous() }}" class="btn btn-fixed-size btn-default pull-right">Quay lại</a>
                  <button type="submit" class="btn btn-info btn-fixed-size">Lưu</button>
                </div>
              </form>
            </div>
      </div>
    </div>
  </section>
@endsection
@section('js')
  <script>
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'd/m/Y',
    })
  </script>
@endsection