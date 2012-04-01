<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * Image library
 *
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */
if ( ! function_exists('panelshowTop'))
{
	/**
	 * wyswietla top
	 */
	function panelshowTop($text) {
		$html = '
		<div style="background:#003D4C; color: white; width: 100%;height:50px;margin-bottom: 1px">
			<div style="padding: 15px 0 0 25px;font-family:arial,sans-serif;"><b>'.$text.'</b></div>
		</div>
		
		<div style="background:#003D4C; color: white; width: 100%;height:41px;margin-bottom: 20px">
			<div style="padding: 0 25px;font-family:tahoma,sans-serif;">
			
			<!--
				<div onclick="location.href=\'/index.php/klienci\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Zarzadzaj klientami">Klienci</div>
			-->
				
				<div onclick="location.href=\'/index.php/Tlo\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Zarzadzaj tłami">Tła</div>
				<div onclick="location.href=\'/index.php/Slupy\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Zarzadzaj kolumnami">Kolumny</div>
				<div onclick="location.href=\'/index.php/Korony\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Zarzadzaj koronami">Korony</div>
				<div onclick="location.href=\'/index.php/Oprawy\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Zarzadzaj oprawami">Oprawy</div>
				<div onclick="location.href=\'/index.php/Merge/choose/column/crown\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Łączenie kolumny z koronami">Kolumny --&gt; korony</div>
				<div onclick="location.href=\'/index.php/Merge/choose/column/fitting\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Łączenie kolumny z koronami">Kolumny --&gt; oprawy</div>
				<div onclick="location.href=\'/index.php/Merge/choose/crown/fitting\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Łączenie kolumny z koronami">Korony --&gt; oprawy</div>
				<div onclick="location.href=\'/index.php/Home/logout\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 30px;cursor:pointer" title="Wyloguj">Wyloguj</div>
				<!--
				<div style="margin:5px 10px 0 30px; float:left; border:2px solid #0F7D98; width:100px; height:30px; color:#0F7D98"><div style="padding:5px 0 0 5px">jlkalajdlajlds</div></div>
				-->
				<div style="clear:both"></div>
			</div>
		</div>
		
		<div style="width: 100%; text-align: center;">
			<div style="margin:0 auto; width: 95%; text-align: left;">
		';
		echo $html;
	}
}

if ( ! function_exists('panelshowTopLogout'))
{
	/**
	 * wyswietla top
	 */
	function panelshowTopLogout($text) {
		$html = '
		<div style="background:#003D4C; color: white; width: 100%;height:50px;margin-bottom: 1px">
			<div style="padding: 15px 0 0 25px;font-family:arial,sans-serif;"><b>Panel administracyjny'.$text.'</b></div>
		</div>
		
		';
		echo $html;
	}
}

if ( ! function_exists('panelShowBottom'))
{
	/**
	 * wyswietla top
	 */
	function panelShowBottom() {
		$html = '</div></div><div style="background:#003D4C; color: white; width: 100%;height:50px;margin-top: 40px;">&nbsp;</div>';
		echo $html;
		
	}
}

if ( ! function_exists('panelShowTableTop'))
{
	/**
	 * wyswietla top
	 */
	function panelShowTableTop() {
		$html = '<table cellpadding="5" cellspacing="5" width="100%" style="margin:0 auto;">
		<tr>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 2px solid #aaa; width: 3%">Lp.</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 2px solid #aaa; width: 62%">Nazwa</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 2px solid #aaa; width: 5%;text-align:center">Ulica</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 2px solid #aaa; width: 5%;text-align:center">Ogród</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 2px solid #aaa; width: 10%;text-align:center">Wymiary</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 2px solid #aaa; width: 15%;text-align:center">Akcje</td>
		</tr>';
		echo $html;
		
	}
}

if ( ! function_exists('panelShowTableList'))
{
	/**
	 * wyswietla top
	 */
	function panelShowTableList($id, $title, $street, $garden, $size, $actions) {
		
		$street = intval($street);
		$garden = intval($garden);
		$aStretGarden = array('street'=>array('&nbsp;', '<font color=green>Tak</font>'), 'garden'=>array('&nbsp;','<font color=green>Tak</font>'));
		$iter = 1;
		$html = '<tr>
		  <td style="color:#003D4C;font-weight: bold; border-bottom: 1px solid #ddd">'.$id.'.</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 1px solid #ddd">'.$title.'</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 1px solid #ddd;text-align:center">'.$aStretGarden['street'][$street].'</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 1px solid #ddd;text-align:center">'.$aStretGarden['garden'][$garden].'</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 1px solid #ddd;text-align:center">'.$size.'</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 1px solid #ddd;text-align:center">'.$actions.'</td>
		</tr>';
		
		echo $html;
		
	}
}

if ( ! function_exists('panelShowSubmitCancel'))
{
	/**
	 * wyswietla top
	 */
	function panelShowSubmitCancel($cancelUrl) {
		$html = '
			<table cellpadding="5" style="margin:10px 0 10px 0;">
				<tr><td>'.getLink('Anuluj', "/index.php/$cancelUrl", '', true).'</td><td>'.getButton('Zapisz', 'document.form.submit()').'</td></tr>
			</table> 
			';
		
		echo $html;
		
	}
}

