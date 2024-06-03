<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        @stack('css')
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/dashboard">CodigoMantra</a>
                @if(!isset(Auth::user()->id))
                    <form class="d-flex" action="/" method="POST">
                        @csrf
                        <input class="form-control me-2" type="search" name="key" placeholder="Search Blogs" value="{{isset($searchedKey) ? $searchedKey : ''}}" aria-label="Search">
                        <button class="btn btn-outline-success" style="margin-right:10px" type="submit">Search</button>
                        <a href="/login" class="btn btn-success">Login</a>
                    </form>
                @else
                    @if(isset(Auth::user()->id))
                        <a href="/logout" class="btn btn-danger float-right mt-3 mr-3">Logout</a>
                    @endif
                @endif
            </div>
        </nav>
        @yield('contentWithoutContainer')
        <div class="container mt-5">
            @yield('mainContent')
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        @stack('scripts')
    </body>
</html>