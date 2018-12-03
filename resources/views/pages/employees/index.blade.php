@extends('layouts.master')

@section('content')
  {{-- <section class="content-header">
      <h1>
        {{ $moduleName }}
      </h1>
  </section> --}}
  <section class="content">
    @include('includes.message')
    <div class="box box-primary" id="app">
      <div class="box-header with-border">
        <h3 class="box-title text-info">Danh sách {{ $moduleName }}</h3>
        <div class="box-tools">
          <form action="{{ route('employee.index') }}" method="get">
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
                  <th>Họ tên</th>
                  <th>Tài khoản</th>
                  <th>Địa chỉ</th>
                  <th>Giới tính</th>
                  <th>Phone</th>
                  <th>Ngày sinh</th>
                  <th>Trạng thái</th>
                  <th class="text-right">Thao tác</th>
                </tr>
                @foreach ($employees as $employee)
                <tr>
                  <td>{{ $employee->id }}</td>
                  <td>{{ $employee->fullname }}</td>
                  <td>{{ $employee->account }}</td>
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
                    @foreach (config('employee.status_str') as $status_id => $status_name)
                      {{ ($status_id == $employee->status) ? $status_name : '' }}
                    @endforeach
                  </td>
                  <td class="text-right">
                    <button class="btn btn-sm btn-default"><i class="fa fa-flag"></i></button>
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
        <div class="col-md-12 text-center">
          {{ $employees->appends(['keyword' => $keyword])->links() }}
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
    {{-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script> --}}
    {{-- <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script>
        function deleteEmployee(id) {
          $('#delete-employee #employee_id').val(id);
          confirmModal.showConfirm('Bạn có chắc chắn muốn xóa nhân viên này không ?', 'danger', function () {
            $('#delete-employee').submit();
          });
        }

        var reconnection = true;
        var reconnectionDelay = 5000;
        var reconnectionTry = 0;

        function initClient() {
            var socket = "";
            var token = localStorage.getItem('token_auth');
            if (token) {
                connectClient(token);
            }
        }

        function connectClient(token) {
            var socket = "";
            socket = io.connect('http://localhost:9000', { query: "token=" + token });

            socket.on('connect', function (e) {
                routesClient(socket);
            });

            socket.on('connect_error', function (e) {
                reconnectionTry++;
                console.log("Reconnection attempt #" + reconnectionTry);
            });
            return false;
        }

        function routesClient(socket) {
            console.log('connected');

            socket.on('test', function (e) {
                console.log(e);
                socket.emit("test", "pong");
            });

            socket.on('disconnect', function () {
                socket.disconnect();
                console.log('client disconnected');

                if (reconnection === true) {
                    setTimeout(function () {
                        console.log('client trying reconnect');
                        connectClient(localStorage.getItem('token_auth'));
                    }, reconnectionDelay);
                }
            });

            return false;
        }

        window.onload = function () {
            initClient();
        }
    </script>
@endsection