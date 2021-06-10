for servers in $(cat hosts); do
#  touch $servers.cfg
  cat client.cfg > /usr/local/nagios/etc/servers/$servers.cfg
  sed -i "s/test1/$servers/g" /usr/local/nagios/etc/servers/$servers.cfg
  cat /usr/local/nagios/etc/servers/$servers.cfg
done
