function test() {
  var p = document.getElementsByClassName("test");
  // NOTE: showAlert(); ou showAlert(param); NE fonctionne PAS ici.
  // Il faut fournir une valeur de type function (nom de fonction déclaré ailleurs ou declaration en ligne de fonction).
  p.onclick = showAlert;
}

function showAlert() {
  alert("Evènement de click détecté");
}
function changeColor(tr) {
  tr.style.backgroundColor = "#fa4";
}
