<?php
echo "<h3>LDAP query test</h3>";
echo "Connecting...<br />";
$ds=ldap_connect("172.16.11.1");
                                        /* Replace yourldapserver for
                                               ldap://w.x.y.z (standar LDAP)
                                               ldaps://w.x.y.z (secure LDAP)
                                               w.x.y.z:389 (standard LDAP)
                                               w.x.y.z:636 (secure LDAP)
                                               w.x.y.z:3268 (standard LDAP against AD's global catalog
                                                             in a primary domain controller server)
                                               w.x.y.z:3269 (secure LDAP against AD's global catalog
                                                             in a primary domain controller server)
                                        */
echo "Connect result is " . $ds . "<br />";

if ($ds) { 
   echo "Binding...<br />"; 
   $r=ldap_bind($ds,"cn=administrador,cn=Users,dc=agrorural,dc=gob,dc=pe","%4gr0.kfch$");
                                         /* Replace yourusertoqueryldap for something like
                                                cn=user,ou=usersbox,dc=your,dc=domain
                                                user@your.domain
                                            Replace yourpassword for the correspondent one to
                                            yourusertoqueryldap
                                         */
   echo "Bind result is " . $r . "<br />";


   echo "Searching...<br />";
   $sr=ldap_search($ds, "ou=agrorural,dc=agrorural,dc=gob,dc=pe", "samaccountname=msoto");
                                         /* Replace yourdomainroot for something like
                                            dc=your,dc=domain
                                            This can be any AD context, but is easier from the tree's root
                                            Replace targetusertosearchfor for the username you use to
                                            login in a windows network.
                                         */
   echo "Search result is " . $sr . "<br />";

   echo "Number of entires returned is " . ldap_count_entries($ds, $sr) . "<br />";

   echo "Getting entries...<br />";
   $info = ldap_get_entries($ds, $sr);
   echo "Data for " . $info["count"] . " items returned:<p>";

echo '<pre>';
var_dump($info);
echo '</pre>';

/*
   for ($i=0; $i<$info["count"]; $i++) {  #loop though ldap search result
   
     print "<b>dn:</b> " . $info[$i]["dn"] . "<br>"; #print dn
   
     for ($e=0; $e<$info[$i]["count"]; $e++) { #loop though attributes in this dn
       print "&nbsp;&nbsp;<b>" . $info[$i][$e] . ":</b> "; #print attribute name
       $attrib = $info[$i][$e]; #set attribute
       eval("print \$info[\$i][\"$attrib\"][0];"); #print attribute value

       print "<br>";
     } 
     
     print "<br>";
   }

*/

   echo "Closing connection...";
   ldap_close($ds);

} else {
   echo "<h4>Unable to connect to LDAP server</h4>";
}
?>
