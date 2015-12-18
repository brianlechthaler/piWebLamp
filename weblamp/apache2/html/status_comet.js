function setRow(tableId, rowId, colNum, newValue) {
    $('#'+tableId).find('tr#'+rowId).find('td:eq(colNum)').html(newValue);
}

function long_polling() { 
    $.getJSON("cgi-bin/status_comet.php",'ajax', function(status) { 
        for
        long_polling(); 
    }); 
} 
long_polling();

var mydata = eval(jdata);
var table = $.makeTable(mydata);
$(table).appendTo("#status");
