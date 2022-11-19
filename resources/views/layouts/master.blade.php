<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="au theme template">
  <meta name="author" content="Hau Nguyen">
  <meta name="keywords" content="au theme template">

  <!-- Title Page-->
  <title>@yield('title')</title>

  <!-- Fontfaces CSS-->
  <link href="{{ asset('/admin/css/font-face.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

  <!-- Bootstrap CSS-->
  <link href="{{ asset('/admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link href="{{asset('imagehover.css-master/css/imagehover.min.css')}}" rel="stylesheet">


  <!-- Vendor CSS-->
  <link href="{{ asset('/admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Main CSS-->
  <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('admin/css/contact.css') }}" rel="stylesheet">

</head>

<body>

  @yield("content")

  @yield("javascript")

  @yield("userJsHome")


  <script src="{{ asset('/admin/js/user.js') }}"></script>
  <!-- Jquery JS-->
  <script src="{{ asset('/admin/vendor/jquery-3.2.1.min.js') }}"></script>

  @yield("contactAndCartAvatar")

  @yield("ajaxTwo")
  <!-- Bootstrap JS-->
  <script src="{{ asset('/admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
  <script src="{{ asset('/admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
  <!-- Vendor JS       -->
  <script src="{{ asset('/admin/vendor/slick/slick.min.js') }}">
  </script>
  <script src="{{ asset('/admin/vendor/wow/wow.min.js') }}"></script>
  <script src="{{ asset('/admin/vendor/animsition/animsition.min.js') }}"></script>
  <script src="{{ asset('/admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
  </script>
  <script src="{{ asset('/admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('/admin/vendor/counter-up/jquery.counterup.min.js') }}">
  </script>
  <script src="{{ asset('/admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
  <script src="{{ asset('/admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('/admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
  <script src="{{ asset('/admin/vendor/select2/select2.min.js') }}">
  </script>

  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

  <!-- Main JS-->
  <script src="{{ asset('/admin/js/main.js') }}"></script>

  <script src="{{ asset('/admin/js/user.js') }}"></script>

  <script src="{{ asset('/admin/js/ajax.js') }}"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('/admin/js/ajax.js') }}"></script>
</body>

</html>
<!-- end document-->