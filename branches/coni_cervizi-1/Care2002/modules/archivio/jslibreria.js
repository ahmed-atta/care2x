/*				LIBRERIRE JAVASCRIPT VERSIONE 2				*/

/*
 	questa funzione prende in input un parametro relativo all'URL della finestra correte
 	restituisce il valore del parametro passato
 */
function get_url_paramvalue(parameter){
	
	var arrayCoppie;
	var app,param,value;
	
	param= new String(parameter);
	
	//estra la query string (senza il ?)
	var querystr=window.location.search;
	querystr=querystr.slice(1);
	
	//crea un array delle coppie variabile=valore
	if (querystr.indexOf("&")==-1)
		arrayparams = new Array(querystr);
	else
		arrayparams = queystr.split("&");//se sono più coppie le separo in base al car. &
	
	
	//cerca il valore del parametro passato
	for (i=0;i<arrayparams.length;i++){			
			
			app=arrayparams[i].split("=");
			
			//se ho trovato il parametro indicato restituisco il suo valore
			if (app[0]==param){
				return app[1];
			}
			
	}
	
	//non ho trovato nulla
	return null;
}

function findspecialchar(stringa) {
	
	if (
		(stringa.indexOf("*")!=-1) ||
		(stringa.indexOf("\\")!=-1) ||
		(stringa.indexOf("/")!=-1) ||
		(stringa.indexOf("?")!=-1) 
	) return true;
	else return false;
}

/*                                       -
   ---                                                                                 -
   --- Questa libreria e' disponibile alla URL: http://www.jsdir.com/LibreriaJs        -
   ---------------------------------------------------------------------------------- */

/* -----------------------------------------------------------------------------------
------- Trim(), LTrim(), RTrim() -----------------------------------------------------
------- 
------- Metodi per l'oggetto String, restituiscono la stringa cui sono applicati
------- senza spazi iniziali e/o finali:
------- 
------- str_a = stringa.Trim();
-------       str_a contiene il valore di stringa senza spazi iniziali ne' finali
------- 
------- str_a = stringa.LTrim();
-------       str_a contiene il valore di stringa senza spazi iniziali
------- 
------- str_a = stringa.RTrim();
-------       str_a contiene il valore di stringa senza spazi finali
------- 
------- N.B.
------- [\s] nelle RegExp contiene sia gli spazi che i ritorni a capo, avanzamento riga
------- tabulatore, tabulatore verticale. Tutti questi caratteri, se presenti, verranno
------- eliminati.
-------                                                                            --- */
function Trim() {
   return this.replace(/\s+$|^\s+/g,"");
   }

function LTrim() {
   return this.replace(/^\s+/,"");
   }

function RTrim() {
   return this.replace(/\s+$/,"");
   }
	
String.prototype.Trim=Trim;	
String.prototype.RTrim=RTrim;	
String.prototype.LTrim=LTrim;	
/* ----------------------------------------------------------------------------------- */

/* Funzione per controllare la data per ora ho disabilitato gli alert*/
function isDate(dateStr) {

var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
var matchArray = dateStr.match(datePat); // is the format ok?

if (matchArray == null) {
	//alert("Data Errata!");
	return false;
}

month = matchArray[3]; // p@rse date into variables
day = matchArray[1];
year = matchArray[5];

if (month < 1 || month > 12) { // check month range
	//alert("Il mese deve esser compreso tra 1 e 12.");
return false;
}

if (day < 1 || day > 31) {
	//alert("Il giorno compreso tra 1 e 31.");
	return false;
}

if ((month==4 || month==6 || month==9 || month==11) && day==31) {
	//alert("Il mese "+month+" non ha 31 giorni!")
	return false;
}

if (month == 2) { // check for february 29th
var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
if (day > 29 || (day==29 && !isleap)) {
	//alert("Febbraio " + year + " non ha " + day + " giorni!");
return false;
}
}
return true; // date is valid
}