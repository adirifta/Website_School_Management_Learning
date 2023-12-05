@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Guru</h1>
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
                            <input type="text" class="form-control" value="{{ old('name', $getRecord->name) }}" name="name" required placeholder="First Name">
                            <div style="color:red">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name', $getRecord->last_name) }}" name="last_name" required placeholder="Last Name">
                            <div style="color:red">{{ $errors->first('last_name') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin <span style="color: red;">*</span></label>
                            <select class="form-control" required name="jenis_kelamin">
                                <option value="">Select Jenis Kelamin</option>
                                <option {{ (old('jenis_kelamin', $getRecord->jenis_kelamin) == 'Laki-Laki') ? 'selected' : '' }} value="Laki-Laki">Laki-Laki</option>
                                <option {{ (old('jenis_kelamin', $getRecord->jenis_kelamin) == 'Perempuan') ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                                <option {{ (old('jenis_kelamin', $getRecord->jenis_kelamin) == 'Lainnya') ? 'selected' : '' }} value="Lainnya">Lainnya</option>
                            </select>
                            <div style="color:red">{{ $errors->first('jenis_kelamin') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Lahir <span style="color: red;"></span></label>
                            <input type="date" class="form-control" required value="{{ old('tanggal_lahir', $getRecord->tanggal_lahir) }}" name="tanggal_lahir">
                            <div style="color:red">{{ $errors->first('tanggal_lahir') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Masuk <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" value="{{ old('tanggal_masuk', $getRecord->tanggal_masuk) }}" name="tanggal_masuk" required>
                            <div style="color:red">{{ $errors->first('tanggal_masuk') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomer Telepon <span style="color: red;"></span></label>
                            <input type="text" class="form-control" value="{{ old('no_telepon', $getRecord->no_telepon) }}" name="no_telepon" placeholder="Nomer Telepon">
                            <div style="color:red">{{ $errors->first('no_telepon') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status Pernikahan <span style="color: red;"></span></label>
                            <input type="text" class="form-control" value="{{ old('status_pernikahan', $getRecord->status_pernikahan) }}" name="status_pernikahan" placeholder="Status Pernikahan">
                            <div style="color:red">{{ $errors->first('status_pernikahan') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Foto Profil <span style="color: red;"></span></label>
                            <input type="file" class="form-control" name="profile_pic">
                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                            @if(!empty($getRecord->getProfile()))
                                <img src="{{ $getRecord->getProfile() }}" style="width: auto;height: 50px;">
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Alamat Saat Ini <span style="color: red;">*</span></label>
                            <textarea class="form-control" name="alamat" value="{{ old('alamat', $getRecord->alamat) }}"></textarea>
                            <div style="color:red">{{ $errors->first('alamat') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Alamat Asli <span style="color: red;"></span></label>
                            <textarea class="form-control" name="alamat_asli" value="{{ old('alamat_asli', $getRecord->alamat_asli) }}"></textarea>
                            <div style="color:red">{{ $errors->first('alamat_asli') }}</div>
                        </div><div class="form-group col-md-6">
                            <label>Kualifikasi <span style="color: red;"></span></label>
                            <textarea class="form-control" name="kualifikasi" value="{{ old('kualifikasi', $getRecord->kualifikasi) }}"></textarea>
                            <div style="color:red">{{ $errors->first('kualifikasi') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pengalaman Kerja <span style="color: red;"></span></label>
                            <textarea class="form-control" name="pengalaman_kerja" value="{{ old('pengalaman_kerja', $getRecord->pengalaman_kerja) }}"></textarea>
                            <div style="color:red">{{ $errors->first('pengalaman_kerja') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Note <span style="color: red;"></span></label>
                            <textarea class="form-control" name="note" value="{{ old('note', $getRecord->note) }}"></textarea>
                            <div style="color:red">{{ $errors->first('note') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status <span style="color: red;">*</span></label>
                            <select class="form-control" required name="status">
                                <option value="">Select Status</option>
                                <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                            </select>
                            <div style="color:red">{{ $errors->first('status') }}</div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label>Email <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $getRecord->email) }}" required placeholder="Email">
                        <div style="color:red">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Password <span style="color: red;"></span></label>
                        <input type="text" class="form-control" name="password" placeholder="Password">
                        <p>Due you want to change password so please add new password</p>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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