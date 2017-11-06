(function ($) {

    'use strict';

    var produk = {

        // Initialization the functions
        init: function () {
            //produk.AffixMenu();
            produk.SideNav();
            produk.Parallax();
            produk.SmoothScroll();
            produk.FeatureImagePointer();
            produk.SlickSlider();
            produk.CounterUp();
            produk.Lightbox();
            produk.AccordionFaqs();
            produk.PlaceHolder();
            produk.FormContact();
            produk.FormSubscribe();
            produk.Animated();
        },

        // Navigation menu affix
        AffixMenu: function () {
            var navMenu = '<nav id="navigation_affix">';
            navMenu += '<div class="container">';
            navMenu += '<div class="navbar">';
            navMenu += '<div class="navbar-brand">';
            navMenu += '<a href="/"><img src="images/SolidBlueBrain.png" alt="Logo" /><strong> | ThrowSmart</strong></a>';
            navMenu += '</div>';
            //navMenu += '<button class="navigation-toggle navbar-right">';
            //navMenu += $('#navigation .navigation-toggle').html();
            //navMenu += '</button>';
            navMenu += '</div>';
            navMenu += '</div>';
            navMenu += '</nav>';

            $('#header').before(navMenu);

            if ($('#navigation').hasClass('scrollspy')) {
                $('#navigation_affix').addClass('scrollspy');
            }

            $('#navigation').waypoint(function () {
                $('#navigation_affix').removeClass('show');

            }, {
                offset: -80
            });

            $('#navigation').waypoint(function () {
                $('#navigation_affix').addClass('show');

            }, {
                offset: -81
            });
        },

        // Side Navigation menu
        SideNav: function () {
            $('.somethingElse').on('click', function () {
                if ($('.sidenav').hasClass('open')) {
                    $('.sidenav').css('right', '-285px');
                    $('body').removeClass('sliding');
                    $('#navigation_affix').removeClass('move');
                    $('.sidenav').removeClass('open');
                }
                else {
                    $('.sidenav').css('right', '-1px');
                    $('body').addClass('sliding');
                    $('#navigation_affix').addClass('move');
                    $('.sidenav').addClass('open');
                    $('.overlay-body').css('visibility', 'visible');
                }
            });

            $('.overlay-body').on('click', function () {
                $('.sidenav').css('right', '-285px');
                $('body').removeClass('sliding');
                $('#navigation_affix').removeClass('move');
                $('.sidenav').removeClass('open');
                $('.overlay-body').css('visibility', 'hidden');
                setTimeout(function () {
                    $(window).trigger('resize.px.parallax');
                }, 500);
            });
        },

        // Embed animation effects to HTML elements with CSS3
        Animated: function () {
            $(window).on('load', function () {
                $('img.parallax-slider').imgpreload({
                    all: function () {
                        $('img.parallax-slider').addClass('loaded');
                    }
                });

                $('.animation, .animation-visible').each(function () {
                    var $element = $(this);
                    $element.waypoint(function () {
                        var delay = 0;
                        if ($element.attr('data-delay')) {
                            delay = parseInt($element.attr('data-delay'), 0);
                        }
                        if (!$element.hasClass('animated')) {
                            setTimeout(function () {
                                $element.addClass('animated ' + $element.attr('data-animation'));
                            }, delay);
                        }
                        delay = 0;
                    }, {
                        offset: '90%'
                    });
                });

                $('.animation-hover, .animation-hover-parent').on('hover', function () {
                    var $element = $(this);
                    if ($element.hasClass('animated')) {
                        $element.removeClass('animated');
                        $element.removeClass($element.attr('data-animation-hover'));
                    }
                    else {
                        $element.addClass('animated ' + $element.attr('data-animation-hover'));
                    }
                });

                $('.animation-click').on('click', function () {
                    var $element = $(this);
                    if ($element.hasClass('animated')) {
                        $element.removeClass('animated');
                        $element.removeClass($element.attr('data-animation-click'));
                    }
                    else {
                        $element.addClass('animated ' + $element.attr('data-animation-click'));
                    }
                });
            });
        },

        // Pointer Animation at Feature Image
        FeatureImagePointer: function () {
            $('.feature-image .feature-image-pointer .pointer-icon .pointer-icon-img').each(function () {
                var $element = $(this);

                $element.on('click', function () {
                    if ($(this).parents('.feature-image-pointer').hasClass('show')) {
                        $(this).parents('.feature-image-pointer').removeClass('show');
                        setTimeout(function () {
                            $element.parents('.feature-image-pointer').removeClass('show-end');
                        }, 200);
                    } else {
                        $(this).parents('.feature-image-pointer').addClass('show');
                        setTimeout(function () {
                            $element.parents('.feature-image-pointer').addClass('show-end');
                        }, 200);
                    }
                });
            });
        },

        // Background with parallax effect
        Parallax: function () {
            $(window).on('resize', function () {
                setTimeout(function () {
                    $(window).trigger('resize.px.parallax');
                }, 200);
            });

            $('.navigation-toggle, .affa-accordion .accordion-item.open').on('click', function () {
                setTimeout(function () {
                    $(window).trigger('resize.px.parallax');
                }, 500);
            });
        },

        // Slider with Slick carousel Testimonial
        SlickSlider: function () {
            $('.affa-testimonial-slider').slick({
                arrows: false,
                speed: 300,
                draggable: false,

                autoplaySpeed: 1000,
                infinite: true,
                asNavFor: '.affa-client-logo-slider'
            });

            $('.affa-client-logo-slider').slick({
                arrows: false,
                speed: 300,
                draggable: false,

                autoplaySpeed: 1000,
                slidesToShow: 6,
                slidesToScroll: 6,
                infinite: true,
                asNavFor: '.affa-testimonial-slider',
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            infinite: true,
                            centerMode: true,
                            focusOnSelect: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            centerMode: true,
                            focusOnSelect: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            centerMode: true,
                            focusOnSelect: true
                        }
                    },
                    {
                        breakpoint: 580,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                            focusOnSelect: true
                        }
                    },
                    {
                        breakpoint: 540,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },

        // Preview images popup gallery with Fancybox
        Lightbox: function () {
            $('.fancybox').fancybox({
                loop: false
            });

            $('.fancybox-media').attr('rel', 'media-gallery').fancybox({
                openEffect: 'none',
                closeEffect: 'none',
                prevEffect: 'none',
                nextEffect: 'none',
                arrows: false,
                helpers: {
                    title: null,
                    media: {},
                    buttons: {}
                }
            });
        },

        // Smooth scrolling to anchor section
        SmoothScroll: function () {
            $('a.smooth-scroll').on('click', function (event) {
                var $anchor = $(this);
                var offsetTop = '';

                if (window.Response.band(768)) {
                    offsetTop = parseInt($($anchor.attr('href')).offset().top - 0, 0);
                } else {
                    offsetTop = parseInt($($anchor.attr('href')).offset().top, 0);
                }

                $('html, body').stop().animate({
                    scrollTop: offsetTop
                }, 1500, 'easeInOutExpo');

                event.preventDefault();
            });
        },

        // Accordion animation
        AccordionFaqs: function () {
            $('.accordion-item').accordion({
                "transitionSpeed": 400
            });
        },

        // Placeholder compatibility for IE8
        PlaceHolder: function () {
            $('input, textarea').placeholder();
        },

        // Form submit function
        FormContact: function () {
            var pattern = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;

            // Checking form input when focus and keypress event
            $('.affa-form-contact, .affa-form-contact input[type="text"], .affa-form-contact input[type="email"], .affa-form-contact textarea').on('focus keypress', function () {
                var $input = $(this);

                if ($input.hasClass('error')) {
                    $input.removeClass('error');
                }
            });

            // Contact form when submit button clicked
            $('.affa-form-contact').on('submit', function () {
                var $form = $(this);
                var submitData = $form.serialize();
                var $name = $form.find('input[name="name"]');
                var $email = $form.find('input[name="email"]');
                var $subject = $form.find('input[name="subject"]');
                var $message = $form.find('textarea[name="message"]');
                var $submit = $form.find('button[type="submit"]');
                var status = true;
                var error = 0;

                if ($email.val() === '' || pattern.test($email.val()) === false) {
                    $email.addClass('error');
                    error = 1;
                }
                if ($message.val() === '') {
                    $message.addClass('error');
                    error = 2;
                }

                if (status) {
                    $name.attr('disabled', 'disabled');
                    $email.attr('disabled', 'disabled');
                    $message.attr('disabled', 'disabled');
                    $subject.attr('disabled', 'disabled');
                    $submit.attr('disabled', 'disabled');

                    $.ajax({
                        type: 'POST',
                        url: 'process-contact.php',
                        data: submitData + '&action=add',
                        dataType: 'html',
                        success: function (msg) {
                            if (parseInt(msg, 0) !== 0) {
                                var msg_split = msg.split('|');
                                if (msg_split[0] === 'success') {
                                    $name.val('').removeAttr('disabled').removeClass('error');
                                    $email.val('').removeAttr('disabled').removeClass('error');
                                    $subject.val('').removeAttr('disabled').removeClass('error');
                                    $message.val('').removeAttr('disabled').removeClass('error');
                                    $submit.removeAttr('disabled');
                                    $form.find('.submit-status').html('<div class="submit-status-text"><span class="success"><i class="ion ion-ios-checkmark"></i> ' + msg_split[1] + '</span></div>').fadeIn(300).delay(3000).fadeOut(300);
                                } else {
                                    if (error === 1) {
                                        $email.removeAttr('disabled');
                                        $message.removeAttr('disabled').removeClass('error');
                                    } else if (error === 2) {
                                        $email.removeAttr('disabled').removeClass('error');
                                        $message.removeAttr('disabled');
                                    } else {
                                        $email.removeAttr('disabled').removeClass('error');
                                        $message.removeAttr('disabled').removeClass('error');
                                    }
                                    $name.removeAttr('disabled').removeClass('error');
                                    $submit.removeAttr('disabled').removeClass('error');
                                    $form.find('.submit-status').html('<div class="submit-status-text"><span class="error"><i class="fa fa-exclamation-circle"></i> ' + msg_split[1] + '</span></div>').fadeIn(300).delay(3000).fadeOut(300);
                                }
                            }
                        }
                    });
                }

                status = true;

                return false;
            });
        },
        // Form subscribe function
        FormSubscribe: function () {
            var pattern = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;

            // Checking subcribe form input when focus and keypress event
            $('.affa-form-subscribe input, .affa-form-subscribe input[type="text"], .affa-form-subscribe input[type="email"]').on('focus keypress', function () {
                var $input = $(this);

                if ($input.hasClass('error')) {
                    $input.val('').removeClass('error');
                }
                if ($input.hasClass('success')) {
                    $input.val('').removeClass('success');
                }
            });

            // Subscribe form when submit button clicked
            $('.affa-form-subscribe').on('submit', function () {
                var $email = $(this).find('input[name="email"]');
                var $submit = $(this).find('button[type="submit"]');

                if (pattern.test($email.val()) === false) {
                    $email.val('Please enter a valid email address!').addClass('error');
                } else {
                    var submitData = $(this).serialize();
                    $email.attr('disabled', 'disabled');
                    $submit.attr('disabled', 'disabled');
                    $.ajax({
                        type: 'POST',
                        url: 'process-subscribe.php',
                        data: submitData + '&action=add',
                        dataType: 'html',
                        success: function (msg) {
                            if (parseInt(msg, 0) !== 0) {
                                var msg_split = msg.split('|');

                                if (msg_split[0] === 'success') {
                                    $submit.removeAttr('disabled');
                                    $email.removeAttr('disabled').val(msg_split[1]).addClass('success');
                                } else {
                                    $submit.removeAttr('disabled');
                                    $email.removeAttr('disabled').val(msg_split[1]).addClass('error');
                                }
                            }
                        }
                    });
                }

                return false;
            });
        },

        // Number counter ticker animation
        CounterUp: function () {
            $('.affa-counter > h4 > span, .affa-counter2 > h4 > span').counterUp({
                delay: 10,
                time: 3000
            });
        }
    };//end var produck

    // Run the main function
    $(function () {
        produk.init();
    });

})(window.jQuery);

$("#emailChangeTrigger").click(function () {
        $("#emailChange").fadeTo("fast", 0.5, function () {
            $("#emailChange").html("support@throwsmart.com");
        })
    }
)
