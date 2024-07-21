@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                @if (auth()->check())
                    <div class="justify-end ">
                        <div class="col" style="margin-bottom:10px;">
                            <a class="btn btn-sm btn-success" href={{ route('author.create') }}>Add New Author</a>
                        </div>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="col-10">
                    <table class="table table-bordered table-hover" style="width:100%;" id="table_book">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name of author</th>
                                <th>Biography of author</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $key => $auth)
                                <tr class="sid{{ $auth->id }}">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $auth->name }}</td>
                                    <td>{{ $auth->biography }} </td>
                                    <td>
                                        @if (auth()->check() && auth()->user()->role->name == 'admin')
                                            <a href="{{ route('author.edit', $auth->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                                href="{{ route('author.destroy', $auth->id) }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $authors->links() }}
            </div>
        </section>
    @endsection
    <script>
        var deleteLinks = document.querySelectorAll('.btn-delete-js');

        for (var i = 0; i < deleteLinks.length; i++) {
            deleteLinks[i].addEventListener('click', function(event) {
                event.preventDefault();
                var choice = confirm(this.getAttribute('data-confirm'));
                if (choice) {
                    window.location.href = this.getAttribute('href');
                }
            });
        }
    </script>
