<?php

/*** 

	Copyright (c) http://wiki.bombshellz.net/
	Author: Lutchy Horace
	Version: 0.0.1
	
	Redistribution and use in source or binary forms are permitted provided that the following conditions are met:
		
		* Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
		* Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
		* Neither the name of the BombShellz.net nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
		* Modification to this file or program is not permitted without the consent of the author.
		* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
	
***/

/**
 @Operating Settings
*/
/*
 note: these operating setting config how LightJet operates. These settings might have to be adjusted
       to work correctly with your application
*/

/*
 !!!!!VERY!!!!!IMPORTANT!!!!!READ!!!!!FIRST
 
 note: certain fields only take specific values, accepted values are boolen and string.
 
      fields that only accept boolen values will be marked with boolen
       boolen values are constant true or false
      
      if boolen values are left blank, False will be assumed
      
      fields that only accept string values will be marked with string
       string values accepts any content
       
 note: string values must be places within quotes
 
 note: more information could be find in readme_config.txt
 
 note: settings that require path to be set, an ending forward slash is required. Otherwise PHP will assume
       that path points to a filename and in the end could could lead to errors
*/

/* set the name of this config 
 
  note: *IMPORTANT*, do not include spaces  

  note: this is used in various locations of the program or classes
*/
$_CFG[ 'LG_Config_Name' ] = "BMS_local"; /* string */

/* set the host
 
  note: if left blank, an attempt will be made to autodetect it  

  note: the host could be a ip address or fqdn
*/
$_CFG[ 'LG_Host' ] = ""; /* string */


/* set the relative path to the server host
 
  note: if left blank, an attempt will be made to autodetect it  

  note: the relative path is the root location of your scripts seen from the web server
        Example: If you place all your scripts under /scripts/, your root path 
                 or relative path is /scripts/.
*/
$_CFG[ 'LG_Relative_Path' ] = null; /* string */


/* if set to true, critical data will be logged and be displayed on screen if necessary 
  note: 0 for disabled
  	    1 for debug level 1
  	    2 for debug level 2
 
*/
$_CFG[ 'LG_Debug' ] = 2; /* integer */


/* set a list of ip(s) that are safe to display errors to the screen 
 
  note: ip(s) are sparated by a comma
  
  note: any invalid ip(s) will be ignored
*/
$_CFG[ 'LG_Safe_Client_IP' ] = "127.0.0.1,192.168.56.1,::ffff:192.168.56.1"; /* string */


/* if set to true, set_path will automatically append _SERVER_ROOT_ to paths

   functions that are dependent of this value are
    
    filesystem::path_translate()
    filesystem::is_exists()
    and any other functions that depend on either two above
*/
//$_CFG[ 'set_path_dir' ]  = "true"; /* string */
/*  TODO 3 -oevil-genius -cClass_Config : This will be moved to another personal config. The filesystem config */


/* if set to true, return_path will return the full path including SERVER_ROOT if
set_path is true */
$_CFG[ 'LG_Return_Path_Dir' ] = true; /* boolen */
/* I'm not sure what this config does */

/* if set to true, check_url_path will check the path of the url to see if it exists on the server. 
   
	 note: If the path doesn't exists, and debug is true, user will be prompt with an error code.
	       However this only apply's to url(s) that point to the local server; Otherwise, the user
	       will be redirected to an redirect script (Located at: 'servlet/redirect.php' ). View
	       redirect script for more details.
	 
	 note: not found path(s) are logged automatically with or without debug
	 
	 note: if set to false, NO error checking and the user will be redirected automatically.
	 
	 note: setting this to false, could improve proformance but if not sure all your url(s) are valid
	       or working in a environment where people submit urls. It would be a good choice to leave it on.
   
    functions that are dependent of this value are
    
    http::path_exists()
    and any other functions that depend on the above
*/
//$_CFG[ 'check_url_path' ] = "true"; /* boolen */
/*  TODO 3 -oevil-genius -cClass_Config : This will be moved to another personal config. The http config */


/* temp directory where temp files will be stored  
	 
	note: The temporary directory must exists and writable prior to excuting 
		  LightJet
		   
	note: If you ommit the full path, the path is relative to the root directory
		  where main.php lies or whatever lg_root_path is set to in main.php.
		  
	note: If you ommit this configuration, temp directory will be disabled
*/
$_CFG[ 'LG_Temp' ] = "/root/Mounts/G/Default/Workspace/LightJet2/Temp/"; /* string */


/* Log Messages
   
  note: If disabled, no log messages will be written to disk

*/
$_CFG[ 'LG_Log' ] = true; /* boolen */


/* set path to the location to write the log file
 
 note: there is a string limit to 35
 
 note: make sure log directory is writable
 
 note: if left blank, the temp directory if enabled will be used. Exp. temp/log/LogFile
*/
$_CFG[ 'LG_Log_Path' ] = "/root/Mounts/G/Default/Workspace/BMS1/Logs/"; /* string */

/* set the log file name */
$_CFG[ 'LG_Log_Name' ] = "error.log.txt"; /* string */


/* set the ip(s) of nameservers for DNS lookup 
 
 note: if left blank, http::Url_isValid() will only check if the url is formatted
       properly
 
 note: ip(s) are sparated by a comma
 
 note: this feature applies only to windows because checkdnsrr is not available under windows.
       On Linux or Unix, checkdnsrr uses the systems dns ip(s).
 
 note: Pear Net::Dns package is required to use this feature on Microsoft Windows.
      
 functions that are dependent of this value are
    
    http::Url_isValid()
    http::dns()
    and any other functions that depend on either of the two

*/
//$_CFG[ 'nameservers_ip' ] = "162.51.200.71, 162.51.72.151"; /* string */
/*  TODO -oevil-genius -cClass_Config : NOt supported and possibly will be never supported. Pending erasing this config. */

/* query name servers
 
 note: if nameservers_ip is empty, query_nameservers is false; Only on Microsoft Windows does this apply.
       On Linux or Unix, nameservers_ip don't apply. Check Above.
 
 note: If query_nameservers is set to false, functions that are dependend of this value
       could return true; which doesn't guarantee that the url is a valid url.
 
 functions that are dependent of this value are
    
    http::dns()
    and any other functions that depend on the above
*/
//$_CFG[ 'query_nameservers' ] = "false"; /* boolen */
/*  TODO -oevil-genius -cClass_Config : NOt supported and possibly will be never supported. Pending erasing this config. */


/* if set to true, on redirections, the url will be verified
 
 functions that are dependent of this value are
    
    http::header_redirect()
    and any other functions that depend on http::_header_redirect()
 
*/
//$_CFG[ 'url_verify' ] = false; /* boolen */
/*  TODO 2 -oevil-genius -cClass_Config : I want to support this future but not yet. This config has moved to it's own class config. */

/* if set, this will help distinguish between bad and good domain names. www.example.org but not www.example.fgs 

 note: if left blank, default to com and net
 
 note: various function depend on this setting

*/
$_CFG[ 'LG_Valid_Domain_Extensions' ] = "com, net, org, gov, biz"; /* string */


/* sometimes, some applications might use pear api(s). If you have pear installed, where is located? 
 
 note: on a typical installation of PEAR, your pear packages will be most likely
      be installed in the PEAR folder under  PEAR directory
      
 note: check readme_config.txt for more help
 
*/
//$_CFG[ 'pear_install_pkgs' ] = "PEAR/PEAR/"; /* string */
/*  TODO 3 -oevil-genius -cConfig : I possibly might support this future, don't know yet */


/* check if client supports ajax */
//$_CFG[ 'check_for_ajax_support' ] = "true"; /* boolen */
/*  TODO 3 -oevil-genius -cConfig : This config is going into it's own index.php file */

/* if set to true, all post vars will be filtered for invalid characters  
	
	note: You will encounter a performance if you choose to enabled. Otherwise,
		  use filter_data() function to filter the vars individually.
*/
$_CFG[ 'LG_Filter_Post_Data' ] = true; /* boolen */
/*  TODO 3 -oevil-genius -cFunction : I need to create the function, filter_data */


/* set the database type to use 

 note: if left blank, Sqlite will be assumed
 
 note: application settings can override this value
*/
//$_CFG[ 'database_type' ] = "Sqlite"; /* string */
/*  TODO -oevil-genius -cClass : The Database class needs to be recreated and it's own config file */

/* the path to store database files 

 note: this path only apply's to Sqlite
*/
//$_CFG[ 'database_path' ] = "db/"; /* string */


/* enable Zsystems internal php error manager */
//$_CFG[ 'enable_php_error_manager' ] = "false"; /* bool */
/*  TODO 1 -oevil-genius -cFunction : Haven't figure out how this config will work --- It's disabled for now */


/* Default Admin email 
 note: Error messages will be sent to this E-Mail address
 
 note: If left blank, no E-Mail will be sent.
*/
$_CFG[ 'LG_Default_Admin_Email' ] = "admin@localhost"; /* string */



/* What type of emails you will like to recieve 

  note: It's best you leave this to critical for performance
        because frequent System errors can occurs. You don't want to recieve an email for
				every system error that occurs. Take the time to check
        the logs and only send critical errors.
  
  note: Critical errors will only be sent if enable_php_error_manager is enabled
*/
//$_CFG[ 'email_error_type' ] = "critical";		
/*  TODO 3 -oevil-genius -cFunction : This is neat but it needs more development */

/* Open File
 Do you want openFile to store files it opens in memory?  
 note: Having this option on can help speed up performance for CLI applications but
       having side affect for Web Applications. Not tested performance so I'm not really be
       sure
 note: This is cached data in memory, if you use writeFile, it will automatically update the contents 
       in memory, however, if you modify the file from outside of LightJet. The cache data could end
       up being outdated.
 note: If you use writeFile in append mode, then the entire file has to be re-read and loaded into memory
       that could slow down performance.
*/
$_CFG[ 'LG_OW_Store_In_Memory' ] = false; /* bool */

/* fileWrite
 The maxmum number of backups to keep at one time
*/
$_CFG[ 'LG_OW_Max_Backup' ] = 5; /* integer */

/* Default TimeZone
 Set the default time zone, if PHP TimeZone setting is undefined
*/
$_CFG[ 'LG_Default_Timezone' ] = 'America/New_York';