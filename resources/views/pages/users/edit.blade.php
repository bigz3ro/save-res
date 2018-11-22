@extends('layouts.master')

@section('content')
    {{-- <section class="content-header">
      <h1>
          Users
      </h1>
    </section> --}}
    <section class="content">
      @include('includes.message')
      <div class="clearfix"></div>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Chỉnh sửa thông tin</h3>
        </div>

        <form method="post" action="{{ route('user.postEdit') }}" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <input type="hidden" name="id" value="{{ $user->id }}" />

            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Họ và tên</label>
                    <div>
                      <input type="text" name="fullname" value="{{ $user->fullname }}" class="form-control"placeholder="Fullname">
                      @if($errors->has('fullname'))
                        <p style="color:red">{{$errors->first('fullname')}}</p>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <div>
                      <input type="email" name="email" class="form-control" value={{ $user->email }} placeholder="Email">
                      @if($errors->has('email'))
                        <p style="color:red">{{$errors->first('email')}}</p>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">
                      Doanh nghiệp <span class="text-danger">*</span>
                    </label>
                    <div>
                      <select class="form-control" name="organization" id="organization">
                        <option value=""></option>
                        @foreach($organizations as $organization)
                          <option value="{{ $organization->id }}" @if ($user->organization_id == $organization->id) selected @endif>{{ $organization->name }}</option>
                        @endforeach
                      </select>
                      @if($errors->has('organization'))
                        <p style="color:red">{{$errors->first('organization')}}</p>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Role</label>
                    <div>
                      <select class="form-control" name="roles[]" id="role">
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
                    <label class="control-label">Trạng thái</label>
                    <div>
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

                  <div class="form-group">
                    <label class="control-label">Ảnh đại diện </label>
                    <div>
                      <input type="file" name="avatar" class="form-control">
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-info btn-fixed-size">Lưu</button>
              <a href="{{ url()->previous() }}" class="btn btn-default btn-fixed-size pull-right">Quay lại</a>
            </div>
        </form>
      </div>
    </section>
@endsection