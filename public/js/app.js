$(document).foundation();

var nInterval = 10000;
var nDisplayCount = 10;
var nSlideSpeed = 500;

$(function() {
	var $eventTemplate = $('#event-template');
	var $eventsContainer = $('#event-container');
	var $subjectLife = $('#subject-life');
	var $newEvent = null;
	var $lastChild = null;
	var nTurn = 1;

	function getEvent() {
		$.post('/api.php', { turn: nTurn }, function(data) {
			$newEvent = $eventTemplate.clone();
			$eventsContainer.prepend($newEvent);
			$newEvent.html(data);
			$newEvent.hide();
			$newEvent.removeClass('hide');
			$newEvent.slideDown(nSlideSpeed);
			$subjectLife.html(nTurn);
			nTurn++;
		});
	}

	function cleanContainer() {
		if ($eventsContainer.children().length >= nDisplayCount) {
			$lastChild = $eventsContainer.children().last();
			$lastChild.slideUp(nSlideSpeed, function() {
				$lastChild.remove();
			});
		}
	}

	getEvent();

	setInterval(function () {
		getEvent();
		cleanContainer();
	}, nInterval);
});