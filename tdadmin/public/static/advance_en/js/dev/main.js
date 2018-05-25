jQuery.easing.jswing = jQuery.easing.swing;

jQuery.extend(jQuery.easing, {
	def: "easeOutQuad",
	swing: function(e, n, t, r, a) {
		return jQuery.easing[jQuery.easing.def](e, n, t, r, a)
	},
	easeInQuad: function(e, n, t, r, a) {
		return r * (n /= a) * n + t
	},
	easeOutQuad: function(e, n, t, r, a) {
		return -r * (n /= a) * (n - 2) + t
	},
	easeInOutQuad: function(e, n, t, r, a) {
		return (n /= a / 2) < 1 ? r / 2 * n * n + t : -r / 2 * (--n * (n - 2) - 1) + t
	},
	easeInCubic: function(e, n, t, r, a) {
		return r * (n /= a) * n * n + t
	},
	easeOutCubic: function(e, n, t, r, a) {
		return r * ((n = n / a - 1) * n * n + 1) + t
	},
	easeInOutCubic: function(e, n, t, r, a) {
		return (n /= a / 2) < 1 ? r / 2 * n * n * n + t : r / 2 * ((n -= 2) * n * n + 2) + t
	},
	easeInQuart: function(e, n, t, r, a) {
		return r * (n /= a) * n * n * n + t
	},
	easeOutQuart: function(e, n, t, r, a) {
		return -r * ((n = n / a - 1) * n * n * n - 1) + t
	},
	easeInOutQuart: function(e, n, t, r, a) {
		return (n /= a / 2) < 1 ? r / 2 * n * n * n * n + t : -r / 2 * ((n -= 2) * n * n * n - 2) + t
	},
	easeInQuint: function(e, n, t, r, a) {
		return r * (n /= a) * n * n * n * n + t
	},
	easeOutQuint: function(e, n, t, r, a) {
		return r * ((n = n / a - 1) * n * n * n * n + 1) + t
	},
	easeInOutQuint: function(e, n, t, r, a) {
		return (n /= a / 2) < 1 ? r / 2 * n * n * n * n * n + t : r / 2 * ((n -= 2) * n * n * n * n + 2) + t
	},
	easeInSine: function(e, n, t, r, a) {
		return -r * Math.cos(n / a * (Math.PI / 2)) + r + t
	},
	easeOutSine: function(e, n, t, r, a) {
		return r * Math.sin(n / a * (Math.PI / 2)) + t
	},
	easeInOutSine: function(e, n, t, r, a) {
		return -r / 2 * (Math.cos(Math.PI * n / a) - 1) + t
	},
	easeInExpo: function(e, n, t, r, a) {
		return 0 == n ? t : r * Math.pow(2, 10 * (n / a - 1)) + t
	},
	easeOutExpo: function(e, n, t, r, a) {
		return n == a ? t + r : r * (-Math.pow(2, -10 * n / a) + 1) + t
	},
	easeInOutExpo: function(e, n, t, r, a) {
		return 0 == n ? t : n == a ? t + r : (n /= a / 2) < 1 ? r / 2 * Math.pow(2, 10 * (n - 1)) + t : r / 2 * (-Math.pow(2, -10 * --n) + 2) + t
	},
	easeInCirc: function(e, n, t, r, a) {
		return -r * (Math.sqrt(1 - (n /= a) * n) - 1) + t
	},
	easeOutCirc: function(e, n, t, r, a) {
		return r * Math.sqrt(1 - (n = n / a - 1) * n) + t
	},
	easeInOutCirc: function(e, n, t, r, a) {
		return (n /= a / 2) < 1 ? -r / 2 * (Math.sqrt(1 - n * n) - 1) + t : r / 2 * (Math.sqrt(1 - (n -= 2) * n) + 1) + t
	},
	easeInElastic: function(e, n, t, r, a) {
		var i = 1.70158,
			o = 0,
			u = r;
		if (0 == n) return t;
		if (1 == (n /= a)) return t + r;
		if (o || (o = .3 * a), u < Math.abs(r)) {
			u = r;
			var i = o / 4
		} else var i = o / (2 * Math.PI) * Math.asin(r / u);
		return -(u * Math.pow(2, 10 * (n -= 1)) * Math.sin((n * a - i) * (2 * Math.PI) / o)) + t
	},
	easeOutElastic: function(e, n, t, r, a) {
		var i = 1.70158,
			o = 0,
			u = r;
		if (0 == n) return t;
		if (1 == (n /= a)) return t + r;
		if (o || (o = .3 * a), u < Math.abs(r)) {
			u = r;
			var i = o / 4
		} else var i = o / (2 * Math.PI) * Math.asin(r / u);
		return u * Math.pow(2, -10 * n) * Math.sin((n * a - i) * (2 * Math.PI) / o) + r + t
	},
	easeInOutElastic: function(e, n, t, r, a) {
		var i = 1.70158,
			o = 0,
			u = r;
		if (0 == n) return t;
		if (2 == (n /= a / 2)) return t + r;
		if (o || (o = a * (.3 * 1.5)), u < Math.abs(r)) {
			u = r;
			var i = o / 4
		} else var i = o / (2 * Math.PI) * Math.asin(r / u);
		return 1 > n ? -.5 * (u * Math.pow(2, 10 * (n -= 1)) * Math.sin((n * a - i) * (2 * Math.PI) / o)) + t : u * Math.pow(2, -10 * (n -= 1)) * Math.sin((n * a - i) * (2 * Math.PI) / o) * .5 + r + t
	},
	easeInBack: function(e, n, t, r, a, i) {
		return void 0 == i && (i = 1.70158), r * (n /= a) * n * ((i + 1) * n - i) + t
	},
	easeOutBack: function(e, n, t, r, a, i) {
		return void 0 == i && (i = 1.70158), r * ((n = n / a - 1) * n * ((i + 1) * n + i) + 1) + t
	},
	easeInOutBack: function(e, n, t, r, a, i) {
		return void 0 == i && (i = 1.70158), (n /= a / 2) < 1 ? r / 2 * (n * n * (((i *= 1.525) + 1) * n - i)) + t : r / 2 * ((n -= 2) * n * (((i *= 1.525) + 1) * n + i) + 2) + t
	},
	easeInBounce: function(e, n, t, r, a) {
		return r - jQuery.easing.easeOutBounce(e, a - n, 0, r, a) + t
	},
	easeOutBounce: function(e, n, t, r, a) {
		return (n /= a) < 1 / 2.75 ? r * (7.5625 * n * n) + t : 2 / 2.75 > n ? r * (7.5625 * (n -= 1.5 / 2.75) * n + .75) + t : 2.5 / 2.75 > n ? r * (7.5625 * (n -= 2.25 / 2.75) * n + .9375) + t : r * (7.5625 * (n -= 2.625 / 2.75) * n + .984375) + t
	},
	easeInOutBounce: function(e, n, t, r, a) {
		return a / 2 > n ? .5 * jQuery.easing.easeInBounce(e, 2 * n, 0, r, a) + t : .5 * jQuery.easing.easeOutBounce(e, 2 * n - a, 0, r, a) + .5 * r + t
	}
});

 function viewport() {
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

function toPosition() {
  if (window.location.hash) {
    var hash_val = window.location.hash.substr(1);
    if (hash_val) {
      if ($('#' + hash_val).offset()) {
        var top = $('#' + hash_val).offset().top || 0;
      }
      $(document).scrollTop(top);
    }
  }
}

function animateMenubar () {
  var w_width = viewport().width;
  if (w_width > 768) {
    var duration = 500;
    var speed = $('.menu-wrapper a').first().width() / duration;
    var delay_time = 700;
    $('.menu-wrapper a').each(function(index) {
      var w = $(this).width();
      var new_w = w;
      $(this).find('span.bar-background').css({
        width: w
      }).delay(delay_time - 100 * index).animate({
        width: 0
      }, {
        duration: (new_w / speed),
        easing: 'easeInQuart'
      });
      $(this).css({
        color: '#fff'
      }).delay(delay_time - 100 * index).animate({
        color: '#676767'
      }, {
        duration: (new_w / speed),
        easing: 'easeInQuart',
        complete: function() {
          $(this).removeAttr('style');
        }
      });
      delay_time += (new_w / speed);
    });
  }
}

$(window).load(function() {
  var w_width = viewport().width;
  var is_flex_visible = false;
  var $flex_cache;
  if (w_width >=768) {
    is_flex_visible = true;
    $('.flexslider').flexslider({
      controlsContainer: ".flex-container",
      directionNav: false,
      useCss: false,
      start: function() {
        setTimeout(function() {
          $('#preloader').fadeOut(1500);
          animateMenubar();
          toPosition();
        }, 100);
      }
    });
  } else {
    $flex_cache = $('.flex-container-wrapper').clone();
    $('.flex-container-wrapper').remove();
    $('#preloader').fadeOut(1500);
    setTimeout(toPosition, 100);
    is_flex_visible = false;
  }

  $(window).resize(function() {
    var w_width = viewport().width;
    if (w_width < 768) {
      if (is_flex_visible) {
        $flex_cache = $('.flex-container-wrapper').clone();
        $('.flex-container-wrapper').remove();
        is_flex_visible = false;
        $(window).trigger('scroll');
      }
    } else {
      if (!is_flex_visible) {
        $flex_cache.find('.clone, .flex-control-nav').remove();
        $flex_cache.find('.flexslider, .slides, .slides li').removeAttr('style');
        $flex_cache.appendTo('.flex-container-outer-wrapper');
        $('.flexslider').flexslider({
          controlsContainer: ".flex-container",
          directionNav: false,
          useCss: false,
          start: function() {
            $(window).trigger('scroll');
          },
          after: function() {
          }
        });
        is_flex_visible = true;
      }
    }
  });
});




$(function() {
  $('.menu-wrapper a').on('mouseenter mouseleave', function(e) {
    var w_width = viewport().width;
    if (w_width > 768) {
      var $cur = $(this);
      var w = e.type === 'mouseenter' ? $cur.width() : 0;
      $cur.find('span.bar-background').stop().animate({
        width: w
      }, {
        duration: 200
      });
    }
  });
});

$(function() {
  $('.private-feature-inner-wrapper').on('mouseenter mouseleave', function(e) {
    var w_width = viewport().width;
    if (w_width >= 768) {
      var $cur = $(this);
      var $slide = $cur.find('.private-feature-slide');
      var $caption = $cur.find('.private-feature-caption');
      var $first_li = $cur.find('.private-first-item');
      var $second_li = $cur.find('.private-second-item');
      var height1 = $cur.height();
      var height2 = $slide.height();
      var offset = e.type === 'mouseenter' ? (height1 - height2) : 0;
      if (e.type === 'mouseenter') {   
        $slide
          .stop()
          .animate({
            'margin-top': offset
          }, {
            duration: 300,
            easing: 'easeOutQuart'
          }).promise().done(function() {
            $first_li.addClass('seq');         
            $second_li.addClass('seq');
          });
          $caption.addClass('show');
      } else {
        $slide.stop().animate({
          'margin-top': offset
        }, {
          duration: 200,
          easing: 'easeOutQuart'
        }).promise().done(function() {
          $caption.removeClass('show');
          $first_li.removeClass('seq');
          $second_li.removeClass('seq');
        });
      }
      
    }
  });

  $('.private-feature-inner-wrapper').click(function() {
    var w_width = viewport().width;
      if (w_width < 768) {
        var $cur = $(this);
        var $slide = $cur.find('.private-feature-slide');
        var $caption = $cur.find('.private-feature-caption');
        var $li = $cur.find('li');
        var height1 = $cur.height();
        var height2 = $slide.height();
        if (!($li.hasClass('seq'))) {   
          $slide
            .stop()
            .animate({
              'margin-top': height1 - height2
            }, {
              duration: 300,
              easing: 'easeOutQuart'
            }).promise().done(function() {
              $li.addClass('seq');      
            });
            $caption.addClass('show');
        } else {
          $slide.stop().animate({
            'margin-top': 0
          }, {
            duration: 200,
            easing: 'easeOutQuart'
          }).promise().done(function() {
            $caption.removeClass('show');
            $li.removeClass('seq');
          });
        }
        
      }
  });

  $(window).resize(function() {
    $('.private-feature-inner-wrapper').find('li').removeClass('seq');
    $('.private-feature-inner-wrapper').find('.private-feature-caption').removeClass('show');
    $('.private-feature-inner-wrapper').find('.private-feature-slide').removeAttr('style');
  });
});