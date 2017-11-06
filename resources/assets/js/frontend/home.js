let Home = {

    init: function() {
        this.bindUIActions();
    },

    bindUIActions: function() {
        $(function() {
            $('select#package1_period').trigger('change');
            $('input#package1_equipment').trigger('change');
        });

        let standardPrice = (parseFloat($('input#standardPrice').val())).toFixed(2);
        let discountedPrice = (parseFloat($('input#discountedPrice').val())).toFixed(2);
        let savePrice = discountedPrice;
        let equipmentFee = 0.00;

        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        /*
         * ==
         *
         * Package 1 - Annual commitment, no prepaid period
         * @param : planType = 1, planAmount = discounted price, planTrialPeriod = 0
         *
         * Package 2 - No annual commitment, no prepaid period
         * @param : planType = 2, planAmount = standard price, planTrialPeriod = 0
         *
         * Package 3 - Annual commitment, 3 months prepaid
         * @param : planType = 1, planAmount = discounted price, planTrialPeriod = 90 days
         *
         * Package 4 - Annual commitment (implied), one year prepaid
         * @param : planType = 1, planAmount = discounted price, planTrialPeriod = 365 days
         *
         * ==
         *
         * Package Setup Fee - unless add the equipment in Package 1 & 2
         * @param : chargeType = 1, chargeAmount = 0.00
         *
         * Equipment Setup Fee - if add the equipment in Package 1 & 2
         * @param : chargeType = 2, chargeAmount = 150.00
         *
         * Package + Equipment Setup Fee - required in Package 3 & 4
         * @param : chargeType = 3, chargeAmount = number of prepaid months x discounted price + equipment setup fee
         *
         * ==
         */
        let planType = 1;
        let planAmount = discountedPrice;
        let planTrialPeriod = 0;
        let chargeType = 1;
        let chargeAmount = 0.00;

        let stripeHandler = StripeCheckout.configure({
            key: $("#stPubKey").val(),
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
            locale: 'auto',
            token: function(token) {
                // Use the token to create the charge with a server-side script.
                // You can access the token ID with `token.id`
                // Pass along various parameters you get from the token response and your form.
                let myData = {
                    stripeToken: token.id,
                    _token: CSRF_TOKEN,
                    stripeEmail: token.email,
                    planType: planType,
                    planAmount: planAmount,
                    planTrialPeriod: planTrialPeriod,
                    chargeType: chargeType,
                    chargeAmount: chargeAmount,
                };

                let actionURL = $("#actionURL").val();

                wrapperIsLoading($("body#main")); // add the loading spinner

                // Make an AJAX post request using jQuery, change the first parameter to your charge script.
                $.ajax({
                    url: actionURL,
                    type: 'POST',
                    data: myData,
                    success: function (data) {
                        // Successful POST
                        // do whatever you want

                        if (data.hasOwnProperty('success')) {
                            // wrapperEndLoading($("body#main")); // remove the loading spinner

                            console.log(data.success);
                            window.location.href = $("#successURL").val();
                        }

                        if (data.hasOwnProperty('error')) {
                            wrapperEndLoading($("body#main")); // remove the loading spinner

                            $("#payment_error").html(data.error);
                            $("#errorModal").modal("show");
                        }
                    },
                    error: function (data) {
                    }
                });
            }
        });

        let checkoutForm = function (amount) {
            // Open Checkout with further options:
            stripeHandler.open({
                name: 'Stripe.com',
                description: 'Train Smart Payment Gateway',
                zipCode: true,
                amount: amount
            });
        };

        // Close Checkout on page navigation:
        window.addEventListener('popstate', function() {
            stripeHandler.close();
        });

        $('select#package1_period').on('change', function() {
            if ($(this).val() * 1 === 1) {
                let total = (parseFloat(discountedPrice) + parseFloat(equipmentFee)).toFixed(2);
                savePrice = discountedPrice;

                $('div#package1_major').html('$' + parseInt(discountedPrice));
                $('div#package1_minor').html((discountedPrice - parseInt(discountedPrice)).toFixed(2) * 100 + '/<br />mo');
                $('input#package1_amount').val(total * 100);
                $('div#package1_today').html('$' + total);

                planType = 1;
                planAmount = discountedPrice;
                planTrialPeriod = 0;
            } else {
                let total = (parseFloat(standardPrice) + parseFloat(equipmentFee)).toFixed(2);
                savePrice = standardPrice;

                $('div#package1_major').html('$' + parseInt(standardPrice));
                $('div#package1_minor').html((standardPrice - parseInt(standardPrice)).toFixed(2) * 100 + '/<br />mo');
                $('input#package1_amount').val(total * 100);
                $('div#package1_today').html('$' + total);

                planType = 2;
                planAmount = standardPrice;
                planTrialPeriod = 0;
            }
        });

        $('input#package1_equipment').on('change', function() {
            if ($(this).is(":checked")) {
                let val = (parseFloat(savePrice) + parseFloat(150.00)).toFixed(2);
                $('input#package1_amount').val(val * 100);
                $('div#package1_today').html('$' + val);

                chargeType = 2;
                chargeAmount = equipmentFee = 150.00;
            } else {
                $('input#package1_amount').val(savePrice * 100);
                $('div#package1_today').html('$' + savePrice);

                chargeType = 1;
                chargeAmount = equipmentFee = 0.00;
            }
        });

        $("form#package1_form").on('submit', function (e) {
            let amount = parseInt($("input#package1_amount").val());

            checkoutForm(amount);
            e.preventDefault();
        });

        $("form#package2_form").on('submit', function (e) {
            let amount = parseInt($("input#package2_amount").val());
            planType = 1;
            planAmount = discountedPrice;
            planTrialPeriod = 90;
            chargeType = 3;
            chargeAmount = amount / 100;

            checkoutForm(amount);
            e.preventDefault();
        });

        $("form#package3_form").on('submit', function (e) {
            let amount = parseInt($("input#package3_amount").val());
            planType = 1;
            planAmount = discountedPrice;
            planTrialPeriod = 365;
            chargeType = 3;
            chargeAmount = amount / 100;

            checkoutForm(amount);
            e.preventDefault();
        });

    },
};

Home.init();
