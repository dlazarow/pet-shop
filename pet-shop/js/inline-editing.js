function enableEditing() {
	var editableElems = getElementsByClassName(document,"editable");
	var numElems = editableElems.length;
	var elem;
	for (var i=0; i<numElems; i++) {
		elem = editableElems[i];
		elem.innerHTML = "<span id='clicked' contenteditable='true'>" + elem.innerHTML + "</span>";
		observeEvent(elem.firstChild, "blur",saveCell);
	}
}

function saveCell(e) {
	var target = getTarget(e);
	var td = target.parentNode;
	var tr = td.parentNode;
	var field = td.title;
	var value = target.innerHTML;
	var pid = tr.id;	
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", "includes/admin/SaveCell.php", true);
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			blinkText(td,1000,"Saved","Normal");
		}
	}
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
	xmlhttp.send("field=" + field + "&value=" + value + "&pid=" + pid);
}

function blinkText(elem,time,on,off,timePast) {
	var timePast = timePast + 100 || 0;
	elem.className = (elem.className == on) ? off : on;

	if (timePast < time) {
		setTimeout(function () { blinkText(elem,time,on,off,timePast) },100);
	} else {
		elem.className = "editable";
	}
}

observeEvent(window,"load",enableEditing);


