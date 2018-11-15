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
                    <form class="form-horizontal" method="post" action="{{ route('button.postEdit') }}">
                      {!! csrf_field() !!}
                      <input type="hidden" name="id" value="{{ $button->id }}">
                      <div class="box-body">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Serial Number</label>

                          <div class="col-sm-6">
                            <input type="text" name="serial_number" value="{{ $button->serial_number }}" class="form-control" placeholder="Serial number">
                            @if($errors->has('serial_number'))
                              <p style="color:red">{{$errors->first('serial_number')}}</p>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Command</label>

                          <div class="col-sm-6">
                            <input type="text" name="command" value="{{ $button->command }}" class="form-control" placeholder="Command">
                            @if($errors->has('command'))
                              <p style="color:red">{{$errors->first('command')}}</p>
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