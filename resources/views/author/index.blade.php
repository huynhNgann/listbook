@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="justify-end ">
                    <div class="col" style="margin-bottom:10px;">
                        <a class="btn btn-sm btn-success" href={{ route('author.create') }}>Add New Author</a>
                    </div>
                </div>
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
                                    <td>{{ $auth->biography }}</td>
                                    <td>
                                        <a href="{{ route('author.edit', $auth->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="#" id="{{ $auth->id }}" class="text-danger mx-1 deleteIcon"
                                            style="margin-top:10px;display:inline-block;"><i class="bi-trash h4"></i>
                                            <form action="{{ route('author.destroy', $auth->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$authors->links()}}
            </div>
        </section>
    @endsection
