@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Orang Tua</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-header">
              <form method="post" action="" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="First Name">
                            <div style="color:red">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" required placeholder="Last Name">
                            <div style="color:red">{{ $errors->first('last_name') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin <span style="color: red;">*</span></label>
                            <select class="form-control" required name="jenis_kelamin">
                                <option value="">Select Jenis Kelamin</option>
                                <option {{ (old('jenis_kelamin') == 'Laki-Laki') ? 'selected' : '' }} value="Laki-Laki">Laki-Laki</option>
                                <option {{ (old('jenis_kelamin') == 'Perempuan') ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                                <option {{ (old('jenis_kelamin') == 'Lainnya') ? 'selected' : '' }} value="Lainnya">Lainnya</option>
                            </select>
                            <div style="color:red">{{ $errors->first('jenis_kelamin') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pekerjaan <span style="color: red;"></span></label>
                            <input type="text" class="form-control" value="{{ old('pekerjaan') }}" name="pekerjaan" placeholder="Pekerjaan">
                            <div style="color:red">{{ $errors->first('pekerjaan') }}</div>
                        </div>                     
                        <div class="form-group col-md-6">
                            <label>Nomer Telepon <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" required value="{{ old('no_telepon') }}" name="no_telepon" placeholder="Nomer Telepon">
                            <div style="color:red">{{ $errors->first('no_telepon') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Alamat <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" required value="{{ old('alamat') }}" name="alamat" placeholder="Alamat">
                            <div style="color:red">{{ $errors->first('pekerjaan') }}</div>
                        </div>   
                        <div class="form-group col-md-6">
                            <label>Foto Profil <span style="color: red;"></span></label>
                            <input type="file" class="form-control" name="profile_pic">
                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status <span style="color: red;">*</span></label>
                            <select class="form-control" required name="status">
                                <option value="">Select Status</option>
                                <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                            </select>
                            <div style="color:red">{{ $errors->first('status') }}</div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label>Email <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">
                        <div style="color:red">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Password <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" name="password" required placeholder="Password">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (left) -->
          <!-- right column -->
         
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection 