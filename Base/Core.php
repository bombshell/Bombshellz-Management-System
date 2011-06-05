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

class BMS_Core extends Framework
{
	public $loadedExtensions;
	
	public function __construct()
	{
		global $BMS_CFG, $BMS_PATH;
		
		/* Init LightJet2 framework */
		parent::__construct( $BMS_PATH[ 'LightJetConfig' ] );
		$this->setDebug( $BMS_CFG[ 'Debug' ] );
		/* Load Extensions */
		$BMS = $this;
		if ( !empty( $BMS_CFG[ 'Extensions' ] ) )
			if ( is_array( $BMS_CFG[ 'Extensions' ] ) ) {
				$path_ext = BMS_PATH_BASE . path_rewrite( 'Base/Extensions/' );
				foreach( $BMS_CFG[ 'Extensions' ] as $file ) {
					$path = $path_ext . $file;
					if ( !file_exists( $path ) ) {
						if ( $this->getDebugLevel() >= 1 ) 
							$this->printf( "Error: Extension not loaded: $path" );
					} else 
						require $path;
				}
		
			}
	}
	
	/**
	 * 
	 * Initialize class in BMS object scope
	 * @param (string) $class Class Name
	 * 
	 */
	public function initExtension( $class )
	{
		if ( class_exists( $class ) ) {
			$this->$class = new $class;
			if ( $this->debug >= 1 )
				$this->printf( "Notice: Extension $class loaded" );
			$this->loadedExtensions[ $class ] = $this->$class->discription;
		}
	}
	
	/**
	 * 
	 * Initialize LightJet Classes
	 * @param (string) $class
	 */
	public function initClass( $class )
	{
		$this->loadClass( $class );
		if ( !is_object( @$this->$class ) )
			$this->$class = new $class;
	}
	
	/**
	 * 
	 * Converts Unix Epoch TimeStamp into human readable format
	 * @param (int) $time timestamp returned by time()
	 * 
	 */
	public function timeToStr( $time )
	{
		return date( 'm/d/Y h:i:s A' , $time );
	}
	
	/**
	 * 
	 * Prints a formatted string
	 * @param (string) $str
	 * 
	 */
	public function printf( $str )
	{
		if ( $this->getSapi() == 'cli' )
			fwrite( STDOUT , $str . "\n" );
		else
			$this->logData( 'ERR0000' , $str );
	}
	
	/**
	 * 
	 * Sanitize path to avoid security exploits
	 * @param (string) $path Path to sanitize
	 * 
	 */
	public function sanitazePath( $path )
	{
		return str_replace( array( DS , '.' ) , '' , $path );
	}
}

$BMS = new BMS_Core();