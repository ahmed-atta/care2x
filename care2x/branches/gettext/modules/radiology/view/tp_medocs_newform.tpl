<table border=0 cellpadding=2 width=100%>
   <tr bgcolor='#f6f6f6'>
     <td><FONT SIZE=-1  FACE='Arial' color='#000066'>  {{$LDExtraInfo}}<br>({{$LDInsurance}}) </td>
     <td><textarea name='aux_notes' cols=60 rows=2 wrap='physical'></textarea></td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT SIZE=-1  FACE='Arial' color=red>*  {{$LDGotMedAdvice}} </td>
     <td><FONT SIZE=-1  FACE='Arial' color='#000066'>
	 		<input type='radio' name='short_notes' value='got_medical_advice'>   {{$LDYes}} 
         	<input type='radio' name='short_notes' value=''>   {{$LDNo}} 
         </td>

   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT SIZE=-1  FACE='Arial' color='red'>*  {{$LDDiagnosis}} </td>
     <td><textarea name='text_diagnosis' cols=60 rows=8 wrap='physical'></textarea></td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT SIZE=-1  FACE='Arial' color='red'>*  {{$LDTherapy}} </td>

     <td><textarea name='text_therapy' cols=60 rows=8 wrap='physical'></textarea></td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT SIZE=-1  FACE='Arial' color='red'>*  {{$LDDate}} </td>
     <td><input type='text' name='date' size=10 maxlength=10 {{$TP_date_validate}} >
	 <a href="{{$TP_href_date}}"><img   {{$TP_img_calendar}} ></a> 
	<font size=1>[ {{$TP_date_format}} ]</font>
	 </td>

   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT SIZE=-1  FACE='Arial' color='red'>*  {{$LDBy}} </td>
     <td><input type='text' name='staff_name' size=50 maxlength=60 value='{{$TP_user_name}}' readonly></td>
   </tr>
</table>