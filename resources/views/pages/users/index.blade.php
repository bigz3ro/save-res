@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Users
        </h1>
    </section>
    <section class="content">
      @include('includes.message')
      <div class="box box-primary" id="app">
          <div class="box-header with-border">
            <h3 class="box-title text-info">Danh sách nhân viên</h3>
            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 350px;">
                    <input type="text" name="keyword" class="form-control pull-right" placeholder="Search">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
              <div class="col-xs-12">
                  <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Doanh nghiệp</th>
                            <th>Ngày tạo</th>
                            <th class="text-right">Thao tác</th>
                          </tr>
                          @foreach ($users as $user)
                          <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                  {{ $role->display_name }}
                                @endforeach
                            </td>
                            <td>
                                @foreach($organizations as $organization)
                                  @if ($organization->id == $user->organization_id)
                                  {{ $organization->name }}
                                  @endif
                                @endforeach
                            </td>
                            <td>
                              {{ date('d/m/Y', strtotime($user->created_at)) }}
                            </td>
                            <td class="text-right">
                              <a class="btn btn-sm btn-default" href="{{ route('user.getEdit', ['id' => $user->id]) }}"><i class="fa fa-pencil"></i></a>
                              <a class="btn btn-sm btn-danger text-danger" onclick="deleteUser({{ $user->id }})"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  <!-- /.box-body -->
                <!-- /.box -->
              </div>
          </div>
          <div class="row">
            <div class="col-md-12" class="text-right">
              {{ $users->appends([])->links() }}
            </div>
          </div>
        </div>
    </section>
    <form action="{{ route('user.delete') }}" method="post" id="delete-user">
      {!! csrf_field() !!}
      <input name="id" id="user_id" type="hidden" value="">
    </form>
@endsection
@section('js')
  <script>
    function deleteUser(id) {
      $('#delete-user #user_id').val(id);
      confirmModal.showConfirm('Bạn có chắc chắn muốn xóa người này không ?', 'danger', function () {
        $('#delete-user').submit();
      });
    }
  </script>
@endsection