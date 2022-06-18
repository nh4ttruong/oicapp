$(document).ready(function () {
	var zindex = 10;

	$("div.ecard-title").click(function (e) {
		e.preventDefault();

		var isShowing = false;

		if ($(this).parent().hasClass("show")) {
			isShowing = true;
		}

		if ($("div.ecards").hasClass("showing")) {
			// a card is already in view
			$("div.ecard.show").removeClass("show");

			if (isShowing) {
				// this card was showing - reset the grid
				$("div.ecards").removeClass("showing");
			} else {
				// this card isn't showing - get in with it
				$(this).parent().css({ zIndex: zindex }).addClass("show");
			}

			zindex++;
		} else {
			// no cards in view
			$("div.ecards").addClass("showing");
			$(this).parent().css({ zIndex: zindex }).addClass("show");

			zindex++;
		}
	});
});
