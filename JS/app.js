var httpRequest = new XMLHttpRequest();
httpRequest.onreadystatechange = function () {
  if (httpRequest.readyState === 4) {
    document.getElementById("test").innerHTML = httpRequest.responseText;
  }
};
httpRequest.open("GET", this.getAttribute("href"), true);
httpRequest.send();
