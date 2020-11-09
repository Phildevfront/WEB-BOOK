var  myvar= document.getElementById("fil");
var select = myvar.getElementsByClassName("link-filter");
for (var i = 0; i < select.length; i++) {
    select[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
}