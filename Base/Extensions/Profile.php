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

class Profile
{
	public $discription = 'Provides Profile Support';
	
	private $profileType;
	private $currProfile;
	
	public function getByName( $bmsuid )
	{
		global $BMS_DB;
		
		if ( empty( $bmsuid ) )
			return false;
			
		$bmsuid = trim( $bmsuid );
		if ( @$currProfile[ 'bmsuid' ] != $bmsuid ) {
			if ( $this->profileType == 'admin' ) {
				$BMS_DB->setTableName( 'bms_accounts_admin' );
			} else {
				$BMS_DB->setTableName( 'bms_accounts' );
			}
			$account = $BMS_DB->query( '*' , "WHERE bms_uid = '$bmsuid'" );
			if ( empty( $account ) )
				return false;
			$this->currProfile = $account[0];
		}
		return true;
	}
	
	public function setType( $profileType )
	{
		global $BMS_DB;
		$this->profileType = $profileType;
	}
	
	public function getField( $field )
	{
		return $this->currProfile[ $field ];
	}
	
	public function valid()
	{
		if ( $this->profileType == 'admin' ) {
			if ( $this->currProfile[ 'bms_account_status' ] != 'Suspended' ) {
				return true;
			}
		} elseif ( $this->currProfile[ 'bms_email_valid' ] == 1 
				&& ( $this->currProfile[ 'bms_account_status' ] != 'Suspended' || $this->currProfile[ 'bms_account_status' ] != 'Inactive' ) ) {
			return true;
		}
		return false;
	}
}

$BMS->initExtension( 'Profile' );