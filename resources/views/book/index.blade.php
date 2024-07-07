@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="justify-end ">
                    <div class="col" style="margin-bottom:10px;">
                        <a class="btn btn-sm btn-success" href={{ route('book.create') }}>Add New Book</a>
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
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>ISBN</th>
                                <th>Published At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $key => $book)
                                <tr class="sid{{ $book->id }}">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author_name }}</td>
                                    <td>{{ $book->category_name }}</td>
                                    <td>{{ $book->isbn }}</td>
                                    <td>{{ $book->published_at}}</td>
                                    <td>
                                        <a href="{{ route('book.edit', $book->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="#" id="{{ $book->id }}" class="text-danger mx-1 deleteIcon"
                                            style="margin-top:10px;display:inline-block;"><i class="bi-trash h4"></i>
                                            <form action="{{ route('book.destroy', $book->id) }}" method="post">
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
                {{$books->links()}}
            </div>
        </section>
    @endsection
