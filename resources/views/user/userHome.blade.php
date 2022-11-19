@extends('layouts.master')

@section('title','User Home Page')

@section('content')

@include('navbar')

<div class="container-fluid d-flex justify-content-center align-items-center">
  <div class="editBox">
  </div>
  <div class="col-lg-6 col-sm-10 editAlert">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h3 class="text-center title-2">Do you want to change your info?</h3>
        </div>
        <hr>
        <form action="{{route('change#useraccount')}}" novalidate="novalidate" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Name</label>
            <input type="hidden" class="form-control userID" name="user_id" value="{{Auth::user()->id}}">
            <input name="name" value="{{old('name',Auth::user()->name)}}" type="text" class="form-control editVal" aria-required="true" aria-invalid="false" />
            @error('name')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Email</label>
            <input name="email" value="{{old('email',Auth::user()->email)}}" type="text" class="form-control editVal" aria-required="true" aria-invalid="false" />
            @error('email')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Address</label>
            <input name="address" value="{{old('password',Auth::user()->address)}}" type="text" class="form-control editVal" aria-required="true" aria-invalid="false" />
            @error('address')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Phone</label>
            <input name="phone" value="{{old('phone',Auth::user()->phone)}}" type="number" class="form-control editVal" aria-required="true" aria-invalid="false" />
            @error('phone')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Upload Image</label>
            <input name="image" value="{{Auth::user()->image}}" type="file" class="form-control editVal" aria-required="true" aria-invalid="false" />
          </div>
          <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-danger btn-block text-light">
              <span id="payment-button-amount">Submit</span>
              <span id="payment-button-sending" style="display:none;">Sending…</span>
              <i class="fa-solid fa-circle-right"></i>
            </button>
          </div>
        </form>
        <button class="btn btn-dark my-1 toPass">Change Password</button>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-sm-10 editAlert">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h3 class="text-center title-2">Change Password</h3>
        </div>
        @if(session('notMatch'))
        <div class="alert alert-danger">{{session('notMatch')}}</div>
        @else

        @endif
        <hr>
        <form action="{{route('change#userpassword')}}" method="POST">
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
              <span id="payment-button-amount">Submit</span>
            </button>
          </div>
        </form>
        <button class="btn btn-dark my-2 toInfo">
          < Back</button>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid p-5 mt-5">
  <div class="row">
    <div class="col-lg-2 col-sm-1">

      <section id="sidebar" class="mt-4">
        <div>
          <h3 class="p-1 border-bottom mb-3">Categories</h3>
          <ul class="cate-list">
            <li class="d-flex justify-content-between align-items-center"><a href="{{route('user#page')}}">All</a>
              <span class="badge badge-dark">{{$product}}</span>
            </li>

            @if(count($cateList) != 0)
            @foreach($cateList as $d)
            <li class="d-flex justify-content-between align-items-center">
              <a href="{{route('search#productwithsomething',['whatIs' => $d->id])}}">{{$d->name}}</a>
            </li>
            @endforeach
            @else
            <h4>No categories here!</h4>
            @endif

          </ul>
        </div>
        <div>
          <h3 class="p-1 border-bottom mt-1">Filter By</h3>
          <p class="mb-2">Price</p>
          <ul class="list-group">
            <li class="list-group-item list-group-item-action mb-2 rounded"><a href="{{route('search#productwithsomething',['whatIs' => 'greater'])}}">
                <span class="fa fa-circle pr-1 text-danger" id="red"></span>
                <span class="text-dark">10000 ></span>
              </a></li>
            <li class="list-group-item list-group-item-action mb-2 rounded"><a href="{{route('search#productwithsomething',['whatIs' => 'lower'])}}">
                <span class="fa fa-circle pr-1 text-danger" id="teal"></span>
                <span class="text-dark">10000 < </span>
              </a></li>
          </ul>
        </div>
      </section>


      <!-- For Mobile Side Bar -->
      <div class="mobileSideBar">

        <div class="mb-3">
          <div class="avatarInfo">
            <div class="profile userTwo">
              @if(Auth::user()->image == null)
              @if(Auth::user()->gender == 'female')
              <img src="{{asset('admin/images/images.jpg')}}" class="rounded-lg" alt="admin" width="42px" height="42px" />
              @else
              <img src="{{asset('admin/images/userOne.png')}}" class="rounded-lg" alt="admin" width="42px" height="42px" />
              @endif
              @else
              <img src="{{asset('storage/'.Auth::user()->image)}}" class="rounded" alt="user" width="42px" height="42px" />
              @endif
              <h4 class="text-light mx-3 fs-5">{{Auth::user()->name}}</h4>
            </div>

            <div>
              <i class="fa-solid fa-xmark text-light cross"></i>
            </div>

          </div>

          <h3 class="p-1 border-bottom mb-4 text-light" style="font-size:1.2rem ;">Categories</h3>
          <ul class="cate-list">
            <li class="d-flex justify-content-between align-items-center"><a href="{{route('user#page')}}" class="text-light">All</a>
              <span class="badge badge-danger">{{$product}}</span>
            </li>

            @if(count($cateList) != 0)
            @foreach($cateList as $d)
            <li class="d-flex justify-content-between align-items-center">

              <a href="{{route('search#productwithsomething',['whatIs' => $d->id])}}" class="text-light">{{$d->name}}</a>
            </li>
            @endforeach
            @else
            <h4 class="text-light">No categories here!</h4>
            @endif

          </ul>
        </div>

        <div>
          <h3 class="p-1 border-bottom mt-1 mb-3 text-light" style="font-size:1.2rem ;">Filter By</h3>
          <p class="mb-2 text-light">Price</p>
          <ul class="list-group">
            <li class="list-group-item list-group-item-action mb-2 rounded"><a href="{{route('search#productwithsomething',['whatIs' => 'greater'])}}">
                <span class="fa fa-circle pr-1 text-danger" id="red"></span>
                <span class="text-dark">10000 ></span>
              </a></li>
            <li class="list-group-item list-group-item-action mb-2 rounded"><a href="{{route('search#productwithsomething',['whatIs' => 'lower'])}}">
                <span class="fa fa-circle pr-1 text-danger" id="teal"></span>
                <span class="text-dark">10000 < </span>
              </a></li>
            <li>
              <a href="{{route('userorder#page')}}">
                <button type="button" class="btn @if($cartCount > 0) bg-danger @else bg-dark @endif position-relative">
                  <i class="fa-solid fa-cart-plus text-light"></i>
                </button>
              </a>
            </li>
          </ul>
        </div>


      </div>


    </div>


    <div class="col-lg-10">

      <div class="row my-4" id="secondmenuBar">

        <div class="col-sm-12 d-flex justify-content-between align-items-center">

          <div id="menu">
            <div class="one"></div>
            <div class="two"></div>
            <div class="three"></div>
          </div>

          <form class="form-header" action="{{route('user#search')}}" method="get">
            @csrf
            <input class="au-input au-input--xl" type="text" name="key" value="{{request('key')}}" placeholder="Search..." />
            <button class="au-btn--submit" type="submit">
              <i class="zmdi zmdi-search"></i>
            </button>
          </form>

        </div>

      </div>

      <div class="row my-4" id="firstmenuBar">
        <div class="col-1">
          <a href="{{route('userorder#page')}}">
            <button type="button" class="btn @if($cartCount > 0) bg-danger @else bg-dark @endif position-relative">
              <i class="fa-solid fa-cart-plus text-light"></i>
            </button>
          </a>
        </div>

        <div class="col">
          <form class="form-header" action="{{route('user#search')}}" method="get">
            @csrf
            <input class="au-input au-input--xl" type="text" name="key" value="{{request('key')}}" placeholder="Search..." />
            <button class="au-btn--submit" type="submit">
              <i class="zmdi zmdi-search"></i>
            </button>
          </form>
        </div>

        <div class="col">
          <select id="selectOperations" name="sort" class="form-control bg-dark col-3 text-light float-right">
            <option value="">Sort</option>
            <option value="asc">Asc</option>
            <option value="desc">Desc</option>
          </select>
        </div>
      </div>


      <div class="row" id="pizzaList">
        @if(count($data) != 0)
        @foreach($data as $d)
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card neo p-2">
            <div class="all">
              <div class="image-part">
                <img src="{{ asset('storage/'.$d->image) }}" class="img-fluid productPhoto" alt="pizza photo">
                <div class="infopart">
                  <h1 class="text-light fw-bold mx-2">{{$d->name}}</h1>
                  <p class="text-light fw-bold my-2 mx-2">{{$d->description}}</p>
                  <h3 class="text-light fw-bold mx-2">${{$d->price}}</h3>
                  <div class="d-flex">
                    <div class="time bg-danger">
                      <box-icon name='timer' color="white" size="md" class="bx-tada"></box-icon>
                      <h5 class="ml-2 text-white">{{$d->waiting}}mins</h5>
                    </div>
                  </div>
                </div>
              </div>

              <div class="position-relative addToCart">
                <button class="btn btn-dark mt-2 w-100">Add To Cart</button>
                <input type="hidden" class="form-control" value="{{Auth::user()->id}}" id="userID">
                <button class="btn btn-danger mt-2 w-100 bu" pizzaID="{{$d->id}}">
                  <box-icon name='cart' size="48" color="white"></box-icon>
                </button>
              </div>

            </div>
          </div>
        </div>
        @endforeach
        @else
        <h1 class="text-center offset-4 mt-3">No pizzas here!</h1>
        @endif
      </div>
    </div>
  </div>
</div>
</div>

@endsection

@section("javascript")

<script src="{{ asset('/admin/js/menu.js') }}"></script>

@stop