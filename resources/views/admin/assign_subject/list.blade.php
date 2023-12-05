@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Kelas Pembelajaran</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
                <a href="{{ url('admin/assign_subject/add') }}" class="btn btn-primary">Add New Kelas Pembelajaran</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
        <div class="col-md-12">
            <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Search Kelas Pembelajaran</h3>
            </div>
                <form method="get" action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Nama Kelas</label>
                                <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder="Class Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Mata Pembelajaran</label>
                                <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" name="subject_name" placeholder="Subject Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}" placeholder="Email">
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Search</button>
                                <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


          <!-- /.col -->
        

          @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Kelas Pembelajaran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nama Kelas</th>
                      <th>Mata Pembelajaran</th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th>Tanggal</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($getRecord as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->subject_name }}</td>
                        <td>
                            @if( $value->status == 0)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>{{ $value->created_by_name }}</td>
                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                        <td>
                            <a href="{{ url('admin/assign_subject/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{ url('admin/assign_subject/edit_single/'.$value->id)}}" class="btn btn-primary">Edit Single</a>
                            <a href="{{ url('admin/assign_subject/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float: right;">
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection