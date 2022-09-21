<?php
// File name   : example_custom_header_footer.php
// Begin       : 2013-12-03
// Last Update : 2013-12-03
//
// Description : Example to overwite header, footer of TCPDF class

ini_set("display_errors", 1);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
include "config-pdo.php";
define("encryption_method", "AES-128-CBC");
define("key", "enlyft@2022#$%");
define("iv", "dataencrypt@2022");
function encrypt($data) {
    $key = key;
    $plaintext = $data;
    $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
    $iv = iv;
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
    return $ciphertext;
}
function decrypt($data) {
    $key = key;
    $c = base64_decode($data);
    $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
    $iv = iv;
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    if (hash_equals($hmac, $calcmac))
    {
        return $original_plaintext;
    }
}

// Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = 'images/enlyft-logo_90x90-.jpg'; // *** Very IMP: make sure this image is available on given path on your server
        $this->Image($image_file,130,5,35);
        // Set font
        $this->SetFont('times', 'C', 20);
    
        // Line break
        $this->Ln();        
        // $this->Cell(294, 15, 'ABC test company', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // $this->Ln(5);        
        // $this->Cell(280, 0, 'ENLYFT NETWORK PRIVATE LIMITED', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // We need to adjust the x and y positions of this text ... first two parameters
        
    }

    // Page footer
    public function Footer() {
        // Position at 25 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('times', 'B', 12);
        
        // $this->Cell(0, 0, 'ENLYFT NETWORK PRIVATE LIMITED', 0, 0, 'C');
        $this->Ln(1);
        $this->Cell(0,0,'Website : www.enlyft.in  Mobile : +91 937-255-3300  Email : info@enlyft.in', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
    
}

///////////////// End of class ////////////////////////////

//////////////////////////////////
//
//
// Create new PDF document
//
//
//////////////////////////////////
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ENLYFT NETWORK PRIVATE LIMITED');
$pdf->SetTitle('YouTube Influencer');
$pdf->SetSubject('YouTube Influencer');
$pdf->SetKeywords('YouTube Influencer, PDF');


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
// $pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->setFont('dejavusans', '', 14);
// $pdf->SetFont('times', '', 10); 
// *** Very IMP: Please use times font, so that if you send this pdf file in gmail as attachment and if user
//opens it in google document, then all the text within the pdf would be visible properly.

// add a page
$pdf->AddPage('L');
$channelid = $_POST['channel-id'];
$ids = implode(',', $channelid);
//fetching data from database
$table_data = "SELECT * FROM youtube WHERE id IN ($ids)";
$stmt1 = $con->prepare($table_data);
$stmt1->execute();


// create some HTML content
$html = '';
if(isset($_POST['internal'])){
    while($row = $stmt1->fetch()){

	$html .= '
	<style>
	.txtwhite{color:white;font-weight:bold;}
	.txtred{color:#EF1931;font-weight:bold;}
    .txtyellow{color:yellow;font-weight:bold;}
	</style>
	<br>
	<div style="background-color:black;"><br>
		<img style="text-align:center;" src="'.$row->profile_image.'" class="img-radius" align="center" alt="User-Profile-Image"><br><br>
		<table border="1" cellpadding="4" align="center">
			<tr class="txtred">
				<th>Channel Name</th>
				<th>Influencer Name</th>
				<th>Genre</th>
			</tr>
			<tr class="txtwhite">
				<td>'.decrypt($row->channel_name).'</td>
				<td>'.decrypt($row->influencer_name).'</td>
				<td>'.ucwords($row->genre).'</td>
			</tr>
		</table><br><br>
		<table cellspacing="2" cellpadding="4" align="center">
			<tr class="txtred">
				<th>Subscribers</th>
				<th>Avg. Views</th>
				<th>Avg. Likes</th>
			</tr>
			<tr class="txtwhite">
				<td>'.number_format($row->subscribers).'</td>
				<td>'.number_format($row->avg_views).'</td>
				<td>'.number_format($row->avg_likes).'</td>
			</tr>
		</table><br><br>
		<table cellspacing="2" cellpadding="4" align="center">
			<tr class="txtred">
				<th>Gender</th>
				<th>State</th>
				<th>Language</th>
			</tr>
			<tr class="txtwhite">
				<td>'.$row->gender.'</td>
				<td>'.ucwords($row->state).'</td>
				<td>'.ucwords($row->language).'</td>
			</tr>
		</table><br><br>
		<table cellspacing="2" cellpadding="4" align="center">
			<tr class="txtred">
				<td colspan="3"><a style="text-decoration:none;color:#EF1931;font-size:17px;" target="_blank" href="'.decrypt($row->profile_url).'">Visit Channel</a></td>
			</tr>
		</table>
	</div>
	<br><br><br>
	';

}
}

if(isset($_POST['external'])){
   while($row = $stmt1->fetch()){

	$html .= '
	<style>
	.txtwhite{color:white;font-weight:bold;}
	.txtred{color:red;font-weight:bold;}
	</style>
	<br>
	<div style="background-color:black;"><br>
		<br><br><br>
		<table border="1" cellpadding="4" align="center">
			<tr class="txtred">
				<th>Channel Name</th>
				<th>Influencer Name</th>
				<th>Genre</th>
			</tr>
			<tr class="txtwhite">
				<td>'.decrypt($row->channel_name).'</td>
				<td>'.decrypt($row->influencer_name).'</td>
				<td>'.ucwords($row->genre).'</td>
			</tr>
		</table><br><br><br>
		<table cellspacing="2" cellpadding="4" align="center">
			<tr class="txtred">
				<th>Subscribers</th>
                <th rowspan="4"><img style="text-align:center;" src="'.$row->profile_image.'" class="img-radius" align="center" alt="User-Profile-Image"></th>
				<th>Gender</th>
			</tr>
			<tr class="txtwhite">
				<td>'.number_format($row->subscribers).'</td>
                
				<td>'.$row->gender.'</td>
			</tr>
			<tr class="txtred">
				<th>State</th>
                
				<th>Language</th>
			</tr>
			<tr class="txtwhite">
				<td>'.ucwords($row->state).'</td>
                
				<td>'.ucwords($row->language).'</td>
			</tr>
		</table><br><br><br><br>
		<table cellspacing="2" cellpadding="4" align="center">
			<tr class="txtred">
				<td colspan="3"><a style="text-decoration:none;color:red;font-size:17px;" target="_blank" href="'.decrypt($row->profile_url).'">Visit Channel</a></td>
			</tr>
		</table><br>
	</div>
	<br><br><br>
	';

} 
}


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
date_default_timezone_set("Asia/Calcutta");
$createdon = date('dmYHis');
//Close and output PDF document
$pdf_file_name = $createdon."youtube-influencers.pdf";
$pdf->Output($pdf_file_name, 'I');
//echo $dnlod;

//============================================================+
// END OF FILE                                                
//============================================================+
?>