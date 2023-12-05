@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Guru (Total : {{ $getRecord->total() }})</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
                <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">Add New Guru</a>
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
                  <h3 class="card-title">Search Guru</h3>
              </div>
                  <form method="get" action="">
                      <div class="card-body">
                          <div class="row">
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
                              <div class="form-group col-md-2">
                                  <label>Jenis Kelamin</label>
                                  <select class="form-control" name="jenis_kelamin">
                                    <option value="">Jenis Kelamin</option>
                                    <option {{ (Request::get('jenis_kelamin') == 'Laki-Laki') ? 'selected' : '' }} value="Laki-Laki">Laki-Laki</option>
                                    <option {{ (Request::get('jenis_kelamin') == 'Perempuan') ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                                    <option {{ (Request::get('jenis_kelamin') == 'Lainnya') ? 'selected' : '' }} value="Lainnya">Lainnya</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-2">
                                  <label>Nomer Telepon</label>
                                  <input type="text" class="form-control" name="no_telepon" value="{{ Request::get('no_telepon') }}" placeholder="Nomer Telepon">
                              </div>
                              <div class="form-group col-md-2">
                                  <label>Status Pernikahan</label>
                                  <input type="text" class="form-control" name="marital_status" value="{{ Request::get('marital_status') }}" placeholder="Alamat Saat Ini">
                              </div>
                              <div class="form-group col-md-2">
                                  <label>Alamat Saat Ini</label>
                                  <input type="text" class="form-control" name="address" value="{{ Request::get('address') }}" placeholder="Status Pernikahan">
                              </div>
                              <div class="form-group col-md-2">
                                  <label>Status</label>
                                  <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    <option {{ (Request::get('status') == 100) ? 'selected' : '' }} value="100">Active</option>
                                    <option {{ (Request::get('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-2">
                                  <label>Tanggal Masuk</label>
                                  <input type="date" class="form-control" name="tanggal_masuk" value="{{ Request::get('tanggal_masuk') }}">
                              </div>
                              <div class="form-group col-md-2">
                                  <label>Tanggal Pembuatan</label>
                                  <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}" placeholder="Email">
                              </div>
                              <div class="form-group col-md-3">
                                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Search</button>
                                  <a href="{{ url('admin/teacher/list') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>


          @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Guru</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Foto</th>
                      <th>Nama Guru</th>
                      <th>Email</th>
                      <th>Jenis Kelamin</th>
                      <th>Tanggal Lahir</th>
                      <th>Tanggal Masuk</th>
                      <th>Nomer Telepon</th>
                      <th>Status Pernikahan</th>
                      <th>Alamat</th>
                      <th>Alamat Asli</th>
                      <th>Kualifikasi</th>
                      <th>Pengalaman Kerja</th>
                      <th>Catatan</th>
                      <th>Status</th>
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
                        <td>{{ $value->jenis_kelamin }}</td>
                        <td>
                            @if(!empty($value->tanggal_lahir ))
                              {{ date('d-m-Y', strtotime($value->tanggal_lahir)) }}
                            @endif
                        </td>
                        <td>
                            @if(!empty($value->tanggal_masuk ))
                              {{ date('d-m-Y', strtotime($value->tanggal_masuk)) }}
                            @endif
                        </td>
                        <td>{{ $value->no_telepon }}</td>
                        <td>{{ $value->status_pernikahan }}</td>
                        <td>{{ $value->alamat }}</td>
                        <td>{{ $value->alamat_asli }}</td>
                        <td>{{ $value->kualifikasi }}</td>
                        <td>{{ $value->pengalaman_kerja }}</td>
                        <td>{{ $value->note }}</td>
                        <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                        <td style="min-width: 150px;"> 
                            <a href="{{ url('admin/teacher/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ url('admin/teacher/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
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