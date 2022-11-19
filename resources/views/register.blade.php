@extends('layouts.master')

@section('title','Register')

@section('content')

<div class="page-wrapper">
  <div class="page-content--bge5">
    <div class="container">
      <div class="login-wrap">
        <div class="login-content">
          <div class="login-logo">
            <a href="#">
              <h1>P<span style="color:red; font-style:italic;">i</span>zza</h1>
              <!-- <img src="{{asset('/admin/images/icon/logo.png')}}" alt="CoolAdmin"> -->
            </a>
          </div>
          <div class="login-form">
            <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="au-input au-input--full" type="text" name="name" value="{{old('name')}}">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Upload Image</label>
                    <input class="form-control" type="file" name="image">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Address</label>
                    <input class="au-input au-input--full" type="text" name="address" value="{{old('address')}}">
                    @error('address')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Phone</label>
                    <input class="au-input au-input--full" type="text" name="phone" value="{{old('phone')}}">
                    @error('phone')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-group">
                <select class="form-control" type="text" name="gender">
                  <option value="">Choose Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
                @error('gender')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>

              <div class="form-group">
                <label>Email</label>
                <input class="au-input au-input--full" type="email" name="email" value="{{old('email')}}">
                @error('email')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password">
                @error('password')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label>Retype Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation">
                @error('password_confirmation')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>

              <button class="au-btn au-btn--block au-btn--green m-b-20 m-t-20" type="submit">register</button>

            </form>
            <div class="register-link">
              <p>
                Already have account?
                <a href="{{route('login#page')}}">Sign In</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection