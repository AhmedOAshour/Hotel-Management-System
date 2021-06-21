function search(){
  var bar = document.getElementById("search").value;
  if(bar==""){
    var cards = document.getElementsByClassName("card");
    for (var i = 0; i < cards.length; i++) {
      cards[i].style.display = "block";
    }
  }
  else {
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
