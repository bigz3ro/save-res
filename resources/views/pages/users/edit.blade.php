@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Users
        </h1>
    </section>
    <section class="content">
      <div class="col-xs-12">
        @include('includes.message')
        <div class="clearfix"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Chỉnh sửa thông tin</h3>
          </div>

          <form class="form-horizontal" method="post" action="{{ route('user.postEdit') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $user->id }}" />

              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Họ và tên</label>
                  <div class="col-sm-6">
                    <input type="text" name="fullname" value="{{ $user->fullname }}" class="form-control"placeholder="Fullname">
                    @if($errors->has('fullname'))
                      <p style="color:red">{{$errors->first('fullname')}}</p>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" value={{ $user->email }} placeholder="Email">
                    @if($errors->has('email'))
                      <p style="color:red">{{$errors->first('email')}}</p>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Role</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="role" id="role">
                      @foreach($roles as $role)
                      <option value="{{ $role->id }}" @if(in_array($role->id, $userRole)) selected @endif>{{ $role->name }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('role'))
                      <p style="color:red">{{$errors->first('role')}}</p>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Trạng thái</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="status" id="status">
                      @foreach(config('user_status.str_status') as $status_id => $name)
                      <option value="{{ $status_id }}" @if($user->status == $status_id) selected @endif>{{ $name }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('status'))
                      <p style="color:red">{{$errors->first('status')}}</p>
                    @endif
                  </div>
                </div>
              </div>

              <div class="box-footer">
                <a href="{{ url()->previous() }}" class="btn btn-default">Quay lại</a>
                <button type="submit" class="btn btn-info pull-right">Lưu</button>
              </div>
          </form>
        </div>
      </div>
    </section>
@endsection