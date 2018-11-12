@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Roles
        </h1>
    </section>
    <section class="content">
      <div class="row">
          <div class="col-xs-8">
            <div class="box">
              @include('includes.message')
              <div class="clearfix"></div>
                <!-- /.box-header -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Tạo role</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{ route('role.postCreate') }}">
                  {!! csrf_field() !!}
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Role</label>

                      <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" placeholder="Tên role">
                        @if($errors->has('role'))
                          <p style="color:red">{{$errors->first('role')}}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Tên hiển thị</label>

                      <div class="col-sm-9">
                        <input type="text" name="display_name" class="form-control" placeholder="Tên hiển thị">
                        @if($errors->has('display_name'))
                          <p style="color:red">{{ $errors->first('display_name') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Mô tả</label>

                      <div class="col-sm-9">
                        <textarea name="description" class="form-control" placeholder="Mô tả"></textarea>
                        @if($errors->has('description'))
                          <p style="color:red">{{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Chọn quyền</label>

                      <div class="col-sm-9">
                          <div class="row">
                            @foreach($permissions as $i => $value)
                            @if ($i%2 == 0)
                            <div class="col-md-6">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="permission[]" value="{{ $value->id }}"> {{$value->display_name}}
                                </label>
                              </div>
                            </div>
                            @else
                            <div class="col-md-6">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="permission[]" value="{{ $value->id }}"> {{$value->display_name}}
                                </label>
                              </div>
                            </div>
                            @endif
                            @endforeach
                          </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <a href="{{ route('role.getCreate') }}" class="btn btn-default">Hủy</a>
                    <button type="submit" class="btn btn-info pull-right">Tạo mới</button>
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