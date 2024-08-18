<!DOCTYPE html>
<html lang="en">
<head>
  <title>Wedding cards Catalog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex p-3 justify-content-between">
                <div>
                    <h1>Admin Dashboard</h1>
                </div>
                <div>
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <a href="{{ url('/') }}" class="btn btn-outline-primary">Home</a>
                    <button type="submit" class="btn btn-default btn-outline-secondary">Logout</button>
                </form>
                </div>
            </div>
            @error('file')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }} <a href="{{ url('/') }}">Go to home</a>
                </div>
            @endif
            @if (session('error_msg'))
                <div class="alert alert-danger">
                    {{ session('error_msg') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Import Products</div>
                <div class="card-body">
                <form action="{{ url('import-csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Choose CSV File</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
                </div>

        </div>
    </div>
</div>
</body>
</html>
