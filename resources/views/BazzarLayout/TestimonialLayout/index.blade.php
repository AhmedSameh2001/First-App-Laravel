@extends('BazzarLayout.parent')

@section('title', 'Index Page for Testimonials')

@section('word', 'Table Show All Testimonials')
@section('Sub-address', 'Testimonials')

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Show All Testimonials</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Job</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($testimonials as $testimonial)
                            <tr>
                                <td>{{ $testimonial->id }}</td>
                                <td>{{ $testimonial->name }}</td>
                                <td><img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}" width="220px">
                                </td>
                                <td>{{ $testimonial->description }}</td>
                                <td>{{ $testimonial->Job }}</td>
                                <td>{{ $testimonial->created_at }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('testimonials.edit', $testimonial->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    <form class="d-inline" action="{{ route('testimonials.destroy', $testimonial->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i
                                                class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <td colspan="7" style="text-align: center;color:red;">Not Found testimonial</td>
                        @endforelse
                    </tbody>
                </table>
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
    </div>
@stop
