/*
 * DicomFile.java - �t�@�C���̃I�[�v���E�t�@�C���̐؂�o���EVR�̉��
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

import java.io.*;
import java.text.*;
import java.net.*;
import java.util.*;

public class DicomFile {

  int             debug_level = 3;

  boolean         isLtlEndian;      // littleEndian�]���\���̂Ƃ��Atrue
  boolean         vrType;           // �����IVR�̏ꍇ�Atrue
  boolean         patientPrivacy;   // ���҂̃v���C�o�V�[����邽�߁A���Җ���ϊ�����Ƃ�true
  boolean         VReqSQ = false;   // �V�[�P���X��؂荀�ڂ̂��߂̃t���O
  boolean         containDic;       // DICOM�����Ɋ܂܂��^�O���H
  DicomDic	      dicomDic;         // DICOM����
  DicomData       dicomData;        // �i�[����f�[�^�̔�

  // �R���X�g���N�^
  public DicomFile(boolean argIsLtlEndian, boolean argVRType, boolean privacy, DicomDic argDicomDic) {
    patientPrivacy = privacy;
    isLtlEndian = argIsLtlEndian;
    vrType = argVRType;
    dicomDic = argDicomDic;
  }
  public DicomFile(boolean argIsLtlEndian, boolean argVRType, DicomDic argDicomDic) {
    this(argIsLtlEndian, argVRType, false, argDicomDic);
  }
  public DicomFile(DicomDic argDicomDic) {
    this(true, false, false, argDicomDic);
  }

  // DICOM�t�@�C�����؂�o��
  public DicomData load(String imgURL){
    // �f�[�^���i�[���锠����������
    dicomData = new DicomData();

    try {
      // DICOM�t�@�C����http�ŃQ�b�g���邽�߂�URL�����
      URL urlConn = new URL(imgURL);
      // InputStream���쐬����B
      // ��x�ABufferedInputStream�����܂����Ƃɂ�荂�����B
      // InputStream inS = urlConn.openStream();
      BufferedInputStream inS = new BufferedInputStream(urlConn.openStream());
      DataInputStream din = new DataInputStream(inS);

      int tempInt;
      byte[] buff2 = new byte[2];
      byte[] buff4 = new byte[4];

      String group;
      String number;
      String tag;
      String vr;
      int length;
      byte[] value;

      // �t�@�C�����Ō�܂œǂ�
      while (din.read(buff2) != -1) {
        // �^�O
        tempInt = readInt2(buff2);
        group  = Integer.toString((tempInt&0x0000f000)>>12,16);
        group += Integer.toString((tempInt&0x00000f00)>>8,16);
        group += Integer.toString((tempInt&0x000000f0)>>4,16);
        group += Integer.toString((tempInt&0x0000000f),16);
        din.readFully(buff2);
        tempInt = readInt2(buff2);
        number  = Integer.toString((tempInt&0x0000f000)>>12,16);
        number += Integer.toString((tempInt&0x00000f00)>>8,16);
        number += Integer.toString((tempInt&0x000000f0)>>4,16);
        number += Integer.toString((tempInt&0x0000000f),16);
        tag = ("("+group+","+number+")");

        // �f�o�b�O�p
        if (debug_level > 3) System.out.println("currentTag is : " + tag);
        dicomData.setTag(tag);  // DicomData�ɃZ�b�g

        // DICOM�����Ɋ܂܂�Ă��邩�ǂ����H
        containDic = dicomDic.isContain(tag);

        if(vrType && !VReqSQ){
				  // �t�@�C���������IVR�̏ꍇ
          StringBuffer sbuff = new StringBuffer(2);
          din.readFully(buff2);
          for(int i=0; i<2; i++)
	          sbuff.append((char)buff2[i]);
          dicomData.setVR(tag, sbuff.toString());

          // VR�ɂ���āA�l�������ς��B
          if(sbuff.toString().equals("OB") ||
             sbuff.toString().equals("OW") ||
             sbuff.toString().equals("SQ")) {
            // VR��OB�AOW�A�܂���SQ�̏ꍇ
            din.skip(2);
            // �l����(4bytes�ǂݍ���Version)
            din.readFully(buff4);
            length = readInt4(buff4);
          } else {
            // VR��OB�AOW�A�܂���SQ�ȊO
				    // �l����(2bytes�ǂݍ���Version)
            din.readFully(buff2);
            length = readInt2(buff2);
          }
        } else{
      	  // �t�@�C�����ÖٓIVR�̏ꍇ
				  // VR��DICOM�����ɂăQ�b�g����B
				  // �l����(4bytes�ǂݍ���Version)
          if(containDic) dicomData.setVR(tag, dicomDic.getVR(tag));
          else dicomData.setVR(tag, "na");
          din.readFully(buff4);
          length = readInt4(buff4);
        }

        // �V�[�P���X��؂荀�ڂ�������A�t���O��ς���
        if(tag.equals("(fffe,e0dd)")) VReqSQ = false;

        vr = dicomData.getVR(tag);
        // �f�o�b�O�p
        if (debug_level > 3) System.out.println("currentVR is : " + vr);
        if (debug_level > 3) System.out.println("currentLength: " + length);

        //�v�f����������`�����̏ꍇ
        if(length == -1) {
          VReqSQ = true;
          length = 0;
        }

        // �l
        value = new byte[length];
        din.readFully(value);
        dicomData.setValue(tag, value);

        // �f�[�^�̎擾
        if(containDic) {
          dicomData.setName(tag, dicomDic.getName(tag));
          dicomData.setVM(tag, dicomDic.getVM(tag));
          dicomData.setVersion(tag, dicomDic.getVersion(tag));
        }else {
          dicomData.setName(tag, "NotContainedInDICOMDictionary");
          dicomData.setVM(tag, "na");
          dicomData.setVersion(tag, "na");
        }

        // �f�o�b�O�p
        if (debug_level > 3) System.out.println("currentName is : " + dicomData.getName(tag));

        this.analyzer(tag, vr);
      } // while �����܂ŁB

      din.close();
      inS.close();
    }
    catch(EOFException eof){
      System.out.println("DicomFile.EOFException: " + eof.getMessage() );
    }
    catch(IOException ioe){
      System.out.println("DicomFile.IOException: " + ioe.getMessage() );
    }
    catch(Exception e){
      System.out.println("DicomFile.Exception: " + e.getMessage() );
    }
    
    // �v���C�o�V�[�΍�̃R�[�h
    // (0010,0010)�̃f�[�^��
    //     Takahiro Katoji -> T*k*h*r* *a*o*i
    // �̂悤�ȁu*�v������̕�����ɕϊ�����
    if(patientPrivacy) {
      String patientName;
      // ����DicomData�ɃZ�b�g����Ă��銳�Җ����擾����
      patientName = dicomData.getAnalyzedValue("(0010,0010)");
      StringBuffer patientBuf = new StringBuffer(patientName);
      
      // ���Җ��̊�Ԗڂ̕������u*�v�ɕϊ�����
      for(int i=0; i < patientName.length(); i++) {
        if(i % 2 == 1) patientBuf.setCharAt(i, '*');
      }
      
      // �ϊ���̕������DicomData�ɖ߂�
      dicomData.setAnalyzedValue("(0010,0010)", patientBuf.toString());
    }
    
    // DicomData��Ԃ��ďI��
    return dicomData;
  }

  // 2bytes�ǂ��Int�ɕϊ�
  private int readInt2(byte[] argtmp){
    int tmp;
    if(isLtlEndian) {
      tmp = ((0x000000ff & argtmp[1]) << 8 | (0x000000ff & argtmp[0]));
    } else {
      tmp = ((0x000000ff & argtmp[0]) << 8 | (0x000000ff & argtmp[1]));
    }
    return tmp;
  }

  // 4bytes�ǂ��Int�ɕϊ�
  private int readInt4(byte[] argtmp){
    int tmp;
    if(isLtlEndian) {
      tmp = ((0x000000ff & argtmp[3]) << 24 | (0x000000ff & argtmp[2]) << 16
           | (0x000000ff & argtmp[1]) << 8  | (0x000000ff & argtmp[0]));
    } else {
      tmp = ((0x000000ff & argtmp[0]) << 24 | (0x000000ff & argtmp[1]) << 16
           | (0x000000ff & argtmp[2]) << 8  | (0x000000ff & argtmp[3]));
    }
    return tmp;
  }

  // VR����͂��f�[�^�v�f�̒l��K�؂ȏ����ɕϊ�����B
  private void analyzer(String currentTag, String currentVR) {
	
    if(currentVR==null){
      // VR�������ꍇ
      dicomData.setAnalyzedValue(currentTag, "Not contain VR.");
    }
    else if(dicomData.getValueLength(currentTag)==0){
      // �傫��0�͖���
      dicomData.setAnalyzedValue(currentTag, "");
    }
    else if(currentVR.equals("PN") | currentVR.equals("LO")
          |	currentVR.equals("SH") | currentVR.equals("LT")
          |	currentVR.equals("ST") | currentVR.equals("UI")
          |	currentVR.equals("DS") | currentVR.equals("CS")
          |	currentVR.equals("IS") | currentVR.equals("AS")){
      // ���ʂ̕�����
      for(int j=0; j<dicomData.getValueLength(currentTag); j++)
        if((dicomData.getValue(currentTag))[j] == 0)
           (dicomData.getValue(currentTag))[j] = 20;
      dicomData.setAnalyzedValue(currentTag, new String(dicomData.getValue(currentTag)));

    }
    else if(currentVR.equals("SS")){
      int tmp;
      // 16bit�����t2�i��
      if(isLtlEndian){
        tmp = (((int)(dicomData.getValue(currentTag))[1] & 0x000000ff) << 8)
             | ((int)(dicomData.getValue(currentTag))[0] & 0x000000ff);
      } else {
        tmp = (((int)(dicomData.getValue(currentTag))[0] & 0x000000ff) << 8)
             | ((int)(dicomData.getValue(currentTag))[1] & 0x000000ff);
      }
      if((tmp & 0x00008000)==0x00008000) 	// ��������
				  tmp |= 0xffff0000;
      dicomData.setAnalyzedValue(currentTag, Integer.toString(tmp));

    }
    else if(currentVR.equals("US")){
      int tmp;
      // 16bit������2�i��
      if(isLtlEndian){
        tmp = (((int)(dicomData.getValue(currentTag))[1] & 0x000000ff) << 8)
             | ((int)(dicomData.getValue(currentTag))[0] & 0x000000ff);
      } else {
        tmp = (((int)(dicomData.getValue(currentTag))[0] & 0x000000ff) << 8)
             | ((int)(dicomData.getValue(currentTag))[1] & 0x000000ff);
      }
      dicomData.setAnalyzedValue(currentTag, Integer.toString(tmp));
    }
    else if(currentVR.equals("UL")){
      int tmp;
      // 32bit������2�i��
      if (isLtlEndian){
        tmp = (((int)(dicomData.getValue(currentTag))[3] & 0x000000ff) << 24)
            | (((int)(dicomData.getValue(currentTag))[2] & 0x000000ff) << 16)
            | (((int)(dicomData.getValue(currentTag))[1] & 0x000000ff) <<  8)
            |  ((int)(dicomData.getValue(currentTag))[0] & 0x000000ff);
      } else {
        tmp = (((int)(dicomData.getValue(currentTag))[0] & 0x000000ff) << 24)
            | (((int)(dicomData.getValue(currentTag))[1] & 0x000000ff) << 16)
            | (((int)(dicomData.getValue(currentTag))[2] & 0x000000ff) <<  8)
            |  ((int)(dicomData.getValue(currentTag))[3] & 0x000000ff);
      }
      dicomData.setAnalyzedValue(currentTag, Integer.toString(tmp));

    }
    else if(currentVR.equals("TM")){
      // ���� hh:mm:ss.frac
      dicomData.setAnalyzedValue(currentTag, new String(dicomData.getValue(currentTag)));
      StringBuffer buffer = new StringBuffer(dicomData.getAnalyzedValue(currentTag));
      buffer.insert(2, ":");
      buffer.insert(5, ":");
      dicomData.setAnalyzedValue(currentTag, buffer.toString());
    }
    else if(currentVR.equals("DA")){
      // ���t yyyy.mm.dd
      dicomData.setAnalyzedValue(currentTag, new String(dicomData.getValue(currentTag)));

      // 8bytes�����Ȃ��Ƃ���,�u-�v��ǉ�����
      if(dicomData.getValueLength(currentTag)==8){
        StringBuffer buffer = new StringBuffer(dicomData.getAnalyzedValue(currentTag));
        buffer.insert(4, "-");
        buffer.insert(7, "-");
        dicomData.setAnalyzedValue(currentTag, buffer.toString());
      }else if(dicomData.getValueLength(currentTag) == 10){
        // 10bytes�̂Ƃ���,�u.�v�u-�v�ɕύX����
        StringTokenizer st = new StringTokenizer(dicomData.getAnalyzedValue(currentTag), ".");
        String temp  = st.nextToken();
        temp += "-" + st.nextToken();
        temp += "-" + st.nextToken();
        dicomData.setAnalyzedValue(currentTag, temp);
      }
    }
    else
      // �T�|�[�g���Ă��Ȃ��^�O
      dicomData.setAnalyzedValue(currentTag, "Unknown VR");
    // �f�o�b�O�p
    if (debug_level > 3) System.out.println("AnalyzedValue :" + dicomData.getAnalyzedValue(currentTag));
  }
}


