@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Orang Tua Siswa ({{ $getOrangtua->name }} {{ $getOrangtua->last_name }})</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Search Siswa</h3>
                    </div>
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>ID Siswa</label>
                                        <input type="text" class="form-control" value="{{ Request::get('id') }}" name="id" placeholder="ID Siswa">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Name">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('last_name') }}" name="last_name" placeholder="Last Name">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Search</button>
                                        <a href="{{ url('admin/orangtua/my-student/'.$orangtua_id) }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
                                </div>
                            </div>
                        </form>
                </div>
            </div>


          <!-- /.col -->
        

          @include('_message')

@if(!empty($getSearchStudent))
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Siswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>Id</th>
                                <th>Foto</th>
                                <th>Nama Siswa</th>   
                                <th>Email</th>
                                <th>Nama Orang Tua</th>
                                <th>Created Date</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>
                        @foreach($getSearchStudent as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>
                              @if(!empty($value->getProfile()))
                              <img src="{{ $value->getProfile() }}" style="height: 50px; width:50px; border-radius: 50px;">
                              @endif
                            </td>
                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->orangtua_name }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td style="min-width: 150px;"> 
                           
                                <a href="{{ url('admin/orangtua/assign_student_orangtua/'.$value->id.'/'.$orangtua_id)}}" class="btn btn-primary btn-sm">Add Siswa ke Orang Tua</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                    <div style="padding: 10px; float: right;">
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          @endif
          </div>
        
          <div class="col-md-13">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Orang Tua Siswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>Id</th>
                                <th>Foto</th>
                                <th>Nama Siswa</th>   
                                <th>Email</th>
                                <th>Nama Orang Tua</th>
                                <th>Created Date</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>
                        @foreach($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>
                              @if(!empty($value->getProfile()))
                              <img src="{{ $value->getProfile() }}" style="height: 50px; width:50px; border-radius: 50px;">
                              @endif
                            </td>
                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->orangtua_name }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td style="min-width: 150px;"> 
                           
                                <a href="{{ url('admin/orangtua/assign_student_orangtua_delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                    <div style="padding: 10px; float: right;">
                </div>
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection