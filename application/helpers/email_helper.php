<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */
if ( ! function_exists('mail_attachment'))
{
	function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
		
		$file = $path.$filename;
		
		/* jsli jest zalacznik */
		if (is_file($file)) {
			$file_size = filesize($file);
			$handle = fopen($file, "r");
			$content = fread($handle, $file_size);
			fclose($handle);
		
			$content = chunk_split(base64_encode($content));
			$uid = md5(uniqid(time()));
			$name = basename($file);
			$header = "From: Konfigurator <biuro@promar-sj.com.pl>\r\n";
			//$header = "Reply-To: ".$from_name." <".$from_mail.">\r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
			$header .= "This is a multi-part message in MIME format.\r\n";
			$header .= "--".$uid."\r\n";
			$header .= "Content-type:text/plain; charset=UTF-8\r\n";
			$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$header .= $message."\r\n\r\n";
			$header .= "--".$uid."\r\n";
			$header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
			$header .= "Content-Transfer-Encoding: base64\r\n";
			$header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
			$header .= $content."\r\n\r\n";
			$header .= "--".$uid."--";
			$res = @mail($mailto, $subject, $message, $header);
			$is_file=1;
		}
		//w przeciwnym przypadku
		else {
			$header = "From: Konfigurator <biuro@promar-sj.com.pl>\r\n";
			$header .= "Content-type:text/plain; charset=UTF-8\r\n";
			$res = @mail($mailto, $subject, $message, $header);
			$is_file=0;
		}
		
		if (!$res) {
			var_dump($mailto);
			var_dump($subject);
			var_dump($message);
			var_dump($header);
			var_dump($is_file);
			die('Nie wysłano.');
		}
		
	}
}

