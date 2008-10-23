<?php
# Translated by Phu Nguyen Manh <nmphu_vn@yahoo.com>
# 2004-01-05

$Jan='Th�ng 1';//'January';
$Feb='Th�ng 2';//'February';
$Mae='Th�ng 3';//'March';
$Apr='Th�ng 4';//'April';
$Mai='Th�ng 5';//'May';
$Jun='Th�ng 6';//'June';
$Jul='Th�ng 7';//'July';
$Aug='Th�ng 8';//'August';
$Sep='Th�ng 9';//'September';
$Okt='Th�ng 10';//'October';
$Nov='Th�ng 11';//'November';
$Dez='Th�ng 12';//'December';

/**
* Note: the first element of $monat is set to empty string
*/
$monat=array('',$Jan,$Feb,$Mae,$Apr,$Mai,$Jun,$Jul,$Aug,$Sep,$Okt,$Nov,$Dez);
//Bac sy
$LDDoctors='Ch&#x1EEF;a b&#x1EC7;nh';//'Doctors';
//Thong tin nhan ve bac sy
$LDQView='Th�ng tin nhanh';//'DOC Quickview';  // DOC = doctor on call
//Thong tin nhanh ve cac ca truc trong ngay hom nay
$LDQViewTxt='Th�ng tin nhanh v&#x1EC1; c�c ca tr&#x1EF1;c trong ng�y';//'Quickview of today\'s DOC (doctor-on-call) schedule';
//Lich phan cong
$LDDutyPlan='L&#x1ECB;ch ph�n c�ng';//'Duty plan';
//Ke hoach cong viec, xem, cap nhat, xoa, quan ly,...
$LDDutyPlanTxt='K&#x1EBF; ho&#x1EA1;ch c�ng vi&#x1EC7;c, xem, c&#x1EAD;p nh&#x1EAD;t, xo�, qu&#x1EA3;n l�,...';//'Duty plan, view, update, delete, manage, etc.';
//Danh sach bac sy
$LDDocsList='Danh s�ch b�c s&#x1EF9;';//'Doctors\' list';
//Tao hoac cap nhat danh sach cac bac sy, nhap du lieu,...
$LDDocsListTxt='T&#x1EA1;o ho&#x1EB7;c c&#x1EAD;p nh&#x1EAD;t danh s�ch b�c s&#x1EF9;, nh&#x1EAD;p d&#x1EEF; li&#x1EC7;u,...';//'Create or update doctors\' list, enter data, etc..';
//Dien dan trao doi
$LDDocsForum='Di&#x1EC5;n &#x111;�n trao &#x111;&#x1ED5;i';//'Forum';
//Dien dan trao doi cho cac bac sy
$LDDocsForumTxt='Di&#x1EC5;n &#x111;�n trao &#x111;&#x1ED5;i cho c�c b�c s&#x1EF9;';//'Discussions forum for doctors';
//Tin tuc
$LDNews='Tin t&#x1EE9;c';//'News';
//Soan, doc, sua cac tin tuc
$LDNewsTxt='So&#x1EA1;n, &#x111;&#x1ECD;c, s&#x1EE7;a c�c tin t&#x1EE9;c';//'Compose, read, edit news';
//Ghi chep
$LDMemo='Ghi ch�p';//'Memo';
//Soan, doc, sua cac ghi chep
$LDMemoTxt='So&#x1EA1;n, &#x111;&#x1ECD;c, s&#x1EED;a c�c ghi ch�p';//'Compose, read, edit memo';
//Dong cua so lam viec
$LDCloseAlt='&#x110;�ng c&#x1EE7;a s&#x1ED5; l�m vi&#x1EC7;c';//'Close physicians/surgeons\' window';
//Ca truc cua cac bac sy
$LDDocsOnDuty='Ca tr&#x1EF1;c c&#x1EE7;a c�c b�c s�';//'Doctors on Call';

/*$LDTabElements=array('Department',
								 'DOC 1',
								 'Beeper/Phone',
								 'DOC 2',
								 'Beeper/Phone',
								 'Duty plan'
								 );
*/
//Phong ban, bac sy 1, bac sy 2, NT(Nhan tin), DT(Dient hoai), lich phan cong
$LDTabElements=array('Ph�ng ban',
								 'B�c s&#x1EF9; 1',
								 'NT/&#x110;T',
								 'B�c s&#x1EF9; 2',
								 'NT/&#x110;T',
								 'L&#x1ECB;ch ph�n c�ng'
								 );
//Xem lich phan cong
$LDShowActualPlan='Xem l&#x1ECB;ch ph�n c�ng';//'Show actual duty plan';
/*$LDShortDay=array('Su',
								'Mo',
								'Tu',
								'We',
								'Th',
								'Fr',
								'Sa'
								);
*/
$LDShortDay=array('CN',
								'T2',
								'T3',
								'T4',
								'T5',
								'T6',
								'T7'
								);
/*$LDFullDay=array('Sunday',
								'Monday',
								'Tuesday',
								'Wednesday',
								'Thursday',
								'Friday',
								'Saturday'
								);
*/
$LDFullDay=array('Ch&#x1EE7; nh&#x1EAD;t',
								'Th&#x1EE9; 2',
								'Th&#x1EE9; 3',
								'Th&#x1EE9; 4',
								'Th&#x1EE9; 5',
								'Th&#x1EE9; 6',
								'Th&#x1EE9; 7'
								);
//Truc ca 1
$LDDoc1='Tr&#x1EF1;c ca 1';//'Doctor-On-Call 1';
//Truc ca 2
$LDDoc2='Tr&#x1EF1;c ca 2';//'Doctor-On-Call 2';
//Dong
$LDClosePlan='&#x110;�ng';//'Close this plan';
//Tao moi mot lich truc
$LDNewPlan='T&#x1EA1;o m&#x1EDB;i m&#x1ED9;t l&#x1ECB;ch tr&#x1EF1;c';//'Create a new plan';
//Quay lai
$LDBack='Quay l&#x1EA1;i';//'Back';
//Tro giup
$LDHelp='Tr&#x1EE3; gi�p';//'Help';
//Tao lich truc
$LDMakeDutyPlan='T&#x1EA1;o l&#x1ECB;ch tr&#x1EF1;c';//'Create dutyplan';
//Nhan chuot vao day de chon bac sy tu danh sach;
$LDClk2Plan='Nh&#x1EA5;n chu&#x1ED9;t v�o &#x111;�y &#x111;&#x1EC3; ch&#x1ECD;n b�c s&#x1EF9; t&#x1EEB; danh s�ch';//'Click to open personell list';
//Thong tin
$LDInfo4Duty='Th�ng tin';//'Information';
//Dang lam nhiem vu
$LDStayIn='&#x110;ang l�m nhi&#x1EC7;m v&#x1EE5;';//'Stay-in duty';
//Trong ca truc
$LDOnCall='Trong ca tr&#x1EF1;c';//'On call duty';
//Dien thoai
$LDPhone='&#x110;i&#x1EC7;n tho&#x1EA1;i';//'Phone';
//Nhan tin
$LDBeeper='Nh&#x1EAF;n tin';//'Beeper';
//Thong tin chi tiet
$LDMoreInfo='Th�ng tin chi ti&#x1EBF;t';//'More Info';
//Trong
$LDOn='Trong';//'on';
//Dong cua so
$LDCloseWindow='&#x110;�ng c&#x1EED;a s&#x1ED5;';//'Close window';
//Thang
$LDMonth='Th�ng';//'Month';
//Nam
$LDYear='N&#x103;m';//'Year';
/*$LDPerElements=array('Family name',
									'Given name',
									'Date of birth',
									'Beeper',
									'Phone',
									'Beeper',
									'Phone'
									);
*/
$LDPerElements=array('H&#x1ECD;',
									'T�n',
									'Ng�y sinh',
									'Nh&#x1EAF;n tin',
									'&#x110;i&#x1EC7;n tho&#x1EA1;i',
									'Nh&#x1EAF;n tin',
									'&#x110;i&#x1EC7;n tho&#x1EA1;i'
									);
//Chon phong ban
$LDChgDept='Ch&#x1ECD;n ph�ng ban: ';
//Dong y thay doi phong ban
$LDChange='&#x110;&#x1ED3;ng �';//'Change';
//Tao danh sach can bo
$LDCreatePersonList='T&#x1EA1;o m&#x1EDB;i danh s�ch c�n b&#x1ED9;';//'Create a list for personell';
//Danh sach can bo chua duoc tao
$LDNoPersonList='Danh s�ch c�n b&#x1ED9; ch&#x1B0;a &#x111;&#x1B0;&#x1EE3;c t&#x1EA1;o';//'The list of personell is not yet created.';
//Hien thi
$LDShow='Hi&#x1EC3;n th&#x1ECB;';//'Show';

//Lich lam viec viec
$LDDOCS='L&#x1ECB;ch l�m vi&#x1EC7;c';//'DOC Scheduler';
//Lich truc, ke hoach, xem, cap nhat, sua,...
$LDDOCSTxt='L&#x1ECB;ch tr&#x1EF1;c, k&#x1EBF; ho&#x1EA1;ch, xem, c&#x1EAD;p nh&#x1EAD;t, s&#x1EED;a, ...';//'Doctor On Call Scheduler, plan, view, update, edit, etc.';
//Yeu cau
$LDDOCSR='Y�u c&#x1EA7;u';//'DOCSR';
//Yeu cau lich truc
$LDDOCSRTxt='Y�u c&#x1EA7;u l&#x1ECB;ch tr&#x1EF1;c';//'Doctor On Call Schedule Requester';
/* 2002-09-15 EL */
//Kiem tra yeu cau
$LDTestRequest='Ki&#x1EC3;m tra y�u c&#x1EA7;u';//'Test request';
/* 2003-03-16 EL */
//Thong tin lien he
$LDContactInfo='Th�ng tin li�n h&#x1EC7;';//'Contact Info';
//Thong tin ca nhan
$LDPersonalContactInfo='Th�ng tin ca nh�n';//'Personal Contact Info';
//Thong tin lich truc
$LDOnCallContactInfo='Th�ng tin l&#x1ECB;ch tr&#x1EF1;c';//'On-Call Contact Info';
//Ban phai chon phong ban
$LDPlsSelectDept='B&#x1EA1;n ph&#x1EA3;i ch&#x1ECD;n ph�ng ban';//'Please select a department';
//tao danh sach bac sy
$LDCreateDoctorsList='T&#x1EA1;o danh s�ch b�c �';//'Create doctors\' list';
//Tao danh sach dau tien
$LDPlsCreateList='T&#x1EA1;o danh s�ch &#x111;&#x1EA7;u ti�n';//'Please create the list first.';
//Tiep theo hay nhan vao nut lenh
$LDPlsClickButton='Ti&#x1EBF;p theo h�y nh&#x1EA5;n v�o n�t l&#x1EC7;nh';//'Click on the following button.';
//Ho
$LDFamilyName='H&#x1ECD;';//'Family name';
//Ten
$LDGivenName='T�n';//'Given name';
//Ngay sinh
$LDDateOfBirth='Ng�y sinh';//'Date of birth';
//Nhap vao tu can tim
$LDEntryPrompt='Nh&#x1EAD;p v�o t&#x1EEB; c&#x1EA7;n t�m: <br>(vd: h&#x1ECD;, t�n,...)<br>';//'Please enter a search keyword:<br>(e.g. family name, given name, personell number, etc.)<br>';
//Ma so ca nhan
$LDPersonellNr='M� s&#x1ED1; c� nh�n';//'Personell Nr.';
//Chuc nang
$LDFunction='Ch&#x1EE9;c n&#x103;ng';//'Function';
//Lua chon
$LDOptions='L&#x1EF1;a ch&#x1ECD;n';//'Options';
//Tim thay... ban ghi
$LDSearchFound='T�m th&#x1EA5;y ~nr~ b&#x1EA3;n ghi.';
//Them mot bac sy vao danh sach
$LDAddDoctorToList='Th�m m&#x1ED9;t b�c s&#x1EF9; v�o danh s�ch';//'Add a doctor to list';
//Them
$LDAdd='Th�m';//'Add';
//xoa
$LDDelete='Xo�';//'Delete';
//Ban co chac chan muon xoa muc nhap nay khong
$LDSureToDeleteEntry='B&#x1EA1;n c� ch&#x1EAF;c ch&#x1EAF;n mu&#x1ED1;n xo� m&#x1EE5;c nh&#x1EAD;p n�y kh�ng?';//'Are you sure you want to delete this entry?';
/* 2003-03-18 EL */
//Thay doi phong ban
$LDChangeOnlyDept='Thay &#x111;&#x1ED5;i ph�ng ban';//'Change the department';
//Tao danh sach y ta
$LDCreateNursesList='T&#x1EA1;o danh s�ch y t�';//'Create Nurses\' List';
?>
