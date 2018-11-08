@extends('layouts.master')

@section('content')
    <section class="content" style="padding: 15px;">
    <div class="box box-primary" id="app" v-cloak>
        <div class="box-header with-border">
            <h3 class="box-title text-info">Danh sách Nhân viên</h3>
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
                        abc
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </div>
</section>
@endsection