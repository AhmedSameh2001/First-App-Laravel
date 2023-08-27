@extends('BazzarLayout.parent')

@section('title', 'Index Page for Services')

@section('word', 'Table Show All Services')

@section('Sub-address', 'Services')


@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Show All Services</h3>

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
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->description }}</td>
                                <td><img src="{{ asset('uploads/services/' . $service->image) }}" width="220px">
                                </td>
                                <td>{{ $service->created_at }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('services.edit', $service->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    <form class="d-inline" action="{{ route('services.destroy', $service->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i
                                                class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <td colspan="6" style="text-align: center;color:red;">Not Found service</td>
                        @endforelse
                    </tbody>
                </table>
                {{ $services->links() }}
            </div>
        </div>
    </div>
    </div>
@stop
