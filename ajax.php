<?php
ob_start();
include_once('functions.php');
include_once('tcpdf/tcpdf.php');
if($_POST['action'] == 'pdf')
{
	//print_r($_POST);
	check_empty($_POST['customer'], 'Customer name is required.');
	check_empty($_POST['in'], 'Invoice number is required.');
	check_empty($_POST['address'], 'Address is required.');
	check_empty($_POST['name'][0], 'Add atleast one item.');
	check_empty($_POST['price'][0], 'Item price is required.');
	check_empty($_POST['qty'][0], 'Quantity is required.');
	$customer = htmlen($_POST['customer']);
	$address = htmlen($_POST['address']);
	$in = htmlen($_POST['in']);
	$address = nl2br($address);
	//
	$total = 0;
	for($i = 0; $i < sizeof($_POST['name']); $i++)
	{
		$item_name[] = htmlen($_POST['name'][$i]);
		$price_check = check_numeric($_POST['price'][$i], 'Price must have only numeric value.');
		$quantity_check = check_numeric($_POST['qty'][$i], 'Quantity must have only numeric value.');
		$price[] = $_POST['price'][$i];
		$quantity[] = $_POST['qty'][$i];
		$total += $_POST['price'][$i]*$_POST['qty'][$i];
	}
	//content
	$html = '
	<style>
	table, tr, td {
	padding: 15px;
	}
	</style>
	<table style="background-color: #222222; color: #fff">
	<tbody>
	<tr>
	<td><h1>INVOICE<strong> #'.$in.'</strong></h1></td>
	<td align="right"><img src="logo.png" height="60px"/><br/>

	123 street, ABC Store<br/>
	Country, State, 00000
	<br/>
	<strong>+00-1234567890</strong> | <strong>abc@xyz</strong>
	</td>
	
	</tr>
	</tbody>
	</table>
	';
	$html .= '
	<table>
	<tbody>
	<tr>
	<td>Invoice to<br/>
	<strong>'.$customer.'</strong>
	<br/>
	'.$address.'
	</td>
	<td align="right">
	<strong>Total Due: $'.$total.'</strong><br/>
	Tax ID: ABCDEFGHIJ12345<br/>
	Invoice Date: '.date('d-m-Y').'
	</td>
	</tr>
	</tbody>
	</table>
	';
	$html .= '
	<table>
	<thead>
	<tr style="font-weight:bold;">
	<th>Item name</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Total</th>
	</tr>
	</thead>
	<tbody>';
	for($i = 0; $i <sizeof($item_name); $i++)
	{
		$each_item = $item_name[$i];
		$each_price = $price[$i];
		$each_quantity = $quantity[$i];
		$each_total = $each_price*$each_quantity;
		$html .= '
		<tr>
		<td style="border-bottom: 1px solid #222">'.$each_item.'</td>
		<td style="border-bottom: 1px solid #222">$'.$each_price.'</td>
		<td style="border-bottom: 1px solid #222">'.$each_quantity.'</td>
		<td style="border-bottom: 1px solid #222">$'.$each_total.'</td>
		</tr>
		';
	}
	$html .='
	<tr align="right">
	<td colspan="4"><strong>Grand total: $'.$total.'</strong></td>
	</tr>
	<tr>
	<td colspan="4">
	<h2>Thank you for your business.</h2><br/>
	<strong>Terms and conditions:<br/></strong>
	Make it look like digital big boy pants we need to leverage our synergies. Digital literacy productize and fire up your browser fast track.
	</td>
	</tr>
	</tbody>
	</table>
	';
	//end content
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// set default monospaced font
	// set margins
	$pdf->SetMargins(-1, 0, -1);
	// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	// set default font subsetting mode
	$pdf->setFontSubsetting(true);
	// Set font
	// dejavusans is a UTF-8 Unicode font, if you only need to
	// print standard ASCII chars, you can use core fonts like
	// helvetica or times to reduce file size.
	$fontname = TCPDF_FONTS::addTTFfont('ubuntu.ttf', 'TrueTypeUnicode', '', 96);
	$fontbold = TCPDF_FONTS::addTTFfont('ubuntuB.ttf', 'TrueTypeUnicode', '', 96);
	$pdf->SetFont($fontname, '', 10);
	$pdf->AddPage();
	// Print text using writeHTMLCell()
	$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
	//$pdf->Output(dirname(__FILE__).'example_001.pdf', 'F');
	$pdf_name = ''.$customer.time().'.pdf';
	//$pdf_name = 'test.pdf';
	ob_end_flush();
	$pdf->Output(dirname(__FILE__).'/invoice/'.$pdf_name.'', 'F');
	echo 'PDF saved. <a href="invoice/'.$pdf_name.'">View</a>';
}
?>