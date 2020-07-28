var form = document.querySelector("form.doc-list");
form.onsubmit = function(){
    var btn = document.querySelector("input[type=submit]:focus");
    var id = btn.getAttribute("id");
    id = id.split("e")['1'];
    btn.setAttribute("value", id);
}