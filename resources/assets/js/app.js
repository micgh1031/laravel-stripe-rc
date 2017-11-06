let version = 1.0;
let loadJS = function(url, implementationCode){
    let scriptTag = document.createElement('script');
    scriptTag.src = url+'?ver='+version;
    scriptTag.onload = implementationCode;
    scriptTag.onreadystatechange = implementationCode;
    document.body.appendChild(scriptTag);
};


let path = window.location.pathname;
let pathArray = path.split("/");
let page = pathArray.pop();
if (page === 'login')
    page = 'auth/login';
else
    page = 'frontend/' + page;

loadJS('/js/' + page + '.js');

let App = {

    // Initialization the functions
    init: function () {
        App.Animated();
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

};

function wrapperIsLoading(wrapper) {
    wrapper.append('<div class="loader"></div>');
}
function wrapperEndLoading(wrapper) {
    wrapper.find('div.loader').remove();
}

App.init();
