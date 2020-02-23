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
  let contTotal = document.createElement("div");
  let contBuy = document.createElement("div");
  let total = 0;
  let textTotal = document.createElement("p");
  let currency = document.createElement("i");
  $(currency).text("€");
  let buy = document.createElement("button");
  let returnBuy = document.createElement("button");

  for (let i = 0; i < books.length; i++) {
    if (books[i].img == "") books[i].img = "no-img.jpg";
    total += parseInt(books[i].quantity) * parseFloat(books[i].price);
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
      .text("written by: " + books[i].author);

    let arrows = document.createElement("div");
    let up = document.createElement("i");
    $(up)
      .addClass("fas fa-sort-up")
      .on("click", function() {
        books[i].quantity++;
        $(quantity).text(books[i].quantity);
        $(price).text(
          (parseInt(books[i].quantity) * parseFloat(books[i].price)).toFixed(
            2
          ) + $(currency).text()
        );
        total += parseInt(books[i].price);
        $(".totalText").text("TOTAL: " + total.toFixed(2) + $(currency).text());
      });
    let down = document.createElement("i");
    $(down)
      .addClass("fas fa-sort-down")
      .on("click", function() {
        if (books[i].quantity > 1) {
          books[i].quantity--;
          total -= parseInt(books[i].price);
        } else deleteItem(books[i].id, i);
        $(quantity).text(books[i].quantity);
        $(price).text(
          (parseInt(books[i].quantity) * parseFloat(books[i].price)).toFixed(
            2
          ) + $(currency).text()
        );

        $(".totalText").text("TOTAL: " + total.toFixed(2) + $(currency).text());
      });
    $(arrows)
      .addClass("up-down")
      .append([up, down]);
    let quantity = document.createElement("i");
    $(quantity).text(books[i].quantity);

    let price = document.createElement("i");

    $(price).text(
      (parseInt(books[i].quantity) * parseFloat(books[i].price)).toFixed(2) +
        $(currency).text()
    );

    let deleteIcon = document.createElement("i");
    $(deleteIcon)
      .addClass("fas fa-trash-alt")
      .on("click", function() {
        $("." + i).remove();

        localStorage.removeItem("" + books[i].id);

        let bookDeleted = new FormData();
        bookDeleted.append("id", books[i].id);

        fetch("cart/db_delete_itemCart.php", {
          method: "POST",
          body: bookDeleted
        });

        getProdcuts();
        if (books.length <= 0) $(".total").remove();
      });

    let otherItem = document.createElement("div");
    $(otherItem).attr({ class: "otherItem " + i });

    $(contImg)
      .addClass("img")
      .append(img);
    $(contInfo)
      .addClass("infoItem")
      .append([title, info]);
    $(contQuatity)
      .addClass("quantity")
      .append([arrows, quantity]);
    $(contPrice)
      .addClass("price")
      .append(price);
    $(contDelete)
      .addClass("deleteIcon")
      .append(deleteIcon);

    $(cont)
      .addClass("itemCart " + i)
      .append([contImg, contInfo, contQuatity, contPrice, contDelete]);
    $(document.body)
      .find(".shoppingCart")
      .append([cont, otherItem]);
  }
  $(buy)
    .attr({ class: "buy" })
    .text("finish")
    .on("click", checkDataBook);

  $(returnBuy)
    .attr("class", "return")
    .text("return shopping")
    .on("click", function() {
      window.location = "index.php";
    });

  $(contBuy)
    .addClass("buttonPanel")
    .append([returnBuy, buy]);

  $(textTotal)
    .addClass("totalText")
    .text("TOTAL: " + total.toFixed(2) + $(currency).text());

  $(contTotal)
    .addClass("total")
    .append([returnBuy, buy, textTotal]);

  $(document.body)
    .find(".shoppingCart")
    .append(contTotal);
}

function deleteItem(id, pos) {
  localStorage.removeItem("" + id);
  $("." + pos).remove();

  let bookDeleted = new FormData();
  bookDeleted.append("id", id);

  fetch("cart/db_delete_itemCart.php", {
    method: "POST",
    body: bookDeleted
  });
  getProdcuts();
  if (books.length <= 0) $(".total").remove();
}

function checkDataBook() {
  Promise.all(
    books.map(book => {
      let bookData = new FormData();
      bookData.append("id", book.id);
      bookData.append("quantity", book.quantity);
      bookData.append("price", book.price);
      return fetch("cart/db_check_dataBook.php", {
        method: "POST",
        body: bookData
      })
        .then(answer => answer.json())
        .then(answer => {
          if (answer.correct == "false")
            changeData(answer.id, answer.price, answer.quantity, answer.title);
        });
    })
  ).then(() => {
    finishShop();
  });
}

function changeData(id, price, quantity, title) {
  alert("We sorry, but the book: " + title + " changes the dates");
  let actualBook = JSON.parse(localStorage.getItem(id));
  actualBook.quantity = quantity;
  actualBook.price = price;
  localStorage.setItem(id, JSON.stringify(actualBook));
  // $(".itemCart , .otherItem, .total").remove();
  // getProdcuts();
  // chargeCart();
}

function finishShop() {
  if (confirm("Do you wanna finish the cart?")) {
    //localStorage.clear();
    $(".itemCart").each(function() {
      let $item = $(this);
      let itemData = new FormData();
      itemData.append("title", $item.find($(".title")).text());
      itemData.append(
        "quantity",
        $item
          .find($(".quantity"))
          .find("i")
          .text()
      );

      fetch("cart/db_finish_cart.php", {
        method: "POST",
        body: itemData
      })
        .then(x => x.json())
        .then(x => console.log(x));
    });
    //getProdcuts();
    //chargeCart();
  }
}

/** Start the activity */
getProdcuts();
if (books.length > 0) chargeCart();
