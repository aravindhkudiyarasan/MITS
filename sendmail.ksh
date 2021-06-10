#!/bin/bash
SCRIPT_DIR=$(cd `dirname $0` && pwd)
LOG_DIR=${SCRIPT_DIR}
 styleTable="style='border:1px solid #000;border-collapse: collapse;'"
 style="style='border:1px solid #000;padding:2px 4px;font-size: 13px;font-family:arial;'"
 thStyle="style='border:1px solid #000;padding:2px 4px;background:#8a6d3b;color:#fff;font-size: 13px;font-family:arial;'"

(
 echo "From: localhost"
 echo "To: aravindh.kudiyarasu@gmail.com"
 echo "MIME-Version: 1.0"
 echo "Content-Type: text/html; charset=UTF-8"
 echo "Content-Transfer-Encoding: 8bit"
 echo "Subject: UDeploy Daily Agent Validation"
 echo "<p>For complete list go to - http://teckieweb.com/Udeploy/index.php</p>"
 echo "<h1>Stopped Agent List</h1>"
 echo "<table $styleTable>"
 echo "<th $thStyle>HOSTNAME</th><th $thStyle>DATE</th><th $thStyle>AGENT STATUS</th><th $thStyle>RUNNING JAVA VERSION</th><th $thStyle>INSTALLED PROPERTIES VERSION</th>"
 cat ${LOG_DIR}/agent.csv | grep "NOT RUNNING" | sort -r --field-separator=',' -n --key=7,7 > ${LOG_DIR}/final2.csv
#cat agent.csv

 while read INPUT; do
 echo "<tr><td $style>${INPUT//,/</td><td $style>}</td></tr>";
 done < ${LOG_DIR}/final2.csv
 echo "</table>"
 echo "<br>""</br>"
 echo "<h1>Running Agent List</h1>"
 echo "<table $styleTable>"
 echo "<th $thStyle>HOSTNAME</th><th $thStyle>DATE</th><th $thStyle>AGENT STATUS</th><th $thStyle>RUNNING JAVA VERSION</th><th $thStyle>INSTALLED PROPERTIES VERSION</th>"
 cat ${LOG_DIR}/agent.csv | grep "RUNNING" | sort -r --field-separator=',' -n --key=7,7 > ${LOG_DIR}/final1.csv

 while read INPUT; do
 echo "<tr><td $style>${INPUT//,/</td><td $style>}</td></tr>";
 done < ${LOG_DIR}/final1.csv
 echo "</table>"
 ) | /usr/sbin/sendmail -t
