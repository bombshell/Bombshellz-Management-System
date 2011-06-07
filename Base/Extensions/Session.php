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

/* load core class before Session class is initialize */
$BMS->loadClass( 'Session_Core' );

class Session extends Session_Core
{
	public $discription = "Provides session support";
	
	public function __construct()
	{
		/* Start Session */
		parent::__construct();
	}
	
	public function isAuth()
	{
		global $BMS; 
		
		if ( $this->isValid() ) {
			if ( @$_SESSION[ 'is_auth' ] ) {
				$BMS->Profile->setType( $_SESSION[ 'profile_type' ] );
				if ( $BMS->Profile->getByName( $_SESSION[ 'bms_uid' ] ) ) {
					return true;
				} else {
					$_SESSION[ 'is_auth' ] = false;
					//$this->session->destroy();
				}
			}
		}
		return false;
	}
	
	public function auth( $bms_uid , $bms_pwd , $authType = null )
	{
		global $BMS;
		
		if ( empty( $bms_uid ) || empty( $bms_pwd ) ) {
			return false;
		}
		
		/* Pull profile */
		$BMS->Profile->setType( $authType );
		$BMS->Profile->getByName( $bms_uid );
        if ( $BMS->Profile->valid() ) {
			if ( $BMS->Profile->getField( 'bms_uid' ) == $bms_uid ) {
				if ( $BMS->hash( $bms_pwd ) == $BMS->Profile->getField( 'bms_pwd' ) ) {
					$_SESSION[ 'is_auth' ]      = true;
					$_SESSION[ 'profile_type' ] = $authType;
					$_SESSION[ 'bms_uid' ]      = $bms_uid;
					return true;
				}
			}
        } else {
        	$this->errorId = 'ERR0605';
        	$this->errorMsg = 'Profile disabled';
        }
		return false;
	}
}

$BMS->initExtension( 'Session' );