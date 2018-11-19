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
            <h3 class="box-title">Chỉnh sửa thông tin</h3>
          </div>
          <form method="post" action="{{ route('table.postEdit') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $table->id }}">
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Tên bàn</label>
                    <div>
                      <input type="text" name="name" value="{{ $table->name }}" class="form-control">
                      @if($errors->has('name'))
                        <p style="color:red">{{$errors->first('name')}}</p>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Vị trí</label>
                    <div>
                      <input type="text" name="location" value="{{ $table->location }}" class="form-control">
                      @if($errors->has('location'))
                        <p style="color:red">{{$errors->first('location')}}</p>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Mô tả</label>
                    <div>
                      <input type="text" name="description" value="{{ $table->description }}" class="form-control">
                      @if($errors->has('description'))
                        <p style="color:red">{{$errors->first('description')}}</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info btn-fixed-size">Lưu</button>
              <a href="{{ url()->previous() }}" class="btn btn-default pull-right">Quay lại</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection