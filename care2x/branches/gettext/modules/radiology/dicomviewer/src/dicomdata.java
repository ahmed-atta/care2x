/*
 * DicomData.java - �^�O�Ȃǂ�Dicom����ێ�����
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

import java.util.*;
import java.io.Serializable;

public class DicomData implements Serializable {
  // �L�[���^�O,�l��Dicomvalue�Ƃ����I�u�W�F�N�g�̃n�b�V���e�[�u��
  Hashtable table = new Hashtable();

  // �n�b�V���e�[�u���Ƀ^�O�Ƃ����L�[�ŋ�̃I�u�W�F�N�g��ǉ�
  public void setTag(String tag) {
    table.put(tag, new Dicomvalue());
  }

  // �ȉ��I�u�W�F�N�g�̒l���Z�b�g
  public void setValue(String tag, byte[] argValue) {
    ((Dicomvalue)table.get(tag)).value = new byte[argValue.length];
    System.arraycopy(argValue, 0, ((Dicomvalue)table.get(tag)).value, 0, argValue.length);
    ((Dicomvalue)table.get(tag)).valueLength = argValue.length;
  }

  public void setName(String tag, String argName) {
    ((Dicomvalue)table.get(tag)).name = argName;
  }

  public void setVR(String tag, String argVR) {
    ((Dicomvalue)table.get(tag)).vr = argVR;
  }

  public void setVM(String tag, String argVM) {
    ((Dicomvalue)table.get(tag)).vm = argVM;
  }

  public void setVersion(String tag, String argVersion) {
    ((Dicomvalue)table.get(tag)).version = argVersion;
  }

  public void setAnalyzedValue(String tag, String argAnalyzed) {
    ((Dicomvalue)table.get(tag)).analyzedValue = argAnalyzed;
  }

  // �ȉ��I�u�W�F�N�g�̒l��Ԃ�
  public byte[] getValue(String tag) {
    return ((Dicomvalue)table.get(tag)).value;
  }

  public int getValueLength(String tag) {
    return ((Dicomvalue)table.get(tag)).valueLength;
  }

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

  public String getAnalyzedValue(String tag) {
    return ((Dicomvalue)table.get(tag)).analyzedValue;
  }

  // �S�Ẵ^�O��Ԃ�
  public Enumeration keys() {
    return table.keys();
  }

  // �f�[�^�̒��g���̂Ă�
  public void removeAll() {
    table.clear();
  }

  // �f�[�^�Ƀ^�O���܂܂�邩���ׂ�
  public boolean isContain(String tag) {
    return table.containsKey(tag);
  }

  // �n�b�V���e�[�u���̒l�ƂȂ�I�u�W�F�N�g
  class Dicomvalue {
    String	name;						// �^�O�ɑ΂��閼�O
    String	vr;							// VR
    String 	vm;							// VM
    String 	version;				// DicomVersion
    byte[]	value;					// �ǂݍ��񂾂܂܂̒l
    int			valueLength;		// �l����
    String	analyzedValue;	// �l��\���ł���`�ɂ�������
  }
}

