<?php

$words = array(

/* ArticleMgr */

    // titles
    'Article Manager'         => '���������� ��������',
    'Article Manager :: Add'  => '���������� �������� :: ����������',
    'Article Manager :: Edit' => '���������� �������� :: ��������������',
    'Article Browser'         => '�������� ������',

    // list
    'New Article'    => '�������� ������',
    'Article filter' => '������ ������',
    'Article type'   => '��� ������',
    'Article list'   => '������ ������',
    'Article Name'   => '�������� ������',
    'Date created'   => '���� ��������',
    'Start Date'     => '���� ������',
    'Expiry Date'    => '���� ���������',
    'Modif. By'      => '�������������',
    'article'        => '������',

    // flow
    'approve'      => '���������',       // actions
    'publish'      => '������������',
    'archive'      => '������������',
    'For Approval' => '��� �����������', // statuses
    'Being Edited' => '�������������',
    'Approved'     => '����������',
    'Published'    => '������������',
    'Archived'     => '������������',
    'Deleted'      => '�������',

    // add / edit
    'Content'               => '����������',
    'Editing options'       => '���������',
    'Author'                => '�����',
    'No other text entered' => '����� �� ������',
    'Flesch score'          => 'Flesch Score', // ???
    'No expire'             => '�� ����������',

    // messages
    'Article successfully added'                             => '������ ������� ���������',
    'Article successfully updated'                           => '������ ������� ���������������',
    'Article status has been successfully changed'           => '������ ������ ������� ������',
    'The selected article(s) have successfully been deleted' => '��������� ������ ������� �������',


/* ArticleViewMgr */

    // view / summary
    'Current Category'      => '������� ���������',
    'No lead article found' => '�������� ������ �� �������',
    'No articles found'     => '������ �� �������',
    'No documents found'    => '���������� �� �������',
    'Related Articles'      => '������ ������',
    'Related Documents'     => '������������� ���������',
    'contributed by'        => '�����', // ������� / ������
    'full story'            => '�����������', // ����. - Continue reading


/* DocumentMgr */

    // titles
    'Document Manager' => '���������� �������',

    // actions
    'New Asset'     => '����� ����',
    'Editing Asset' => '�������������� �����',

    // list
    'Document filter'     => '������ ����������',
    'select a category'   => '�������� ���������',
    'Document list'       => '������ ������',
    'showing results for' => '����������', //
    'Asset Name'          => '�������� �����',
    'Size'                => '������',
    'Type'                => '���',
    'Date Added'          => '���������',
    'Owner'               => '��������',
    'Download'            => '�������',
    'Document type'       => '��� ���������',
    'asset'               => '����',
    'choose'              => '�������',
    'whole DB'            => '��� ���������',
    'this category'       => '������� ���������',
    'close'               => '�������',
    'preview'             => '��������', // ���������������

    // add / edit
    'Locate'          => '�������',
    'Mime Type'       => 'Mime ���',
    'Upload'          => '���������',
    'Category'        => '���������',
    'Change Category' => '�������� ���������',
    'Description'     => '��������',

    // validate
    'You must select a file to upload'                   => '����������, ������� ���� ��� ��������',
    'Error: Not a recognised file type'                  => '������: ����������� ��� �����',
    'Error: A file with this name already exists'        => '������: ���� � ����� ������ ����������',
    'There was an error attempting to download the file' => '������ �������� �����',
    'The specified file does not appear to exist'        => '��������� ���� �� ����������',

    // form alerts
    'Please wait until upload is finished' => '����������, ��������� ���� �������� �� ����������',
    'Please select a file to upload'       => '����������, ������� ���� ��� ��������',
    'Please wait while document uploads'   => '����������, ��������� ���� �������� �����������',

    // messages
    'The asset has successfully been added'   => '���� ������� ��������',
    'The asset has successfully been deleted' => '����� ������� �������',
    'The asset has successfully been updated' => '���� ������� ��������������',


/* FileMgr */

    // messages
    'You do not have read permissions for this file' => '� ��� ��� ���� �� ������ ������� �����',


/* DocumentViewMgr */

    // titles
    'Document Browser' => '�������� ����������',

    // list
    'view'     => '�����������',
    'download' => '�������',


/* WikiScrapeMgr */

    // titles
    'WikiScrape Manager' => '���������� WikiScrape',


/* ContentTypeMgr */

    // titles
    'Content Type Manager' => '���������� ������ ����������',

    // types
    'Title'    => '���������',
    'BodyHtml' => 'HTML �����',
    'NewsHtml' => '�����',

    // actions
    'Add New Content Type' => '���������� ������ ���� ����������',
    'Editing Content Type' => '�������������� ���� ����������',

    //
    // ������������� � ���������; �� ������ ������ ����� ������� ����� ����������
    // �������� ����, ��� � � ���������� ��������
    //

    'select a type to create a new article' => '������� ��� ��� �������� ����� ������',
    'Current View Wysiwyg' => 'Current View Htmlers', // ?
    'View Wysiwyg' => 'View Wysiwyg', // ?
    'Current View Html' => 'Current View Html', // ?
    'View Html' => 'View Html', // ?
    'Select Font' => '������� �����',

    'Number of fields' => 'Number of fields',
    'field' => 'field',
    'New content type' => 'New content type',
    'Give a name to this field and select its type' => 'Give a name to this field and select its type',
    'With selected content type(s)' => 'With selected content type(s)',
    'content type has successfully been added' => 'content type has successfully been added',
    'content type(s) has successfully been deleted' => 'content type(s) has successfully been deleted',
    'content type has successfully been updated' => 'content type has successfully been updated',
    'Through the Publisher module Seagull allows you to create three types of content.This is easily customisable however only 3 types will be discussed here:'=>'Through the Publisher module Seagull allows you to create three types of content.This is easily customisable however only 3 types will be discussed here:',
    'What you see when you click the Articles tab in the front end is a document collection. Creating articles of type Html Article allows you to place your content in a hierarchy that you build using the Categories button above.  This can be useful for intranet applications, or if you have a large body of work that needs to be categorised. Document collection articles will be displayed with all articles from the same category appearing in the Related Articles box  on the right. Similarly, all files uploaded to the same category with the Document Manager will appear in the Related Documents box.'=>'What you see when you click the \'Articles\' tab in the front end is a document collection. Creating articles of type \'Html Article\' allows you to place your content in a hierarchy that you build using the \'Categories\' button above. This can be useful for intranet applications, or if you have a large body of work that needs to be categorised. Document collection articles will be displayed with all articles from the same category appearing in the \'Related Articles\' box on the right. Similarly, all files uploaded to the same category with the Document Manager will appear in the \'Related Documents\' box.',
    'However, if you want to make standalone pages that will be linked to by their own tab, please use the Static Html Article type.  In order to create the navigation that will link to these static pages, please use the'=>'However, if you want to make standalone pages that will be linked to by their own tab, please use the \'Static Html Article\' type.  In order to create the navigation that will link to these static pages, please use the',
    'Finally, you can create news items by choosing the News Item type, these will appear in the left hand column in the Site News box.  These articles (and all others) can be retired automatically according to the date constraints you set on the item.'=>'Finally, you can create news items by choosing the News Item type, these will appear in the left hand column in the Site News box.  These articles (and all others) can be retired automatically according to the date constraints you set on the item.',
    'You can also set permissions on who can view the content using the Permissions button above.'=>'You can also set permissions on who can view the content using the \'Permissions\' button above.',
    'more info'=>'more info',
    'Contributed by' =>'Contributed by',
    'Please select an article type' => 'Please select an article type',
);

?>