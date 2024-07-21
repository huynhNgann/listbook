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
                <h3>Update Author</h3>
                <div class="col-6">
                    <form action="{{ route('author.update', ['author' => $author->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{ $author->name }}" required>
                            @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Biography: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="biography" name="biography"
                                value="{{ $author->biography }}" required>
                            @error('biography')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="col-12" style="display: flex; justify-content: space-between;">
                          <div>
                              <a class="btn btn-warning" href="{{ route('author.index') }}">Back</a>
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
