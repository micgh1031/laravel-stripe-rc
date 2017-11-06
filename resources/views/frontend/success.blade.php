@extends('layouts.app')

@section('content')
  <!-- #success -->
  <div id="success" class="bg-image container-padding120">
    <!-- .container -->
    <div class="container">
      <div class="post-heading-center animation" data-animation="animation-fade-in-up">
        <h2>Congratulations!</h2>
        <p>You completed the subscription process successfully.</p>
      </div>

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
