
function setRow(tableId, rowId, colNum, newValue) {
    $('#'+tableId).find('tr#'+rowId).find('td:eq(colNum)').html(newValue);
}
function updateTable(data) {
	setRow("odd_pins", 'row_3', 3,    data['pin_2' ][0]);
	setRow("odd_pins", 'row_3', 4,    data['pin_2' ][1]);
	setRow("odd_pins", 'row_5', 3,    data['pin_3' ][0]);
	setRow("odd_pins", 'row_5', 4,    data['pin_3' ][1]);
	setRow("odd_pins", 'row_7', 3,    data['pin_4' ][0]);
	setRow("odd_pins", 'row_7', 4,    data['pin_4' ][1]);
	setRow("even_pins", 'row_26', 3,  data['pin_7' ][0]);
	setRow("even_pins", 'row_26', 4,  data['pin_7' ][1]);
	setRow("even_pins", 'row_24', 3,  data['pin_8' ][0]);
	setRow("even_pins", 'row_24', 4,  data['pin_8' ][1]);
	setRow("odd_pins", 'row_21', 3,   data['pin_9' ][0]);
	setRow("odd_pins", 'row_21', 4,   data['pin_9' ][1]);
	setRow("odd_pins", 'row_19', 3,   data['pin_10'][0]);
	setRow("odd_pins", 'row_19', 4,   data['pin_10'][1]);
	setRow("odd_pins", 'row_23', 3,   data['pin_11'][0]);
	setRow("odd_pins", 'row_23', 4,   data['pin_11'][1]);
	setRow("even_pins", 'row_8', 3,   data['pin_14'][0]);
	setRow("even_pins", 'row_8', 4,   data['pin_14'][1]);
	setRow("even_pins", 'row_15', 3,  data['pin_15'][0]);
	setRow("even_pins", 'row_15', 4,  data['pin_15'][1]);
	setRow("odd_pins", 'row_11', 3,   data['pin_17'][0]);
	setRow("odd_pins", 'row_11', 4,   data['pin_17'][1]);
	setRow("even_pins", 'row_12', 3,  data['pin_18'][0]);
	setRow("even_pins", 'row_12', 4,  data['pin_18'][1]);
	setRow("odd_pins", 'row_15', 3,   data['pin_22'][0]);
	setRow("odd_pins", 'row_15', 4,   data['pin_22'][1]);
	setRow("even_pins", 'row_16', 3,  data['pin_23'][0]);
	setRow("even_pins", 'row_16', 4,  data['pin_23'][1]);
	setRow("even_pins", 'row_18', 3,  data['pin_24'][0]);
	setRow("even_pins", 'row_18', 4,  data['pin_24'][1]);
	setRow("even_pins", 'row_22', 3,  data['pin_25'][0]);
	setRow("even_pins", 'row_22', 4,  data['pin_25'][1]);
	setRow("odd_pins", 'row_13', 3,   data['pin_27'][0]);
	setRow("odd_pins", 'row_13', 4,   data['pin_27'][1]);
}
var Connection = (function() {

    function Connection(ElementId, url) {

        this.element = document.getElementById('status');

        this.open = false;

        this.socket = new WebSocket("ws://" + url);
        this.setupConnectionEvents();
    }

    Connection.prototype = {

        addOutputMessage: function(msg) {
            this.element.innerHTML += msg + '<br>';
        },

        addSystemMessage: function(msg) {
            this.element.innerHTML += '<p><b>' + msg + '</b></p>';
        },

        setupConnectionEvents: function() {
            var self = this;

            self.socket.onopen = function(evt) { self.connectionOpen(evt); };
            self.socket.onmessage = function(evt) { self.connectionMessage(evt); };
            self.socket.onclose = function(evt) { self.connectionClose(evt); };
        },

        connectionOpen: function(evt) {
            this.open = true;
            this.addSystemMessage("Connected");
        },

        connectionMessage: function(evt) {
            if (!this.open) {
				return;
			}
            else 
			if (data['mode']) {
				switch(data['mode']) {
					case 'sleep':
						this.addOutputMessage(data['msg']);
						break;
					case 'update':
						updateTable(data['pin_status']);
				}
			}
        },

        connectionClose: function(evt) {
            this.open = false;
            this.addSystemMessage("Disconnected");
        },

        sendMsg: function(message) {
            if (this.open) {
                this.socket.send(JSON.stringify({
                    action: 'message',
                    msg: message
                }));

                this.addOutputMessage(message);
            } else {
                this.addSystemMessage("You are not connected to the server.");
            }
        }
    };

    return Connection;

})();
$(document).ready(function(){
	conn = new Connection('status',"localhost:8080");
});
