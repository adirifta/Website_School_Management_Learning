@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Kelas Pembelajaran</h1>
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
              <form method="post" action="">
              {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <select class="form-control" name="class_id">
                            <option value="">Pilih Kelas</option>
                            @foreach($getClass as $class)
                              <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mata Pembalajaran</label>
                        @foreach($getSubject as $subject)
                            @php
                              $checked = "";
                            @endphp
                        <div>
                          <label style="font-weight: normal;">
                            <input {{ $checked }} type="checkbox" value="{{ $subject->id }}" name="subject_id[]" > {{ $subject->name }}
                          </label>
                        </div>  
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                            <option {{ ($getRecord->status == 1) ? 'selected' : ''}} value="1">Inactive</option>
                        </select>
                    </div>
                  

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