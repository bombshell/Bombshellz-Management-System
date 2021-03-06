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

/*** DO NOT MODIFY THESE LINES ***/
define( 'BMS_PATH_WEBUI' , BMS_PATH_LIBRARY . path_rewrite( 'UI/WebUI/' ) );

if ( !empty( $_POST[ 'formType' ] ) ) {
	$BMS->Forms->processForm( $_POST[ 'formType' ] );
	exit;
}
if ( isset( $_GET[ 'media' ] ) ) {
	require BMS_PATH_WEBUI . 'media.php';
	exit;
}
$BMS->Html->head();
/*** DO NOT MODIFY THESE LINES ***/
var_dump( $_SESSION );
if ( !$BMS->Session->isAuth() ) {
	/* Custom check added*/
	if ( @$_GET[ 'loginType' ] == 'admin' || file_exists( BMS_PATH_BASE . '.shell' ) ) {
		$body = $BMS->Forms->getLoginForm( 'admin' );
	} else {
		$body = $BMS->Forms->getLoginForm();	
	}
} else {
	print 'yay';
}

$BMS->Html->body( $body );
/*** DO NOT MODIFY THESE LINES ***/
$BMS->Html->footer();
/*** DO NOT MODIFY THESE LINES ***/