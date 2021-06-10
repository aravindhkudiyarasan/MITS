for servers in $(cat hosts); do
var1=${servers//./-}.cfg
  cat client.config > /usr/local/nagios/etc/servers/ip-${var1}
  sed -i "s/test1/$servers/g" /usr/local/nagios/etc/servers/ip-${var1}
  cat /usr/local/nagios/etc/servers/ip-${var1}
done
