/**
 * BorderPanel.java
 *
 * ���x���Ɨ��̓I�Șg�����\�������p�l���B
 * ���x���t���̏ꍇ�A�p�l���̉��ɏ����]�����ł���B
 * ���C�A�E�g�� FlowLayout �݂̂ɑΉ��B
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

public class BorderPanel extends Panel {
  boolean isLabelNull = true; // ���x���t�����ǂ����H(���x���Ȃ�:true)
  Color color;                // ���ƂȂ�F
  Color upLeft, downRight;    // ���̐F�̏����Z���F�Ɣ����F
  String label;               // ���x��
  Font font;                  // ���x����\������t�H���g
  FontMetrics fm;

  // �R���X�g���N�^
  // ���x���Ȃ�
  public BorderPanel() {
    // �t�H���g�̐ݒ�
    font = new Font("Dialog", Font.PLAIN, 12);
    fm = getFontMetrics(font);
    // ���C�A�E�g�̐ݒ�
    super.setLayout(new FlowLayout(FlowLayout.LEFT, 5, 5));
  }
  // ���x���t��
  public BorderPanel(String label) {
    isLabelNull = false;
    // �t�H���g�̐ݒ�
    font = new Font("Dialog", Font.PLAIN, 12);
    fm = getFontMetrics(font);
    // ���x���̎擾
    this.label = label;
    // ���C�A�E�g�̐ݒ�
    super.setLayout(new FlowLayout(FlowLayout.CENTER, 5, fm.getHeight()));
  }

  // setLayout�̃I�[�o�[���C�h
  public void setLayout(LayoutManager mgr) {
    // �������Ȃ��B�܂背�C�A�E�g�̕ύX�������Ȃ��B
  }

  // ���x���A�g���̕`��
  public void paint(Graphics g){
    // �F�̐ݒ�
    color = Color.gray;
	upLeft = color.darker();
    downRight = color.brighter();
    // �`��̂��߂̑傫��
    int width, height, fmHeightHalf, stringWidth;

    // ���̓I�Șg���ƃ��x����`��
    // ���x���Ȃ��̏ꍇ
    if(isLabelNull) {
      // �傫���̏���
      width = (int)this.getSize().width;
      height = (int)this.getSize().height;
      fmHeightHalf = 0;

      // ��̐�
      g.setColor(upLeft);
      g.drawLine(0, 0, width -1, 0);
      g.setColor(downRight);
      g.drawLine(1, 1, width -2, 1);

    // ���x���t���̏ꍇ
    }else {
      // �傫���̏���
      width = (int)this.getSize().width;
      height = (int)this.getSize().height - fm.getHeight() +5;
      fmHeightHalf = fm.getAscent() >> 1;
      stringWidth = fm.stringWidth(label);

      // ���x���̕`��
      g.setFont(font);
      g.setColor(Color.black);
      g.drawString(label, fm.getAscent(), 10);

      // ��̐�
      g.setColor(upLeft);
      g.drawLine(0, fmHeightHalf, 7, fmHeightHalf);
      g.drawLine(stringWidth +16, fmHeightHalf, width -1, fmHeightHalf);
      g.setColor(downRight);
      g.drawLine(1, fmHeightHalf +1, 7, fmHeightHalf +1);
      g.drawLine(stringWidth +16, fmHeightHalf +1, width -2, fmHeightHalf +1);
    }

    // ���x���Ȃ��A���x���t���Ƃ�����
    // ���̐�
    g.setColor(upLeft);
    g.drawLine(0, fmHeightHalf, 0, height -1);
    g.setColor(downRight);
    g.drawLine(1, fmHeightHalf +1, 1, height -2);
    // ���̐�
    g.setColor(upLeft);
    g.drawLine(1, height -2, width -2, height -2);
    g.setColor(downRight);
    g.drawLine(0, height -1, width -1, height -1);
    // �E�̐�
    g.setColor(upLeft);
    g.drawLine(width -2, fmHeightHalf +1, width -2, height -2);
    g.setColor(downRight);
    g.drawLine(width -1, fmHeightHalf, width -1, height -1);
  }

  // updata���\�b�h�̃I�[�o�[���C�h�i�`��̌������̂��߂Ɂj
  public void updata(Graphics g){
    paint(g);
  }

}

