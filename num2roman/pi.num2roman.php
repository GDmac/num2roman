<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * For usage with ExpressionEngine by EllisLab
 */
 
// ------------------------------------------------------------------------

/**
 * Numeral to Roman Plugin
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Plugin
 * @author		GDmac
 * @link		
 */

$plugin_info = array(
	'pi_name'		=> 'Numeral to Roman',
	'pi_version'	=> '1.0',
	'pi_author'		=> 'GDmac',
	'pi_author_url'	=> '',
	'pi_description'=> 'usage',
	'pi_usage'		=> Num2roman::usage()
);


class Num2roman {

	public $return_data;
    
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();
	}
	

	public function convert()
	{
		if ($this->EE->TMPL->fetch_param('num') !== FALSE)
		{
			return $this->_numberToRoman($this->EE->TMPL->fetch_param('num'));
		}
	}
	
	// pradeep http://www.go4expert.com/forums/showthread.php?t=4948
	
	private function _numberToRoman($num) 
	{
		// Make sure that we only use the integer portion of the value
		$n = intval($num);
		$result = '';
	 
		// Declare a lookup array that we will use to traverse the number:
		$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
		'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
		'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
	 
		foreach ($lookup as $roman => $value) 
		{
			// Determine the number of matches
			$matches = intval($n / $value);

			// Store that many characters
			$result .= str_repeat($roman, $matches);

			// Substract that from the number
			$n = $n % $value;
		}

		// The Roman numeral should be built, return it
		return $result;
	}


	// ----------------------------------------------------------------
	
	/**
	 * Plugin Usage
	 */
	public static function usage()
	{
		ob_start();
?>
{exp:num2roman:convert num="2011"} will convert 2011 to MMXI

examples:
  Month: {exp:num2roman:convert num="{entry_date format="%m"}"}
  Year:  {exp:num2roman:convert num="{entry_date format="%Y"}"}


<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}


/* End of file pi.num2roman.php */
/* Location: /system/expressionengine/third_party/num2roman/pi.num2roman.php */