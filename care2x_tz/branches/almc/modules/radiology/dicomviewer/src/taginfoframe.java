/*
 * TagInfoFrame.java - DICOM�^�O����\�����邽�߂̃t���[��
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

import java.awt.*;
import java.awt.event.*;
import java.util.*;

public class TagInfoFrame extends Frame {

  DicomData[] dicomData;    // DicomData��ێ�

  Vector      vector8;      // (0008,????)�̃^�O�̏�񂪊i�[�����
  Vector      vector10;     // (0010,????)�̃^�O�̏�񂪊i�[�����
  Vector      vector18;     // (0018,????)�̃^�O�̏�񂪊i�[�����
  Vector      vector20;     // (0020,????)�̃^�O�̏�񂪊i�[�����
  Vector      vector28;     // (0028,????)�̃^�O�̏�񂪊i�[�����
  Vector      vectorOther;  // ��L�ȊO�̃^�O�̏��͂����Ɋi�[

  List tag_list = new java.awt.List(5, false);  // �^�O�O���[�v��I�����郊�X�g
  hGrid table = new hGrid();                    // ������񂪊i�[�����e�[�u��
  Panel panel1 = new Panel();
  Label label1 = new Label();
  Choice imgNo_choice = new Choice();           // �摜�ԍ���I������

  // �R���X�g���N�^
  public TagInfoFrame() {
    // �t���[�������Z�b�g����
    super("DICOM Tag Browser");
    try  {
      jbInit();
    }
    catch(Exception e) {
      e.printStackTrace();
    }
  }

  // �ێ�����摜�f�[�^�̖��������肷��i�\������O�ɕK���Ă΂Ȃ���΂Ȃ�Ȃ��j
  public void setTagInfoFrame(int length) {
    dicomData = new DicomData[length];
    for(int i=0; i<length; i++) {
      imgNo_choice.add("0");
    }
  }

  // arrayNo�Ԗڂɉ摜�ԍ���imageNo�Ƃ��āAdicomData���Z�b�g����
  public void setDicomData(DicomData argData, int arrayNo, int imageNo) {
    dicomData[arrayNo] = argData;
    imgNo_choice.remove(arrayNo);
    imgNo_choice.insert(Integer.toString(imageNo +1), arrayNo);
  }


  // �R���|�[�l���g�̏�����
  private void jbInit() throws Exception {

    // �R���|�[�l���g�̓\��t��
    // �e�[�u���̗񖼂��`����
    String[] head = new String[4];
    head[0] = "Tag";
    head[1] = "VR";
    head[2] = "Name";
    head[3] = "Value";
    table.setHead(head);

    // �^�O�O���[�v��I�����郊�X�g�̏�����
    tag_list.add("0008 - Identifying");
    tag_list.add("0010 - Patient");
    tag_list.add("0018 - Acquisition");
    tag_list.add("0020 - Relationship");
    tag_list.add("0028 - ImagePresentation");
    tag_list.add("otherz");
    // �f�t�H���g�ł́A(0008,????)���I�������悤�ɂ���
    tag_list.select(0);

    label1.setText("ImageNo");
    // �e�[�u����CENTER�ɔz�u���邱�ƂŁA�t���[���̑傫�����ω������ꍇ�e�[�u���̑傫�����ω�����
    this.add(table, BorderLayout.CENTER);
    this.add(panel1, BorderLayout.NORTH);
    panel1.add(label1, null);
    panel1.add(imgNo_choice, null);
    panel1.add(tag_list, null);

    // �C�x���g�֌W
    tag_list.addItemListener(new ItemListener () {
      public void itemStateChanged(ItemEvent e) {
        // �I�����ꂽ�^�O�O���[�v�ɂ��\����ς���
        switch(tag_list.getSelectedIndex()) {
          case  0:  showTagInfo(vector8);
                    break;
          case  1:  showTagInfo(vector10);
                    break;
          case  2:  showTagInfo(vector18);
                    break;
          case  3:  showTagInfo(vector20);
                    break;
          case  4:  showTagInfo(vector28);
                    break;
          case  5:  showTagInfo(vectorOther);
                    break;
          default:  showTagInfo(vector8);
                    break;
        }
      }
    });
    imgNo_choice.addItemListener(new ItemListener () {
      public void itemStateChanged(ItemEvent e) {
        // �摜�ԍ����ω������ꍇ�A�f�[�^���Z�b�g���A
        setVector();
        // �I������Ă���^�O�O���[�v�ɍ��킹�ĕ\������
        switch(tag_list.getSelectedIndex()) {
          case  0:  showTagInfo(vector8);
                    break;
          case  1:  showTagInfo(vector10);
                    break;
          case  2:  showTagInfo(vector18);
                    break;
          case  3:  showTagInfo(vector20);
                    break;
          case  4:  showTagInfo(vector28);
                    break;
          case  5:  showTagInfo(vectorOther);
                    break;
          default:  showTagInfo(vector8);
                    break;
        }
      }
    });
  }

  // �摜�ԍ��̑I����ω�������
  public void setImageNo(int imgNo) {
    imgNo_choice.select(Integer.toString(imgNo +1));
    setVector();
    // �f�t�H���g�ŕ\������̂́A(0008,????)�̃^�O
    tag_list.select(0);
    showTagInfo(vector8);
  }

  // ���������Z�b�g����
  private void setVector() {
    int           index;

    index       = imgNo_choice.getSelectedIndex();
    vector8     = new Vector();
    vector10    = new Vector();
    vector18    = new Vector();
    vector20    = new Vector();
    vector28    = new Vector();
    vectorOther = new Vector();

    // ���ׂẴ^�O�ɂ��Ē��ׂ�
    for(Enumeration e = dicomData[index].keys(); e.hasMoreElements(); ){
      String    tag     = e.nextElement().toString();
      String[]  string  = new String[4];

      // ��������쐬����B
      string[0] = tag;
      string[1] = dicomData[index].getVR(tag);
      StringBuffer sBuffer = new StringBuffer(dicomData[index].getName(tag));
      sBuffer.setLength(30);
      string[2] = sBuffer.toString().replace('\u0000', ' ') ;
      string[3] = dicomData[index].getAnalyzedValue(tag);

      // �쐬��������������ꂼ���Vector��add����B
      if(tag.substring(1,5).equals("0008")) {
        vector8.addElement(string);
      } else if(tag.substring(1,5).equals("0010")) {
        vector10.addElement(string);
      } else if(tag.substring(1,5).equals("0018")) {
        vector18.addElement(string);
      } else if(tag.substring(1,5).equals("0020")) {
        vector20.addElement(string);
      } else if(tag.substring(1,5).equals("0028")) {
        vector28.addElement(string);
      } else {
        vectorOther.addElement(string);
      }
    }
  }

  // �^�O�O���[�v��\�ɕ\������
  private void showTagInfo(Vector vector) {
    // ���łɑ��݂���\�̃f�[�^��j������
    table.removeRows();
    // �\�̍s��ǉ����Ă���
    for(int i = 0; i < vector.size(); i++) {
      table.addRow((String[])vector.elementAt(i));
    }
    // �^�O�̗�(��ԍ�0)�Ń\�[�g����
    table.sort(0);
  }

}
