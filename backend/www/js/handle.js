function handleUploadImages(id, fileName, responseJSON) {

}

function addLoading(container) {
	if ($(container).hasClass("hasLoading"))
		$(container).removeClass("hasLoading");
	else {
		$(container).addClass("hasLoading");
	}
}