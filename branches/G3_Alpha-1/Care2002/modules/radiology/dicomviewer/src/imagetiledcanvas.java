/*
 * ImageTiledCanvas.java - �C���[�W����ׂĕ\��
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
import java.awt.image.*;
import java.applet.*;

public class ImageTiledCanvas extends Canvas {

  Viewer    parent;

  Image[]   image;                  // �`�悷��DICOM�C���[�W
  Dimension canvasSize;             // ����̃T�C�Y
  int       width, height;          // ���摜�̃T�C�Y
  int       imgW, imgH;             // 1���̉摜�̕`��T�C�Y
  int       px = 0, py = 0;         // ���摜�̂��̍��W�����\������
  int       x0, y0, x1, y1, x2, y2; // �}�E�X�̃|�C���g���W�i�}�E�X�v���X�A�h���b�O�A�����[�X�j
  double    zoom = 1.0;             // �g��k����
  int       zoomW, zoomH;           // ���摜�̂��̕���\������
  boolean   zoom_flag = false;      // �}�E�X��ZOOM��ύX���邩�ǂ����H
  boolean   hand = true; 		        // �J�[�\���̌`
  boolean   loupe = false;          // ���[�y��`�悷�邩�ǂ����H
  boolean   mouseDown;              // �}�E�X��������Ă����Ԃ��ǂ����H
  boolean   move = false;           // �摜�̕`��ʒu���ړ�������B

  int       tileR, tileC;           // �������i�s�A��j
  int       imageIndex;             // �Z�b�g����Ă���摜����

  int       activeNo = 0;           // ���ډ摜�ԍ�
  boolean   changeActive = false;   // ���ډ摜���}�E�X�̃N���b�N�ɂ���ĕω��������H
  int       start =0;               // �`�悷��摜�̃X�^�[�g�ԍ�

  // �������̕\���֘A
  boolean   showStudyInfo = true;   // ��������\�����邩�ǂ����H
  String[]  patientID;              // (0010,0020)
  String[]  patientName;            // (0010,0010)
  String[]  patientAgeSex;          // (0010,1010) (0010,0040)
  String[]  studyID;                // (0020,0010)
  String[]  studyDate;              // (0008,0020)
  String[]  studyTime;              // (0008,0030)
  String[]  imageNo;                // (0020,0013)
  String[]  ww_wl;                  // ���݂�WW/WL

  Font      font;                   // �������\���p�̃t�H���g
  FontMetrics fm;                   // ����FontMetrics

  // �R���X�g���N�^
  public ImageTiledCanvas(int w, int h, Viewer applet){
    parent = applet;
    zoomH = height = imgH = h;
    zoomW = width  = imgW = w;
    // �}�E�X�v���X�A�����[�X���̃C�x���g��ݒ�
    addMouseListener(new SetPoint());
    // �}�E�X�h���b�O���̃C�x���g��ݒ�
    addMouseMotionListener(new SetPoint_move());
    // �t�H���g�̍쐬
    font = new Font("Helvetica", Font.PLAIN, 12);
    fm = getFontMetrics(font);
  }

  // �Ȃ�ׂ鐔��ݒ肷��B
  // ���̃��\�b�h�̌Ăяo����łȂ��ƁA�摜��add�ł��Ȃ��B
  public void setTileType(int r, int c) {
    int max = r * c;

    // �������̎擾
    tileR = r;
    tileC = c;
    // �������ɉ����Ă��ꎩ�g�̑傫����ω�������
    canvasSize = new Dimension(width * tileC, height * tileR);
    setSize(canvasSize);
    // �������ɉ����ĕϐ��̊m��
    image           = new Image[max];
    patientID       = new String[max];
    patientName     = new String[max];
    patientAgeSex   = new String[max];
    studyID         = new String[max];
    studyDate       = new String[max];
    studyTime       = new String[max];
    imageNo         = new String[max];
    ww_wl           = new String[max];
    imageIndex = 0;
  }

  // �C���[�W���Ō�ɒǉ�����B
  // ���łɕ\���ł��邩�������\�����Ă���ꍇ�́A
  // �擪���폜���Ēǉ�����B
  public void addImage(Image argImage) {
    if(imageIndex < image.length) {
      image[imageIndex] = argImage;
      imageIndex++;
    } else {
      System.arraycopy(image, 1, image, 0, image.length -1);
      image[imageIndex -1] = argImage;
    }
    repaint();
  }

  // �C���[�W��擪�ɒǉ�����B
  // ���łɍő吔�\�����Ă���ꍇ�́A�Ō���폜����B
  public void addPreImage(Image argImage) {
    System.arraycopy(image, 0, image, 1, image.length -1);
    image[0] = argImage;
    if(imageIndex < image.length) imageIndex++;
    repaint();
  }

  // �C���[�W��index�ɃZ�b�g����B
  public void setImage(Image argImage, int index) {
    image[index] = argImage;
    imageIndex = index;
    repaint();
  }

  // ��������\�����邩���Ȃ������Z�b�g����
  public void setStudyInfo_flag(boolean flag){
    showStudyInfo = flag;
    repaint();
  }

  // ��������index�ɃZ�b�g����
  public void setStudyInfo(DicomData dicomData, int index) {
    String tag;

    // �����̏�񂪂Ȃ����Null����
    if(dicomData == null) {
      patientID[index] = null;
      patientName[index] = null;
      patientAgeSex[index] = null;
      studyID[index] = null;
      studyDate[index] = null;
      studyTime[index] = null;
      imageNo[index] = null;
      ww_wl[index] = null;

    // ������񂪑��݂���ꍇ�A���ꂼ��̃^�O�𒲂ׂĒl���Z�b�g
    }else {
      tag = "(0010,0020)";
      if(dicomData.isContain(tag))
        patientID[index] = dicomData.getAnalyzedValue(tag);
      else
        patientID[index] = null;

      tag = "(0010,0010)";
      if(dicomData.isContain(tag))
        patientName[index] = dicomData.getAnalyzedValue(tag);
      else
        patientName[index] = null;

      tag = "(0010,1010)";
      if(dicomData.isContain(tag)) {
        patientAgeSex[index] = dicomData.getAnalyzedValue(tag);
        tag = "(0010,0040)";
        if(dicomData.isContain(tag))
          patientAgeSex[index] += " " + dicomData.getAnalyzedValue(tag);
      }else {
        tag = "(0010,0040)";
        if(dicomData.isContain(tag))
          patientAgeSex[index] = dicomData.getAnalyzedValue(tag);
        else
          patientAgeSex[index] = null;
      }

      tag = "(0020,0010)";
      if(dicomData.isContain(tag))
        studyID[index] = dicomData.getAnalyzedValue(tag);
      else
        studyID[index] = null;

      tag = "(0008,0020)";
      if(dicomData.isContain(tag))
        studyDate[index] = dicomData.getAnalyzedValue(tag);
      else
        studyDate[index] = null;

      tag = "(0008,0030)";
      if(dicomData.isContain(tag))
        studyTime[index] = dicomData.getAnalyzedValue(tag);
      else
        studyTime[index] = null;

      tag = "(0020,0013)";
      if(dicomData.isContain(tag))
        imageNo[index] = dicomData.getAnalyzedValue(tag);
      else
        imageNo[index] = null;
    }
  }

  // �\���p��WW/WL�̒l���Z�b�g����
  public void setWW_WL(int ww, int wl, int index) {
    ww_wl[index] = "" + wl + "/" + ww;
  }

  // index�Ԃ̃C���[�W����������B
  public void changeImage(Image argImage, int index) {
    image[index] = argImage;
    repaint();
  }

  // ���ډ摜�ԍ����Z�b�g����
  public void setActiveNo(int index) {
    this.activeNo = index;
  }

  // �ŏ��ɕ\������摜�̉摜�ԍ�
  public void setStartNo(int start_imgNo) {
    start = start_imgNo;
  }

  // �L�����o�X�T�C�Y��ύX����
  public void setCanvasSize(int w, int h) {
    canvasSize = new Dimension(w, h);
    setSize(canvasSize);
    repaint();
  }

  public void paint(Graphics g) {
    update(g);
  }

  public void update(Graphics g)
  {
    // �}�E�X�������ė������������C���[�W���ړ�������B
    // �A���A�͂������ȏ㓮���Ȃ��悤�ɂ���
    if(px+zoomW > imgW) px = imgW - zoomW;
    if(py+zoomH > imgH) py = imgH - zoomH;
    if(px < 0) px = 0;
    if(py < 0) py = 0;

    // �I�t�X�N���[���̏���(�摜�ꖇ���ALoupe�p)
    Graphics  offg, loupeg;
    Image     offImage, loupeImage;
    offImage = createImage(width, height);
    offg = offImage.getGraphics();
    loupeImage = createImage(200, 200);
    loupeg = loupeImage.getGraphics();

    int imgNo = 0;
    int tmp_x, tmp_y;

    // �C���[�W��`��
    for (int j=0; j < tileR; j++) {
      if(imgNo > imageIndex) break;
      for (int i=0; i < tileC; i++) {
        if(imgNo > imageIndex) break;

        // �摜��`�����W�����߂�
        tmp_x = width * i;
        tmp_y = height * j;

        // �C���[�W��`��
        // �܂��A�摜1�����I�t�X�N���[���ɕ`��
        // �摜�����݂��Ȃ��ꍇ
        if(image[imgNo] == null){
          // �����h��Ԃ�
          offg.setColor(Color.black);
          offg.fillRect(0, 0, width, height);
        // �摜�����݂���ꍇ
        }else {
          // ���摜��(px,py)���W���畝zoomW�A����zoomH���̃C���[�W���擾���Ă��āA
          // (0,0)���W����A�I�t�X�N���[�������ς��ɉ摜��`��
          offg.drawImage(image[imgNo], 0, 0, width, height, px, py, px+zoomW, py+zoomH, this);
        }
        // ���������I�t�X�N���[����(tmp_x,tmp_y)���W�ɕ`��
        g.drawImage(offImage, tmp_x, tmp_y, this);

        // ��������`��
        if(showStudyInfo) {
          int x, y;           // ���������������W
          int maxlength = 0;  // ������̒���

          // �������̓O���[���ŕ`��
          g.setColor(Color.green);
          g.setFont(font);
          // ����
          x = tmp_x +2;
          y = tmp_y + fm.getAscent() +2;
          if(patientID[imgNo] != null) {
            g.drawString(patientID[imgNo], x, y);
            y += fm.getHeight();
          }
          if(patientName[imgNo] != null) {
            g.drawString(patientName[imgNo], x, y);
            y += fm.getHeight();
          }
          if(patientAgeSex[imgNo] != null) {
            g.drawString(patientAgeSex[imgNo], x, y);
          }
          // ����
          y = tmp_y + height - fm.getDescent() -2;
          if(ww_wl[imgNo] != null) {
            g.drawString(ww_wl[imgNo], x, y);
          }
          // �E��
          // ������̒����������Ƃ��������̂�T��
          if(maxlength < fm.stringWidth(studyID[imgNo])) maxlength = fm.stringWidth(studyID[imgNo]);
          if(maxlength < fm.stringWidth(studyDate[imgNo])) maxlength = fm.stringWidth(studyDate[imgNo]);
          if(maxlength < fm.stringWidth(studyTime[imgNo])) maxlength = fm.stringWidth(studyTime[imgNo]);
          x = tmp_x + width - maxlength -2;
          y = tmp_y + fm.getAscent() +2;
          if(studyID[imgNo] != null) {
            g.drawString(studyID[imgNo], x, y);
            y += fm.getHeight();
          }
          if(studyDate[imgNo] != null) {
            g.drawString(studyDate[imgNo], x, y);
            y += fm.getHeight();
          }
          if(studyTime[imgNo] != null) {
            g.drawString(studyTime[imgNo], x, y);
          }
          // �E��
          x = tmp_x + width - fm.stringWidth(imageNo[imgNo]) -2;
          y = tmp_y + height - fm.getDescent() -2;
          if(imageNo[imgNo] != null) {
            g.drawString(imageNo[imgNo], x, y);
          }
        }

        // �C���[�W�̗֊s��`��
        // �I���摜���ω������ꍇ
        if(changeActive) {
          // �}�E�X�̃N���b�N�������W�����`�悷��摜��̏ꍇ
          if((tmp_x <= x1) && (x1 < tmp_x+width) && (tmp_y <= y1) && (y1 < tmp_y+height))  {
            // �摜�����݂��Ȃ��ꏊ�̃N���b�N�̏ꍇ�͔��g�i�I���摜�ω��Ȃ��j
            if(image[imgNo] == null){
              g.setColor(Color.white);
              g.drawRect(tmp_x, tmp_y, width -1, height -1);
            // �摜�����݂���ꍇ�́A�I���摜�����̉摜�ɂ��āA���F�g������
            }else {
              // activeNo�̕ύX
              activeNo = imgNo;
              parent.changeActive(activeNo + start);
              g.setColor(Color.yellow);
              g.drawRect(tmp_x, tmp_y, width -1, height -1);
            }
          // �}�E�X�̃N���b�N�����̉摜��łȂ��ꍇ�A���g������
          }else {
            g.setColor(Color.white);
            g.drawRect(tmp_x, tmp_y, width -1, height -1);
          }

        // �I���摜���ω����Ȃ��ꍇ
        }else {
          // �I���摜�Ȃ物�F�g
          if(activeNo == imgNo) {
            g.setColor(Color.yellow);
            g.drawRect(tmp_x, tmp_y, width -1, height -1);
          // �I���摜�łȂ��Ȃ�΁A���g
          }else {
            g.setColor(Color.white);
            g.drawRect(tmp_x, tmp_y, width -1, height -1);
          }
        }
        // ���[�y�����
        if(loupe && mouseDown) {
          // �N���b�N�������W�����`�悵�Ă���摜��̏ꍇ���[�y�����
          if((tmp_x <= x1) && (x1 < tmp_x+width) && (tmp_y <= y1) && (y1 < tmp_y+height))  {
            // �N���b�N�������W�̑O��50�s�N�Z�������v�c��100�s�N�Z���擾���A
            // �c��200�s�N�Z���̃I�t�X�N���[���ɕ`�悷��i�܂�A2�{�ɕ\�������j
            loupeg.drawImage(offImage, 0, 0, 200, 200, x1-tmp_x-50, y1-tmp_y-50, x1-tmp_x+50, y1-tmp_y+50,this);
          }
        }
        imgNo++;
      }
    } // for���̏I���

    changeActive = false;

    // ���[�y��`��
    if(loupe && mouseDown) {
      // �N���b�N�������W�̐^���ɂȂ�悤�Ƀ��[�y�I�t�X�N���[����`��
      g.drawImage(loupeImage, x1-100, y1-100, this);
      // ���[�y�摜�̎���ɔ��g��`��
      g.setColor(Color.white);
      g.drawRect(x1-100, y1-100, 200, 200);
    }
  }

  // �Y�[������ύX���郁�\�b�h
  public void changeZoom(double zoom){
    this.zoom = zoom;
    int zoomW_old = zoomW;
    int zoomH_old = zoomH;
    int px_old = px;
    int py_old = py;

    // �Y�[���̐ݒ�
    zoomW = (int)(width * zoom);
    zoomH = (int)(height * zoom);

    // �摜�̒��S��\������悤�Ɋg��k������悤�ɂ���
    px = (int)((zoomW_old - zoomW) >> 1) + px_old;
    py = (int)((zoomH_old - zoomH) >> 1) + py_old;

    repaint();
  }

  // CanvasSize��ύX���郁�\�b�h
  public void changeCanvasSize(double size) {
    width = (int)(imgW * size);
    height = (int)(imgH * size);
    canvasSize.setSize(width * tileC, height * tileR);
    setSize(canvasSize);
  }

  // ���Ă��鎋�_�i���W�j��ύX����
  public void setPxPy(int x, int y) {
    this.px = x;
    this.py = y;
  }

  // ���Ă��鎋�_�i���W�j�𓾂�
  public int getPx() {
    return px;
  }
  public int getPy() {
    return py;
  }

  // ���[�y��`�悷�邩�ǂ����Z�b�g����
  public void setLoupeState(boolean state) {
    this.loupe = state;
  }

  // �摜���}�E�X�ňړ����邩�ǂ����Z�b�g����
  public void setMoveState(boolean state) {
    this.move = state;
  }

  // �摜���}�E�X�Ŋg��k�����邩�ǂ����Z�b�g����
  public void setZoomState(boolean state) {
    this.zoom_flag = state;
  }

  // �}�E�X�J�[�\���̌`��ύX���郁�\�b�h
  private void changeCursor(){
    if(hand)
    	this.setCursor(new Cursor(Cursor.MOVE_CURSOR));
    else
    	this.setCursor(new Cursor(Cursor.DEFAULT_CURSOR));
    hand = !hand;
  }

  // �}�E�X���샊�X�i�[
  class SetPoint extends MouseAdapter {

    // �}�E�X��Canvas���ɓ������Ƃ�
    public void mouseEntered(MouseEvent e) {
      if(loupe) {
    	  setCursor(new Cursor(Cursor.CROSSHAIR_CURSOR));
      }else if(move) {
    	  setCursor(new Cursor(Cursor.HAND_CURSOR));
      }
    }

    // �}�E�X��Canvas�O�ɂł��Ƃ�
    public void mouseExited(MouseEvent e) {
    	setCursor(new Cursor(Cursor.DEFAULT_CURSOR));
    }

    // �}�E�X���������Ƃ��̏���
    public void mousePressed(MouseEvent e) {
      x0 = x1 = e.getX();
      y0 = y1 = e.getY();
      if(loupe) {
        mouseDown = true;
      }else if(!move) {
        changeCursor(); // �J�[�\���̌`��ύX
      }
      changeActive = true;
      repaint();
    }

    // �}�E�X�𗣂����Ƃ��̏���
    public void mouseReleased(MouseEvent e) {
      x2 = e.getX();
      y2 = e.getY();
      if(loupe) {
        mouseDown = false;
        repaint();
      }else if(move) {
        px = px + x1 - x2;
        py = py + y1 - y2;
        repaint();
      }else if(zoom_flag) {
        changeCursor(); // �J�[�\���̌`��߂�
        parent.drag_changeZoom(y2-y1);
      }else {
        changeCursor(); // �J�[�\���̌`��߂�
        parent.dragDone_changeWwWl(x2-x1, x2-x0, y2-y1, y2-y0);
      }
    }
  }

  class SetPoint_move extends MouseMotionAdapter {

    // �}�E�X���h���b�O���ꂽ�Ƃ�
    public void mouseDragged(MouseEvent e) {
      x2 = e.getX();
      y2 = e.getY();
      if(move) {
        px = px + x1 - x2;
        py = py + y1 - y2;
        x1 = x2;
        y1 = y2;
        repaint();

      // Zoom
      }else if(zoom_flag) {
        parent.drag_changeZoom(y2-y1);
        x1 = x2;
        y1 = y2;

      // WW/WL
      }else if(!loupe) {
        parent.drag_changeWwWl(x2-x1, y2-y1);
        x1 = x2;
        y1 = y2;
/*
      // Loupe
      }else {
        x1 = x2;
        y1 = y2;
        repaint();
*/
      }
    }

    public void mouseMoved(MouseEvent e) {
    }
  }
}

