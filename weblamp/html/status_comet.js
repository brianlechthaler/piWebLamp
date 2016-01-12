var url = '/cgi-bin/status_comet.php';
var noerror = true;
var ajax;
function setRow(tableId, rowId, colNum, newValue) {
    $('#'+tableId).find('tr#'+rowId).find('td:eq(colNum)').html(newValue);
}
function updateTable(data) {
	setRow("odd_pins", 'row_3, 3,    data['pin_2' ][0]);
	setRow("odd_pins", 'row_3, 4,    data['pin_2' ][1]);
	setRow("odd_pins", 'row_5, 3,    data['pin_3' ][0]);
	setRow("odd_pins", 'row_5, 4,    data['pin_3' ][1]);
	setRow("odd_pins", 'row_7, 3,    data['pin_4' ][0]);
	setRow("odd_pins", 'row_7, 4,    data['pin_4' ][1]);
	setRow("even_pins", 'row_26, 3,  data['pin_7' ][0]);
	setRow("even_pins", 'row_26,  4, data['pin_7' ][1]);
	setRow("even_pins", 'row_24,  3, data['pin_8' ][0]);
	setRow("even_pins", 'row_24,  4, data['pin_8' ][1]);
	setRow("odd_pins", 'row_21, 3,   data['pin_9' ][0]);
	setRow("odd_pins", 'row_21, 4,   data['pin_9' ][1]);
	setRow("odd_pins", 'row_19, 3,   data['pin_10'][0]);
	setRow("odd_pins", 'row_19, 4,   data['pin_10'][1]);
	setRow("odd_pins", 'row_23, 3,   data['pin_11'][0]);
	setRow("odd_pins", 'row_23, 4,   data['pin_11'][1]);
	setRow("even_pins", 'row_8, 3,   data['pin_14'][0]);
	setRow("even_pins", 'row_8, 4,   data['pin_14'][1]);
	setRow("even_pins", 'row_15, 3,  data['pin_15'][0]);
	setRow("even_pins", 'row_15, 4,  data['pin_15'][1]);
	setRow("odd_pins", 'row_11, 3,   data['pin_17'][0]);
	setRow("odd_pins", 'row_11, 4,   data['pin_17'][1]);
	setRow("even_pins", 'row_12, 3,  data['pin_18'][0]);
	setRow("even_pins", 'row_12, 4,  data['pin_18'][1]);
	setRow("odd_pins", 'row_15, 3,   data['pin_22'][0]);
	setRow("odd_pins", 'row_15, 4,   data['pin_22'][1]);
	setRow("even_pins", 'row_16, 3,  data['pin_23'][0]);
	setRow("even_pins", 'row_16, 4,  data['pin_23'][1]);
	setRow("even_pins", 'row_18, 3,  data['pin_24'][0]);
	setRow("even_pins", 'row_18, 4,  data['pin_24'][1]);
	setRow("even_pins", 'row_22, 3,  data['pin_25'][0]);
	setRow("even_pins", 'row_22, 4,  data['pin_25'][1]);
	setRow("odd_pins", 'row_13, 3,   data['pin_27'][0]);
	setRow("odd_pins", 'row_13, 4,   data['pin_27'][1]);
}
var conn = new ab.Session('ws://localhost:8080',
        function() {
            conn.subscribe('status', function(topic, data) {
                // This is where you would add the new article to the DOM (beyond the scope of this tutorial)
                console.log('New article published to category "' + topic + '" : ' + data.title);
            });
        },
        function() {
            console.warn('WebSocket connection closed');
        },
        {'skipSubprotocolCheck': true}
    );
