@extends('layouts.app')

@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                   <center> <a class="navbar-brand" href="./"><img src="images/logo.png" height="180"  alt="Logo"></a></center>
                    <span class="login100-form-title p-b-43">
					 Ingresa para continuar
					</span>

                     {!! $errors -> first('name','<span class="help-block">:message</span>') !!}
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz" {{ $errors -> has('name') ? 'has-error' : ' '}}">
                    <input class="input100" type="text" name="name"
                           value="{{ old('name') }}">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Email</span>
               
            </div>

                
            <div class="wrap-input100 validate-input {{ $errors -> has('password') ? 'has-error' : ' ' }}" data-validate="Password is required">
                <input class="input100" type="password"  name="password">
                <span class="focus-input100"></span>
                <span class="label-input100">Password</span>
               
            </div>

            <div class="flex-sb-m w-full p-t-3 p-b-32">
                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>


            </div>


            <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Login
                </button>
            </div>




            </form>

            <div class="login100-more" style="background-image: url('images/cheff.jpg');">
            </div>
        </div>
    </div>




@endsection
