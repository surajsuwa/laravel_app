@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blogs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blogs</li>
                        </ol>
                    </div>

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary btn-sm" href="{{ route('blogs.create') }}">
                                    Add Record
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $key => $blog)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->description }}</td>
                                                {{-- <td>{{ $blog->featured_image }}</td> --}}

                                                <td>
                                                    <img src="{{ asset('images/' . $blog->featured_image) }}" height="50" />
                                                </td>

                                                <td>  {{ $blog->is_active == 1 ? 'Active' : 'Inactive' }} </td>

                                                <td style="display: flex">
                                                    <a href="{{ route('blogs.edit', $blog->id) }}" id="edit-event"
                                                        class="btn btn-sm btn-primary" style="margin-right: 2px;"
                                                        data-id="">Edit</a>

                                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->



                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
