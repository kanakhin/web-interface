
setInterval('getWatts()', 30000); 

function init() {
	$.post("/js/check.php",{addr:"0x4d", pins:"3,4,5,6"},
		function(msg){
			if (msg) {
				$("#scripts").empty().append(msg);
				
				$.post("/js/check_buttons.php",{addr:"0x4d", pins:"14,15,16,17"},
					function(msg){
						if (msg) {
							$("#scripts").empty().append(msg);
						}
					}
				);
			}
		}
	);
		
	$.post("/js/check.php",{addr:"0x42", pins:"6,3,4,5,3,4,5,3"},
		function(msg){
			if (msg) {
				$("#scripts").empty().append(msg);
				
				$.post("/js/check_buttons.php",{addr:"0x42", pins:"11,12,13,14,15,16,17"},
					function(msg){
						if (msg) {
							$("#scripts").empty().append(msg);
						}
					}
				);
			}
		}
	);
		
	getWatts()
}

function group_management(action) {
	$.post("/js/group_management.php",{addr:'0x4d', action:action},
		function(msg){
			if (msg) {
				$("#scripts").empty().append(msg);
			}
		}
	);
	$.post("/js/group_management.php",{addr:'0x42', action:action},
		function(msg){
			if (msg) {
				$("#scripts").empty().append(msg);
			}
		}
	);
}

function getWatts() {
	$.post("/js/get_watts.php",{type: "cur"},
		function(msg){
			if (msg) {
				$("#watts").empty().append("Текущее потребление: " + msg);
			}
		}
	);
	$.post("/js/get_watts.php",{type: "h_avg"},
		function(msg){
			if (msg) {
				$("#watts_avg").empty().append("Среднее за последний час: " + msg);
			}
		}
	);
	$.post("/js/get_watts.php",{type: "m_summ"},
		function(msg){
			if (msg) {
				$("#watts_month").empty().append("Расход за месяц: " + msg);
			}
		}
	);
}

function lamp_click(addr,id,lamp) {
	$.post("/js/change.php",{type:"lamp", addr:addr, pin:""+lamp+""},
		function(msg){
			if (msg) {
				$("#scripts").empty().append(msg);
			}
		}
	);
}

function button_click(addr,id,buttons) {
	$.post("/js/change_button.php",{type:"button", addr:addr, pin:""+buttons+""},
		function(msg){
			if (msg) {
				$("#scripts").empty().append(msg);
			}
		}
	);
}