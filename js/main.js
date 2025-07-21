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
  // var introCarousel = $("#intro-carousel")
  // var introCarouselIndicators = $("#intro-carousel-indicators")
  // introCarousel
  //   .find(".carousel-inner")
  //   .children(".carousel-item")
  //   .each((index) => {
  //     index === 0
  //       ? introCarouselIndicators.append(
  //           "<li data-target='#intro-carousel' data-slide-to='" + index + "' class='active'></li>",
  //         )
  //       : introCarouselIndicators.append("<li data-target='#intro-carousel' data-slide-to='" + index + "'></li>")
  //   })

  // introCarousel.on("slid.bs.carousel", function (e) {
  //   $(this).find("h2").addClass("animate__animated animate__fadeInDown")
  //   $(this).find("p").addClass("animate__animated animate__fadeInUp")
  //   $(this).find(".btn-get-started").addClass("animate__animated animate__fadeInUp")
  // })

  // Initialize Owl Carousel for intro
  $("#intro-carousel").owlCarousel({
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: false,
    loop: true,
    items: 1,
    nav: false,
    dots: false,
    animateOut: "fadeOut",
    animateIn: "fadeIn",
    smartSpeed: 1000,
    mouseDrag: false,
    touchDrag: false,
    pullDrag: false,
    freeDrag: false,
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

  // Google Maps
  if ($("#google-map").length) {
    const google = window.google
    var map_lat = $("#google-map").data("latitude")
    var map_lng = $("#google-map").data("longitude")
    var map_zoom = 15
    var map_type = "roadmap"

    var map_options = {
      center: new google.maps.LatLng(map_lat, map_lng),
      zoom: map_zoom,
      panControl: false,
      zoomControl: true,
      mapTypeControl: true,
      streetViewControl: true,
      mapTypeId: google.maps.MapTypeId[map_type.toUpperCase()],
    }

    var map = new google.maps.Map(document.getElementById("google-map"), map_options)

    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(map_lat, map_lng),
      map: map,
      title: "Fuse Electrical and Security Systems",
    })
  }
})(window, document, jQuery)
