@extends('BazzarLayout.parent')

@section('title', 'Create Services')

@section('word', 'Create Services')

@section('Sub-address', 'Create Services')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Create Service</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputTitle">Title</label>
                                    <input type="text" class="form-control" id="exampleInputTitle"
                                        placeholder="Enter Title">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDescription">Description</label>
                                    <textarea rows="6" class="form-control" id="exampleInputDescription" placeholder="Enter Description"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
    </section>
    <!-- /.content -->
@stop
