function remove_test_ajax(id){
    $.post(BASE_URL + "tests/remove/" + id)
        .done(function(data){
            if(data=='OK'){
                $('table#tests-table>tbody>tr#test' + id).remove();
                alert("Test kustutatud")
            }
            else{
                alert("Viga\n\nServer vastus: '" + data + "'.\n\nKontakteeru arendajaga.");
            }
        });
}
