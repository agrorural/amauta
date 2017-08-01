<?php

// Variables del servidor LDAP
$ldaphost = "ldap://172.16.11.1";  // servidor LDAP
$ldapport = 389;                 // puerto del servidor LDAP

// Conexión al servidor LDAP
$ldapconn = ldap_connect($ldaphost, $ldapport)

          or die("Could not connect to $ldaphost");
          if($ldapconn)echo 'se conecto';

?>
