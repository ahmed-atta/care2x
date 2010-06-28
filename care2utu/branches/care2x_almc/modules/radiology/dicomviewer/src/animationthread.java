/*
 * AnimationThread.java - �}���`�X���C�X�̉摜���A�j���[�V����������X���b�h
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

public class AnimationThread extends Thread {

  // �t�B�[���h
  Viewer  parent;
  boolean isStop = false;   // ��~���߂̃t���O
  boolean isNext = true;    // �Đ����A�����߂����H(�Đ��Ftrue�j
  int     interval = 1000;  // �A�j���[�V�����Ԋu(ms)

  // �R���X�g���N�^
  public AnimationThread(Viewer applet) {
    this.parent = applet;
  }

  // run()
  public void run() {
    while(!isStop) {
      // ���̉摜������
      if(isNext) nextImage();
      // �O�̉摜������
      else prevImage();

      // Sleep
      try{ Thread.sleep(interval);
      }catch(InterruptedException e) {}
    }
  }

  // �A�j���[�V�����Ԋu��ύX����
  public void changeInterval(int intarval) {
    this.interval = intarval;
  }

  // ���R�ɃX�g�b�v����悤��
  public void requestStop() {
    isStop = true;
  }

  // �摜�����ɂ���̂��O�̂ɂ���̂�
  public void changeNext(boolean flag) {
    isNext = flag;
  }

  // �摜�����ɂ߂���
  private void nextImage() {
    parent.imageNo_old = parent.imageNo;
    if(parent.imageNo < (parent.NUM -1)){
      parent.imageNo += 1;
    }else {
      parent.imageNo = 0;
    }
    parent.imageNo_S.setValue(parent.imageNo +1);
    parent.imageNo_F.setText(String.valueOf(parent.imageNo +1));
    parent.changeImageNo();
  }

  // �摜��O�̂ɂ���
  private void prevImage() {
    parent.imageNo_old = parent.imageNo;
    if(parent.imageNo > 0) {
      parent.imageNo -= 1;
    }else {
      parent.imageNo = parent.NUM -1;
    }
    parent.imageNo_S.setValue(parent.imageNo +1);
    parent.imageNo_F.setText(String.valueOf(parent.imageNo +1));
    parent.changeImageNo();
  }
}