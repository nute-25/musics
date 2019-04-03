$(document).ready( () => {
    $('#pending_request').click(() => {
        $('#pending_request_list').slideToggle();
    });
});

$(document).ready( () => {
    $('#accepted_request').click(() => {
        $('#accepted_request_list').slideToggle();
    });
});

$(document).ready( () => {
    $('#declined_request').click(() => {
        $('#declined_request_list').slideToggle();
    });
});
