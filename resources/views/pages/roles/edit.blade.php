@extends('layouts.master')

@section('content')
  {{-- <section class="content-header">
    <h1>
      Roles
    </h1>
  </section> --}}
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @include('includes.message')
        <div class="clearfix"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Chỉnh sửa</h3>
          </div>
          <form method="post" action="{{ route('role.postEdit', ['id' => $role->id]) }}">
            {!! csrf_field() !!}
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Role</label>
                    <div>
                      <input type="text" name="name" class="form-control" value="{{ $role->name }}"" placeholder="Tên role">
                      @if($errors->has('role'))
                        <p style="color:red">{{$errors->first('role')}}</p>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Tên hiển thị</label>
                    <div>
                      <input type="text" name="display_name" class="form-control" value="{{ $role->display_name }}" placeholder="Tên hiển thị">
                      @if($errors->has('display_name'))
                        <p style="color:red">{{ $errors->first('display_name') }}</p>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Mô tả</label>
                    <div>
                      <textarea name="description" class="form-control" placeholder="Mô tả">{{ $role->description }}</textarea>
                      @if($errors->has('description'))
                        <p style="color:red">{{ $errors->first('description') }}</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Chọn quyền</label>
                <div>
                  <div class="row">
                    @foreach($permissions as $i => $value)
                    @if ($i%2 == 0)
                    <div class="col-md-4">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="permission[]" value="{{ $value->id }}" @if(in_array($value->id, $rolePermissions)) checked @endif> {{$value->display_name}}
                        </label>
                      </div>
                    </div>
                    @else
                    <div class="col-md-4">
                      <div class="checkbox">
                        <label>
                        <input type="checkbox" name="permission[]" value="{{ $value->id }}" @if(in_array($value->id, $rolePermissions)) checked @endif> {{$value->display_name}}
                        </label>
                      </div>
                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <a href="{{ url()->previous() }}" class="btn pull-right btn-default btn-fixed-size">Quay lại</a>
              <button type="submit" class="btn btn-info btn-fixed-size">Lưu</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection