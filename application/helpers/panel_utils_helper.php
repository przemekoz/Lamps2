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
			
				<div onclick="location.href=\'/index.php/klienci\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Zarzadzaj klientami">Klienci</div>
				<div onclick="location.href=\'/index.php/slupy\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Zarzadzaj slupami">Slupy</div>
				<div onclick="location.href=\'/index.php/korony\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Zarzadzaj koronami">Korony</div>
				<div onclick="location.href=\'/index.php/oprawy\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 0;cursor:pointer" title="Zarzadzaj oprawami">Oprawy</div>
				<div onclick="location.href=\'/index.php/Home/logout\'" onmouseover="this.style.color=\'#003D4C\';this.style.background=\'#fff\'" onmouseout="this.style.color=\'#fff\';this.style.background=\'#003D4C\'" style="padding: 5px;border:1px solid white; float:left;margin:5px 10px 0 30px;cursor:pointer" title="Wyloguj">Wyloguj</div>
				<!--
				<div style="margin:5px 10px 0 30px; float:left; border:2px solid #0F7D98; width:100px; height:30px; color:#0F7D98"><div style="padding:5px 0 0 5px">jlkalajdlajlds</div></div>
				-->
				<div style="clear:both"></div>
			</div>
		</div>
		
		<div style="width: 100%; text-align: center;">
			<div style="margin:0 auto; width: 95%; text-align: left;height: 500px;overflow: auto;">
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
			<td style="color:#003D4C;font-weight: bold; border-bottom: 2px solid #aaa; width: 5%">Id</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 2px solid #aaa; width: 50%">Nazwa</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 2px solid #aaa; width: 45%">Akcje</td>
		</tr>';
		echo $html;
		
	}
}

if ( ! function_exists('panelShowTableList'))
{
	/**
	 * wyswietla top
	 */
	function panelShowTableList($id, $title, $actions) {
		$html = '<tr>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 1px solid #ddd">'.$id.'</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 1px solid #ddd">'.$title.'&nbsp;</td>
			<td style="color:#003D4C;font-weight: bold; border-bottom: 1px solid #ddd">'.$actions.'</td>
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
			<table cellpadding="5" style="margin:40px 0 10px 0;">
				<tr><td>'.getLink('Anuluj', "/index.php/$cancelUrl", '', true).'</td><td>'.getButton('Zapisz', 'document.form.submit()').'</td></tr>
			</table> 
			';
		
		echo $html;
		
	}
}

