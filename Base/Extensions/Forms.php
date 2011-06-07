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

class Forms
{
	public $discription = 'Provides HTML Support';
	
	public function getLoginForm( $loginType = null )
	{
		global $BMS;
		if ( $loginType == 'admin' )
			$title = 'Administrator';
		else 
			$title = 'Client';
			
		if ( !empty( $_GET[ 'loginError' ] ) ) {
			if ( $_GET[ 'loginError' ] == 'invalid' ) {
				$str = 'Username or Password invalid<br>';
				$str .= 'Login attempt: /4';
			}
			if ( !empty( $str ) )
				$loginForm = $BMS->Html->errorBox( $str );
		}
			
@$loginForm .= <<<EOF
  <form method="post" action="{$_SERVER[ 'PHP_SELF' ]}" class="forms font">
  <fieldset style="width: 205px">
   <legend>$title Login</legend>
   <input type="hidden" name="formType" value="loginForm">
   <input type="hidden" name="loginType" value="$loginType">
    <table border="0" style="width: 200px">
	<tr>
	 <td>
       Username
     </td>
    </tr>
    <tr>
     <td>
       <input type="text" size="30" name="bms_uid" >
     </td>
    </tr>
    <tr>
     <td>
      Password
     </td>	  
    </tr>
    <tr>
     <td>
       <input type="password" size="30" name="bms_pwd" >
     </td>
    </tr>
    <tr>
     <td cols="2" style="text-align: right;">
       <input type="submit" value="Login" class="button">
     </td>
    </tr>
   </table>
 </fieldset>
 </form>
		
EOF;
		return $loginForm;
	}
	
	public function processForm( $formType )
	{
		if ( method_exists( $this , $formType ) ) {
			$this->$formType();
		}
	}
	
	public function loginForm()
	{
		global $BMS;
		
		$url = $_SERVER[ 'PHP_SELF' ] . '?loginType=' . $_POST[ 'loginType' ];
		if ( !$BMS->Session->auth( $_POST[ 'bms_uid' ] , $_POST[ 'bms_pwd' ] , $_POST[ 'loginType' ] ) ) {
			if ( $BMS->Session->errorId == 'ERR0605' )
				$loginError = 'disabled';
			else 
				$loginError = 'invalid';
			$BMS->Http->redirectClient( $url . '&loginError=' . $loginError );
		} else {
			$BMS->Http->redirectClient( $_SERVER[ 'PHP_SELF' ] );
		}
	}
}

$BMS->initExtension( 'Forms' );
$BMS->initClass( 'Http' );