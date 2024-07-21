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
                    <h3>Add Category</h3>
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Name:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            @error('name')
                                <span class="text-danger" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="description">
                            @error('description')
                                <span class="text-danger" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="col-12" style="display: flex; justify-content: space-between;">
                          <div>
                              <a class="btn btn-warning" href="{{ route('category.index') }}">Back</a>
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
