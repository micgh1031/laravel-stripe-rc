<!-- Modal -->
<div id="payModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Make a Payment">
  <div class="modal-dialog" role="document">

    <!-- Modal content-->
    <div class="modal-content  dark-bg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="payModalLabel">Subscription Plan: General</h4>
      </div>
      <div class="modal-body light-bg">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="form-group" id="payByCard">
              <form method="POST" action="#">
                {{ csrf_field() }}

                <input type="hidden" name="amount" value="{{ 29.95 * 100 }}">
                <input type="hidden" name="subscription_plan" value="General Plan">

                <h4>Terms of Service</h4>
                <p>Something should be here!</p>
                <hr>
                <div class="text-center">
                  <script
                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      data-key="{{ config('app.stripe_key') }}"
                      data-amount="{{ 29.95 * 100 }}"
                      data-name="Stripe.com"
                      data-description="Train Smart Payment Gateway"
                      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                      data-locale="auto"
                      data-zip-code="true">
                  </script>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal content end -->

  </div>
</div>
<!-- Modal end -->
