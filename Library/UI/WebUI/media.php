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

$path = $BMS->sanitazePath( $_GET[ 'media' ] );
if ( preg_match( '/(.css)$/' , $path ) ) {
	$path = BMS_PATH_WEBUI . path_rewrite( 'Css/' . $path );
	if ( file_exists( $path ) ) {
		header( "Content-type: text/css" );
		print $BMS->fileRead( $path );
	}
} elseif ( preg_match( '/(.js)$/' , $path ) ) {
	$path = BMS_PATH_WEBUI . path_rewrite( 'JavaScript/' . $path );
	if ( file_exists( $path ) ) {
		/* TODO Detect browser and send the proper header */
		header( 'Content-type: text/javascript' );
		print $BMS->fileRead( $path );
	}
} else {
	/**/
	if ( is_array( $BMS_CFG[ 'Valid_Image_FileExtensions' ] ) ) {
		foreach( $BMS_CFG[ 'Valid_Image_FileExtensions' ] as $ext => $mime ) {
			if ( preg_match( "/(.$ext)/" , $path ) ) {
				$path = BMS_PATH_WEBUI . path_rewrite( 'Images/' . $path );
				if ( file_exists( $path ) ) {
					header( "Content-Type: $mime" );
					print $BMS->fileRead( $path );
					exit;
				}
			}
		}
		header( 'Status: 404 Not Found' );
		print 'Not Found';
	} else {
		header( 'Status: 404 Not Found' );
		$BMS->logData( 'ERR0000' , 'Error: No valid image file extensions: returned 404 not found' );
	}
	
}