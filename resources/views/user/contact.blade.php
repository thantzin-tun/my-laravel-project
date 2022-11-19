@extends('layouts.master')

@section('title','Contact Us')

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


<div class="container-fluid contact-us">
  <div class="row d-flex justify-content-center">
    <div class="col"></div>
    <div class="col-lg-6">
      <img src="{{asset('admin/images/contactme.svg')}}" alt="contactme" class="img-fluid" />
    </div>
    <div class="col-lg-4 input-container">
      <h2 class="mb-3">Get in touch</h2>
      <form action="{{route('contact#adminTeam')}}" method="POST">
        @csrf
        <div class="input-icon">
          <input type="text" placeholder="Name" name="contact_name" value="{{old('contact_name')}}">
          <div class="message">
            @error("contact_name")
              <small class="text-danger">{{$message}}</small>
            @enderror 
          </div>
        </div>
        <div class="input-icon">
          <input type="text" placeholder="Email" name="contact_email">
          <div class="message">
            @error("contact_email")
              <small class="text-danger">{{$message}}</small>
            @enderror 
          </div>
        </div>
        <textarea type="text" class="contact-field w-100" rows="5" placeholder="Message" name="contact_message" value="{{old('contact_message')}}"></textarea>
        @error("contact_message")
            <small class="text-danger">{{$message}}</small>
        @enderror 
        <button type="submit">
          Send
        </button>
      </form>
    </div>
    <div class="col"></div>
  </div>
</div>


@stop

@section("contactAndCartAvatar")

<script src="{{ asset('/admin/js/contactAndCartAvatar.js') }}"></script>

@stop