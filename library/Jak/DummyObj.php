<?php

class Jak_DummyObj extends Zend_Application_Resource_ResourceAbstract{
    
    protected $_options = array();
    private $_conf = array();
    
    
    public function __construct($options = array()){
        //$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/jak.ini');
        $this->_conf = $config;
    }
    
    public function init(){        
    }
    
    public function get_it(){
        return $this->_conf->resources->Jak_DummyObj->get('op1');
    }
    
    
    function are_strings(array $strings = array())
    {
        if(!(is_array($strings)) OR count($strings) === 0)
            return false;
        
        foreach($strings as $string){
            if(!is_string($string)){
                return false;
            }
        }
        
        return true;
    }

	function array_keys_exists(array $stack, array $needles, bool $count = false)
	{
		foreach($needles as $needle):
			
			if(!is_string($needle) AND !is_long($needle))
				return false;
			
			if(!array_key_exists($needle, $stack))
				return false;

		endforeach;
        
        if($count)
            if(!(count($needles) === count($stack)))
                return false;

		return true;
	}
	
    
    
	function fchk($fp, $ext = null)
	{
		if(!is_string($fp))
			return false;
		
		if(!file_exists($fp) or !is_file($fp))
			return false;
			
		if(is_string($ext)):
			
			if(!ctype_alpha($ext))
				return false;

			if(strcmp(strrchr($fp, '.'), $ext) === 0)
				return true;
			else
				return false;
	
		elseif(is_null($ext)):

			return true;
		
		else:
		
			return false;
			
		endif;	
	}
	
	function str_compare($s1, $s2)
	{
		if(!is_string($s1) or !is_string($s2)):
			return false;
		endif;

		if((strlen($s1) === strlen($s2)) AND (strcmp($s1, $s2) === 0) AND ($s1 === $s2)):
			return true;
		endif;
        
		return false;
	}
		
	function unhtml($str,$strip_tag = false)
	{
		if((!is_string($str)) or (strlen($str) === 0))
			return 'Empty';
			
		$len = strlen($str);
		
		for($c = 0; $c < $len; $c++)
			if(ord($str[$c]) === 0)
				$str[$c] = 'a';
		
		if($strip_tag)
			$str = strip_tags($str);
			
		$str = htmlspecialchars($str, ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5, 'UTF-8', false);
		
		return $str;
	}
	
	function rehtml(&$str)
	{
		$str = htmlspecialchars_decode($str, ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5);
	}
	
	function symbol_prechk($sym)
	{
		if((is_string($sym) and ctype_alnum($sym)) and
		(strlen($sym) >= 3) && (strlen($sym) <= 15))
			return true;
				
		else
			return false;
	}	
		
	function str_scheme($string,$patt)
	{
		if(!is_string($string) or !is_string($patt))
			return false;

		if(preg_match($patt,$string) === 1)
			return true;

		return false;
	}
		
	function in_range($min, $max, $var)
	{
		if(!is_long($min) or !is_long($max))
			return false;

		if(is_string($var)):
			$l = strlen($var);
			
			if(($l>=$min) and ($l<=$max))
				return true;
			else
				return false;

		elseif(is_long($var)):
			
			if(($var>=$min) and ($var<=$max))
				return true;
			else
				return false;
	
		endif;
		return false;
	}
	
	function name_gen($len)
	{
		if(!is_long($len))
			return false;
		
		$allowed = array();
		$str = '';
		
		foreach(range('A', 'Z') as $ucase)
			array_push($allowed, $ucase);

		foreach(range('a', 'z') as $lcase)
			array_push($allowed, $lcase);

		foreach(range(0, 9) as $int)
			array_push($allowed, $int);			
		
		for($x = 0; $x < $len; $x++)
			$str .= $allowed[array_rand($allowed)];
			
		return $str;
	}
    
	public function qustr(array $qparams)
	{
		$query_arr = array();
		foreach($qparams as $getpar => $getval)
			$query_arr[] = $getpar . '=' . urlencode($getval);
		
		$query_str = implode('&', $query_arr);
		return htmlentities($query_str, ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5, 'UTF-8', false);
	}
}

?>
