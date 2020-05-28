$(document).ready(function () {
	var i = 0,
		j = 0,
		k = 0,
		l = 0;
	var c = 0;
	if ($("#fullpage").length > 0) {
		$("#fullpage").fullpage({
			anchors: [
				"intro!",
				"why!",
				"performance!",
				"team!",
				"advisors!",
				"clients!",
				"contact!",
				"coming-soon!",
				"footer!",
			],
			responsiveWidth: 1200,
			// afterResponsive: function(isResponsive){

			// 		}
			// responsiveHeight: 768
			afterLoad: function (anchorLink, index) {
				if (index === 1) {
					// for executing these animations only once per page scroll
					console.log(anchorLink);
					console.log(index);
					if (l === 0) {
						var homeBannerHeading = $("#home-banner-heading");
						var homeBannerImage = $("#home-banner-image");
						var homeBannerLine = $("#banner-line");

						if ($(window).width() >= 992) {
							TweenMax.to(homeBannerHeading, 2, {
								autoAlpha: 1,
								delay: 1.6,
							});
							TweenMax.from(homeBannerHeading, 1, {
								x: -200,
								delay: 1.6,
							});
							TweenMax.to(homeBannerImage, 2, {
								autoAlpha: 1,
								delay: 1.2,
							});
							TweenMax.from(homeBannerImage, 1, {
								x: 200,
								delay: 1.2,
							});
							setTimeout(function () {
								$("#underline1").css("width", "100%");
							}, 1600);
							setTimeout(function () {
								$("#underline2").css("width", "100%");
							}, 2400);
						} else {
							// TweenMax.to(homeBannerHeading, 2, {});
							// TweenMax.from(homeBannerHeading, 1, {});
							TweenMax.fromTo(
								homeBannerHeading,
								1,
								{ x: -10, autoAlpha: 0, delay: 1.6 },
								{ x: 0, autoAlpha: 1, delay: 1.6 }
							);
							TweenMax.fromTo(
								homeBannerImage,
								1,
								{ autoAlpha: 0, delay: 1.2 },
								{ autoAlpha: 1, delay: 1.2 }
							);
							// TweenMax.from(homeBannerImage, 1, {x: 200, delay: 1.2});
						}
						setTimeout(function () {
							$("#banner-line").css({
								visibility: "visible !important",
								transform: "translateY(-50%)",
								opacity: "1",
							});
						}, 2400);
						setTimeout(function () {
							$("#home-banner-arrow").css({ opacity: "1" });
						}, 3400);
						l++;
					}
				}
				// if(i === 0) {
				if (index === 3) {
					console.log(i);
					if (i === 0) {
						console.log((i = 0));
						generateChartQuarterly();
						i++;
					}
				}
				if (index === 2) {
					console.log(j);
					if (j === 0) {
						console.log("j=0");
						var robotImage = $("#robot-image");
						var whyRain = $("#why-rain");

						if ($(window).width() >= 992) {
							TweenMax.to(robotImage, 2, {
								autoAlpha: 1,
								delay: 0.5,
								css: { opacity: 1 },
							});
							TweenMax.from(robotImage, 1, {
								x: -200,
								delay: 0.5,
							});
							TweenMax.to(whyRain, 2, { autoAlpha: 1, delay: 1 });
							TweenMax.from(whyRain, 1, { x: 200, delay: 1 });
						}
						// else {
						// 	TweenMax.fromTo(whyRain, 2, {autoAlpha: 0, delay: 1}, {autoAlpha: 1, delay: 1});
						// 	// TweenMax.from(whyRain, 1, );
						// }

						setTimeout(function () {
							$("#underline3").css("width", "100%");
						}, 1300);
						setTimeout(function () {
							$("#why-line").css({
								visibility: "visible !important",
								transform: "translateY(20%)",
								opacity: "1",
							});
						}, 1600);
						setTimeout(function () {
							$("#home-why-arrow").css({ opacity: "1" });
						}, 2900);
						j++;
					}
				}
				// }
				if (index === 3) {
					if ($(window).width() >= 992) {
						$("#underlinePerformance").css("width", "100%");
					}
				}
				if (index === 4) {
					if ($(window).width() >= 992) {
						$("#underlineTeam").css("width", "100%");
					}
				}
				if (index === 7) {
					if ($(window).width() >= 992) {
						$("#underlineComing").css("width", "100%");
					}
				}
				if (index === 5) {
					if ($(window).width() >= 992) {
						$("#underlineAdvisors").css("width", "100%");
					}
				}
			},
			onLeave: function (index, nextSlideIndex) {
				if (!(nextSlideIndex === 1 || nextSlideIndex === 6)) {
					$(".top-nav").css("background", "#fff");
				} else {
					$(".top-nav").css("background", "#fbfbfb");
				}
			},
		});
	}

	if ($("#fullpageContact").length > 0) {
		$("#fullpageContact").fullpage({
			anchors: ["intro!", "contact-form!", "footer!"],
			responsiveWidth: 1200,
			afterLoad: function (anchorLink, index) {
				if (index === 1) {
					if (c === 0) {
						var contactBannerHeading = $("#contact-banner-heading");
						var contactBannerImage = $("#contact-banner-image");

						if ($(window).width() >= 992) {
							TweenMax.from(contactBannerHeading, 2, {
								autoAlpha: 0,
								delay: 1.6,
							});
							TweenMax.from(contactBannerHeading, 1, {
								x: -200,
								delay: 1.6,
							});
							TweenMax.from(contactBannerImage, 2, {
								autoAlpha: 0,
								delay: 1.2,
							});
							TweenMax.from(contactBannerImage, 1, {
								x: 200,
								delay: 1.2,
							});
							setTimeout(function () {
								$("#underline3").css("width", "100%");
							}, 2000);
							setTimeout(function () {
								$("#underline4").css("width", "100%");
							}, 2400);
						}
						setTimeout(function () {
							$("#contact-banner-line").css({
								visibility: "visible !important",
								transform: "translateY(-50%)",
								opacity: "1",
							});
						}, 2400);
						setTimeout(function () {
							$("#contact-banner-arrow").css({ opacity: "1" });
						}, 3400);
						c++;
					}
				}
			},
			onLeave: function (index, nextSlideIndex) {
				if (!(nextSlideIndex === 1)) {
					$(".top-nav").css("background", "#fff");
				} else {
					$(".top-nav").css("background", "#fcfcfc");
				}
			},
		});
	}

	if ($("#fullpageVision").length > 0) {
		$("#fullpageVision").fullpage({
			anchors: ["intro!", "how!", "contact!", "footer!"],
			responsiveWidth: 1200,

			afterLoad: function (anchorLink, index) {
				console.log(anchorLink);
				console.log(index);

				if (index === 1) {
					if (i === 0) {
						var visionBannerHeading = $("#vision-banner-heading");
						var visionBannerDetails = $("#vision-banner-details");
						if ($(window).width() >= 992) {
							TweenMax.to(visionBannerHeading, 2, {
								autoAlpha: 1,
								delay: 1.6,
							});
							TweenMax.from(visionBannerHeading, 1, {
								x: -200,
								delay: 1.6,
							});
							TweenMax.to(visionBannerDetails, 2, {
								autoAlpha: 1,
								delay: 1.2,
							});
							TweenMax.from(visionBannerDetails, 1, {
								x: 200,
								delay: 1.2,
							});
							setTimeout(function () {
								$("#underlineHow1").css("width", "100%");
							}, 2000);
							setTimeout(function () {
								$("#underlineHow2").css("width", "100%");
							}, 2400);
						} else {
							TweenMax.fromTo(
								visionBannerHeading,
								1,
								{ x: -5, autoAlpha: 0, delay: 1 },
								{ x: 0, autoAlpha: 1, delay: 1 }
							);
							TweenMax.fromTo(
								visionBannerDetails,
								1,
								{ autoAlpha: 0, delay: 1 },
								{ autoAlpha: 1, delay: 1 }
							);
						}
						// $("#underline1").css("width", "100%");
						setTimeout(function () {
							$("#banner-line").css({
								visibility: "visible !important",
								transform: "translateY(-50%)",
								opacity: "1",
							});
						}, 2400);
						setTimeout(function () {
							$("#home-banner-arrow").css({ opacity: "1" });
						}, 3400);
						i++;
					}
				}

				// }
				if (index === 2) {
					if ($(window).width() >= 992) {
						$("#underlineHow3").css("width", "100%");
						$("#underlineHow4").css("width", "100%");
					}
				}
			},
			onLeave: function (index, nextSlideIndex) {
				console.log(index, nextSlideIndex);
				if (nextSlideIndex === 2) {
					$(".top-nav").css("background", "#fff");
				} else {
					$(".top-nav").css("background", "#fcfcfc");
				}
			},
		});
	}

	if ($("#fullpagePodcast").length > 0) {
		$("#fullpagePodcast").fullpage({
			responsiveWidth: 1200,

			afterLoad: function (anchorLink, index) {
				console.log(anchorLink);
				console.log(index);

				if (index === 1) {
					if (i === 0) {
						var visionBannerHeading = $("#vision-banner-heading");
						var visionBannerDetails = $("#vision-banner-details");
						if ($(window).width() >= 992) {
							TweenMax.to(visionBannerHeading, 2, {
								autoAlpha: 1,
								delay: 1.6,
							});
							TweenMax.from(visionBannerHeading, 1, {
								x: -200,
								delay: 1.6,
							});
							TweenMax.to(visionBannerDetails, 2, {
								autoAlpha: 1,
								delay: 1.2,
							});
							TweenMax.from(visionBannerDetails, 1, {
								x: 200,
								delay: 1.2,
							});
							setTimeout(function () {
								$("#underline3").css("width", "100%");
								$("#underlinePodAbout").css("width", "100%");
								$("#underlineSubscribe").css("width", "100%");
								$("#underlineSubscribeNews").css(
									"width",
									"100%"
								);
							}, 2000);
						} else {
							TweenMax.fromTo(
								visionBannerHeading,
								1,
								{ x: -5, autoAlpha: 0, delay: 1 },
								{ x: 0, autoAlpha: 1, delay: 1 }
							);
							TweenMax.fromTo(
								visionBannerDetails,
								1,
								{ autoAlpha: 0, delay: 1 },
								{ autoAlpha: 1, delay: 1 }
							);
						}
						// $("#underline1").css("width", "100%");
						setTimeout(function () {
							$("#banner-line").css({
								visibility: "visible !important",
								transform: "translateY(-50%)",
								opacity: "1",
							});
						}, 2400);
						setTimeout(function () {
							$("#home-banner-arrow").css({ opacity: "1" });
						}, 3400);
						i++;
					}
				}

				// }
				if (index === 2) {
					if ($(window).width() >= 992) {
						$("#underlineHow3").css("width", "100%");
						$("#underlineHow4").css("width", "100%");
					}
				}
			},
			onLeave: function (index, nextSlideIndex) {
				console.log(index, nextSlideIndex);
				if (nextSlideIndex === 2) {
					$(".top-nav").css("background", "#fff");
				} else {
					$(".top-nav").css("background", "#fcfcfc");
				}
			},
		});
	}
});
// //mobile menu option
// $('.hamburg').on('click', function () {
// 	// alert("ok");
//   $('.side-nav').toggleClass('active');
//   $('.hamburg').toggleClass('close');
//   $('body').toggleClass('overflow');
//   $('.overlay-black').toggleClass('active');
// });
