@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
    <style>
        .choices__list--multiple .choices__item {
            background-color: #046865;
            border: 1px solid #046865;
        }

        .choices__list--multiple .choices__item.is-highlighted {
            background-color: #009b72;
            border: 1px solid #009b72;
        }

    </style>
@endpush
@section('mainContent')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <h1>Add Blog</h1>
    <form action="/add-blog" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" aria-describedby="titleHelp" placeholder="Enter title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="tags">Tags <span class="text-muted">(Enter tag and hit enter)</span></label>
                    <input type="text" class="form-control" id="tags" name="tags" data-choices value="{{ old('tags') }}">
                    @error('tags')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="content">Blog Content</label>
                    <textarea id="content" name="content"></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="/login" class="btn btn-secondary">Back to login</a>
    </form>

    @push('scripts')
        <!-- Include TinyMCE-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Include Choices JavaScript (latest) -->
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

        <script>
            tinymce.init({
                selector: '#content',
                plugins: 'advlist autolink lists link image charmap print preview anchor',
                toolbar: 'bold italic underline | bullist numlist'
            });
           new Choices('[data-choices]', {
                removeItems: true,
                removeItemButton: true,
                duplicateItemsAllowed: false,
                editItems: true
            });
        </script>
    @endpush
@endsection