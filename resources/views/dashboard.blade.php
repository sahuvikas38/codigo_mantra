@extends('layouts.master')
@section('mainContent')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <h1>Dashboard</h1>
    <form action="/dashboard" method="POST">
        @csrf
        <a href="/add-blog" class="btn btn-secondary">Add Blog</a>

        @foreach ($blogs as $blog)
            <div class="my-3">
                <div class="card">
                    <div class="card-header">
                        <h4 style="color:blue">{{ $blog->title }}</h4>
                        <span class="text-muted"><i>Published {{ $blog->created_at->format('F j, Y g:i a')}}, by {{ Auth::user()->name }}</i></span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div>
                                    {!! $blog->blog !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <a href="/view-blog/{{$blog->id}}" class="btn btn-success">View</a>
                                <a href="/edit-blog/{{$blog->id}}" class="btn btn-primary">Edit</a>
                                <a href="/delete-blog/{{$blog->id}}" class="btn btn-secondary">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $blogs->links() }}
        </div>
    </form>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#blogs-table').DataTable({
                    searching: false,
                    paginate: false,
                    lengthChange: false
                });
            });
        </script>
    @endpush
@endsection