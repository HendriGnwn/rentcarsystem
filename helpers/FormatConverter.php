<?php

namespace app\helpers;

use DateTime;
use yii\helpers\FormatConverter as BaseFormatConverter;



/**
 * Description of FormatConverter
 * 
 * @author Hendri <hendri.gnw@gmail.com>
 */
class FormatConverter extends BaseFormatConverter
{
    /**
     * Format string as date
     *
     * @param string $date
     * @param string $format
     * @return string
     */
    public static function dateFormat($date, $format)
    {
        $date = new DateTime($date);

        return $date->format($format);
    }
	
	/**
	 * the date format into indonesian
	 * 
	 * @param type $date date or datetime
	 * @param type $format eg. (%Y-%m-%d) 
	 * @see type $format http://php.net/manual/en/function.strftime.php
	 * @return type
	 */
	public static function indoDateFormat($date, $format)
	{
		setLocale(LC_ALL, 'id_ID', 'ind', 'indonesia');
		return strftime($format, strtotime($date));	
	}
	
	/**
     * Format number to rupiah
     * @param float $value
     * @return string
     */
    public static function rupiahFormat($value, $decimal = 0)
    {
		return number_format($value, $decimal, ',', '.');
    }
	
	/**
     * Format number to dollar
     * @param float $value
     * @return string
     */
    public static function dollarFormat($value, $decimal = 0)
    {
		return number_format($value, $decimal, '.', ',');
    }
	
	/**
	 * 
	 * @param type $date
	 * @param type $interval
	 * @param type $format
	 * @return type
	 */
	public static function dateInIntervalFormat($date, $interval, $format = 'Y-m-d')
	{
		$date = date_create($date);
		date_add($date, date_interval_create_from_date_string($interval .' days'));
		
		return date_format($date, $format);
	}
}