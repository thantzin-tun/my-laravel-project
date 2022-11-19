@extends('layouts.master ')

@section('title','User Cart Page')

@section('content')

@include('navbar')

<div class="container-fluid d-flex justify-content-center align-items-center">
  <div class="editBox">
  </div>
  <div class="col-lg-6 editAlert">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h3 class="text-center title-2">Do you want to change you info?</h3>
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
  <div class="col-lg-6 editAlert">
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


<div class="container-fluid" style="margin-top:100px;">
  <div class="row">
    <div class="col">
      <a href="{{route('user#page')}}">
        <h4 class="bg-dark p-2 text-white w-auto"> < Go Shopping</h2>
      </a>
      <div class="card">
        <table class="styled-table" id="datatable">
          <thead>
              <th>Product</th>
              <th>Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
              <th>---</th>
          </thead>
          <tbody>
            @foreach($result as $p)
              <tr>

                <td>
                  <img src="{{ asset('storage/'.$p->image) }}" class="img-fluid" width="60px" height="60px">
                </td>

                <td>{{$p->name}}
                  <input type="hidden" class="productID" value="{{$p->id}}">
                  <input type="hidden" class="useID" value="{{$p->user_id}}">
                </td>

                <td>
                  <input type="hidden" class="pizzaprice" value="{{$p->price}}">

                  <button class="btn btn-dark btn-sm operation" pizzaID="{{$p->product_id}}" status="decrease" userID="{{$p->user_id}}">
                      -
                  </button>

                  <span class="text-dark fw-bold quantity" style="font-size: 1.1rem;">{{$p->qty}}</span>

                  <button class="btn btn-dark btn-sm operation" pizzaID="{{$p->product_id}}" status="increase" userID="{{$p->user_id}}">
                      +
                  </button>

                </td>

                <td>
                  <span class="p fw-bolder">{{$p->price}}</span> <span> kyats</span>
                </td>

                <td>
                  <span class="cartTotal fw-bolder">{{$p->price * $p->qty}}</span> <span> kyats</span>
                </td>

                <td>
                  <a href="{{route('user#deleteOrder',['deleteOrder' => $p->cart_id])}}">
                  <button class="btn btn-danger btn-sm rounded-lg">
                        X
                  </button>
                    </a>
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 text-dark">
        <div class="amount d-flex justify-content-between align-items-center">
          <p class="bg-dark p-2 text-light font-weight-bolder">Total Amount</p>
          <box-icon type='solid' name='purchase-tag-alt' color="black" size="36"></box-icon>
        </div>
        <hr class="py-1">

  
            <div class="amount d-flex justify-content-between align-items-center font-weight-bold">
              <p>Sub Total</p>
              <p id="totalPrice">{{$totalPrice}}</p>
            </div>
            <div class="amount d-flex justify-content-between align-items-center font-weight-bold">
              <p>Delievery Fees</p>
              <p class="fee">5000</p>
            </div>
      
        <hr class="py-3">
        <div class="amount d-flex justify-content-between align-items-center  font-weight-bold">
          <p>---</p>
          <p id="totalCost">{{$totalPrice + 5000}} kyats</p>
        </div>
        <hr class="py-1">
        <p> </p>
        <span class="btn btn-dark btn-sm w-100 mb-2 orderBtn">Order Now!</span>
     

        <a href="{{route('userorder#alldelete')}}" class="w-100">
          <span class="btn btn-danger btn-sm w-100">Cancel All Orders</span>
        </a>

      </div>
    </div>
  </div>
</div>


@endsection

@section("contactAndCartAvatar")

<script src="{{ asset('/admin/js/contactAndCartAvatar.js') }}"></script>

@stop

@section("ajaxTwo")
  <script src="{{ asset('/admin/js/ajaxTwo.js') }}"></script>
@stop