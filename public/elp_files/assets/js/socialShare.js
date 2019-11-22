
	var popupCenter = function(url, title, width, height){
		var popupWidth = width || 640;
		var popupHeight = height || 320;
		var windowLeft = window.screenLeft || window.screenX;
		var windowTop = window.scrennTop || window.screenY;
		var windowWidth = window.innerWidth || document.documentElement.clientWidth;
		var windowHeight = window.innerHeight || document.documentElement.clientHeight;
		var popupLeft = windowLeft + windowWidth /2 - popupWidth / 2;
		var popupTop = windowTop + windowHeight / 2 - popupHeight / 2;
		window.open(url, title, 'scrollbars=yes' + popupWidth + ', height=' + popupHeight + ', top=' + popupTop +', left=' +popupLeft)
	};

	document.querySelector('.partager_facebook').addEventListener('click', function(e){
		e.preventDefault();
		var url = this.getAttribute('data-url');
		var shareUrl = "https://www.facebook.com/sharer/sharer.php?url=" + encodeURIComponent(url);
		popupCenter(shareUrl, "Partager sur facebook");
	});

	document.querySelector('.partager_twitter').addEventListener('click', function(e){
		e.preventDefault();
		var url = this.getAttribute('data-url');
		var shareUrl = "https://twitter.com/intent/tweet?text=" + encodeURIComponent(document.title) +
		"&via=enginnova" +
		"&url=" + encodeURIComponent(url);
		popupCenter(shareUrl, "Partager sur twitter");
	});
