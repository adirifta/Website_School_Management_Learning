@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Subject</h1>
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
                        <label>Subject Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $getRecord->name }}" required placeholder="Subject Name">
                    </div>
                    <div class="form-group">
                        <label>Edit Type</label>
                        <select class="form-control" name="type">
                            <option value="">Select Type</option>
                            <option {{ ($getRecord->type == 'Teori') ? 'selected' : '' }} value="Teori">Teori</option>
                            <option {{ ($getRecord->type == 'Praktik') ? 'selected' : '' }} value="Praktik">Praktik</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                            <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
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