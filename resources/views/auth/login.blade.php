@extends('layouts.app')

@section('content')
  <!-- #login -->
  <div id="login" class="bg-image container-padding120">
    <!-- .container -->
    <div class="container">
      <div class="post-heading-center animation" data-animation="animation-fade-in-up">
        <h2>SIGN IN</h2>
        <p>Please sign in below to complete your subscription to Train Smart.</p>
      </div>
      <!-- .row -->
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @if (isset($alert))
            <div class="alert alert-{{ $alert['type'] }} alert-dismissable fade in">
              <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
              </button>
              <p>{!! $alert['msg'] !!}</p>
            </div>
          @endif
          <form class="affa-form-subscribe animation" data-animation="animation-fade-in" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group input">
              <label for="email" class="sr-only">Email address</label>
              <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email"
                     value="{{ old('email') }}" placeholder="Enter Your Email Address" required>
            </div>
            <div class="form-group input">
              <label for="password" class="sr-only">Password</label>
              <input id="password" type="password" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="password"
                     placeholder="Enter Your Password" required>
            </div>
            @if ($errors->has('email'))
              <div class="form-group input {{ $errors->has('email') ? 'has-error' : '' }}">
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              </div>
            @endif
            <p>
              <input type="submit" value="Sign In">
            </p>
          </form>
        </div>
      </div>
      <!-- .row end -->

      <!-- .row -->
      <div class="row">
        <div class="col-md-8 col-md-offset-2 contact-support">
          <h3>CONTACT SUPPORT</h3>
          <p>Please use the details below if you need to contact our support team.</p>
          <ul>
            <li><a href="mailto:support@throwsmart.com?subject=Train%20Smart%20Support%20Request">support@throwsmart.com</a></li>
            <li><a href="tel:+18665485077">1-866-548-5077</a></li>
          </ul>
        </div>
      </div>
      <!-- .row end -->
    </div>
    <!-- .container end -->
  </div>
  <!-- #login end -->
@endsection
