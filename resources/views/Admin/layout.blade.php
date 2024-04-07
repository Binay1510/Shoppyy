<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
        <link href=" {{asset('admin_assets'). '/css/styles.css'}} " rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
<body class="sb-nav-fixed">

@include('admin.layout_partials.header')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('admin.layout_partials.sidebar')
    </div>
</div>

<div id="layoutSidenav_content">
    @yield('content')
    @include('admin.layout_partials.footer')
</div>


@include('admin.layout_partials.footer_scripts')




</body>
</html>