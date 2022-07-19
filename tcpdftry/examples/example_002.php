<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 002');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '
<style>
.txtwhite{color:white;font-weight:bold;}
.txtred{color:red;font-weight:bold;}
</style>
<br>
<div style="background-color:black;"><br>
	<img style="text-align:center;" src="https://yt3.ggpht.com/ytc/AKedOLREOBT109d1QFQcEBEKs25fsOi9nOWxGT75UoIN5g=s88-c-k-c0x00ffffff-no-rj" class="img-radius" align="center" alt="User-Profile-Image"><br><br>
	<table border="1" cellpadding="4" align="center">
		<tr class="txtred">
			<th>Channel Name</th>
			<th>Influencer Name</th>
			<th>Genre</th>
		</tr>
		<tr class="txtwhite">
			<td>Indian Jugaad Tech</td>
			<td>Sarvan Kumar</td>
			<td>Technology</td>
		</tr>
	</table><br><br>
	<table cellspacing="2" cellpadding="4" align="center">
		<tr class="txtred">
			<th>Subscribers</th>
			<th>Avg. Views</th>
			<th>Avg. Likes</th>
		</tr>
		<tr class="txtwhite">
			<td>100000</td>
			<td>19000</td>
			<td>5000</td>
		</tr>
	</table><br><br>
	<table cellspacing="2" cellpadding="4" align="center">
		<tr class="txtred">
			<th>Gender</th>
			<th>State</th>
			<th>Language</th>
		</tr>
		<tr class="txtwhite">
			<td>Male</td>
			<td>West Bengal</td>
			<td>Hindi</td>
		</tr>
	</table><br><br>
	<table cellspacing="2" cellpadding="4" align="center">
		<tr class="txtred">
			<td colspan="3"><a style="text-decoration:none;color:red;font-size:15px;" target="_blank" href="https://www.youtube.com/channel/UCeCsvjRYbSEmuD5YsYf35CQ">Visit Channel</a></td>
		</tr>
	</table>
</div>
<br><br>
<div style="background-color:black;"><br>
	<img style="text-align:center;" src="https://yt3.ggpht.com/ytc/AKedOLREOBT109d1QFQcEBEKs25fsOi9nOWxGT75UoIN5g=s88-c-k-c0x00ffffff-no-rj" class="img-radius" align="center" alt="User-Profile-Image"><br><br>
	<table border="1" cellpadding="4" align="center">
		<tr class="txtred">
			<th>Channel Name</th>
			<th>Influencer Name</th>
			<th>Genre</th>
		</tr>
		<tr class="txtwhite">
			<td>Indian Jugaad Tech</td>
			<td>Sarvan Kumar</td>
			<td>Technology</td>
		</tr>
	</table><br><br>
	<table cellspacing="2" cellpadding="4" align="center">
		<tr class="txtred">
			<th>Subscribers</th>
			<th>Avg. Views</th>
			<th>Avg. Likes</th>
		</tr>
		<tr class="txtwhite">
			<td>100000</td>
			<td>19000</td>
			<td>5000</td>
		</tr>
	</table><br><br>
	<table cellspacing="2" cellpadding="4" align="center">
		<tr class="txtred">
			<th>Gender</th>
			<th>State</th>
			<th>Language</th>
		</tr>
		<tr class="txtwhite">
			<td>Male</td>
			<td>West Bengal</td>
			<td>Hindi</td>
		</tr>
	</table><br><br>
	<table cellspacing="2" cellpadding="4" align="center">
		<tr class="txtred">
			<td colspan="3"><a style="text-decoration:none;color:red;font-size:15px;" target="_blank" href="https://www.youtube.com/channel/UCeCsvjRYbSEmuD5YsYf35CQ">Visit Channel</a></td>
		</tr>
	</table>
</div>
<br><br>
<div style="background-color:black;"><br>
	<img style="text-align:center;" src="https://yt3.ggpht.com/ytc/AKedOLREOBT109d1QFQcEBEKs25fsOi9nOWxGT75UoIN5g=s88-c-k-c0x00ffffff-no-rj" class="img-radius" align="center" alt="User-Profile-Image"><br><br>
	<table border="1" cellpadding="4" align="center">
		<tr class="txtred">
			<th>Channel Name</th>
			<th>Influencer Name</th>
			<th>Genre</th>
		</tr>
		<tr class="txtwhite">
			<td>Indian Jugaad Tech</td>
			<td>Sarvan Kumar</td>
			<td>Technology</td>
		</tr>
	</table><br><br>
	<table cellspacing="2" cellpadding="4" align="center">
		<tr class="txtred">
			<th>Subscribers</th>
			<th>Avg. Views</th>
			<th>Avg. Likes</th>
		</tr>
		<tr class="txtwhite">
			<td>100000</td>
			<td>19000</td>
			<td>5000</td>
		</tr>
	</table><br><br>
	<table cellspacing="2" cellpadding="4" align="center">
		<tr class="txtred">
			<th>Gender</th>
			<th>State</th>
			<th>Language</th>
		</tr>
		<tr class="txtwhite">
			<td>Male</td>
			<td>West Bengal</td>
			<td>Hindi</td>
		</tr>
	</table><br><br>
	<table cellspacing="2" cellpadding="4" align="center">
		<tr class="txtred">
			<td colspan="3"><a style="text-decoration:none;color:red;font-size:15px;" target="_blank" href="https://www.youtube.com/channel/UCeCsvjRYbSEmuD5YsYf35CQ">Visit Channel</a></td>
		</tr>
	</table>
</div>
<br><br>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
