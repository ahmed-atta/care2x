/*
 * DicomDic.java - Dicom����(Dicom.dic�t�@�C��)��ǂݍ���Ń^�O�Ō����ł���悤�ɂ���
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 * @param   dicURL Dicom���������݂���URL
 *
 */

package dicomviewer;

import java.io.*;
import java.util.*;
import java.net.*;

public class DicomDic {

  int             debug_level = 3;

  Hashtable				table = new Hashtable();  // �����f�[�^���i�[

  // �R���X�g���N�^
  public DicomDic(String dicURL) {
    // �f�o�b�O�p
    if (debug_level > 3) System.out.println("Now Loading DicomDic from " + dicURL +"...");
    InputStream     inS;
    BufferedReader	din;
    StringTokenizer tkn;
    try{
      // �f�o�b�O�p
      if (debug_level > 3) System.out.println("Now Making Resive Stream....");
      if(dicURL.equals("none")) {
        // Jar�t�@�C���̒��ɂ���Dicom�������Q�Ƃ���
        inS = this.getClass().getResourceAsStream("Dicom.dic");
      }else {
        // URL�\�P�b�g�����AURL���玫��������Ă���
        URL urlConn = new URL(dicURL);
        inS = urlConn.openStream();
      }

      // ��M�X�g���[���̐ݒ�
      din = new BufferedReader(new InputStreamReader(inS));
      String line_str;
      int j=0;

      // �t�@�C����1�s���A�Ō�܂œǂ�
      while((line_str = din.readLine())!=null){

        // �s�̐擪��#�̏ꍇ�̓R�����g�Ƃ��ēǂݔ�΂�
        if(line_str.startsWith("#")!=true){
          j++;
				  //Hashtable�ɁA�L�[���^�O(String)�A�l��Dicomvalue�I�u�W�F�N�g�Ƃ��ē����
				  String tag = null;
				  Dicomvalue dicomvalue = new Dicomvalue();
          tkn = new StringTokenizer(line_str);
          tag = tkn.nextToken();
          // �f�o�b�O�p
          if (debug_level > 5) System.out.println("Tag  : " + tag);
          dicomvalue.vr = tkn.nextToken();
          // �f�o�b�O�p
          if (debug_level > 5) System.out.println("VR   : " + dicomvalue.vr);
          dicomvalue.name = tkn.nextToken();
          // �f�o�b�O�p
          if (debug_level > 5) System.out.println("Name : " + dicomvalue.name);
          dicomvalue.vm = tkn.nextToken();
          // �f�o�b�O�p
          if (debug_level > 5) System.out.println("VM   : " + dicomvalue.vm);
          dicomvalue.version =tkn.nextToken();
          // �f�o�b�O�p
          if (debug_level > 5) System.out.println("Ver. : " + dicomvalue.version);
				  table.put(tag, dicomvalue);
        }
      }
      din.close();
    }
    catch(EOFException eof){
      System.out.println("EOFException: " + eof.getMessage() );
    }
    catch(IOException ioe){
      System.out.println("IOException: " + ioe.getMessage() );
    }
    catch(Exception e){
    	System.out.println("Exception: " + e.getMessage() );
    }
  }

  // �ȉ��I�u�W�F�N�g�̒l��Ԃ�
  public String getName(String tag) {
    return ((Dicomvalue)table.get(tag)).name;
  }

  public String getVR(String tag) {
    return ((Dicomvalue)table.get(tag)).vr;
  }

  public String getVM(String tag) {
    return ((Dicomvalue)table.get(tag)).vm;
  }

  public String getVersion(String tag) {
    return ((Dicomvalue)table.get(tag)).version;
  }

  // �f�[�^�Ƀ^�O���܂܂�邩���ׂ�
  public boolean isContain(String tag) {
    return table.containsKey(tag);
  }

  // �n�b�V���e�[�u���̒l�ƂȂ�I�u�W�F�N�g
  class Dicomvalue {
    String name;		//�^�O�ɑ΂��閼�O
    String vr;			//VR
    String vm;			//VM
    String version;	//DicomVersion
  }
}


