	<div class="head">
		<div class="headline">
			{{$sToolbarTitle}}
		</div>
		<div class="help">
			<a href="javascript:window.back();"><img {{$gifBack2}} alt="" {{$dhtml}} ></a>
			<a href="{{$pbHelp}}"><img {{$gifHilfeR}} alt="" {{$dhtml}}></a>
			<a href="{{$breakfile}}" {{$sCloseTarget}}><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>
	     </div>
	</div>
	<div class="patient_quickinfo">
		<div class="patient_qickinfo_cell">
			{{$LDCaseNr}} : {{$sPatientNumber}}
		</div>
		<div class="patient_qickinfo_cell">
			{{$LDLastName}} : {{$sNameLast}}
		</div>
		<div class="patient_qickinfo_cell">
			{{$LDFirstName}} : {{$sNameFirst}}
		</div>
		<div class="patient_qickinfo_cell">
			{{$LDBday}} : {{$sBirthDay}} <font color="black">{{$sDeathDate}}</font>
		</div>
	</div>