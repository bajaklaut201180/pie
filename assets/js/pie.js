function enable_cbox() {
	$("input[type=checkbox]").removeAttr("disabled");
}

function disable_cbox() {
	$("input[type=checkbox]").attr("disabled", "true");
}

function trigger_cbox(privileges=false) {
	if(privileges > 2) {
		enable_cbox();
	}else {
		disable_cbox();
	}
}

function match_password() {
	var password = $("#password").val();
	var retype = $("#retype").val();

	if(password != retype) {
		$(".password-notif").html("Not Matching").css("color", "red");
    }else {
    	$(".password-notif").html("");
        console.log("password match");
    }
}