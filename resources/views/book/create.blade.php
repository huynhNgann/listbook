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
                    <h3>Add Book</h3>
                    <form action="{{ route('book.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Title:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name">
                            @error('title')
                                <span class="text-danger" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Author: <span class="text-danger">*</span></label>
                            <select id="author_id" name="author_id">
                                @foreach($author as $book)
                                    <option value="{{ $book->id }}" name="author_id">{{ $book->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Category: <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id">
                                @foreach($category as $book)
                                    <option value="{{ $book->id }}" name="category_id">{{ $book->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Isbn: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="isbn" name="isbn" placeholder="isbn"
                                required>
                            @error('isbn')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Pusblished At: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="published_at" name="published_at"
                                placeholder="published_at">
                        </div>
                        <div class="col-12" style="display: flex; justify-content: space-between;">
                          <div class="col-8" style="padding-right: 20px;margin-left: -20px">
                              <a class="btn btn-warning" href="{{ route('book.index') }}">Back</a>
                          </div>
                          <div class="col-4" style="padding-left: 100px;margin-right: -20px;">
                              <button type="submit" class="btn btn-primary">Update Book</button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
