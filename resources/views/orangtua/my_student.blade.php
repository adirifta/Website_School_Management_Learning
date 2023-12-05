@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Student</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
        <div class="col-md-12">

          <!-- /.col -->
        

          @include('_message')


          </div>
          <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Student</h3>
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
                           
                                <a href="{{ url('orangtua/assign_student_orangtua_delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
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