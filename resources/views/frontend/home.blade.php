@extends('layouts.app')

@section('content')
  <!-- #pricing -->
  <div id="home" class="bg-grey container-padding80">

    <!-- .container -->
    <div class="container">

      <div class="post-heading-center animation" data-animation="animation-fade-in-up">
        <h2>PLANS &amp; PACKAGES</h2>
      </div>

      <!-- .row -->
      <div class="row">
        <input type="hidden" id="stPubKey" value="{{ config('app.stripe_key') }}">
        <input type="hidden" id="actionURL" value="{{ route('payment') }}">
        <input type="hidden" id="successURL" value="{{ route('success') }}">
        <input type="hidden" id="standardPrice" value="{{ $standardPrice }}">
        <input type="hidden" id="discountedPrice" value="{{ $discountedPrice }}">

        <div class="no-padding col-sm-4">
          <div class="affa-tbl-prc animation" data-animation="animation-fade-in">
            <div class="tbl-prc-base">
              <div class="tbl-prc-tag-line">
                <p>Equipment Optional</p>
              </div>
              <div class="tbl-prc-heading">
                <h5>MONTH to MONTH</h5>
                <p class="sub-heading">Equipment Optional</p>
                <div class="tbl-prc-price">
                  <div class="major" id="package1_major">
                    ${{ (int) $discountedPrice }}
                  </div>
                  <div class="minor" id="package1_minor">
                    {{ ($discountedPrice - (int) $discountedPrice) * 100 }}/<br>mo
                  </div>
                </div>
                <p class="commitment">Requires Annual Commitment</p>
                <select id="package1_period">
                  <option value="1" selected="selected">Annual</option>
                  <option value="2">Monthly</option>
                </select>
              </div>
              <ul class="tbl-prc-list-features">
                <li>Personalized Throwing Program</li>
                <li>Personalized Strength Workouts</li>
                <li>Personalized Recovery Routines</li>
                <li>Workload Manager</li>
                <li>Progress Tracker</li>
              </ul>
              <div class="tbl-prc-equipment">
                <p class="heading">Equipment Optional $150 (add below)</p>
                <p class="add">
                  <input type="checkbox" id="package1_equipment"> Add Equipment (+ $150)
                </p>
                <ul>
                  <li>- V+ Weighted Ball Kit</li>
                  <li>- PREMIUM Resistance Band Sets (5lb, 10lb &amp; 15lb)</li>
                </ul>
              </div>
              <div class="tbl-today">
                <div>Today:</div>
                <input type="hidden" id="package1_amount" value="{{ $discountedPrice * 100 }}">
                <div class="total" id="package1_today">${{ $discountedPrice }}</div>
              </div>
              <div class="tbl-prc-btn">
                <form id="package1_form" method="POST" action="{{ route('payment') }}">
                  {{ csrf_field() }}

                  <button type="submit" class="btn-custom hvr-shutter-out-horizontal">
                    SELECT
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="no-padding col-sm-4">
          <div class="affa-tbl-prc animation" data-animation="animation-fade-in" data-delay="400">
            <div class="tbl-prc-base recommended">
              <div class="tbl-prc-heading">
                <div class="tbl-prc-tag-line strong">
                  <p>Includes V+ Balls &amp; Premium Bands</p>
                </div>
                <div class="tbl-prc-label">
                  <p>Best Seller</p>
                </div>
                <h5>ALL INCLUSIVE</h5>
                <p class="sub-heading period">3 Months Prepaid</p>
                <p class="sub-heading save">Save $65</p>
                <div class="tbl-prc-price">
                  <div class="major">
                    ${{ (int) $discountedPrice }}
                  </div>
                  <div class="minor">
                    {{ ($discountedPrice - (int) $discountedPrice) * 100 }}/<br>mo
                  </div>
                </div>
                <p class="commitment">Requires Annual Commitment</p>
              </div>
              <ul class="tbl-prc-list-features">
                <li>Personalized Throwing Program</li>
                <li>Personalized Strength Workouts</li>
                <li>Personalized Recovery Routines</li>
                <li>Workload Manager</li>
                <li>Progress Tracker</li>
              </ul>
              <div class="tbl-prc-equipment">
                <div class="included"><div>Equipment:</div><div class="increase">+ $85</div></div>
                <ul>
                  <li>- V+ Weighted Ball Kit</li>
                  <li>- PREMIUM Resistance Band Sets (5lb, 10lb &amp; 15lb)</li>
                </ul>
              </div>
              <div class="tbl-today">
                <div>Today:</div>
                <input type="hidden" id="package2_amount" value="{{ ($discountedPrice * 3 + 85.00) * 100 }}">
                <div class="total">${{ sprintf('%0.2f', $discountedPrice * 3 + 85.00) }}</div>
              </div>
              <div class="tbl-prc-btn">
                <form id="package2_form" method="POST" action="{{ route('payment') }}">
                  {{ csrf_field() }}

                  <button type="submit" class="btn-custom hvr-shutter-out-horizontal">
                    SELECT
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="no-padding col-sm-4">
          <div class="affa-tbl-prc animation" data-animation="animation-fade-in" data-delay="200">
            <div class="tbl-prc-base">
              <div class="tbl-prc-tag-line strong">
                <p>Includes V+ Balls &amp; Premium Bands</p>
              </div>
              <div class="tbl-prc-heading">
                <h5>ALL INCLUSIVE</h5>
                <p class="sub-heading period">1 Year Prepaid</p>
                <p class="sub-heading save">Save $110</p>
                <div class="tbl-prc-price">
                  <div class="major">
                    ${{ (int) $discountedPrice }}
                  </div>
                  <div class="minor">
                    {{ ($discountedPrice - (int) $discountedPrice) * 100 }}/<br>mo
                  </div>
                </div>
              </div>
              <ul class="tbl-prc-list-features">
                <li>Personalized Throwing Program</li>
                <li>Personalized Strength Workouts</li>
                <li>Personalized Recovery Routines</li>
                <li>Workload Manager</li>
                <li>Progress Tracker</li>
              </ul>
              <div class="tbl-prc-equipment">
                <div class="included"><div>Equipment:</div><div class="increase">+ $40</div></div>
                <ul>
                  <li>- V+ Weighted Ball Kit</li>
                  <li>- PREMIUM Resistance Band Sets (5lb, 10lb &amp; 15lb)</li>
                </ul>
              </div>
              <div class="tbl-today">
                <div>Today:</div>
                <input type="hidden" id="package3_amount" value="{{ ($discountedPrice * 12 + 40.00) * 100 }}">
                <div class="total">${{ sprintf('%0.2f', $discountedPrice * 12 + 40.00) }}</div>
              </div>
              <div class="tbl-prc-btn">
                <form id="package3_form" method="POST" action="{{ route('payment') }}">
                  {{ csrf_field() }}

                  <button type="submit" class="btn-custom hvr-shutter-out-horizontal">
                    SELECT
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- .row end -->

    </div>
    <!-- .container end -->

  </div>
  <!-- #pricing end -->

  <!-- #paymentModal -->
  {{--@include('frontend._pay_modal')--}}
  <!-- #paymentModal end -->

  <!-- #errorModal -->
  <div class="modal fade" id="errorModal" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header alert alert-danger">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Error</h4>
        </div>
        <div class="modal-body">
          <p id="payment_error"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn info" data-dismiss="modal">Try again</button>
        </div>
      </div>

    </div>
  </div>
  <!-- #errorModal end -->
@endsection

@section('script')
  <script>

  </script>
@endsection
