/*
 * MyLabel.java
 *
 * �C�x���g���擾�ł��郉�x��
 *
 * @see http://java-house.etl.go.jp/ml/archive/j-h-b/003638.html#body
 *
 * Modified by Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 */

package dicomviewer;

import java.applet.*;
import java.awt.*;
import java.awt.event.*;
import java.net.*;

public class MyLabel extends Canvas {
    public static final int LEFT   = Label.LEFT;
    public static final int CENTER = Label.CENTER;
    public static final int RIGHT  = Label.RIGHT;

    private String label;
    private int alignment;
    private static final int hgap = 5;
    private static final int vgap = 3;

    // Viewer��AppletContext���i�[����
    AppletContext appletContext;

    // �����̐F(default: black)
    Color color = Color.black;

    public MyLabel() {
	    this("", LEFT);
    }

    public MyLabel(String label) {
	    this(label, LEFT);
    }

    public MyLabel(String label, int alignment) {
	    this.label = label;
	    this.alignment = alignment;

      // �}�E�X�C�x���g���擾����悤����
      this.addMouseListener(new MyMouseListener());
    }

    public void setText(String text) {
	    label = text;
	    repaint();
    }

    public String getText() {
	    return label;
    }

    public void setAlignment(int alignment) {
	    this.alignment = alignment;
	    repaint();
    }

    public int getAlignment() {
	    return alignment;
    }

    public Dimension preferredSize() {
	    Font f = getFont();
	    int height = getFont().getSize();
	    int width = getFontMetrics(getFont()).stringWidth(label);
	    return new Dimension(width + hgap * 2, height + vgap * 2);
    }

    public Dimension minimumSize() {
	    Font f = getFont();
	    int height = getFont().getSize();
	    int width = getFontMetrics(getFont()).stringWidth(label);
	    return new Dimension(width, height);
    }

    public void paint(Graphics g) {
	    Dimension area = size();
	    Font f = g.getFont();
	    int w = g.getFontMetrics().stringWidth(label);
	    int h = f.getSize();
	    int x;
	    switch (alignment) {
	      // case LEFT:
	      default:
	        x = area.width - w > hgap ? hgap : 0;
	        break;
	      case CENTER:
	        x = (area.width - w) / 2;
	        break;
	      case RIGHT:
	        x = area.width - w - (area.width - w > hgap ? hgap : 0);
	        break;
	    }
	    int y = (area.height + h) / 2 - g.getFontMetrics(f).getMaxDescent();

      // �����̐F�����肷��
      g.setColor(color);

	    g.drawString(label, x, y);
    }

    // AppletContext���󂯎��
    public void setAppletContext(AppletContext appletContext) {
      this.appletContext = appletContext;
    }

  // �}�E�X���샊�X�i�[
  class MyMouseListener extends MouseAdapter {

    // �}�E�X��Canvas���ɓ������Ƃ�
    public void mouseEntered(MouseEvent e) {
      // �J�[�\���̌`����ɂ���
      setCursor(new Cursor(Cursor.HAND_CURSOR));
      // �����̐F�������
      color = Color.blue;
      repaint();
    }

    // �}�E�X��Canvas�O�ɂł��Ƃ�
    public void mouseExited(MouseEvent e) {
      // �J�[�\���̌`�����ɖ߂�
    	setCursor(new Cursor(Cursor.DEFAULT_CURSOR));
      // �����̐F����������
      color = Color.black;
      repaint();
    }

    // �}�E�X���������Ƃ��̏���
    public void mousePressed(MouseEvent e) {
      try {
        URL url = new URL("http://mars.elcom.nitech.ac.jp/dicom/index-e.html");

        // DICOM Viewer (Java Applet)�@�̃y�[�W��V�����E�B���h�E�ɕ\������
        appletContext.showDocument(url, "_blank");
      }
      catch(Exception exception){
    	  System.out.println("Exception: " + exception.getMessage() );
      }
    }

    // �}�E�X�𗣂����Ƃ��̏���
    public void mouseReleased(MouseEvent e) {
    }

  }

}
