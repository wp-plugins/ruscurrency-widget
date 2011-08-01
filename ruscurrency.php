<?php
/*
Plugin Name: RuCurrency
Plugin URI: http://v4w.in/ruscurrency/
Description: Виджет курса валют ЦБ РФ на текущий день. Widget show the exchange rate of The Central Bank of the Russian Federation.
Version: 1.0
Author: vHv
Author URI: http://v4w.in/
License: GPL2

Copyright 2011  Vlad Valiev  (email : vlad4web@meun.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


function RuCurrencyWidget($args){
extract($args);
$title = 'Курс валют ЦБ РФ на ';
$urlcurr = 'http://www.cbr.ru/scripts/XML_daily.asp';
$currArray = array('978', '826', '840');
echo $before_widget;
echo $before_title . $title . date('d.m.y') . $after_title;
            $currentCurrency = array();
            $x = 0;
			$currxml = simplexml_load_file($urlcurr);
            foreach ($currxml as $node) {
                if (in_array($node->NumCode[0], $currArray)) {
                    $currentCurrency[$x]['Value'] = $node->Value[0];
                    $currentCurrency[$x]['CharCode'] = $node->CharCode[0];
                    $currentCurrency[$x]['Nominal'] = $node->Nominal[0];
                    echo '<li><img src="' . WP_PLUGIN_URL . '/ruscurrency/images/' . $currentCurrency[$x]['CharCode']. '.gif" /> &nbsp;&nbsp;' . $currentCurrency[$x]['Nominal'] . ' ' . $currentCurrency[$x]['CharCode'] . ' - '.  $currentCurrency[$x]['Value'].' руб. </li>';
                }
            }
echo $after_widget;
}
register_sidebar_widget('RuCurrency', 'RuCurrencyWidget');
?>