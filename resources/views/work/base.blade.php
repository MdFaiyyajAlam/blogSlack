<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Awesome Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a href="" class="navbar-brand" style="font-size: 30px;color:red; margin-left:10px">Novels</a>
          <form action="{{route('blog.index')}}" method="get" class="d-flex ms-auto">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" size="70">
            <button class="btn btn-outline-success" name="send" type="submit">Search</button>
          </form>

          <ul class="navbar-nav ms-auto">

            <li class="nav-link"><a href="{{route('blog.index')}}" class="btn btn-light btn-sm">Home</a></li>

            @auth
            <li class="nav-link"><a href="{{route('blog.create')}}" class="btn btn-light btn-sm">Insert</a></li>
            <li class="nav-item">
                <form action="{{route('logout')}}" method="POST">
                @csrf
                <input type="submit" value="Logout" class="btn btn-light btn-sm mt-2">
            </form>
            </li>
            @endauth

            @guest

            <li class="nav-link"><a href="{{route('login')}}" class="btn btn-light btn-sm">Login</a></li>
            <li class="nav-link"><a href="{{route('register')}}" class="btn btn-light btn-sm">Create an Account</a></li>
            @endguest
        </ul>
        </div>
      </nav>

</body>
@yield('content')
</html>
