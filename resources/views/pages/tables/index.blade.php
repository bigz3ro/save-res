@extends('layouts.master')

@section('content')
  {{-- <section class="content-header">
    <h1>
      Quản lí bàn
    </h1>
  </section> --}}
  <section class="content">
    @include('includes.message')
    <div class="box box-primary" id="app">
      <div class="box-header with-border">
        <h3 class="box-title text-info">Danh sách bàn</h3>
        <div class="box-tools">
          <form action="{{ route('table.index') }}" method="get">
            <div class="input-group input-group-sm" style="width: 350px;">
              <input type="text" name="keyword" class="form-control pull-right" value="{{ $keyword }}" placeholder="Tìm kiếm">
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
                  <th>Tên bàn</th>
                  <th>Vị trí</th>
                  <th>Mô tả</th>
                  <th>Ngày tạo</th>
                  <th class="text-right">Thao tác</th>
                </tr>
                @foreach ($tables as $table)
                  <tr>
                    <td>{{ $table->id }}</td>
                    <td>{{ $table->name }}</td>
                    <td>{{ $table->location }}</td>
                    <td>{{ $table->description }}</td>
                    <td>
                      {{ date('d/m/Y', strtotime($table->created_at)) }}
                    </td>
                    <td class="text-right">
                      <a class="btn btn-sm btn-default" href="{{ route('table.getEdit', ['id' => $table->id]) }}"><i class="fa fa-pencil"></i></a>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-list-user"><i class="fa fa-book"></i></button>
                      <a class="btn btn-sm btn-danger" onclick="deleteTable({{ $table->id }})"><i class="fa fa-trash"></i></a>
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
          {{ $tables->appends(['keyword' => $keyword])->links() }}
        </div>
      </div>

    </div>
  </section>

  {{-- Delete form  --}}
  <form action="{{ route('table.delete') }}" method="post" id="delete-table">
    {!! csrf_field() !!}
    <input name="id" id="table_id" type="hidden" value="">
  </form>
  {{-- Delete form  --}}

  {{-- Modal show list user  --}}
  <div id="modal-list-user" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Danh sách nhân viên</h4>
        </div>
        <div class="modal-body">
          <table class="table table-hover table-bordered">
            <tbody>
              <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Địa chỉ</th>
                <th>Giới tính</th>
                <th>Phone</th>
                <th>Ngày sinh</th>
                <th>Doanh nghiệp</th>
                <th class="text-right">Thao tác</th>
              </tr>
              @foreach ($employees as $employee)
              <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->fullname }}</td>
                <td>{{ $employee->address }}</td>
                <td>
                  @foreach (config('user.gender_str') as $genderID => $genderName)
                    @if ($genderID == $employee->gender)
                    {{ $genderName }}
                    @endif
                  @endforeach
                </td>
                <td>
                  {{ $employee->phone }}
                </td>
                <td>
                  {{ date('d/m/Y', strtotime($employee->birthday)) }}
                </td>
                <td>
                  {{ $employee->organization->name }}
                </td>
                <td class="text-right">
                  <a class="btn btn-sm btn-default" href="{{ route('employee.getEdit', ['id' => $employee->id]) }}"><i class="fa fa-pencil"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  {{-- Modal show list user  --}}

@endsection
@section('js')
  <script>
    function deleteTable(id) {
      $('#delete-table #table_id').val(id);
      confirmModal.showConfirm('Bạn có chắc chắn muốn xóa người này không ?', 'danger', function () {
        $('#delete-table').submit();
      });
    }
  </script>
@endsection