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

if ( file_exists( 'CustomInitHook.php' ) )
	require( 'CustomInitHookBefore.php' );
	
/*** FUNCTIONS ***/
function load_extension( $ext )
{
	require BMS_PATH_BASE . path_rewrite( 'Base/Extensions/' . $ext );
	
}

function bms_quit( $errorMsg )
{
	global $BMS_CFG, $BMS;
	if ( is_object( $BMS ) ) {
		$BMS->printError( 'ERR0000' , $errorMsg , 'Bombshellz Management System' );
		$BMS->logData( 'ERR0000' , $errorMsg );
	} else {
		print $errorMsg;
	}
	exit(1);
}

function bms_std()
{
	if ( !is_resource( STDIN ) ) {
		$stdin = fopen( 'php://stdin' , 'r' );
		define( 'STDIN' , $stdin );
	}
	if ( !is_resource( STDOUT ) ) {
		$stdin = fopen( 'php://stdout' , 'w' );
		define( 'STDOUT' , $stdin );
	}
	if ( !is_resource( STDERR ) ) {
		$stdin = fopen( 'php://stderr' , 'w' );
		define( 'STDERR' , $stdin );
	}
}

/*** Initialize BMS ***/

/* Load BMS Configuration */
if ( file_exists( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '.prod' ) ) 
	require 'DefaultSettings.php';
elseif ( is_file( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '.local' ) ) 
	require 'LocalSettings.php';
else 
	bms_quit( 'Error: Unable to load configuration' );
/* Load Lightjet class */
require $BMS_PATH[ 'LightJet' ] . 'main.php';


/* Default values */
if ( empty( $BMS_PATH[ 'Base' ] ) ) {
	$BMS_PATH[ 'Base' ] = dirname( __FILE__ ) . DS;
}

define( 'BMS_NAME' , 'Bombshell Management System' );
define( 'BMS_VER' , 'v1.0.0' );
define( 'BMS_PATH_BASE' , path_rewrite( $BMS_PATH[ 'Base' ] ) );
define( 'BMS_PATH_LIBRARY' , BMS_PATH_BASE . path_rewrite( 'Library/' ) );
define( 'BMS_ERROR' , 'Error: ' );

/*** Load API ***/
require BMS_PATH_BASE . path_rewrite( 'Base/Core.php' );
/* Series of checks in CLI mode */
if ( $BMS->getSapi() == 'cli' ) {
	bms_std();
	if ( $_SERVER[ 'USER' ] != 'root' ) 
		bms_quit( BMS_ERROR . 'BMS needs to be run as root' );
}

/***  ***/
/*** Database Connection ***/
$BMS->loadClass( 'DatabasePDO' );
$connectOptions[ 'dbType' ] = 'mysql';
$connectOptions[ 'dbPath' ] = $BMS_CFG[ 'Database' ][ 'Location' ];
$connectOptions[ 'dbName' ] = $BMS_CFG[ 'Database' ][ 'Name' ];
$connectOptions[ 'dbUser' ] = $BMS_CFG[ 'Database' ][ 'Username' ]; 
$connectOptions[ 'dbPass' ] = $BMS_CFG[ 'Database' ][ 'Password' ];
$BMS_DB = new Database( $connectOptions );
/* Verify if the connection was made */
if ( $BMS_DB->errorId == 'ERR0403' ) {
	bms_quit( BMS_ERROR . 'Unable to establish a connection to client database: ' . $BMS_DB[ 'Client' ]->errorMsg );
}

//var_dump( $_SERVER[ 'REMOTE_ADDR' ] );
/* Check for a root admin account */
$BMS->Profile->setType( 'admin' );
if ( !$BMS->Profile->getByName( 'root' ) ) {
	bms_quit( 'Error: Root admin account missing' );
}