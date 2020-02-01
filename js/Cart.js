var books = new Array();

function getProdcuts() {
  for (let i = 0; i < localStorage.length; i++) {
    let key = localStorage.key(i);
    let product = localStorage.getItem(key);
    books.push(JSON.parse(product));
  }
}
