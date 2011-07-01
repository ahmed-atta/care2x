	// JavaScript Document

	function moveitem(xx,yy,d) {
		var acc;
		var item_selected_index;
		var objfrom     = document.forms['mover'].elements[xx];
		var destn       = document.forms['mover'].elements[yy];

		if (d == 'toleft'){
			while (destn.selectedIndex != -1) {
				item_selected_index   = destn.selectedIndex;
				destn.options[0].text=null;
				destn.options[0]=null;
				destn.options[destn.selectedIndex].selected = false;
			}
		}

		while (objfrom.selectedIndex != -1) {
		  item_selected_index   = objfrom.selectedIndex;

			if (item_selected_index !=-1) {
			var newtxt         = objfrom.options[item_selected_index].text;
			var newval        = objfrom.options[objfrom.selectedIndex].value;

			if(newval=="-1") return false;

			if(destn.length > 0)
				if(destn.options[0].value=="-1") {
					destn.options[0].text=null;
					destn.options[0]=null;
				}
			if (ifexists(newtxt , objfrom ,destn) && (d == 'toright'))
				alert (newtxt+" is already in list!");

			else {
				new_item_obj = new Option ( newtxt , newval);
				destn.options[destn.options.length]=new_item_obj;

				objfrom.options[objfrom.selectedIndex].text=null;
				objfrom.options[objfrom.selectedIndex]=null;


			} // end check

			} else
				alert ("Select at least one item to move.");

		  //objfrom.options[objfrom.selectedIndex].selected = false;
		} return true;
			alert('done');
	} // end of item_add()

	function ifexists(itemdescription , objfrom , destn) {
		for(var i=0;i<destn.length;i++) {
			if (objfrom.options[objfrom.selectedIndex].text==destn.options[i].text) {
			    return true;
			}
		}
		return false;
	}

	function moveall(dir,xx,yy) {
	  var objfrom     = document.forms['mover'].elements[xx];
	  var destn       = document.forms['mover'].elements[yy];
	  var val = 0;

		document.forms['mover'].elements[yy].options.length = 0;

		if (dir == 'alltoright'){
			// populate my list
			for(var i=0;i<objfrom.length;i++) {
					var newtxt         = objfrom.options[i].text;
					var newval        = objfrom.options[i].value;

					new_item_obj = new Option ( newtxt , newval);
					destn.options[destn.options.length]=new_item_obj;

					val++;

				}  // end for
			} // end if

		return false;

	}


	function removeitem(source){
		var rmove = document.forms['mover'].elements[source];
	  	if (rmove.selectedIndex >= 0 ) {
	    	rmove.options[rmove.selectedIndex].text=null;
	    	rmove.options[rmove.selectedIndex]=null;
	    	return true;
	  	} else {
	    	alert ("Please select one item on the right side if you have to remove it");
	    	return false;
	  	} // end of if
	} // end of function removeitem()


	///////////////////////////////////////    END MOVING SCRIPT    ///////////////////////////////////////////////////