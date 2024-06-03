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
    <h1>Latest Blogs</h1>
    @if(isset($searchedKey) && !empty($searchedKey))
        <span class="text-muted">Search based on key: "{{$searchedKey}}"</span>
    @endif
    <form action="/dashboard" method="POST">
        @csrf

        @if ($blogs->isEmpty())
            <p class="mt-5">No blogs found.</p>
        @else
            @foreach ($blogs as $blog)
                <div class="my-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color:blue">{{ $blog->title }}</h4>
                            <span class="text-muted"><i>Published {{ $blog->created_at->format('F j, Y g:i a')}}, by admin</i></span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-11">
                                    <div>
                                        {!! $blog->blog !!}
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="/view-blog/{{$blog->id}}" class="btn btn-success">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
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