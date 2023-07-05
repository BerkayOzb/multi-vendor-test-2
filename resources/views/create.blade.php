@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>
                            Create Post
                        </h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn-sm btn-success btn mx-1" href="{{route('posts.index')}}">Go Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Category</label>
                        <select type="file" name="category_id" class="form-control" id="">
                            <option value="">Select</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Description</label>
                        <textarea type="text" name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
