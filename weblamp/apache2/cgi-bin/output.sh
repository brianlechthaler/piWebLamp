#!/bin/bash
echo "Content-type: text/html"
echo ""
echo '<html>'
echo '<head>'
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'
echo '<title>Output</title>'
echo '</head>'
echo '<body>'
echo  "<pre>"
cat /usr/lib/cgi-bin/iframe.txt 
echo "</pre>"
echo '</body>'
echo '</html>'
