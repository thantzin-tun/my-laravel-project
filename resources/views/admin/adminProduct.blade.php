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

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    <!-- END MENU SIDEBAR-->

    <!-- HEADER DESKTOP-->
    <div class="page-container">
      <header class="header-desktop">
        <div class="section__content section__content--p30">
          <div class="container-fluid">
            <div class="header-wrap">
              <form class="form-header" action="{{route('admin#productList')}}" method="get">
                @csrf
                <input class="au-input au-input--xl" type="text" name="key" value="{{request('key')}}" placeholder="ရှာဖွေရန်..." />
                <button class="au-btn--submit" type="submit">
                  <i class="zmdi zmdi-search"></i>
                </button>
              </form>
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
                      <img src="{{asset('storage/'.Auth::user()->image)}}" alt="user" />
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
                      <div class="account-dropdown__body">
                        <div class="account-dropdown__item">
                          <a href="{{route('admin#changePasswordPage')}}">
                            <i class="zmdi zmdi-account"></i>Change Password</a>
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
          <div class="container-fluid">
            <div class="col-md-12">
              <!-- DATA TABLE -->
              <div class="table-data__tool">
                <div class="table-data__tool-left">
                  <div class="overview-wrap">
                    <h2 class="title-1">Pizza Lists</h2>
                  </div>
                  <h4 class="mt-3 text-danger">Total Pizzas : <span class="badge bg-warning badge-lg"></span></h4>
                </div>
                <div class="table-data__tool-right">

                  <button class="au-btn au-btn-icon au-btn--green au-btn--small addCategory">
                    <i class="zmdi zmdi-plus"></i>အသစ်ထည့်ရန်
                  </button>


                  <!-- <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        CSV download
                                    </button>   -->
                </div>
              </div>

            
              @if(count($product) != 0)
              <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>View Count</th>
                      <!-- <th>CREATED DATE</th> -->
                      <!-- <th>UPDATED DATE</th> -->
                      <th></th>
                    </tr>
                  </thead>
                  <tbody class="tBody">
                    @foreach($product as $p)
                    <tr class="tr-shadow">
                      <td>
                        <img src="{{ asset('storage/'.$p->image) }}" alt="pizza" width="60px" height="60px" class="shadow-lg" />
                      </td>
                      <td>{{$p->name}}</td>
                      <td>{{$p->description}}</td>
                      <td>{{$p->price}}</td>
                      <td>{{$p->view_count}}<i class="fa-regular fa-eye ml-2"></i></td>
                      <td>
                        <a href="#">
                          <button class="btn btn-outline-primary btn-sm" id="{{$p->id}}" name="{{$p->name}}" description="{{$p->description}}" price="{{$p->price}}" image="{{$p->image}}" category_id="{{$p->category_id}}" waiting="{{$p->waiting}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                          </button>
                        </a>
                        <a href="#">
                          <button class="btn btn-danger btn-sm ml-2" id="{{$p->id}}">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="text-right mt-3">
									{{$product->appends(request()->query())->links()}}
								</div>
              </div>
              @else
              <h1 class="text-secondary text-center">No pizza here!</h1>
              @endif

            </div>
          </div>
        </div>
      </div>


    </div>
  </div>


  <!-- Create Product Model Box -->
  <div class="container-fluid">
    <div class="createBox">
    </div>
    <div class="col-lg-6 offset-3 createAlert">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <h5 class="text-left">ပစ္စည်းထည့်သွင်းရန်</h5>
          </div>
          <hr>
          <form action="{{route('create#product')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Name</label>
              <input name="id" type="hidden" class="form-control" value="{{Auth::user()->id}}" />
              <input name="name" type="text" class="form-control" value="{{old('name')}}" />
              @error('name')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Category</label>
              @if(count($cate) == 0)
                <input type="text" value="No categories here!" class="form-control" disabled>
              @else
              <select name="category_id" class="form-control">
                <option value="">Choose Categories</option>
                @foreach($cate as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
              @error('category_id')
              <small class="text-danger">{{$message}}</small>
              @enderror
              @endif
            </div>
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Description</label>
              <textarea name="description" cols="" rows="2" class="form-control">{{old('description')}}</textarea>
              @error('description')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Image</label>
              <input name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" />
              @error('image')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Waiting Time</label>
              <input name="waiting" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{old('waiting')}}" />
              @error('waiting')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Price</label>
              <input name="price" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{old('price')}}" />
              @error('price')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div>
              <button id="payment-button" type="submit" class="btn btn-lg btn-danger btn-block text-light">
                <span id="payment-button-amount">ထည့်သွင်းရန်</span>
                <span id="payment-button-sending" style="display:none;">Sending…</span>
                <i class="fa-solid fa-circle-right"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <!-- Update Model Box -->
  <div class="container-fluid">
    <div class="editBox">
    </div>
    <div class="col-lg-6 offset-3 editAlert">
      <div class="card">
        <div class="card-body">
          <div class="card-title text-left">
            <h5>ပြင်ဆင်ရန်</h5>
          </div>
          <hr>
          <form action="{{route('update#product')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Name</label>
              <input name="id" type="hidden" class="form-control input" value="{{old('id')}}" />
              <input name="name" type="text" class="form-control input" value="{{old('name')}}" />
              @error('name')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">

              <label class="control-label mb-1" for="cc-payment">Category</label>
              @if(count($data) == 0)
                <input type="text" value="No categories here!" class="form-control" disabled>
              @else

              <select name="category_id" class="form-control input">
                <option value="">Choose Categories</option>
                @foreach($cate as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
              @error('category_id')
              <small class="text-danger">{{$message}}</small>
              @enderror
              @endif
            </div>
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Description</label>
              <textarea name="description" cols="" rows="2" class="form-control input">{{old('description')}}</textarea>
              @error('description')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Image</label>
              <input name="image" type="file" class="form-control file" aria-required="true" aria-invalid="false" value="" />
              @error('image')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Waiting Time</label>
              <input name="waiting" type="number" class="form-control input" aria-required="true" aria-invalid="false" value="{{old('waiting')}}" />
              @error('waiting')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label mb-1" for="cc-payment">Price</label>
              <input name="price" type="number" class="form-control input" aria-required="true" aria-invalid="false" value="" />
              @error('price')
              <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div>
              <button id="payment-button" type="submit" class="btn btn-lg btn-danger btn-block text-light">
                <span id="payment-button-amount">ပြင်ဆင်ရန်</span>
                <span id="payment-button-sending" style="display:none;">Sending…</span>
                <i class="fa-solid fa-circle-right"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <!-- Product Detail and View Count Design -->
  <div class="container-fluid">
    <div class="productBox">
    </div>
    <div class="container productAlert">
        <div class="row">
          <div class="col-md-10 offset-2">
              <div class="card carding py-4 px-3 shadow-lg">
                  <div class="row d-flex justify-content-around">
                    <div class="col-md-5 position-relative">
                        <img src="{{asset('admin/images/pppppp.png')}}" width="600px" height="600px" class="img"/>
                        <div class="time col-sm-4">
                                <box-icon name='timer' color="red" size="md" class="bx-tada"></box-icon>
                                <span class="ml-2">10 mins</span>
                          </div>
                    </div>
                    <div class="col-md-5 pt-3">
                        <div class="card-title d-flex align-items-center">
                            <h1 class="mr-3">Tomoto Paccibo</h1>
                            <img src="{{asset('admin/images/ppp.png')}}" />
                            <img src="{{asset('admin/images/ppp.png')}}" />
                            <img src="{{asset('admin/images/ppp.png')}}" />
                        </div>
                        <div class="d-flex align-items-center mt-4 mb-2">
                          <p class="p mr-3">So Spicy!!!</p>
                          <img src="{{asset('admin/images/chili.png')}}" />
                          <img src="{{asset('admin/images/chili.png')}}" />
                          <img src="{{asset('admin/images/chili.png')}}" />
                        </div>
                        <p class="text-dark fw-bold fs-2 mb-5">Spicy Lover's Pizza features a new spicy marinara sauce that provides a touch of heat and sweetness, sliced red chilis and Fiery Flakes made from a custom blend of herbs and crushed red peppers.Fiery Flakes made from a custom blend of herbs and crushed red peppers</p>
                        <div class="d-flex align-items-center mt-3">
                          <p class="text-dark mr-3">Price:</p>
                          <div class="price mr-4">
                              <span>5600</span>
                          </div>
                          <div class="view-count">
                              <div class="left">
                                  <span class="mr-2">View Count</span> <box-icon class='bx bxs-star bx-flashing text-danger'></box-icon>
                              </div>
                              <div class="right">
                                32
                              </div>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
  </div>

  <!-- Delete Box -->
  <div class="container-fluid">
    <div class="deleteBox">
    </div>
    <div class="cookiesContent" id="cookiesPopup">
      <button class="close">✖</button>
      <img src="{{ asset('admin/images/p.svg') }}" alt="cookies-img" />
      <p>သင်ဖျက်မှာ သေချာပါသလား?</p>
      <form action="{{route('delete#product')}}" method="POST">
        @csrf
        <input type="hidden" class="form-control val" name="product_id" />
        <button class="accept" type="submit">ဖျက်မည်</button>
      </form>
    </div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />

  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
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
  <script src="{{ asset('/admin/js/product.js') }}"></script>

</body>

</html>
<!-- end document-->