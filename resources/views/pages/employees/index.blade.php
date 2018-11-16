@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
          {{ $moduleName }}
        </h1>
    </section>
  <section class="content">
    @include('includes.message')
    <div class="box box-primary" id="app">
      <div class="box-header with-border">
        <h3 class="box-title text-info">Danh sách {{ $moduleName }}</h3>
        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 550px;">
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
          <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
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
                          <a class="btn btn-sm btn-danger" onclick="deleteEmployee({{ $employee->id }})"><i class="fa fa-trash"></i></a>
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
          {{ $employees->appends([])->links() }}
        </div>
      </div>
    </div>
  </section>
  <form action="{{ route('employee.delete') }}" method="post" id="delete-employee">
    {!! csrf_field() !!}
    <input name="id" id="employee_id" type="hidden" value="">
  </form>
@endsection
@section('js')
  <script>
    function deleteEmployee(id) {
      $('#delete-employee #employee_id').val(id);
      confirmModal.showConfirm('Bạn có chắc chắn muốn xóa nhân viên này không ?', 'danger', function () {
        $('#delete-employee').submit();
      });
    }
  </script>
@endsection