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
  let contTotal = document.createElement("div");
  let currency = document.createElement("i");
  $(currency).text("€");
  for (let i = 0; i < books.length; i++) {
    if (books[i].img == "") books[i].img = "no-img.jpg";
    let cont = document.createElement("div");
    let contImg = document.createElement("div");
    let contInfo = document.createElement("div");
    let contQuatity = document.createElement("div");
    let contPrice = document.createElement("div");
    let contDelete = document.createElement("div");

    let img = document.createElement("img");
    $(img).attr({ src: "src/userImg/" + books[i].img, width: "50px" });

    let title = document.createElement("p");
    $(title)
      .addClass("title")
      .text(books[i].title);

    let info = document.createElement("i");
    $(info)
      .addClass("information")
      .text("write by: " + books[i].author);

    let arrows = document.createElement("div");
    let up = document.createElement("i");
    $(up)
      .addClass("fas fa-sort-up")
      .on("click", function() {
        books[i].quantity++;
        $(quantity).text(books[i].quantity);
        $(price).text(
          (parseInt(books[i].quantity) * parseFloat(books[i].price)).toFixed(2)
        );
      });
    let down = document.createElement("i");
    $(down)
      .addClass("fas fa-sort-down")
      .on("click", function() {
        if (books[i].quantity > 1) books[i].quantity--;
        else deleteElement();
        $(quantity).text(books[i].quantity);
        $(price).text(
          (parseInt(books[i].quantity) * parseFloat(books[i].price)).toFixed(2)
        );
      });
    $(arrows)
      .addClass("up-down")
      .append([up, down]);
    let quantity = document.createElement("i");
    $(quantity).text(books[i].quantity);

    let price = document.createElement("i");

    $(price).text(
      (parseInt(books[i].quantity) * parseFloat(books[i].price)).toFixed(2)
    );

    let deleteIcon = document.createElement("i");
    $(deleteIcon)
      .addClass("fas fa-trash-alt")
      .on("click", deleteElement);

    let otherItem = document.createElement("div");
    $(otherItem).addClass("otherItem");

    $(contImg)
      .addClass("img")
      .append(img);
    $(contInfo)
      .addClass("infoItem")
      .append([title, info]);
    $(contQuatity)
      .addClass("quanttiy")
      .append([arrows, quantity]);
    $(contPrice)
      .addClass("price")
      .append([price, currency]);
    $(contDelete)
      .addClass("deleteIcon")
      .append(deleteIcon);

    $(cont)v
      .addClass("itemCart")
      .attr("id", i)
      .append([contImg, contInfo, contQuatity, contPrice, contDelete]);
    $(document.body)
      .find(".shoppingCart")
      .append([cont, otherItem]);
  }
  
  $(document.body).find(".shoppingCart").append(contTotal);
}


function deleteElement(){
  alert(this);
}

chargeCart();
