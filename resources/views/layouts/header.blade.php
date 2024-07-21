<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        @if(auth()->check())
        <li class="nav-item">
           <div class="mr-2">
            <a href="{{route('logout')}}" class="btn btn-danger">Đăng Xuất</a>
        </div>
        </li>
        @else
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
            <a href="{{route('login')}}" class="btn btn-success">Đăng Nhập</a>
         </li>
      @endif
    </ul>
</nav>
<!-- /.navbar -->
