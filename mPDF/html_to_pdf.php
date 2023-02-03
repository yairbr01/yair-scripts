<?php
// Short example of creating a PDF file from an Elementor template. Supports Hebrew with an custom font

$template = do_shortcode( '[elementor-template id="74123"]' );
		
$template = preg_replace( '/\border_rows\b/u', $order_rows_str, $template );
$template = preg_replace( '/\bclient_name\b/u', $client_name, $template );
$template = preg_replace( '/\bemail\b/u', $email, $template );
$template = preg_replace( '/\bphone\b/u', $phone, $template );
$template = preg_replace( '/\bsummary\b/u', $summary, $template );
$template = preg_replace( '/\bremarks\b/u', $remarks, $template );
$template = preg_replace( '/\bdetails\b/u', $details, $template );
	
	
$params = array(
	'mode' => 'utf-8',
	'format' => 'A4',
);
$mpdf = new \Mpdf\Mpdf( $params );
	
$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;
$mpdf->SetDirectionality('rtl');
$mpdf->simpleTables = true;
		
$mpdf->fonttrans['taameydavidclm'] = 'almoni';
	
$mpdf->WriteHTML( $template );
	
	
$pdf_folder = '/pdf/';
$upload = wp_upload_dir();
$pdf_dir = $upload['basedir'] . $pdf_folder;
	
$client_pdf_file_name = $client_name_for_file_name . '-' . time() . ".pdf";
	
$mpdf->Output( $pdf_dir . $client_pdf_file_name, 'F' );
	
$client_pdf_path = $upload['baseurl'] . $pdf_folder . $client_pdf_file_name;
$client_pdf_path_basedir = $upload['basedir'] . $pdf_folder . $client_pdf_file_name;

?>
