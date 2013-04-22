var current_type_id = 2;

function checkForm() {
    var elements = $('#type_id_' + current_type_id + 'input[type=checkbox]:not(.shuffle_answers), #type_id_' + current_type_id + 'input[type=radio]:not(#shuffle)');
    var textboxes = $('#type_id_' + current_type_id + 'textarea');
    for (var i = 0; i < elements.length; i++) {
        if ($(elements[i]).attr('checked') && $.trim($(textboxes[i]).val()) != "") {
            return true;
        }

    }
    alert("Palun märgi õige vastus");
    return false;
}
$(document).ready(function () {
    $('#answer-template .answer-template').hide();
    $('#type_id_' + current_type_id).show();
    $('#type_id').bind('click change focus', function (event) {
        if ($(this).val() != current_type_id) {
            $('#answer-template .answer-template').hide();
            current_type_id = $(this).val();
            $('#type_id_' + current_type_id).show();
        }
    });
    var list = $('#type_id option');
    for (var i = 0; i < list.length; i++) {
        if ($(list[i]).val() == current_type_id) {
            $(list[i]).attr('selected', 'selected')
        }
    }
    $('textarea:first').focus();
});