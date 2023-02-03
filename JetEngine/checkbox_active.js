<script>
// Add class "checkbox_active" when user click on checkbox item in forms.

jQuery(document).ready(function ($) {
   function check() {
        var $checkbox = $(this);
        if ($checkbox.is(':checked')) {
            $($checkbox).closest('.jet-form__field-label').addClass("checkbox_active");
        } else {
            $($checkbox).closest('.jet-form__field-label').removeClass("checkbox_active");
        }
   }
	$('input[type=checkbox]').not('input[name="property_agreement"]').each(check).change(check);	
})	

</script>
