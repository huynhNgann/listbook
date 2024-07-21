@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                @if (auth()->check())
                    <div class="justify-end ">
                        <div class="col" style="margin-bottom:10px;">
                            <a class="btn btn-sm btn-success" href={{ route('book.create') }}>Add New Book</a>
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
                    {{-- @dd(auth()->check()) --}}
                    <table class="table table-bordered table-hover" style="width:100%;" id="table_book">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Book Code</th>
                                <th>Published At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $key => $book)
                                <tr class="sid{{ $book->id }}">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>
                                        @if(!empty($book->author->name))
                                            {{$book->author->name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($book->category->name))
                                        {{ $book->category->name }}
                                        @endif
                                    </td>
                                    <td>{{ $book->isbn }}</td>
                                    <td>{{ \Carbon\Carbon::parse($book->published_at)->format('Y-m-d') }}</td>
                                    <td>
                                        @if (auth()->check() && auth()->user()->role->name == 'admin')
                                            <a href="{{ route('book.edit', $book->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                                href="{{ route('book.destroy', $book->id) }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $books->links() }}
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
