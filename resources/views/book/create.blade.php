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
                                @foreach($author as $author_tmp)
                                    <option value="{{ $author_tmp->id }}" name="author_id">{{ $author_tmp->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Category: <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id">
                                @foreach($category as $category_tmp)
                                    <option value="{{ $category_tmp->id }}" name="category_id">{{ $category_tmp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Book Code: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Book Code"
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
                          <div>
                              <a class="btn btn-warning" href="{{ route('book.index') }}">Back</a>
                          </div>
                          <div class="justify-content-end">
                              <button type="submit" class="btn btn-primary">Create</button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
