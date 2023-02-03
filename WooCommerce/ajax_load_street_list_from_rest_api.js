<script>
//

jQuery('#billing_city').on('change', function() {
    
    jQuery("#billing_address_1 option").remove();
    
    var city = jQuery(this).val().split('-')[0];
    
    jQuery.ajax({
      url: "{site_url}/wp-json/address/v1/get_streets?city=" + city,
      dataType: "json",
      success: function(data) {
        var name, select, option;
    
        select = document.getElementById('billing_address_1');
    
        for (name in data) {
          if (data.hasOwnProperty(name)) {
            select.options.add(new Option(data[name], name));
          }
        }
      }
    });
});
	
jQuery('#shipping_city').on('change', function() {
    
    jQuery("#shipping_address_1 option").remove();
    
    var city = jQuery(this).val().split('-')[0];
    
    jQuery.ajax({
      url: "{site_url}/wp-json/address/v1/get_streets?city=" + city,
      dataType: "json",
      success: function(data) {
        var name, select, option;
    
        select = document.getElementById('shipping_address_1');
    
        for (name in data) {
          if (data.hasOwnProperty(name)) {
            select.options.add(new Option(data[name], name));
          }
        }
      }
    });
});

</sctipt>
