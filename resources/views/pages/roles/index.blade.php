@extends('layouts.master')

@section('content')
  {{-- <section class="content-header">
    <h1>
      Roles
    </h1>
  </section> --}}
  <section class="content">
    @include('includes.message')
    <div class="box box-primary" id="app">
      <div class="box-header with-border">
        <h3 class="box-title text-info">Danh sách roles</h3>
        <div class="box-tools">
          <form action="{{ route('role.index') }}" method="get">
            <div class="input-group input-group-sm" style="width: 350px;">
              <input type="text" name="keyword" class="form-control pull-right" value="{{ $keyword }}" placeholder="Search">
              <div class="input-group-btn">
                  <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="clearfix"></div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
              <tbody>
                <tr>
                  <th>ID</th>
                  <th>Role</th>
                  <th>Mô tả</th>
                  <th>Ngày tạo</th>
                  <th class="text-right">Thao tác</th>
                </tr>
                @foreach($roles as $role)
                  <tr>
                    <td>
                      {{ $role->id }}
                    </td>
                    <td>
                      {{ $role->name }}
                    </td>
                    <td>
                      {{ $role->description }}
                    </td>
                    <td>
                      {{ date('d/m/Y', strtotime($role->created_at)) }}
                    </td>
                    <td class="text-right">
                      <a class="btn btn-sm btn-default" href="{{ route('role.getEdit', ['id' => $role->id]) }}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger" onclick="deleteRole({{ $role->id }})"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" class="text-right">
          {{ $roles->appends(['keyword' => $keyword])->links() }}
        </div>
      </div>
    </div>
  </section>

  <form action="{{ route('role.delete') }}" method="post" id="form-delete">
    {!! csrf_field() !!}
    <input name="id" id="role_id" type="hidden" value="">
  </form>
@endsection
@section('js')
  <script>
    function deleteRole(id) {
      $('#form-delete #role_id').val(id);
      confirmModal.showConfirm('Bạn có chắc chắn muốn xóa role này không ?', 'danger', function () {
        $('#form-delete').submit();
      });
    }
  </script>
@endsection