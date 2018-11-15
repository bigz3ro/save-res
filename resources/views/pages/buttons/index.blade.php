@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
          Quản lí nút bấm
        </h1>
    </section>
    <section class="content">
      @include('includes.message')
      <div class="box box-primary" id="app">
          <div class="box-header with-border">
            <h3 class="box-title text-info">Danh sách nút bấm</h3>
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
                <div class="box">
                  <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <th>ID</th>
                            <th>Serial number</th>
                            <th>Command</th>
                            <th>Ngày tạo</th>
                            <th class="text-right">Thao tác</th>
                          </tr>
                          @foreach ($buttons as $button)
                          <tr>
                            <td>{{ $button->id }}</td>
                            <td>{{ $button->serial_number }}</td>
                            <td>{{ $button->command }}</td>
                            <td>
                              {{ date('d/m/Y', strtotime($button->created_at)) }}
                            </td>
                            <td class="text-right">
                              <a class="btn btn-sm btn-default" href="{{ route('button.getEdit', ['id' => $button->id]) }}"><i class="fa fa-pencil"></i></a>
                              <a class="btn btn-sm btn-default" onclick="deleteButton({{ $button->id }})"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
          </div>
          <div class="row">
            <div class="col-md-12" class="text-right">
              {{ $buttons->appends([])->links() }}
            </div>
          </div>
        </div>
    </section>
    <form action="{{ route('button.delete') }}" method="post" id="delete-button">
      {!! csrf_field() !!}
      <input name="id" id="button_id" type="hidden" value="">
    </form>
@endsection
@section('js')
  <script>
    function deleteButton(id) {
      $('#delete-button #button_id').val(id);
      confirmModal.showConfirm('Bạn có chắc chắn muốn xóa không ?', 'danger', function () {
        $('#delete-button').submit();
      });
    }
  </script>
@endsection