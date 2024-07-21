@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                @if (auth()->check())
                    <div class="justify-end ">
                        <div class="col" style="margin-bottom:10px;">
                            <a class="btn btn-sm btn-success" href={{ route('category.create') }}>Add New Category</a>
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
                                <th>Name of category</th>
                                <th>Description of category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $cate)
                                <tr class="sid{{ $cate->id }}">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $cate->name }}</td>
                                    <td>{{ $cate->description }}</td>
                                    <td>
                                        @if (auth()->check() && auth()->user()->role->name == 'admin')
                                            <a href="{{ route('category.edit', $cate->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                                <a class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                                href="{{ route('category.destroy', $cate->id) }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $categories->links() }}
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
