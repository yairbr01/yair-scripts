<?php
// Allow VCF file uploud

function _enable_vcard_upload( $mime_types ){
  $mime_types['vcf'] = 'text/vcard';
  $mime_types['vcard'] = 'text/vcard';
  return $mime_types;
}
add_filter('upload_mimes', '_enable_vcard_upload' );

?>
