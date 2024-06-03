@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
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
    <div class="container">
        <h1>{{$blog->title}}</h1>
        <span class="text-muted"><i>Published {{ $blog->created_at->format('F j, Y g:i a')}}, by {{ $name }}</i></span>

        <div class=" mt-5">
            <div style="text-align: justify;">
                {!! $blog->blog !!}
            </div>
        </div>
        <a href="javascript:void(0)" id="sharePost" data-bs-toggle="modal" data-bs-target="#exampleModal">Share this post</a>
        @if(isset(Auth::user()->id))
            <a href="/dashboard" style="margin-left:30px" class="btn btn-secondary">Back to dashboard</a>
            @else
            <a href="/" style="margin-left:30px" class="btn btn-secondary">Back to Home</a>
        @endif
    </div>
    </form>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Share "{{$blog->title}}" by e-mail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/share-blog/{{$blog->id}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter name" value="{{ old('name', $name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="receiverName">To</label>
                                <input type="text" class="form-control" id="receiverName" name="receiverName" placeholder="Receiver's name">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea id="comment" class="form-control" name="comment">{{old('comment')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="shareSelectedPost" class="btn btn-success">Share</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @push('scripts')
    @endpush
@endsection