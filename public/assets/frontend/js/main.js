

function addFavorite(self) {
    let $ = jQuery;
    let id = $(self).data('id');
    let route = $(self).data('route');
    //alert(id);
    $.ajax({
        type: 'GET',
        url: route,
        data: {
            id: id
        },
        success: function (data) {
            if (data.click == 'add') {

                $(self).addClass('active');
            } else {
                $(self).removeClass('active');
            }

        }
    });
}
function addListing(self) {
    let $ = jQuery;
    let id = $(self).data('id');
    let route = $(self).data('route');
    //alert(id);
    $.ajax({
        type: 'GET',
        url: route,
        data: {
            id: id
        },
        success: function (data) {
            if (data.click == 'add') {

                $(self).addClass('active');
            } else {
                $(self).removeClass('active');
            }

        }
    });
}
