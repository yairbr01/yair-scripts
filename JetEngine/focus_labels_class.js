<script>
// Add class "focused" to labels on focus on field in form. use it for floating labels.

jQuery("input , textarea").focus(function(){
  jQuery(this).parents('.jet-form-row').addClass('focused');
});

jQuery("input , textarea").blur(function(){
  var inputValue = jQuery(this).val();
  if ( inputValue == "" ) {
    jQuery(this).parents('.jet-form-row').removeClass('focused');  
  }
});

</script>
