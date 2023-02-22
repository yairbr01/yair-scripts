<script>
// This script works with select2 and runs when a city field option is selected. The script then calls the streets REST API and loads the streets specific to this city.

jQuery('#city').on('select2:select', function (e) {
    var data = e.params.data;
    
    jQuery("#street option").remove();
    var city = data.text;
    
    jQuery.ajax({
      url: "{site_url}/wp-json/address/v1/get_streets?city=" + city,
      dataType: "json",
      success: function(data) {
        var name, select, option;
    
        select = document.getElementById('street');
    
        for (name in data) {
          if (data.hasOwnProperty(name)) {
            select.options.add(new Option(data[name], name));
          }
        }
      }
    });
});
    
</script>
