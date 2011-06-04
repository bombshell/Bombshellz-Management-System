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
	$BMS->printError( 'ERR0000' , $errorMsg , 'Bombshellz Management System' );
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
if ( is_file( '.local' ) ) 
	require 'LocalSettings.php';
else 
	require 'DefaultSettings.php';
/* Load Lightjet class */
require $BMS_PATH[ 'LightJet' ] . 'main.php';


/* Default values */
if ( empty( $BMS_PATH[ 'Base' ] ) ) {
	$BMS_PATH[ 'Base' ] = dirname( __FILE__ ) . DS;
}

define( 'BMS_PATH_BASE' , path_rewrite( $BMS_PATH[ 'Base' ] ) );
define( 'BMS_PATH_LIBRARY' , BMS_PATH_BASE . 'Library' . DS );
define( 'BMS_ERROR' , 'Error: ' );

/* This only supports *Nix environments, since I'm not checking for other type of slashes 
 *  Check if the begining slash is present */
if ( !preg_match( '/^\//' , $BMS_CFG[ 'Database' ][ 'Admin' ][ 'Location' ] ) ) {
	$BMS_CFG[ 'Database' ][ 'Admin' ][ 'Location' ] = BMS_PATH_BASE . $BMS_CFG[ 'Database' ][ 'Admin' ][ 'Location' ];
}

/*** Load API ***/
require BMS_PATH_BASE . path_rewrite( 'Base/Core.php' );
/* Series of checks in CLI mode */
if ( $BMS->getSapi() == 'cli' ) {
	bms_std();
	if ( $_SERVER[ 'USER' ] != 'root' ) 
		bms_quit( BMS_ERROR . 'BMS needs to be run as root' );
}

/*** Database Connection ***/
$BMS->loadClass( 'DatabasePDO' );
$BMS_DB[ 'Admin' ]  = new Database( array( 'dbType' => 'sqlite' , 'dbPath' => $BMS_CFG[ 'Database' ][ 'Admin' ][ 'Location' ] ) );

$connectOptions[ 'dbType' ] = 'mysql';
$connectOptions[ 'dbPath' ] = $BMS_CFG[ 'Database' ][ 'Client' ][ 'Location' ];
$connectOptions[ 'dbName' ] = $BMS_CFG[ 'Database' ][ 'Client' ][ 'Name' ];
$connectOptions[ 'dbUser' ] = $BMS_CFG[ 'Database' ][ 'Client' ][ 'Username' ]; 
$connectOptions[ 'dbPass' ] = $BMS_CFG[ 'Database' ][ 'Client' ][ 'Password' ];
$BMS_DB[ 'Client' ] = new Database( $connectOptions );
/* Verify if the connection was made */
if ( $BMS_DB[ 'Client' ]->errorId == 'ERR0403' ) {
	bms_quit( BMS_ERROR . 'Unable to establish a connection to client database: ' . $BMS_DB[ 'Client' ]->errorMsg );
}