@extends('BazzarLayout.parent')

@section('title', 'Index Page for Sliders')

@section('word', 'Table Show All Sliders')

@section('Sub-address', 'Sliders')


@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Show All Sliders</h3>
                @if (session('msg'))
                    <div class="alert alert-{{ session('type') }}">
                        {{ session('msg') }}
                    </div>
                @endif
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
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->title }}</td>
                                <td><img src="{{ asset('uploads/sliders/' . $slider->image) }}" width="220px"> </td>
                                <td>{{ $slider->created_at }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('sliders.edit', $slider->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    <form class="d-inline" action="{{ route('sliders.destroy', $slider->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i
                                                class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <td colspan="5" style="text-align: center;color:red;">Not Found Slider</td>
                        @endforelse
                    </tbody>
                </table>
                {{ $sliders->links() }}
            </div>
        </div>
    </div>
    </div>
@stop
