#!/bin/sh
#
# $Id: updatedocs.sh,v 1.1 2006/01/13 13:42:14 irroal Exp $
#
# Script to build plain text documentation from the HTML version
#
SRC=Documentation.html
DST=Documentation.txt
OPTIONS="--dont_wrap_pre --nolist --dump"
CMD=lynx

TMPDOCDIRS=".. . `pwd` `pwd`/`dirname ${0}`/.. `dirname ${0}`/.."
for dir in ${TMPDOCDIRS}; do
    [ -e "${dir}/${SRC}" ] && DOCDIR="${dir}"
    [ -n "${DOCDIR}" ] && break
done
unset TMPDOCDIRS
if [ -z "${DOCDIR}" ]; then
    echo 'Unable to locate documentation!'
    exit -1
fi

SRC="${DOCDIR}/${SRC}"
DST="${DOCDIR}/${DST}"

${CMD} ${OPTIONS} "${SRC}" > "${DST}"
