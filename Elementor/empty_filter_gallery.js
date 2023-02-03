<script>
// Hiding a filter in the gallery widget if there are no images in the gallery

jQuery(document).ready(function () {
  var all_colection = document.getElementsByClassName('elementor-gallery-title');
    for (let i = 0; i < all_colection.length; i++) {
        var one_item = all_colection[i];
        var one_item_html = one_item.innerHTML;
        if (one_item_html === '') {
            one_item.classList.add("galley_hidden");
        }
    }
})

</script>
