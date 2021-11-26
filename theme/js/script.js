$(document).ready(function () {

	// for auto scroll message lists
	function autoscroll() {

		$('#publicchat').animate({
			scrollTop: 2000
		}, 1000);
	}
	autoscroll();



	//$("#text").fadeOut(3000);
	$("#Button_3").click(function () {
		$("#text").fadeOut(3000);
	});

	var inputName = $("#name");
	var inputMessage = $("#message");
	var loading = $("#loading");
	var content = $("#content");
	var onlinelist = $("#onlinelist");
	var privetchatlist = $("#privetchatlist");

	function show() {
		loading.html('<img src="/theme/img/loader.gif">');

		$.ajax({
			type: "POST",
			url: "/ajax.php",
			data: "action=show",
			complete: function (data) {
				loading.hide();
				content.html(data.responseText);
			}
		});
	}

	show();

	// Ajax OnlineList

	function ShowOnlineList() {
		loading.html('<img src="/theme/img/loader.gif">');

		$.ajax({
			type: "POST",
			url: "/ajax.php",
			data: "action=onlinelist",
			complete: function (data) {
				loading.hide();
				onlinelist.html(data.responseText);
			}
		});
	}
	ShowOnlineList()

	// Ajax Privetchat

	function ShowPrivetChatList() {
		loading.html('<img src="/theme/img/loader.gif">');

		$.ajax({
			type: "POST",
			url: "/ajax.php",
			data: "action=privetchatlist",
			complete: function (data) {
				loading.hide();
				privetchatlist.html(data.responseText);
			}
		});
	}
	ShowPrivetChatList()


	//Refresh after 2 second

	setInterval(function () { show(); }, 2000);
	setInterval(function () { ShowOnlineList(); }, 2000);
	setInterval(function () { ShowPrivetChatList(); }, 2000);


	$("#form").submit(function () {
		if (inputMessage.val()) {
			var name = inputName.val();
			var message = inputMessage.val();

			$("#submit").attr({ disabled: true, value: "در حال ارسال..." });

			$.ajax({
				type: "POST",
				url: "/ajax.php",
				data: "action=insert&message=" + message,
				complete: function (data) {
					show();
					$("#submit").attr({ disabled: false, value: "ارسال" });
					inputMessage.val('');
				}
			});
			autoscroll();
		}
		else alert('تمامی فیلدها را وارد کنید.');
		return false;
	});

	// Final for Jquary Ready
});

// for exit
function Exit() {
	xmlHttp = new XMLHttpRequest();
	xmlHttp.open('POST', '');
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send('logout=true');
	var time = new Date();
	time.setTime(time.getTime() + (1000 * 24 * 60 * 60));
	time.toUTCString();
	go2NewUrl('/', 1);
	//document.cookie = "PHPSESSID=;expires=" + time + ";path=/";
	//location.reload(true);
}
function go2NewUrl(newUrl, sec) {
	setTimeout("location.href='" + newUrl + "'", sec * 1000);
}

function handleConnectionChange(event) {
	if (event.type === "offline") {
		var newh1 = document.createElement("H1");
		newh1.appendChild(document.createTextNode(" You Are offline! "));
		newh1.setAttribute('id', 'offlineNetAlert');
		document.body.appendChild(newh1);
		alert('You Are offline!');
	}
	if (event.type === "online") {
		document.getElementById('offlineNetAlert').parentNode.removeChild(document.getElementById('offlineNetAlert'))
	}
}



window.addEventListener('online', handleConnectionChange);
window.addEventListener('offline', handleConnectionChange);

$(function () {
	var $document_body = $('body');
	var $online_body = $('#onlinelistj');
	var $chatlist_body = $('#chatlist');
	var $publicchat_body = $('#publicchat');

	$document_body.scrollator();
	$online_body.scrollator();
	$chatlist_body.scrollator();
	$publicchat_body.scrollator();
});

// for auto scroll message lists
function autoscroll() {

	$('#publicchat').animate({
		scrollTop: 20000
	}, 1000);
}

function GetUserchat(id) {
	$.ajax({
		type: "POST",
		url: '/ajax.php',
		data: "action=showprivetchat",
		success: function (data) {

		}
	});
	GetUserchatid(id);
	autoscroll();

}

function UserKickRequset(id) {
	$.ajax({
		type: "POST",
		url: '/ajax.php',
		data: "action=showkickrequset",
		success: function (data) {

		}
	});

	GetUserKickid(id);

}

function RequestVote() {
	$.ajax({
		type: "POST",
		url: '/ajax.php',
		data: "action=requestvote",
		success: function (data) {

		}
	});

}

function GetPublicChat(id) {
	$.ajax({
		type: "POST",
		url: '/ajax.php',
		data: "action=showpublicchat",
		success: function (data) {

		}
	});
	autoscroll();

}

function ExitFromRequestKick() {

	$.ajax({
		type: "POST",
		url: '/ajax.php',
		data: "action=showonlinelist",
		success: function (data) {

		}
	});

}

function voteyeskick() {

	$.ajax({
		type: "POST",
		url: '/ajax.php',
		data: "action=voteyeskick",
		success: function (data) {

		}
	});

}

function votenokick() {

	$.ajax({
		type: "POST",
		url: '/ajax.php',
		data: "action=votenokick",
		success: function (data) {

		}
	});

}
; (function () {

	if (screen.height < 600) {
		var height = screen.height - 70;
	}
	if (screen.height < 700) {
		var height = screen.height - 100;
	}
	if (screen.height > 700) {
		var height = screen.height - 250;
	}
	if (screen.height > 800) {
		var height = screen.height - 290;
	}

	// The entire page height is found
	console.log('Page height is', screen.height);
	document.getElementById('publicchat').setAttribute("style", "height:" + height + "px" + ";background-color:hsla(240, 66.7%, 94.1%, 0.75);");
	document.getElementById('onlinelistj').setAttribute("style", "height:" + height + "px" + ";background-color:#e6e6fa26;");
	document.getElementById('privetchatlistt').setAttribute("style", "height:" + height + "px" + ";background-color:#e6e6fa26;");

})();






