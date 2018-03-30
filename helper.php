<?php
/**
 * @version		$Id: helper.php 786 2018-02-05 17:40:09 kaushik.shivendra@gmail.com
 * @package		Subtable v3.1
 * @author		Umika Technologies LLP https://www.umikatechnologies.com
 * @copyright	Copyright (c) 2012 Umika Technologies LLP. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

class modSubtableHelper
{
	private function __construct(){}
	private function __clone(){}
    static public function getItem($params) {
        $css_class = $params->get('classname');
		$title = $params->get('title');
        return "";
		
    }
	public function getconverterAjax() {
       	jimport('joomla.application.module.helper');
		$input  = JFactory::getApplication()->input;
		$link = '<a href="https://3stechnosolutions.com"  target="_blank" rel="following"><img src="'.JURI::root().'modules/mod_subtable/assets/images/3stechnosolutions.png" alt="3stechnosolutions LLP"></a>';
		$amountcol1 = $input->get('amount1', 'default_value', 'string');
		$amountcol2 = $input->get('amount2', 'default_value', 'string');
		$amountcol3 = $input->get('amount3', 'default_value', 'string');
		$amountcol4 = $input->get('amount4', 'default_value', 'string');
		$to = $input->get('q', 'default_value', 'string');
		 $from = 'USD';
		 $dollarValue = self::get_currency($from, $to, 1);
		 if($dollarValue){
		 switch ($to)
				{
					case ("EUR"):
					$rateinEUR = "&euro;".$amountcol1*$dollarValue.","."&euro;".$amountcol2*$dollarValue.",". "&euro;".$amountcol3*$dollarValue.","."&euro;".$amountcol4*$dollarValue.",".$link;
					echo $rateinEUR;
					break;
					case ("INR"):
					   $rateinINR = "<span class="."rupee".">`</span>".$amountcol1*$dollarValue.","."<span class="."rupee".">`</span>".$amountcol2*$dollarValue.",". "<span class="."rupee".">`</span>".$amountcol3*$dollarValue.","."<span class="."rupee".">`</span>".$amountcol4*$dollarValue.",".$link;
					echo $rateinINR;
					break;
					case ("GBP"):
					$rateinGBP = "&pound;".$amountcol1*$dollarValue.","."&pound;".$amountcol2*$dollarValue.",". "&pound;".$amountcol3*$dollarValue.","."&pound;".$amountcol4*$dollarValue.",".$link;
					echo $rateinGBP;
					break;
					case ("CNY"):
					$rateinCNY = "&yen;".$amountcol1*$dollarValue.","."&yen;".$amountcol2*$dollarValue.",". "&yen;".$amountcol3*$dollarValue.","."&yen;".$amountcol4*$dollarValue.",".$link;
					echo $rateinCNY;
					break;
					case ("CHF"):
					$rateinCHF = "&#8355;".$amountcol1*$dollarValue.","."&#8355;".$amountcol2*$dollarValue.",". "&#8355;".$amountcol3*$dollarValue.","."&#8355;".$amountcol4*$dollarValue.",".$link;
					echo $rateinCHF;
					break;
					default:
					$rateinDEF = $to.$amountcol1*$dollarValue.",".$to.$amountcol2*$dollarValue.",".$to.$amountcol3*$dollarValue.",".$to.$amountcol4*$dollarValue.",".$link;
					echo $rateinDEF;
					
				}
		 
		 }
    }
	
	private function get_currency($from_Currency, $to_Currency, $amount) {
			$amount = urlencode($amount);
			$from_Currency = urlencode($from_Currency);
			$to_Currency = urlencode($to_Currency);
		
			$url = "https://finance.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
		
			$ch = curl_init();
			$timeout = 4;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		
			curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$rawdata = curl_exec($ch);
			curl_close($ch);
			//return $rawdata;
			$data = explode('bld>', $rawdata);
			$data = explode($to_Currency, $data[1]);
		
			return round($data[0], 0);
	}
}
