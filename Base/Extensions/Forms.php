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
	
	public function adminLoginForm()
	{

$loginForm = <<<EOF
  <form method="post" action="{$_SERVER[ 'PHP_SELF' ]}">
  <fieldset>
   <legend>Login Form</legend>
   <input type="hidden" name="formType" value="loginForm">
    <table border="1">
	<tr>
	 <td>
       Admin Username: 
     </td>
    </tr>
    <tr>
     <td>
       <input type="text" name="bms_uid" >
     </td>
    </tr>
    <tr>
     <td>
      Admin Password
     </td>	  
    </tr>
    <tr>
     <td>
       <input type="text" name="bms_pwd" >
     </td>
    </tr>
    <tr>
     <td cols="2">
       <input type="submit" value="Login" >
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
		print 'hey';
	}
}

$BMS->initExtension( 'Forms' );