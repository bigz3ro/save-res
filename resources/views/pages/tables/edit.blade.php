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
              <div class="box">
                  @include('includes.message')
                  <div class="clearfix"></div>
                  <!-- /.box-header -->
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Chỉnh sửa thông tin</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('table.postEdit') }}">
                      {!! csrf_field() !!}
                      <input type="hidden" name="id" value="{{ $table->id }}">
                      <div class="box-body">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Tên bàn</label>

                          <div class="col-sm-6">
                            <input type="text" name="name" value="{{ $table->name }}" class="form-control"placeholder="Tên bàn">
                            @if($errors->has('name'))
                              <p style="color:red">{{$errors->first('name')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Vị trí</label>

                          <div class="col-sm-6">
                            <input type="text" name="location" value="{{ $table->location }}" class="form-control"placeholder="Tên bàn">
                            @if($errors->has('location'))
                              <p style="color:red">{{$errors->first('location')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Mô tả</label>

                          <div class="col-sm-6">
                            <input type="text" name="description" value="{{ $table->description }}" class="form-control" placeholder="Tên bàn">
                            @if($errors->has('description'))
                              <p style="color:red">{{$errors->first('description')}}</p>
                            @endif
                          </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-default">Quay lại</a>
                        <button type="submit" class="btn btn-info pull-right">Lưu</button>
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