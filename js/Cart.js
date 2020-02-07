var books;

function getProdcuts() {
  books = new Array();
  for (let i = 0; i < localStorage.length; i++) {
    let key = localStorage.key(i);
    if (!isNaN(key)) {
      let product = localStorage.getItem(key);
      books.push(JSON.parse(product));
    }
  }
}
function chargeCart() {
  getProdcuts();
  // let contTotal = document.createElement("div");
  for (let i = 0; i < books.length; i++) {
    let cont = document.createElement("div");
    let contImg = document.createElement("div");
    let contInfo = document
      .createElement("div")
      .setAttribute("class", "infoItem");
    let contQuatity = document
      .createElement("div")
      .setAttribute("class", "quantity");
    let contPrice = document
      .createElement("div")
      .setAttribute("class", "price");
    let contDelete = document
      .createElement("div")
      .setAttribute("class", "deleteIcon");

    let img = document.createElement("img");
    let title = document.createElement("p");
    let info = document.createElement("i");
    let arrows = document.createElement("div");
    let up = document.createElement("i");
    let down = document.createElement("i");
    let quantity = document.createElement("i");
    let price = document.createElement("i");
    let currency = document.createElement("i");
    let deleteIcon = document.createElement("i");

    let otherItem = document.createElement("div");

    $(cont)
      .addClass("itemCart")
      .append([$(contImg).addClass("test"), $(img).addClass("test23")]);
    $(document.body)
      .find(".shoppingCart")
      .append(cont);
  }
}

chargeCart();
