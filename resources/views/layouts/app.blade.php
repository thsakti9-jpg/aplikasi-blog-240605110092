<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','CMS Blog')</title>

```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
        background:#f4f6f9;
    }

    .sidebar{
        width:250px;
        min-height:100vh;
        background:#1f2937;
    }

    .sidebar a{
        color:#d1d5db;
        text-decoration:none;
        display:block;
        padding:12px 20px;
    }

    .sidebar a:hover{
        background:#374151;
        color:white;
    }

    .sidebar .active{
        background:#2563eb;
        color:white;
    }

    .content{
        flex:1;
    }

    .topbar{
        background:white;
        padding:15px 25px;
        border-bottom:1px solid #ddd;
    }

    .card-dashboard{
        border:none;
        border-radius:12px;
        box-shadow:0 2px 10px rgba(0,0,0,.08);
    }
</style>
```

</head>
<body>

<div class="d-flex">

```
<div class="sidebar">

    <div class="text-center py-4 text-white">
        <h4>CMS BLOG</h4>
        <small>Laravel 12</small>
    </div>

    <a href="{{ route('dashboard') }}">
        Dashboard
    </a>

    <a href="{{ route('artikel.index') }}">
        Artikel
    </a>

    <a href="{{ route('penulis.index') }}">
        Penulis
    </a>

    <a href="{{ route('kategori.index') }}">
        Kategori
    </a>

    <hr class="text-secondary">

    <form action="{{ route('logout') }}" method="POST" class="px-3">
        @csrf
        <button class="btn btn-danger w-100">
            Logout
        </button>
    </form>

</div>

<div class="content">

    <div class="topbar d-flex justify-content-between">

        <h5 class="mb-0">
            @yield('title')
        </h5>

        <span>
            {{ Auth::user()->nama_depan }}
            {{ Auth::user()->nama_belakang }}
        </span>

    </div>

    <div class="container-fluid p-4">

        @if(session('sukses'))
            <div class="alert alert-success">
                {{ session('sukses') }}
            </div>
        @endif

        @yield('content')

    </div>

</div>
```

</div>

</body>
</html>
