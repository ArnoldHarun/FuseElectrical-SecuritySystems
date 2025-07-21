;((window, document, $) => {
  // Preloader
  $(window).on("load", () => {
    if ($("#preloader").length) {
      $("#preloader")
        .delay(100)
        .fadeOut("slow", function () {
          $(this).remove()
        })
    }
  })

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".back-to-top").fadeIn("slow")
    } else {
      $(".back-to-top").fadeOut("slow")
    }
  })
  $(".back-to-top").click(() => {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      1500,
      "easeInOutExpo",
    )
    return false
  })

  // Import WOW library
  const WOW = window.WOW
  // Initiate the wowjs animation library
  new WOW().init()

  // Header scroll class
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $("#header").addClass("header-scrolled")
    } else {
      $("#header").removeClass("header-scrolled")
    }
  })

  if ($(window).scrollTop() > 100) {
    $("#header").addClass("header-scrolled")
  }

  // Smooth scroll for the navigation and links with .scrollto classes
  $(".nav-menu a, #mobile-nav a, .scrollto").on("click", function () {
    if (
      location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      var target = $(this.hash)
      if (target.length) {
        var top_space = 0

        if ($("#header").length) {
          top_space = $("#header").outerHeight()

          if (!$("#header").hasClass("header-scrolled")) {
            top_space = top_space - 40
          }
        }

        $("html, body").animate(
          {
            scrollTop: target.offset().top - top_space,
          },
          1500,
          "easeInOutExpo",
        )

        if ($(this).parents(".nav-menu").length) {
          $(".nav-menu .menu-active").removeClass("menu-active")
          $(this).closest("li").addClass("menu-active")
        }

        if ($("body").hasClass("mobile-nav-active")) {
          $("body").removeClass("mobile-nav-active")
          $("#mobile-nav-toggle i").toggleClass("fa-times fa-bars")
          $("#mobile-body-overly").fadeOut()
        }
        return false
      }
    }
  })

  // Navigation active state on scroll
  var nav_sections = $("section")
  var main_nav = $(".nav-menu, #mobile-nav")
  var main_nav_height = $("#header").outerHeight()

  $(window).on("scroll", function () {
    var cur_pos = $(this).scrollTop()

    nav_sections.each(function () {
      var top = $(this).offset().top - main_nav_height,
        bottom = top + $(this).outerHeight()

      if (cur_pos >= top && cur_pos <= bottom) {
        main_nav.find("li").removeClass("menu-active")
        main_nav
          .find('a[href="#' + $(this).attr("id") + '"]')
          .parent("li")
          .addClass("menu-active")
      }
    })
  })

  // jQuery counterUp
  $('[data-toggle="counter-up"]').counterUp({
    delay: 10,
    time: 1000,
  })

  // Porfolio isotope and filter
  $(window).on("load", () => {
    var portfolioIsotope = $(".portfolio-container").isotope({
      itemSelector: ".portfolio-item",
    })
    $("#portfolio-flters li").on("click", function () {
      $("#portfolio-flters li").removeClass("filter-active")
      $(this).addClass("filter-active")

      portfolioIsotope.isotope({
        filter: $(this).data("filter"),
      })
    })
  })

  // Clients carousel (uses the Owl Carousel library)
  $(".clients-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: {
      0: {
        items: 2,
      },
      768: {
        items: 4,
      },
      900: {
        items: 6,
      },
    },
  })

  // Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1,
  })

  // Intro carousel
  $(document).ready(() => {
    $("#intro-carousel").owlCarousel({
      items: 5,
      loop: true,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: false,
      nav: false,
      dots: false,
      animateOut: "fadeOut",
      animateIn: "fadeIn",
      smartSpeed: 1000,
      mouseDrag: false,
      touchDrag: false,
      pullDrag: false,
      freeDrag: false,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 1,
        },
        1000: {
          items: 1,
        },
      },
    })
  })

  // Mobile Navigation
  if ($("#nav-menu-container").length) {
    var $mobile_nav = $("#nav-menu-container").clone().prop({
      id: "mobile-nav",
    })
    $mobile_nav.find("> ul").attr({
      class: "",
      id: "",
    })
    $("body").append($mobile_nav)
    $("body").prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>')
    $("body").append('<div id="mobile-body-overly"></div>')
    $("#mobile-nav").find(".menu-has-children").prepend('<i class="fa fa-chevron-down"></i>')

    $(document).on("click", ".menu-has-children i", function (e) {
      $(this).next().toggleClass("menu-item-active")
      $(this).nextAll("ul").eq(0).slideToggle()
      $(this).toggleClass("fa-chevron-up fa-chevron-down")
    })

    $(document).on("click", "#mobile-nav-toggle", (e) => {
      $("body").toggleClass("mobile-nav-active")
      $("#mobile-nav-toggle i").toggleClass("fa-times fa-bars")
      $("#mobile-body-overly").toggle()
    })

    $(document).click((e) => {
      var container = $("#mobile-nav, #mobile-nav-toggle")
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($("body").hasClass("mobile-nav-active")) {
          $("body").removeClass("mobile-nav-active")
          $("#mobile-nav-toggle i").toggleClass("fa-times fa-bars")
          $("#mobile-body-overly").fadeOut()
        }
      }
    })
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    $("#mobile-nav, #mobile-nav-toggle").hide()
  }

  // Sticky Navigation
  if ($(".nav-menu").length) {
    var $nav_menu = $(".nav-menu")
    $nav_menu.superfish({
      animation: {
        opacity: "show",
      },
      speed: 400,
    })
  }

  // Google Maps initialization function
  window.initMap = () => {
    if (window.google && window.google.maps && $("#google-map").length) {
      var map_lat = Number.parseFloat($("#google-map").data("latitude")) || 0.3476
      var map_lng = Number.parseFloat($("#google-map").data("longitude")) || 32.5825
      var map_zoom = 15

      var map_options = {
        center: new window.google.maps.LatLng(map_lat, map_lng),
        zoom: map_zoom,
        panControl: false,
        zoomControl: true,
        mapTypeControl: true,
        streetViewControl: true,
        mapTypeId: window.google.maps.MapTypeId.ROADMAP,
        styles: [
          {
            featureType: "all",
            elementType: "geometry.fill",
            stylers: [
              {
                weight: "2.00",
              },
            ],
          },
          {
            featureType: "all",
            elementType: "geometry.stroke",
            stylers: [
              {
                color: "#9c9c9c",
              },
            ],
          },
        ],
      }

      var map = new window.google.maps.Map(document.getElementById("google-map"), map_options)

      var marker = new window.google.maps.Marker({
        position: new window.google.maps.LatLng(map_lat, map_lng),
        map: map,
        title: "Fuse Electrical and Security Systems",
        icon: {
          url:
            "data:image/svg+xml;charset=UTF-8," +
            encodeURIComponent(
              '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"><circle cx="20" cy="20" r="18" fill="#50d8af" stroke="#0c2e8a" stroke-width="2"/><circle cx="20" cy="20" r="8" fill="#0c2e8a"/></svg>',
            ),
          scaledSize: new window.google.maps.Size(40, 40),
          anchor: new window.google.maps.Point(20, 20),
        },
      })

      var infoWindow = new window.google.maps.InfoWindow({
        content:
          '<div style="padding: 10px;"><h4 style="color: #0c2e8a; margin: 0 0 5px 0;">Fuse Electrical and Security Systems</h4><p style="margin: 0; color: #666;">Professional Electrical & Security Solutions<br>Kampala, Uganda</p></div>',
      })

      marker.addListener("click", () => {
        infoWindow.open(map, marker)
      })
    }
  }
})(window, document, window.jQuery)
