<script>
// Validation on input for phone field and price field. The phone field must contain the word "phone" in its ID and the price field must contain the word "price" in its ID.
 
document.addEventListener('DOMContentLoaded', () => {	
    var price_fileds = document.querySelectorAll('[id*="price"]');	
    for (i = 0; i < price_fileds.length; ++i) {		
		new Cleave("#" + price_fileds[i].id, {			
            numeral: true,
            numeralDecimalMark: ".",
			prefix: "₪",
            delimiter: ","
		})
    }	
    var phone_fileds = document.querySelectorAll('[id*="phone"]');	
    for (i = 0; i < phone_fileds.length; ++i) {		
	    console.log(i);
		new Cleave("#" + phone_fileds[i].id, {			
            phone: true,
            delimiter: "-",
            phoneRegionCode: 'IL'
		})
    }	
});

</script>
