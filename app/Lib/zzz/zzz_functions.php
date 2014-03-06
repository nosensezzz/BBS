<?php

class zzz_functions{
	
	public function site_name( $s=null ){
		$s = 'bbs_example';
		return $s;
	}

	public function file_type( $s ){
		return substr(strrchr($s,'.'),1);
	}

}

?>