@extends('layouts.master')

@section('content')
  {{-- <section class="content-header">
    <h1>
      Doanh nghiệp
    </h1>
  </section> --}}
  <section class="content">
    @include('includes.message')
    <div class="box box-primary" id="app">
      <div class="box-header with-border">
        <h3 class="box-title text-info">Danh sách doanh nghiệp</h3>
        <div class="box-tools">
          <form action="{{ route('organization.index') }}" method="get">
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
                  <th>Tên doanh nghiệp</th>
                  <th>Địa chỉ</th>
                  <th>Số điện thoại</th>
                  <th>Ngày thành lập</th>
                  <th class="text-right">Thao tác</th>
                </tr>
                @foreach ($organizations as $organization)
                <tr>
                  <td>{{ $organization->id }}</td>
                  <td>{{ $organization->name }}</td>
                  <td>{{ $organization->address }}</td>
                  <td>{{ $organization->phone }}</td>
                  <td>{{ date('d/m/Y', strtotime($organization->start_time)) }}</td>
                  <td class="text-right">
                    <a class="btn btn-sm btn-default" href="{{ route('organization.getEdit', ['id' => $organization->id]) }}"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-sm btn-danger" onclick="deleteOrganization({{ $organization->id }})"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" class="text-center">
          {{ $organizations->appends(['keyword' => $keyword])->links() }}
        </div>
      </div>
    </div>
  </section>
  <form action="{{ route('organization.delete') }}" method="post" id="delete-organization">
    {!! csrf_field() !!}
    <input name="id" id="organization_id" type="hidden" value="">
  </form>
@endsection
@section('js')
  <script>
    function deleteOrganization(id) {
      $('#delete-organization #organization_id').val(id);
      confirmModal.showConfirm('Bạn có chắc chắn muốn xóa doanh nghiệp này không ?', 'danger', function () {
        $('#delete-organization').submit();
      });
    }
  </script>
@endsection