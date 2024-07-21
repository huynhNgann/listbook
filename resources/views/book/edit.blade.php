@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
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
                <div class="col-6">
                    <h3>Update Book</h3>
                    <form action="{{ route('book.update', ['book' => $book->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Title:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $book->title }}">
                            @error('title')
                                <span class="text-danger" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Author: <span class="text-danger">*</span></label>
                            <select id="author_id" name="author_id">
                                @forelse($author as $ath)
                                    {{-- <option value="{{ $ath->id }}"> {{ $ath->name }}</option> --}}
                                    <option value="{{ $ath->id }}"{{ (old('author_id') ?? $book->author->id) == $ath->id ? 'selected' : '' }}>
                                        {{ $ath->name }}</option>
                                @empty
                                    <option>Không có thông tin của tác giả</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category: <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id">
                                @forelse($category as $cate)
                                    <option value="{{ $cate->id }}"{{ (old('category_id') ?? $book->category->id) == $cate->id ? 'selected' : '' }}>
                                        {{ $cate->name }}</option>
                                         {{-- @if($book->category->id)
                                        <option value="{{ $book->category->id }}"{{ (old('category_id') ?? $book->category->id) == $cate->id ? 'selected' : '' }}>
                                            {{ $cate->name }}</option>
                                        @else
                                        <option value="{{ $cate->id }}">
                                            {{ $cate->name }}</option>
                                        @endif --}}
                                @empty
                                    <option>Không có thông tin của tác giả</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Book Code: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="isbn" name="isbn"
                                value="{{ $book->isbn }}">
                            @error('isbn')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                     
                        <div class="form-group">
                            <label for="published_at">Pusblished At: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="published_at" name="published_at"
                                value="{{$book->published_at}}">
                        </div>
                        <div class="col-12" style="display: flex; justify-content: space-between;">
                            <div>
                                <a class="btn btn-warning" href="{{ route('book.index') }}">Back</a>
                            </div>
                            <div class="justify-content-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
