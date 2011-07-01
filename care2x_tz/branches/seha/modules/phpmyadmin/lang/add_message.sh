#!/bin/bash
# $Id: add_message.sh,v 1.1 2006/01/13 13:39:24 irroal Exp $
#
# Shell script that adds a message to all message files (Lem9)
#
# Example:  add_message.sh '$strNewMessage' 'new message contents'
#
for file in *.inc.php3
do
        echo $file " "
        grep -v '?>' ${file} > ${file}.new
        echo "$1 = '"$2"';  //to translate" >> ${file}.new
        echo "?>" >> ${file}.new
        rm $file
        mv ${file}.new $file
done
echo " "
echo "Message added to all message files (including english)"
