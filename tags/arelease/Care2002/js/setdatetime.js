function setDate(elindex){

	jetzt=new Date();
	datum=jetzt.getDate();
	if (datum<10) datum="0" + datum;
	monat=jetzt.getMonth();
	monat++;
	if (monat<10) {monat="0" + monat;}
	jahr=jetzt.getYear();
	buf=elindex.value;

	if ((buf<".")||(buf>"9")||(buf=="/")){
		switch (buf){
			case "h": actual=datum + "." + monat + "." + jahr;break;
			case "H": actual=datum + "." + monat + "." + jahr;break;
			case "t": actual=datum + "." + monat + "." + jahr;break;
			case "T": actual=datum + "." + monat + "." + jahr;break;
			case "g": datum--;if (datum<10) datum="0" + datum;actual=datum + "." + monat + "." + jahr;break;
			case "G": datum--;if (datum<10) datum="0" + datum;actual=datum + "." + monat + "." + jahr;break;
			case "y": datum--;if (datum<10) datum="0" + datum;actual=datum + "." + monat + "." + jahr;break;
			case "Y": datum--;if (datum<10) datum="0" + datum;actual=datum + "." + monat + "." + jahr;break;
			default: actual="";
			}
		elindex.value=actual;
		}
	}

function setTime(indexel){

	time=new Date();
	zeit="";
	min=time.getMinutes();
	if (min<10) min="0" + min;
	stunde=time.getHours();
	if (stunde<10) stunde="0" + stunde;
	buf=indexel.value;

	if ((buf<".")||(buf>"9")||(buf=="/")){
		if((buf=="j")||(buf=="J")||(buf=="N")||(buf=="n")) {
			zeit=stunde + "." + min;
			}
		indexel.value=zeit;
		}
	
	}
