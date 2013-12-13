!(function() {
    var StripeBilling = {
        init: function() {
            this.form = $('#registration-form');
            this.submitButton = this.form.find('button[type=submit]');
            this.submitButtonText = this.submitButton.text();

            var stripeKey = $('meta[name="stripe-key"]').attr('content');
            Stripe.setPublishableKey(stripeKey);

            this.bindEvents();
        },

        bindEvents: function() {
            this.form.on('submit', $.proxy(this.sendToken, this));
        },

        sendToken: function(event) {
            var form = this.form;
            
            if (! Validator(
                form,
                function(input) {
                    input.closest('.form-group').removeClass('has-error');
                },
                function(input) {
                    input.closest('.form-group').addClass('has-error');
                }
            )) return false;

            this.submitButton.html('<i class="icon-spinner icon-spin icon-large"></i>')

            Stripe.createToken(form, $.proxy(this.stripeResponseHandler, this));

            event.preventDefault();
        },

        stripeResponseHandler: function(status, response) {
            console.log(status, response);
            
            if (response.error) {
                this.submitButton.prop('disabled', false).text(this.submitButtonText);
                this.form.find('.payment-errors').show().text(response.error.message);
            } else {
                $('<input>', {
                    type: 'hidden',
                    name: 'stripe-token',
                    value: response.id // token
                }).appendTo(this.form);

                this.form.get(0).submit();
            }
        }
    };

    var Validator = (function() {
        var rules = {
            'cc-number': 'validateCardNumber',
            'cvv': 'validateCVC'
        };

        var success;

        return function(form, cbSuccess, cbFail) {
            success = true;

            $.each(rules, function(id, validator) {
                var input = form.find('#' + id);
                var validated = Stripe.card[validator](input.val());

                if (validated) {
                    cbSuccess(input);
                } else {
                    cbFail(input);
                    success = false;
                }
            });

            return success;
        };
    })();

    StripeBilling.init();
})();
