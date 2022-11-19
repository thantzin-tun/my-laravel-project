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
                                    <!-- <img src="{{asset('/admin/images/icon/logo.png')}}" alt="CoolAdmin"> -->
                                    <h1>P<span style="color:red; font-style:italic;">i</span>zza</h1>
                                </a>
                            </div>
                            <div class="login-form">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="au-input au-input--full" type="email" name="email" value="{{old('email')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="au-input au-input--full" type="password" name="password">
                                        @error('password')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    <button class="au-btn au-btn--block au-btn--green m-b-20 m-t-20" type="submit">Sign in</button>
                                    
                                </form>
                                <div class="register-link">
                                    <p>
                                        Don't you have account?
                                        <a href="{{route('register#page')}}">Sign Up Here</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection