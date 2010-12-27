/*
 * ImageData.java - �摜�̏���ێ����Ă���I�u�W�F�N�g
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
import java.awt.image.*;

public class ImageData {

  int     debug_level = 3;

  boolean	blackANDwhite = true;				// �����摜�̎�true
  boolean rgbMode = false;            // Dicom RGB -> true
  boolean	inv = false;								// �l�K�|�W���]
  int			pixel[];										// �摜�̊e�s�N�Z��
  int			orgPixel[];									// �I���W�i���̉�f�l
  int     pixLength;                  // �I���W�i���s�N�Z���̒���
  int			pixelMin;										// �摜�ŏ��l
  int			pixelMax;										// �摜�ő�l
  int			width;											// �C���[�W��
  int			height;											// �C���[�W����
  int			histogram[] = new int[256];	// �q�X�g�O����
  int			histMax;										// �q�X�g�O�����̍ő吔
  int			ww,wl;          						// WW/WL

  // �������̏��
  int			defaultPixel[];							// �������̉�f�l
  int			defaultWidth;								// �������̃C���[�W��
  int			defaultHeight;							// �������̃C���[�W����
  int     defaultWW, defaultWL;       // ��������WW/WL

  Image   image;
  Toolkit toolkit;
  MemoryImageSource source;

  // DicomData����e�ϐ��ɒl���Z�b�g����
  public void setData(DicomData dicomData) {
    // �f�o�b�O�p
    if (debug_level > 3) System.out.println("Now set width and height....");
    // DicomData����C���[�W�̕��ƍ��������߂�
    // String�^��int�^�ɃL���X�g���Ă���
    width		= Integer.parseInt(dicomData.getAnalyzedValue("(0028,0011)"));
    height	= Integer.parseInt(dicomData.getAnalyzedValue("(0028,0010)"));
    defaultWidth = width;
    defaultHeight = height;
    // �f�o�b�O�p
    if (debug_level > 3) System.out.println("Image width  : " + width);
    if (debug_level > 3) System.out.println("Image heigth : " + height);

    // �f�o�b�O�p
    if (debug_level > 3) System.out.print("Now set byte[] to int[]....");
    // DicomData�̉�f�l��byte[]��int[]�ɕϊ�����
    orgPixel        = new int[width * height];
    pixLength       = orgPixel.length;
    pixel           = new int[pixLength];
    defaultPixel    = new int[pixLength];
    byte[] tmpValue = new byte[dicomData.getValue("(7fe0,0010)").length];
    System.arraycopy(dicomData.getValue("(7fe0,0010)"), 0, tmpValue, 0, tmpValue.length);
    // �f�o�b�O�p
    if (debug_level > 3) System.out.println(" OK!");

    // ���݃T�|�[�g���Ă���̂�,
    // (0028,0004)Photometric Interpretation ��RGB
    if(dicomData.isContain("(0028,0004)") &&
        dicomData.getAnalyzedValue("(0028,0004)").trim().equals("RGB")) {
      rgbMode = true;
      for(int i=0; i<pixLength; i++){
        orgPixel[i] = ((255 << 24) |
                       (0xff & tmpValue[3*i]) << 16 |
                       (0xff & tmpValue[(3*i)+1]) << 8 |
                       (0xff & tmpValue[(3*i)+2]) );
      }
    // �������́AMONOCHROME2�̂Ƃ��B
    } else {
      // ���蓖�ăr�b�g��16bit�̎�
      if(dicomData.getAnalyzedValue("(0028,0100)").trim().equals("16")) {
        short shValue = 0;
        for(int i=0; i<pixLength; i++){
          shValue = (short)((0xff & tmpValue[(2*i)+1]) << 8 |
                            (0xff & tmpValue[2*i]) );
          orgPixel[i] = (int)shValue;
        }
      // ���蓖�ăr�b�g��8bit�̎�
      }else {
        for(int i=0; i<pixLength; i++)
          orgPixel[i] = (int)(0xff & tmpValue[i]);
      }
      // �i�[�r�b�g�A���ʃr�b�g�̕␳
      int bit_stored = Integer.parseInt(dicomData.getAnalyzedValue("(0028,0101)"));
      int bit_hight  = Integer.parseInt(dicomData.getAnalyzedValue("(0028,0102)"));
      int bit_gap    = bit_hight - bit_stored +1;
      if(bit_gap > 0) {
        for(int i=0; i<pixLength; i++) orgPixel[i] = (orgPixel[i] >> bit_gap);
      }
    }

    // ������Ԃ̕ۑ�
    System.arraycopy(orgPixel, 0, defaultPixel, 0, pixLength);
    
    tmpValue = null;

    // �f�o�b�O�p
    if (debug_level > 3) System.out.print("Now set pixelMin and pixelMax....");
    // �摜�̍ő�l�ƍŏ��l�����߂�B
    pixelMin = 0;
    pixelMax = 0;
    for(int i=0; i<pixLength; i++){
      if(pixelMin > orgPixel[i])
      	pixelMin = orgPixel[i];
      if(pixelMax < orgPixel[i])
      	pixelMax = orgPixel[i];
    }
    // �f�o�b�O�p
    if (debug_level > 3) System.out.println(" OK!");

    // �f�o�b�O�p
    if (debug_level > 3) System.out.print("Now set WW/WL....");
    // �f�t�H���gWW�^WL�̐ݒ�
    // DICOM�f�[�^�̒���WW/WL������Ƃ��́A���̒l���g���B
    if(dicomData.isContain("(0028,1051)")) {
      try {
        ww = Integer.parseInt(dicomData.getAnalyzedValue("(0028,1051)").replace('+', ' ').trim());
      }catch(NumberFormatException e) {
        // ���܂��l�����o���Ȃ��Ƃ��́A�v�Z�ŋ��߂�B
        ww = pixelMax - pixelMin;
      }
    } else {
      ww = pixelMax - pixelMin;
    }
    if(dicomData.isContain("(0028,1050)")) {
      try {
        wl = Integer.parseInt(dicomData.getAnalyzedValue("(0028,1050)").replace('+', ' ').trim());
      }catch(NumberFormatException e) {
        // ���܂��l�����o���Ȃ��Ƃ��́A�v�Z�ŋ��߂�B
        wl = (ww >> 1) + pixelMin;
      }
    } else {
      wl = (ww >> 1) + pixelMin;
    }
    defaultWW = ww;
    defaultWL = wl;
    // �f�o�b�O�p
    if (debug_level > 3) System.out.println(" OK!");
    if (debug_level > 3) System.out.println("WW :" + ww + " WL :" + wl);

    // ��̃C���[�W������Ă����B
    for(int i=0; i < pixel.length; i++) pixel[i] = 0xff000000;
    source = new MemoryImageSource(width, height, pixel, 0, width);
    source.setAnimated(true);
    toolkit = Toolkit.getDefaultToolkit();
    image = toolkit.createImage(source);
  }

  // WW/WL�̌v�Z,�J���[�̐ݒ�,�l�K�|�W���]
  private void contrast() {

    // �R���g���X�g�ω�����уJ���[�ω��B
    if(!rgbMode){
      //int tmp = (int)(ww * 0.5);
      int tmp = ww >> 1;
      int contrastMin = wl - tmp;
      int contrastMax = wl + tmp;

      if(blackANDwhite) {
    	  // �����摜
        double invWW = 255d / (double)ww;
        int pix;

        for(int i=0; i<pixLength; i++){
          pix = orgPixel[i];
          if(pix <= contrastMin) pix = 0;
          else if(pix >= contrastMax) pix = 255;
          else
            // ���ꂪ��������
            // pix = (int)Math.round((255*(pix - contrastMin))/ww);
        	  pix = (int)((pix - contrastMin) * invWW);
          pixel[i] = (0xff000000 | (pix << 16) | (pix << 8) | pix);
          // �l�K�|�W���]
          if(inv) pixel[i] = ((~pixel[i] & 0x00ffffff) | (pixel[i] & 0xff000000));
        }
      }else {
        // �[���J���[
        float invWW = 0.67f / (float)ww;
        int pminWW = ww + contrastMin;
        int pix;
        float hue;

        for(int i=0; i<pixLength; i++){
          pix = orgPixel[i];
          if(pix <= contrastMin) hue = 0.67f;     // ��(�F��:4/6)����
          else if(pix >= contrastMax) hue = 0.0f; // �Ԃ܂�
          else
            // ���ꂪ��������
            // hue = (1.0f - (pix - contrastMin)/ww) * 0.67f;
            hue = (float)(pminWW - pix) * invWW;
          pixel[i] = hue2RGB(hue);
          // �l�K�|�W���]
          if(inv) pixel[i] = ((~pixel[i] & 0x00ffffff) | (pixel[i] & 0xff000000));
        }
      }
    }else {
      // Dicom RGB Mode�̂Ƃ�
      System.arraycopy(orgPixel, 0, pixel, 0, pixel.length);
    }
  }

  /**
   * HSB(�ʓx�Ɩ��x��1.0�Ƃ���)����RGB�J���[����郁�\�b�h
   *
   * HSB
   *      0     1/6     2/6     3/6     4/6     5/6     1
   * �F�� |------|-------|-------|-------|-------|------|
   *      ��     ��      ��    �V�A��    ��   �}�[���^
   *      0                                             1
   * �ʓx |---------------------------------------------|
   *      �O���[    �W����          �������ȐF
   *      0                                             1
   * ���x |---------------------------------------------|
   *      ��        �Â���          �����邢
   *
   * @param hue - �F��
   * @see   java.awt.Color#HSBtoRGB(float, float, float)
   */
  private int hue2RGB(float hue) {
	  int r = 0, g = 0, b = 0;

    float h = (hue - (float)Math.floor(hue)) * 6.0f;
    float f = h - (float)java.lang.Math.floor(h);
    float q = 1.0f - f;

    switch ((int) h) {
	    case 0:
        r = 255;
		    g = (int) (f * 255.0f + 0.5f);
		    b = 0;
		    break;
	    case 1:
		    r = (int) (q * 255.0f + 0.5f);
		    g = 255;
		    b = 0;
		    break;
	    case 2:
		    r = 0;
		    g = 255;
		    b = (int) (f * 255.0f + 0.5f);
		    break;
	    case 3:
		    r = 0;
		    g = (int) (q * 255.0f + 0.5f);
		    b = 255;
		    break;
	    case 4:
		    r = (int) (f * 255.0f + 0.5f);
		    g = 0;
		    b = 255;
		    break;
	    case 5:
		    r = 255;
		    g = 0;
		    b = (int) (q * 255.0f + 0.5f);
		    break;
    }
	  return 0xff000000 | (r << 16) | (g << 8) | (b << 0);
  }

  private Image getImage() {
    // �s�N�Z���l��ύX���āAImage��Ԃ��B
    source.newPixels();
    return image;
/*
    // �C���[�W�����Ԃ��B
    Toolkit toolkit = Toolkit.getDefaultToolkit();
    return toolkit.createImage(new MemoryImageSource(width, height, pixel, 0, width));
*/
  }

  // ���݂̃f�t�H���g��Ԃ̃C���[�W��Ԃ�
  public Image getDefaultImage() {
    contrast();
    return getImage();
  }

  // ����,�J���[�̏�Ԃ�Ԃ�(�J���[�̂Ƃ�true)
  public boolean color() {
    return rgbMode;
  }

  // WW/WL���C���[�W�ɔ��f������
  public Image wwANDwl(int argWW, int argWL) {
    ww = argWW;
    wl = argWL;
    contrast();
    return getImage();
  }

  // WW/WL�̒l���Z�b�g����
  public void setWwWl(int argWW, int argWL) {
    ww = argWW;
    wl = argWL;
  }

  // Default����̍��𓾂āAWW/WL���C���[�W�ɔ��f������
  public Image getImageWWWL2Current(int argWW, int argWL) {
    ww = defaultWW + argWW;
    wl = defaultWL + argWL;
    contrast();
    return getImage();
  }

  // WW�^WL��Ԃ�
  public int getWW() {
    return ww;
  }
  public int getWL() {
    return wl;
  }

  // �f�t�H���g��WW�^WL��Ԃ�
  public int getDefaultWW() {
    return defaultWW;
  }
  public int getDefaultWL() {
    return defaultWL;
  }

  // �C���[�W��,������Ԃ�
  public int getWidth() {
    return width;
  }
  public int getHeight() {
    return height;
  }

  // Pixel�l�̍ő�l�A�ŏ��l��Ԃ�
  public int getPixelMin() {
    return pixelMin;
  }
  public int getPixelMax() {
    return pixelMax;
  }

  // �l�K�|�W���]
  public void inverse() {
    inv = !inv;
  }
  public void setInverse(boolean flag) {
    inv = flag;
  }
/*
  public Image inverse() {
    inv = !inv;
    contrast();
    return getImage();
  }
*/

  // �[���J���[��
  public void setColor(boolean flag) {
    blackANDwhite = !flag;
  }
  public void changeColor() {
    blackANDwhite = !blackANDwhite;
  }

  // ������Ԃɖ߂��B(WW/WL�ȊO)
  public void setDefaultPixel() {
    System.arraycopy(defaultPixel, 0, orgPixel, 0, pixLength);
    width =  defaultWidth;
    height = defaultHeight;

    blackANDwhite = true;				// �����摜�̎�true
    inv = false;								// �l�K�|�W���]
  }

  // 90�x�摜��]
  public void rotateL() {
    int[] tmpPixel = new int[orgPixel.length];
    int temp;

    System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
    for(int i=0; i < height; i++) {
      for(int j=0; j < width; j++) {
        orgPixel[(width - j -1) * height + i] = tmpPixel[i * width + j];
      }
    }
    temp = width;
    width = height;
    height = temp;
  }
  public void rotateR() {
    int[] tmpPixel = new int[orgPixel.length];
    int temp;

    System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
    for(int i=0; i < height; i++) {
      for(int j=0; j < width; j++) {
        orgPixel[j * height + (height - i -1)] = tmpPixel[i * width + j];
      }
    }
    temp = width;
    width = height;
    height = temp;
  }

  // ���E�摜���]
  public void flipLR() {
    int[] tmpPixel = new int[orgPixel.length];
    int temp1, temp2;

    System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
    for(int i=0; i < height; i++) {
      temp1 = i * width;
      temp2 = temp1 + width -1;
      for(int j=0; j < width; j++) {
        orgPixel[temp2 - j] = tmpPixel[temp1 + j];
      }
    }
  }

  // �㉺�摜���]
  public void flipUD() {
    int[] tmpPixel = new int[orgPixel.length];
    int temp1, temp2;

    System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
    for(int i=0; i < height; i++) {
      temp1 = (height - i -1) * width;
      temp2 = i * width;
      for(int j=0; j < width; j++) {
        orgPixel[temp1 + j] = tmpPixel[temp2 + j];
      }
    }
  }

  // �q�X�g�O�����̍쐬
  private void makeHistogram()
  {
    // ������
    for(int i=0; i<256; i++)
    	histogram[i] = 0;
    histMax = 0;

    // �q�X�g�O�����̍쐬
    for(int i=0; i<pixel.length; i++){
      int data = (0x000000ff & pixel[i]);
      histogram[data]++;
    }

    // �q�X�g�O�����̍ő吔�����߂�
    for(int i=0; i<256; i++){
      if(histMax < histogram[i])
      	histMax = histogram[i];
    }
  }

  // �q�X�g�O����,�q�X�g�O�����̍ő�l��Ԃ�
  public int[] getHistogram()
  {
    return histogram;
  }

  public int getHistMax()
  {
    return histMax;
  }

  // �q�X�g�O�����̕␳������
  public Image reviseHistogram()
  {
    calcRevisedHistogram();
    return getImage();
  }

  // �q�X�g�O�����̕␳���v�Z����
  private void calcRevisedHistogram(){
    double[]	aFreq 				= new double[256];        // �ݐϓx��
    int				sum   				= 0;                      // �q�X�g�O�����̘a
    double		allPixelsInv; 				                  // 1./�S��f��
    double		vmin;                 				          // �ݐϓx���̍ŏ��l
    double		vminInv;
    int[]			fixed 				= new int[256];           // �␳���ꂽ�q�X�g�O����

    // �q�X�g�O���������
    makeHistogram();

    for(int i=0; i<pixel.length; i++){
      pixel[i] = (0x000000ff & pixel[i]); 						// �Ƃ肠�������������l����
    }

    // �ݐϓx���̌v�Z
    allPixelsInv = 1. / (height * width);
    for(int i=0; i<256; i++){
      sum += histogram[i];
      aFreq[i] = (double)sum * allPixelsInv;
    }

    // �q�X�g�O�����̕␳
    vmin = aFreq[0];
    vminInv = (double)255. / (1.- vmin);
    for(int i=0; i<256; i++){
      fixed[i] = (int)((aFreq[i] - vmin) * vminInv);
    }
    for(int i=0; i<pixel.length; i++){
      pixel[i] = ((255 << 24)
      				  | (fixed[pixel[i]] << 16)
                | (fixed[pixel[i]] << 8)
                | fixed[pixel[i]]);
    }
  }
}
