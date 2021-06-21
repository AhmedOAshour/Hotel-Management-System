function search(){
  var bar = document.getElementById("search").value;
  if(bar==""){
    var cards = document.getElementsByClassName("card");
    for (var i = 0; i < cards.length; i++) {
      cards[i].style.display = "block";
    }
  }
  else {
    // var cards = document.getElementsByClassName("Single");
    var cards = document.getElementsByClassName("card");
    for (var i = 0; i < cards.length; i++) {
      cards[i].style.display = "none";
    }
    var cards = document.getElementsByClassName(bar);
    for (var i = 0; i < cards.length; i++) {
      cards[i].style.display = "block";
    }
  }
}

function selectType(element){
  console.log(element.value);
  var div = document.getElementById(element.value);
  if (div.style.display == "none") {
    div.style.display = "block";
  }
  else {
    div.style.display = "none";
  }

}
