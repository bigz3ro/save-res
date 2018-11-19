@extends('layouts.master')

@section('content')
  <section class="content-header">
    <h1>
      Quản lý bàn
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @include('includes.message')
        <div class="clearfix"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tạo bàn mới</h3>
          </div>
          <form method="post" action="{{ route('table.postCreate') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Tên bàn <span class="text-danger">*</span></label>
                    <div>
                      <input type="text" name="name" value="{{ old('name') }}"" class="form-control"placeholder="Tên bàn">
                      @if($errors->has('name'))
                        <p style="color:red">{{$errors->first('name')}}</p>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Location <span class="text-danger">*</span></label>
                    <div>
                      <input type="text" name="location" value="{{ old('location') }}"" class="form-control"placeholder="Vị trí">
                      @if($errors->has('location'))
                        <p style="color:red">{{$errors->first('location')}}</p>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Mô tả <span class="text-danger">*</span></label>

                    <div>
                      <input type="text" name="description" value="{{ old('description') }}"" class="form-control"placeholder="Vị trí">
                      @if($errors->has('description'))
                        <p style="color:red">{{$errors->first('description')}}</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <div class="box-footer">
            <button type="submit" class="btn btn-info btn-fixed-size">Tạo mới</button>
            <a href="{{ route('table.getCreate') }}" class="pull-right btn btn-default btn-fixed-size">Hủy</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection