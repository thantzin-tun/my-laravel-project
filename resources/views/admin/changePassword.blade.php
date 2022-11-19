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
  <title>Admin</title>

  <!-- Fontfaces CSS-->
  <link href="{{ asset('/admin/css/font-face.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

  <!-- Bootstrap CSS-->
  <link href="{{ asset('/admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

  <!-- Vendor CSS-->
  <link href="{{ asset('/admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('/admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

  <!-- Main CSS-->
  <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="animsition">

  <div class="page-wrapper">

  <aside class="menu-sidebar d-none d-lg-block">
			<div class="logo">
				<a href="#">
					<h1 class="text-danger">Admin</h1>
				</a>
			</div>
			<div class="menu-sidebar__content js-scrollbar1">
				<nav class="navbar-sidebar">
					<ul class="list-unstyled navbar__list">
						<li class="active has-sub">
							<form action="{{route('admin#dash')}}" method="get">

								<i class="fa-solid fa-list"></i>
								<button type="submit">
									Category
								</button>

							</form>
						</li>
						<li>
							<form action="{{route('admin#productList')}}" method="GET">
								<i class="fa-brands fa-product-hunt text-primary"></i>
								<button type="submit">
									Product
								</button>
							</form>
						</li>
						<li>
							<form action="{{route('user#List')}}" method="GET">
								<i class="fa-solid fa-user text-danger"></i>
								<button type="submit">
									User Lists
								</button>
							</form>
						</li>
						<li>
							<form action="{{route('contact#List')}}" method="GET">
								<i class="fa-regular fa-address-card  text-success"></i>
								<button type="submit">
									Contact User
								</button>
							</form>
						</li>
						<li>
							<form action="{{route('orderList#page')}}" method="GET">
								<i class="fa-solid fa-arrow-down-short-wide text-dark"></i>
								<button type="submit">
									Order List
								</button>
							</form>
						</li>
					</ul>
				</nav>
			</div>
		</aside>

    <div class="page-container">
      <header class="header-desktop">
        <div class="section__content section__content--p30">
          <div class="container-fluid">
            <div class="header-wrap">
              
              <div class="header-button">

								@include('adminList')
                
                <div class="account-wrap">
                  <div class="account-item clearfix js-item-menu">
                    <div class="image">
                      @if(Auth::user()->image == null)
                        @if(Auth::user()->gender == 'female')
                        <img src="{{asset('admin/images/images.jpg')}}" alt="admin" />
                        @else
                        <img src="{{asset('admin/images/userOne.png')}}" alt="admin" />
                        @endif
                      @else
                      <img src="{{asset('storage/'.Auth::user()->image)}}" alt="admin" />
                      @endif
                    </div>
                    <div class="content">
                      <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                    </div>
                    <div class="account-dropdown js-dropdown">
                      <div class="info clearfix">
                        <div class="image">
                          <a href="#">
                            @if(Auth::user()->image == null)
                              @if(Auth::user()->gender == 'female')
                              <img src="{{asset('admin/images/images.jpg')}}" alt="admin" />
                              @else
                              <img src="{{asset('admin/images/userOne.png')}}" alt="admin" />
                              @endif
                            @else
                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="admin" />
                            @endif
                          </a>
                        </div>
                        <div class="content">
                          <h5 class="name">
                            <a href="#">{{Auth::user()->name}}</a>
                          </h5>
                          <span class="email">{{Auth::user()->email}}</span>
                        </div>
                      </div>
                      <div class="account-dropdown__body">
                        <div class="account-dropdown__item">
                          <a href="{{route('account#info')}}">
                            <i class="zmdi zmdi-account"></i>Account Info</a>
                        </div>
                      </div>
                      <div class="account-dropdown__footer">
                        <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <a href="#">
                            <i class="zmdi zmdi-power"></i>
                            <button type="submit" class="text-dark">
                              Logout
                            </button>
                          </a>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <div class="main-content">
        <div class="section__content section__content--p30">
          <div class="container-fluid d-flex justify-content-center">
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <h3 class="text-left">Change Password</h3>
                    @if(session('notMatch'))
                    <h5 class="text-danger mt-2">{{session('notMatch')}}</h5>
                    @endif
                  </div>
                  <hr>
                  <form action="{{route('admin#changePassword')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label class="control-label mb-1" for="cc-payment">Old Password</label>

                      <input name="oldpassword" type="password" class="form-control" aria-required="true" aria-invalid="false" />
                      @error('oldpassword')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label class="control-label mb-1" for="cc-payment">New Password</label>

                      <input name="newpassword" type="password" class="form-control" aria-required="true" aria-invalid="false" />
                      @error('newpassword')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label class="control-label mb-1" for="cc-payment">Confirm Password</label>

                      <input name="confirmpassword" type="password" class="form-control" aria-required="true" aria-invalid="false" />
                      @error('confirmpassword')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div>
                      <button id="payment-button" type="submit" class="btn btn-lg btn-danger btn-block text-light">
                        <span id="payment-button-amount">Change Password</span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>



  </div>




  <!-- Jquery JS-->
  <script src="{{ asset('/admin/vendor/jquery-3.2.1.min.js') }}"></script>
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

  <!-- Main JS-->
  <script src="{{ asset('/admin/js/main.js') }}"></script>
  <script src="{{ asset('/admin/js/index.js') }}"></script>

</body>

</html>