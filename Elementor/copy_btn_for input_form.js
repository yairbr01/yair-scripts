<script>
// Creating a button to copy a field from a form

function CopyUrlFromInput() {
    var copyText = document.getElementById("form-field-url");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    document.querySelector("#copy-btn span").innerHTML = "הועתק";
    document.querySelector("#copy-btn span").style.color = "#BB0205";
}
document.getElementById("copy-btn").addEventListener("click", CopyUrlFromInput);
document.getElementById("form-field-url").addEventListener("click", CopyUrlFromInput);

</script>
