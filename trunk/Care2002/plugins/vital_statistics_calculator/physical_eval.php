<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Results and their Interpretations </TITLE>
</HEAD>

<BODY>

<DIV ALIGN="CENTER"><H1><font face="Verdana">Results and their Interpretations</font></H1></DIV>

<!-- Sources
Body fat percentage calculator and interpretation: http://bestbodyever.com/body-fat-calculator.html
BMI Calculator; http://nhlbisupport.com/bmi/bmi-m.htm
BMI Interpretation: http://www.cdc.gov/nccdphp/dnpa/bmi/bmi-adult.htm 
-->

<?php 

  # Get the data and assign  the various values to proper variables for manipulation and display.
		$AgeValue = $_POST["age"];
		$SexValue = $_POST["sex"];
		$WTValue = $_POST["wtkgs"];
		$WLValue = $_POST["wtlbs"];
		$HTValue = $_POST["htincms"];
		$PRValue = $_POST["prate"];
		$BPSValue = $_POST["bps"];
		$BPDValue = $_POST["bpd"];
		$waistSInCms = $_POST["wsincms"];

# All datas are in correct form. Now interpret the data as necessary.

		# Set the ideal body weight values as per the sex of the patient...
		if ($SexValue == "male") 
		{
			$maxWaistSize = 102;
			$IBWValue = $HTValue - 105;
			$IBWLVal = (int) ($IBWValue * 2.20462262185);
			if ($AgeValue <= 20)
			{
				$SaluC = "young man";
				$BMIntpret = "These BMI calculations are not applicable to you";
			}
			else
			{
				$SaluC = "man";
				$BMIntpret = "The BMI calculations are applicable to you: ";
			}
		}
		else 
		{
			$maxWaistSize = 88;
			if ($AgeValue <= 20)
			{
				$SaluC = "young lady";
				$BMIntpret = "These BMI calculations are not applicable to you";
			}
			else
			{
				$SaluC = "lady";
				$BMIntpret = "The BMI calculations are applicable to you: ";
			}
			$IBWValue = $HTValue - 107;
			$IBWLVal = (int) ($IBWValue * 2.20462262185);
		}

		# Perform the necessary calculations...
		$height = pow($HTValue, 0.725);
		$weight = pow($WTValue, 0.425);
		$SArea = round( (0.007184 * $height * $weight), 2);
		$PPValue = ($BPSValue - $BPDValue);
		$BMRValue = (0.75 * ($PRValue + (0.74 * $PPValue))) - 72;
		$BMRValue = round($BMRValue, 2);
		$INValue = ($HTValue / 2.54);
		$INValue = round($INValue, 2);
		$HTinM = ($HTValue / 100);
		$htInM = pow($HTinM, 2);
		$bodyFatP = round($WTValue/$htInM, 2);
		$BMIValue = (($WTValue) / $htInM);
		$BMIValue = round($BMIValue, 2);
		$LLBW = round( ($htInM * 18.49), 2);
		$IBWK = round( ($htInM * 22), 0);
		$AcBW = round( ($htInM * 24.99), 2);
		$MaxBW = round( ($htInM * 30), 2);
		$ULGrIOb = round( ($htInM * 34.9), 2);
		$ULGrIIOb = round( ($htInM * 39.9), 2);
		$LLBWLbs = round( ($LLBW * 2.20462262185), 2);
		$IBWL = round( ($IBWK * 2.20462262185), 0);
		$AcBWLbs = round( ($AcBW * 2.20462262185), 2);
		$MaxBWLbs = round( ($MaxBW * 2.20462262185), 2);
		$THRate = (220 - $AgeValue);
		$OHRate = round( ($THRate * 0.85), 0);
		$BPSValInkPa = round($BPSValue / 7.5, 2);
		$BPDValInkPa = round($BPDValue / 7.5, 2);

		# Calculate the Daily Calorie Requirement based on the ideal body weight of the patient
		$DRLValue = floor(($IBWValue * 22) * (1.3));
		$DRUValue = ceil(($IBWValue * 22) * 2);

		# Interpret the body fat percentage
		if ($bodyFatP < 20)
		{
			$bfpInt = "<font color=\"#3300FF\">underweight</font>";
		}
		elseif ( ($bodyFatP >= 20) and ($bodyFatP <= 25) )
		{
			$bfpInt = "<u>within healthy range</u>";
		}
		elseif ( ($bodyFatP > 25) and ($bodyFatP < 27) )
		{
			$bfpInt = "<font color=\"#FF6600\">overweight</font>";
		}
		elseif ( ($bodyFatP > 27) and ($bodyFatP < 30) )
		{
			$bfpInt = "<font color=\"#CC0000\">significantly overweight</font>";
		}
		elseif ($bodyFatP > 30)
		{
			$bfpInt = "<font color=\"#FF0000\">obese</font>";
		}

		# Interpret the grade of obesity, if any
		if ( ($WTValue < $AcBW) and ($waistSInCms <= $maxWaistSize) )
		{
			$ObGrader = "<font color=\"#339900\">You are not overweight</font>";
		}
		elseif ( ($WTValue < $MaxBW) and ($waistSInCms <= $maxWaistSize) )
		{
			$ObGrader = "<font color=\"#FF9900\">You are overweight, and are at an increased risk, <br />particulary if you have type 2 diabetes and/or hypertension (high blood pressure) and/or heart disease</font>";
		}
		elseif ( ($WTValue < $MaxBW) and ($waistSInCms > $maxWaistSize))
		{
			$ObGrader = "<font color=\"#FF9900\">You are overweight, and are at a high risk, <br />particulary if you have type 2 diabetes and/or hypertension (high blood pressure) and/or heart disease</font>";
		}
		elseif ( ($WTValue < $ULGrIOb) and ($waistSInCms <= $maxWaistSize))
		{
			$ObGrader = "<font color=\"#FFCC00\">You appear to have class I obesity, and are at a high risk, <br />particulary if you have type 2 diabetes and/or hypertension (high blood pressure) and/or heart disease</font>";
		}
		elseif ( ($WTValue < $ULGrIOb) and ($waistSInCms > $maxWaistSize) )
		{
			$ObGrader = "<font color=\"#FFCC00\">You appear to have class I obesity, and are at a very high risk, <br />particulary if you have type 2 diabetes and/or hypertension (high blood pressure) and/or heart disease</font>";
		}
		elseif ($WTValue < $ULGrIIOb)
		{
			$ObGrader = "<font color=\"#FF6600\">You appear to have class II obesity, and are at a very high risk, <br />particulary if you have type 2 diabetes and/or hypertension (high blood pressure) and/or heart disease</font>";
		}
		else
		{
			$ObGrader = "<font color=\"#FF0000\">You appear to have class III obesity, and are at an extremely high risk,<br /> particulary if you have type 2 diabetes and/or hypertension (high blood pressure) and/or heart disease</font>";
		}


		# Interpret the body weight vis-a-vis ideal body weight
		if ($IBWK == $WTValue) 
		{
			$IBWInt = "and this is your <font color=\"darkorchid\">ideal body weight</font>";
		}
		else
		{
			$IBWInt = "while your ideal body weight should be <font color=\"darkorchid\">$IBWK </font>Kgs or <font color=\"darkorchid\">$IBWL </font>lbs";
		}

		# Interpret the pulse pressure
		if ($PPValue > 50) 
		{
			$PPInt = "<font color=\"red\">high</font> for it should be no more than 50";
		}
		elseif ($PPValue < 40)
		{
			$PPInt = "<font color=\"blue\">low</font> for it should be no less than 40";
		}
		else
		#		($PPValue >= 40 || $PRValue <= 50)
		{
			$PPInt = "<font color=\"green\">within normal limits</font>";
		}

		# Interpret the type of pulse from its rate
		if ($PRValue < 40) 
		{
			$PRInt = "<font color=\"red\">complete heart block</font>";
		}
		elseif ($PRValue < 60 and $PRValue >= 40) 
		{
			$PRInt = "<font color=\"blue\">bradycardia</font>";
		} 
		elseif ($PRValue > 100 and $PRValue <= 140) 
		{
			$PRInt = "<font color=\"#ff1cae\">sinus tachycardia</font>";
		} 
		elseif ($PRValue > 140 and $PRValue <= 160) 
		{
			$PRInt = "<font color=\"red\">tachycardia</font>";
		} 
		elseif ($PRValue > 160) 
		{
			$PRInt = "<font color=\"red\">supraventricular or ventricluar tachycardia</font>";
		} 
		else
		#		($PRValue >= 60 | $PRValue <= 100)
		{
			$PRInt = "<font color=\"green\">a pulse rate within normal range</font>";
		}

		# Interpret the systolic BP
		$BPInt = "<font color=\"green\">within normal limits</font>";
		
		# If the systolic is less than 60 and diastolic less than 40 say hypotensive
		if ($BPSValue < 60 and $BPDValue < 40) 
		{
			$BPInt = "<font color=\"blue\">hypotensive</font>";
		}

 		# If the systolic is more than 140 but less than or equal to 160
		if ($BPSValue > 140 and $BPSValue <= 160)
		{
			if ($BPDValue > 90 and $BPDValue <= 100) 
			{
				$BPInt = "<font color=\"red\">mildly hypertensive</font>";
			}
			elseif ($BPDValue > 100 and $BPDValue <= 110) 
			{
				$BPInt = "<font color=\"red\">moderately hypertensive</font>";
			}
			elseif ($BPDValue > 110) 
			{
				$BPInt = "<font color=\"red\">severely hypertensive</font>";
			}
		}		

 		# If the systolic is more than 160 but less than or equal to 200		
		if ($BPSValue > 160 and $BPSValue <= 200)
		{
			if ($BPDValue > 110) 
			{
				$BPInt = "<font color=\"red\">severely hypertensive</font>";
			}
			else
			{
			   $BPInt = "<font color=\"red\">moderately hypertensive</font>";
			}
		}		
		elseif ($BPSValue > 200) 
		{
			$BPInt = "<font color=\"red\">severely hypertensive</font>";
		}		

 		# If the diastolic is more than 90 but less than or equal to 100		
		if ($BPDValue > 90 and $BPDValue <= 100)
		{
			$BPInt = "<font color=\"red\">mildly hypertensive</font>";
		}

 		# If the diastolic is more than 100 but less than or equal to 110		
		if ($BPDValue > 100 and $BPDValue <= 110) 
		{
			$BPInt = "<font color=\"red\">moderately hypertensive</font>";
		}

 		# If the diastolic is more than 110		
		if ($BPDValue > 110) 
		{
			$BPInt = "<font color=\"red\">severely hypertensive</font>";
		}

		# Interpret the body mass index
		if ($BMIValue < 19) 
		{
			$BMInt = " and you are <font color=\"blue\">underweight</font>";
		} 
		elseif ($BMIValue > 25 and $BMIValue <= 30) 
		{
			$BMInt = " and you are <font color=\"red\">prone to health risks</font>";
		} 
		elseif ($BMIValue > 30) 
		{
			$BMInt = " and you are <font color=\"red\">at a very high for development of heart diseases</font>";
		}
		elseif ($BMIValue > 25 and $BMIValue <= 30) 
		{
			$BMInt = " and you are <font color=\"red\">prone to health risks</font>";
		} 
		else
		{
			$BMInt = " and you are <font color=\"green\">fine</font>";
		}

		# Interpret the basal metabolic rate
		if ($BMRValue > 10) 
		{
			$BMRVal = "<font color=\"red\">$BMRValue</font>";
			$BMRInt = "this value is <font color=\"red\">high</font> for it should not be more than 10";
		} 
		elseif ($BMRValue < -10) 
		{
			$BMRVal = "<font color=\"blue\">$BMRValue</font>";
			$BMRInt = "this value is <font color=\"blue\">low</font> for it should not be less than 10";
		} 
		else		#	if ($BMRValue >= -10 | $BMRValue <= 10) 
		{
			$BMRVal = "<font color=\"green\">$BMRValue</font>";
			$BMRInt = "this value is <font color=\"green\">within normal limits</font>";
		}

		#Interpret the BP according to age
		if ($BPSValue > 140 or $BPDValue > 90) 
		{
			if ($AgeValue < 35 or $AgeValue > 55) 
			{
				$BPAgeInt = "<font color=\"red\">secondary causes of hypertension<br /><b>See your physician without delay!</b></font>";
			}
			elseif ($AgeValue > 35 or $AgeValue < 55)
			{
				$BPAgeInt = "<font color=\"blue\">idiopathic causes of hypertension</font>";
			}
		}
		else
		{
			$BPAgeInt = "<font color=\"green\">no blood pressure problems</font>";
		}
?>

<div align="center">
  <center>

<TABLE FRAME="BORDER" BORDER="8" RULES="ROWS" COLS="1" CELLSPACING="5" CELLPADDING="5" bordercolorlight="#CCCCCC" bordercolordark="#666666" style="border-collapse: collapse" bordercolor="#111111">
<TR>
<TD ALIGN="LEFT">
<font face="Verdana" size="2">
<div align="center"><b><font color="#333399">You are a <u><?php echo $SaluC ?></u> and your age is <u><?php echo $AgeValue ?> years</u></font></b></div>&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center">Weight</div></u></b></font></td>
  </tr>
  <tr>
    <td width="100%">
<font color="#339900" face="Verdana" size="2"><div align="center"><i><b><?php echo $ObGrader ?></b></i></div></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
Your weight is <font color="#FF3399"><?php echo $WTValue ?> </font>Kgs or <font color="#FF3399"><?php echo $WLValue ?> </font>lbs, <?php echo $IBWInt ?></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
You should maintain <?php echo $SaluL ?> body weight between <font color="blue"><?php echo $LLBW ?></font> and <font color="green"><?php echo $AcBW ?></font> and should NOT cross <font color="red"><?php echo $MaxBW ?></font> Kgs</font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
This is equivalent to <font color="blue"><?php echo $LLBWLbs ?></font>, <font color="green"><?php echo $AcBWLbs ?></font> and <font color="red"><?php echo $MaxBWLbs ?></font> in lbs respectively</font></td>
  </tr>
</table>
<p>&nbsp;<TABLE FRAME="BORDER" BORDER="5" RULES="ROWS" COLS="1" CELLSPACING="5" CELLPADDING="2" bordercolorlight="#999999" bordercolordark="#808080" style="border-collapse: collapse" bordercolor="#111111" bgcolor="#CCCCCC" width="100%">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center">Height and Body Mass Index</div></u></b></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<?php echo $BMIntpret ?><br />
Your height is <font color="#FF3399"><?php echo $HTValue ?> </font>cms or <font color="#FF3399"><?php echo $INValue ?> </font>inches <?php echo $SaluL ?> body mass index is <font color="firebrick"><b><?php echo $BMIValue ?></b></font> <?php echo $BMInt ?> </font>
    </td>
  </tr>
</table>
<p>
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center">Required Calories</div></u></b></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
You require to consume between <font color="red"> <?php echo $DRLValue ?> </font> and <font color="blue"> <?php echo $DRUValue ?> </font>KCalories per day to maintain/achieve your ideal body weight</td>
  </tr>
</table>
<p>
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center">Body Surface Area and Fat Percentage</div></u></b></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
Your body surface area is <b><font color="orange"><?php echo $SArea ?> </font></b>m<sup><b><font size="1">2</font></b></sup></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
Your body fat percentage is <font color="#FF33CC"><?php echo $bodyFatP ?></font>%, and this indicates that you are <?php echo "$bfpInt" ?></u></td>
  </tr>
</table>
<p>
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center">Blood Pressure</div></u></b></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
Your blood pressure is <font color="#3300CC"><?php echo $BPSValue ?>/<?php echo $BPDValue ?></font> torr<FONT COLOR="RED">*</FONT> or <font color="#3300CC"><?php echo $BPSValInkPa ?>/<?php echo $BPDValInkPa ?></font> kPa*</td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
This means that you have a blood pressure that is <?php echo $BPInt ?> and you appear to have <?php echo $BPAgeInt ?></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
Your pulse pressure is <font color="#FF3399"><?php echo $PPValue ?> </font> torr and this figure is <?php echo $PPInt ?></font></td>
  </tr>
</table>
<p>
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center">Pulse Rate</div></u></b></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
Your pulse rate is <font color="#FF3399"><?php echo $PRValue ?> </font>beats per minute and this means that you have <?php echo $PRInt ?></font></font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
Your target heart rate is <font color="red"><?php echo $THRate ?></font> beats per minute</font></td>
  </tr>
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
You should achieve at least <font color="blue"><?php echo $OHRate ?></font> heart beats per minute when you are exercising at your peak</font></td>
  </tr>
</table>
<br />
&nbsp;<table border="5" cellpadding="2" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="100%" bordercolorlight="#999999" bordercolordark="#666666" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
<font face="Verdana" size="2">
<b><u><div align="center">Basal Metabolic Rate</div></u></b></font></td>
  </tr>
  <tr>
    <td width="100%">

<font face="Verdana" size="2">
Your basal metabolic rate is <?php echo $BMRVal ?> and <?php echo $BMRInt ?></font></td>
  </tr>
</table>
<BR />
</TD>
</TR>
</TABLE>
</center>
</div>
<DIV ALIGN="CENTER">
<font face="Verdana" size="1">
<FONT COLOR="RED">*</FONT> 1 torr = 1 mmHg, *kPa 
= kilo Pascals</font><font face="Verdana" size="2"><BR />
<FONT COLOR="RED" SIZE="2">The target heart rate is not useful for children</FONT>
<BR />
<FONT COLOR="RED" SIZE="2">The obesity calculator does not take into account the 
waist to hip ratio, currently</FONT> </font>
<form method="POST" action="medical_eval.php">
  <button name="recalc" value="Re-Calculate" type="submit"><font face="Verdana">
  Re-calculate</font></button>
  </font>
  </p>
</form>
<font face="Verdana" size="1">©Sudisa - 2004 to 2014</font></DIV>
</BODY>
</HTML>