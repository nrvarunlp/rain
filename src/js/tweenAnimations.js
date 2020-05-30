$(document).ready(function () {
	var tl = new TimelineLite({ paused: true });
	var logo = $("#primary-logo");

	TweenMax.from(logo, 1, { y: -200 });
	TweenMax.to(logo, 2, { autoAlpha: 1 });
	tl.staggerFromTo(
		$(".nav-list a"),
		1,
		{ autoAlpha: 0, y: -200 },
		{ autoAlpha: 1, y: 0 },
		0.5
	);

	tl.play();

	tl.eventCallback("onComplete", function () {
		$(".section--blog-content .team-container").css("opacity", "1");
	});

	function animateUnderlines(section) {
		if (window.Waypoint) {
			if (document.getElementById(section)) {
				new Waypoint({
					element: document.getElementById(section),
					offset: "50%",
					handler: function (direction) {
						var underlines = this.element.querySelectorAll(
							".underline"
						);

						underlines.forEach(function (underline) {
							underline.classList.add("w-100");
						});
					},
				});
			}
		}
	}

	animateUnderlines("aboutHost");
	animateUnderlines("podcastBanner");
	animateUnderlines("latestPodcasts");
	animateUnderlines("podcastEpisodes");
	animateUnderlines("subscribeNewsletter");

	if ($("#podcastFilter").length) {
		$("#podcastFilter").dropdown();
	}
	if ($("#podcastSortBy").length) {
		$("#podcastSortBy").dropdown();
	}
});
