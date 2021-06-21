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
  var div = document.getElementById(element.value);
  if (div.style.display == "none") {
    div.style.display = "block";
  }
  else {
    div.style.display = "none";
  }
}

function selectStatus(element){
  console.log(element);
  var card = document.getElementsByClassName(element.value);
  for (var i = 0; i < card.length; i++) {
    if (element.checked) {
      card[i].style.display = "block";
    }
    else {
      card[i].style.display = "none";
    }
  }

}
