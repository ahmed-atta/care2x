/*
 * InfoPanel.java -
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */
package src;

import java.awt.*;

public class InfoPanel extends Panel {

    DicomData dicomData;
    GridBagLayout layout = new GridBagLayout();
    GridBagConstraints c = new GridBagConstraints();
    Label label1 = new Label("Patient Info.");
    Label id_L = new Label("ID");    // (0010,0020)
    Label id_F = new Label();        //
    Label name_L = new Label("Name");  // (0010,0010)
    Label name_F = new Label();
    Label age_L = new Label("Age");   // (0010,1010)
    Label age_F = new Label();
    Label sex_L = new Label("Sex");   // (0010,0040)
    Label sex_F = new Label();
    Label label2 = new Label("Study Info.");
    Label sid_L = new Label("ID");    // (0020,0010)
    Label sid_F = new Label();
    Label date_L = new Label("Date");  // (0008,0020)
    Label date_F = new Label();
    Label time_L = new Label("Time");  // (0008,0030)
    Label time_F = new Label();

    public InfoPanel() {
        super();
        try {
            jbInit();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void jbInit() throws Exception {
        this.setLayout(layout);
//    c.anchor = GridBagConstraints.WEST;
        c.fill = GridBagConstraints.HORIZONTAL;
        c.weightx = 1;
        c.weighty = 0;


        c.gridx = 0;
        c.gridy = 0;
        c.gridwidth = 2;
        layout.setConstraints(label1, c);
        this.add(label1);


        c.gridx = 0;
        c.gridy = 1;
        c.gridwidth = 2;
        layout.setConstraints(id_F, c);
        this.add(id_F);


        c.gridx = 0;
        c.gridy = 2;
        c.gridwidth = 2;
        layout.setConstraints(name_F, c);
        this.add(name_F);

        c.gridx = 0;
        c.gridy = 3;
        c.gridwidth = 1;
        layout.setConstraints(age_F, c);
        this.add(age_F);

        c.gridx = 1;
        c.gridy = 3;
        c.gridwidth = 1;
        layout.setConstraints(sex_F, c);
        this.add(sex_F);

        c.gridx = 0;
        c.gridy = 5;
        c.gridwidth = 2;
        layout.setConstraints(label2, c);
        this.add(label2);


        c.gridx = 0;
        c.gridy = 6;
        c.gridwidth = 2;
        layout.setConstraints(sid_F, c);
        this.add(sid_F);


        c.gridx = 0;
        c.gridy = 7;
        c.gridwidth = 2;
        layout.setConstraints(date_F, c);
        this.add(date_F);


        c.gridx = 0;
        c.gridy = 8;
        c.gridwidth = 2;
        layout.setConstraints(time_F, c);
        this.add(time_F);
    }

    public void setDicomData(DicomData dicomData) {
        this.dicomData = dicomData;
        setLabel(id_F, "(0010,0020)");
        setLabel(name_F, "(0010,0010)");
        setLabel(age_F, "(0010,1010)");
        setLabel(sex_F, "(0010,0040)");
        setLabel(sid_F, "(0020,0010)");
        setLabel(date_F, "(0008,0020)");
        setLabel(time_F, "(0008,0030)");
    }

    private void setLabel(Label label, String tag) {

        if (dicomData.isContain(tag)) {
            label.setText(dicomData.getAnalyzedValue(tag));
            label.setEnabled(true);
        } else {
            label.setText("none");
            label.setEnabled(false);
        }
    }
}
