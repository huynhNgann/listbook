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
                <h3>Update Category</h3>
                <div class="col-6">
                    <form action="{{ route('category.update', ['category' => $category->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{ $category->name }}" required>
                            @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="description" name="description"
                                value="{{ $category->description }}" required>
                            @error('description')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12" style="display: flex; justify-content: space-between;">
                          <div class="col-6" style="padding-right: 20px;margin-left: -20px">
                              <a class="btn btn-warning" href="{{ route('category.index') }}">Back</a>
                          </div>
                          <div class="col-6" style="padding-left: 180px;margin-right: -20px;">
                              <button type="submit" class="btn btn-primary">Update Category</button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection