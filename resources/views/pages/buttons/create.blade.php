@extends('layouts.master')

@section('content')
  <section class="content-header">
    <h1>
      Quản lý nút bấm
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @include('includes.message')
        <div class="clearfix"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tạo nút bấm</h3>
          </div>
          <form method="post" action="{{ route('button.postCreate') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
              <div class="form-group">
                <label class="control-label">Serial number<span class="text-danger">*</span></label>
                <div>
                  <input type="text" name="serial_number" value="{{ old('serial_number') }}"" class="form-control" placeholder="Serial number">
                  @if($errors->has('serial_number'))
                    <p style="color:red">{{$errors->first('serial_number')}}</p>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Command<span class="text-danger">*</span></label>
                <div>
                  <input type="text" name="command" value="{{ old('command') }}"" class="form-control" placeholder="Command">
                  @if($errors->has('command'))
                    <p style="color:red">{{$errors->first('command')}}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info btn-fixed-size">Tạo mới</button>
              <a href="{{ route('button.getCreate') }}" class="pull-right btn btn-default btn-fixed-size">Hủy</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection