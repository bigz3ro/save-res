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
            <h3 class="box-title">Chỉnh sửa thông tin</h3>
          </div>
          <form method="post" action="{{ route('button.postEdit') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $button->id }}">
            <div class="box-body">
              <div class="form-group">
                <label class="control-label">Serial Number</label>
                <div>
                  <input type="text" name="serial_number" value="{{ $button->serial_number }}" class="form-control" placeholder="Serial number">
                  @if($errors->has('serial_number'))
                    <p style="color:red">{{$errors->first('serial_number')}}</p>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Command</label>
                <div>
                  <input type="text" name="command" value="{{ $button->command }}" class="form-control" placeholder="Command">
                  @if($errors->has('command'))
                    <p style="color:red">{{$errors->first('command')}}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="box-footer">
              <a href="{{ url()->previous() }}" class="btn btn-default pull-right">Quay lại</a>
              <button type="submit" class="btn btn-info">Lưu</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection