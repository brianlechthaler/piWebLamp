function long_polling() { 
    $.getJSON("output.php",'ajax', function(output) { 
        processEvents(output); 
        long_polling(); 
    }); 
} 
long_polling();

function processEvents(output) {
	
}
