@extends('layouts.master')

@section('content')
  <section class="content-header">
    <h1>
      Quản lí bàn
    </h1>
  </section>
  <section class="content">
    @include('includes.message')
    <div class="box box-primary" id="app">
      <div class="box-header with-border">
        <h3 class="box-title text-info">Danh sách bàn</h3>
        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 550px;">
            <input type="text" name="keyword" class="form-control pull-right" placeholder="Search">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="clearfix"></div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
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
          {{ $tables->appends([])->links() }}
        </div>
      </div>

    </div>
  </section>
  <form action="{{ route('table.delete') }}" method="post" id="delete-table">
    {!! csrf_field() !!}
    <input name="id" id="table_id" type="hidden" value="">
  </form>
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