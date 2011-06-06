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

$BMS_CFG[ 'Debug' ] = 2;
$BMS_PATH[ 'LightJet' ] = '/root/Mounts/G/Default/Workspace/LightJet2/'; /* This setting is required , it's your responsibility to verify that the path is valid */
$BMS_PATH[ 'LightJetConfig' ] = '/root/Mounts/G/Default/Workspace/BMS1/Config/LightJet2/BMS_local.php';

$BMS_PATH[ 'Base' ] = '';  /* The base path of Bombshellz Management System , Optional */

/* Image Extensions and MIME */
$BMS_CFG[ 'Valid_Image_FileExtensions' ][ 'jpg' ]  = 'image/jpeg';
$BMS_CFG[ 'Valid_Image_FileExtensions' ][ 'jpeg' ] = 'image/jpeg';
$BMS_CFG[ 'Valid_Image_FileExtensions' ][ 'png' ]  = 'image/png';

$BMS_CFG[ 'Hash_Algo' ] = 'md5'; /* Possible values are: md5 , sha256 or sha512. Defaults to md5 if the hash algo is missing. See: http://www.php.net/manual/en/function.hash-algos.php */

$BMS_CFG[ 'Database' ][ 'Location' ] = 'localhost';
$BMS_CFG[ 'Database' ][ 'Name' ]     = 'bmsdb';
$BMS_CFG[ 'Database' ][ 'Username' ] = 'bmsuser';
$BMS_CFG[ 'Database' ][ 'Password' ] = 'Dic20034@';

$BMS_CFG[ 'Extensions' ][] = 'Email.php';
$BMS_CFG[ 'Extensions' ][] = 'Html.php';
$BMS_CFG[ 'Extensions' ][] = 'Forms.php';
$BMS_CFG[ 'Extensions' ][] = 'Profile.php';
$BMS_CFG[ 'Extensions' ][] = 'Session.php';