@extends('layouts.app')
@section('content')
<div class="user-authentication-section">
    <div class="user-authentication-bg" style="background-image: url({{asset("uploads/logos/login.jpg")}})">
        <div class="background-color">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="authentication-content">
                            <div class="product-name">
                                <h1> Human Resource Management System </h1>
                            </div>
                            {{-- <div class="product-discription">
                                <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores vero necessitatibus ex ipsam tempore dolorem,
                                    neque nemo architecto suscipit omnis officia fuga, libero incidunt unde. Ad eius accusantium eaque excepturi! </p>
                            </div>
                            <div class="registration-btn">
                                <a href="{{ route('register') }}" type="button" class="btn"> Registration Now <span> <i class="fas fa-sign-in"></i> </span> </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="login-section">
                            <div class="login-item-box">
                                <div class="section-header">
                                    <div class="company-logo">
                                        <a href="#"> <img src="{{asset("uploads/logos/predictionit.png")}}" alt=""> </a>
                                    </div>
                                    <h4> {{ __('Login') }} </h4>
                                </div>
                                <div class="section-contant">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail or Phone Number') }}</label>

                                            <div class="">
                                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placholder="Email address or phone number" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                                            <div class="">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="submit-btn">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Login') }}
                                                </button>

                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                            </div>
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
</div>

<script>
      new TypeIt('#text', {
  speed: 50,
  loop: true
})
  .type("if you ami at not", {delay: 500})
  .move(-7, {delay: 300})
  .delete(2, {pause: 200})
  .type("im", {pause: 300})
  .move(7, {delay: 200})
  .type("hing, you'll htit it ")
  .move(-6)
  .delete(1)
  .move(null, { to: 'end'})
  .type("<em>every time.</em>")
  .move(null, {speed: 30, to: 'start', instant: true})
  .move(1, { delay: 400})
  .delete(1, { delay: 400})
  .type('I', {delay: 500})
  .move(null, {delay: 200, to: 'end', instant: true})
  .type(" - <em>Zig Ziglar</em>")
  .go();
    </script>

@endsection


