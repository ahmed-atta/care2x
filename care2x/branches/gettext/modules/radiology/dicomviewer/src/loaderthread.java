/*
 * LoaderThread.java - DICOM�t�@�C�������[�h����X���b�h
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

public class LoaderThread extends Thread{

  int       debug_level = 3;

  Viewer    parent;
  int       start, end;
  boolean   isInc;        // �摜�ԍ��͑������̂��H�������̂��H

  // �R���X�g���N�^
  public LoaderThread(int start, int len, int start_old, Viewer applet) {
    parent = applet;
    this.start = start;
    this.end = start + len;
    this.isInc = (start - start_old >=0);
  }

  public void run() {
//    synchronized (parent.dicomData_tmp) {
//    synchronized (parent.imageData_tmp) {
      if(isInc) {
        for (int i=start; i < end; i++){
          // ��~�v�����łĂ���΁A��~����
          if(parent.confirmStopRequest()) {
            // �f�o�b�O�p
            if (debug_level > 3) System.out.println(" Stoped!");
            parent.changeStopRequest(false);
            return;
          }

          // �f�o�b�O�p
          if (debug_level > 3) System.out.print(i);

          // �K�v�ȃf�[�^���A_tmp�ɓ����Ă��邩�ǂ����H
          if(parent.index[i] == -1) {
            // ��ƒ��̃t���O�B
            parent.index[i] = -2;

            // �f�o�b�O�p
            if (debug_level > 3) System.out.print(")");

            // �f�[�^��ǂݏo��
            parent.postData(i, start, end);
          }
          // ���ɑ��s�\�ȃX���b�h������΁A������ɐ�����ڂ�
          //Thread.yield();

          // �f�o�b�O�p
          if (debug_level > 3) System.out.print(" ");
        }
      }else {
        for (int i= end -1; i >= start; i--){
          // ��~�v�����łĂ���΁A��~����
          if(parent.confirmStopRequest()) {
            // �f�o�b�O�p
            if (debug_level > 3) System.out.println(" Stoped!");
            parent.changeStopRequest(false);
            return;
          }

          // �f�o�b�O�p
          if (debug_level > 3) System.out.print(i);

          // �K�v�ȃf�[�^���A_tmp�ɓ����Ă��邩�ǂ����H
          if(parent.index[i] == -1) {
            // ��ƒ��̃t���O�B
            parent.index[i] = -2;

            // �f�o�b�O�p
            if (debug_level > 3) System.out.print(")");

            // �f�[�^��ǂݏo��
            parent.postData(i, start, end);
          }
          // ���ɑ��s�\�ȃX���b�h������΁A������ɐ�����ڂ�
          //Thread.yield();

          // �f�o�b�O�p
          if (debug_level > 3) System.out.print(" ");
        }
      }
      parent.showStatus("Dicom Data Load Done.");
      // �f�o�b�O�p
      if (debug_level > 3) System.out.println();

      // �X���b�h�͒�~����̂ŁA��~���߂�����
      parent.changeStopRequest(false);
//    }
//    }
  }
}
