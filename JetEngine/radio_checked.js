<script>
// Add class "radio_checked" when user select radio item on forms.

jQuery(document).ready(function ($) {
   $('input[type="radio"]').click(function () {
        $('input[type="radio"]').on("change", function() {
        $('div').removeClass('radio_checked');
        $(this).parent().parent().toggleClass('radio_checked', this.checked);
        });
    });
})

</script>
