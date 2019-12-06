const CART = {
  KEY: "cart-123",
  contents: [],

  init() {
    let _contents = localStorage.getItem(CART.KEY);
    if (_contents) {
      CART.contents = JSON.parse(_contents);
    } else {
      CART.contents = []
      CART.sync()
    }
  },
  async sync() {
    let _cart = JSON.stringify(CART.contents);
    await localStorage.setItem(CART.KEY, _cart);
  },
  find(id) {
    //find an item in the cart by it's id
    let match = CART.contents.filter(item => {
      if (item.id == id) return true;
    });
    if (match && match[0]) return match[0];
  },
  add(id) {
    //add a new item to the cart
    //check that it is not in the cart already
    if (CART.find(id)) {
      CART.increase(id, 1);
    } else {
      let arr = PRODUCTS.filter(product => {
        if (product.id == id) {
          return true;
        }
      });
      if (arr && arr[0]) {
        let obj = {
          id: arr[0].id,
          name: arr[0].name,
          qty: 1,
          itemPrice: arr[0].price,
          image: arr[0].image
        };
        CART.contents.push(obj);
        //update localStorage
        CART.sync();
      } else {
        //product id does not exist in products data
        console.error("Invalid Product");
      }
    }
  },
  increase(id, qty = 1) {
    //increase the quantity of an item in the cart
    CART.contents = CART.contents.map(item => {
      if (item.id === id) item.qty = item.qty + qty;
      return item;
    });
    //update localStorage
    CART.sync();
  },
  reduce(id, qty = 1) {
    //reduce the quantity of an item in the cart
    CART.contents = CART.contents.map(item => {
      if (item.id === id) item.qty = item.qty - qty;
      return item;
    });
    CART.contents.forEach(async item => {
      if (item.id === id && item.qty === 0) CART.remove(id);
    });
    //update localStorage
    CART.sync();
  },
  changeQty(id, qty) {
    CART.contents = CART.contents.map((item) => {
      if(item.id === id) item.qty = qty
      return item
    })
    CART.contents.forEach((item) => {
      if(item.id === id && item.qty === 0) CART.remove(id)
    })
    CART.sync()
  },
  remove(id) {
    //remove an item entirely from CART.contents based on its id
    CART.contents = CART.contents.filter(item => {
      if (item.id !== id) return true;
    });
    //update localStorage
    CART.sync();
  },
  empty() {
    //empty whole cart
    CART.contents = [];
    //update localStorage
    CART.sync();
  },
  sort(field = "name") {
    //sort by field - name, price
    //return a sorted shallow copy of the CART.contents array
    let sorted = CART.contents.sort((a, b) => {
      if (a[field] > b[field]) {
        return 1;
      } else if (a[field] < a[field]) {
        return -1;
      } else {
        return 0;
      }
    });
    return sorted;
    //NO impact on localStorage
  },
  logContents(prefix) {
    console.log(prefix, CART.contents);
  },
  count() {
    if (CART.contents.length == 0) return 0
    return CART.contents.reduce((acc, item) => {
      return acc += 1
    }, 0)
  },
  subTotal() {
    if (CART.contents.length == 0) return 0
    return CART.contents.reduce((acc, item) => {
      return acc += (item.qty * item.itemPrice)
    }, 0)
  },

  formatMoney(number) {
    return new Intl.NumberFormat("vn-VN", {
      style: "currency",
      currency: "VND"
    }).format(number)
  }
  

};

function showCart() {
  let cartSection = document.getElementById("cartDetail");
  cartSection.innerHTML = "";
  let cartLocalStorage = CART.sort('qty');
  cartLocalStorage.forEach(item => {
    let cartitem = document.createElement("tr");

    let productImage = document.createElement('td')
    productImage.className = 'text-center'
    productImage.style = 'width: 70px'
    let imageLink = document.createElement('a')
    imageLink.href = `/products/${item.id}`
    let image = document.createElement('img')
    image.classList = ['lazyload preview']
    image.dataset.sizes = 'auto'
    image.src = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='
    image.dataset.src = `/images/${item.image}`
    image.style = 'width: 70px'
    image.alt = item.name//title
    image.title = item.name//title
    imageLink.appendChild(image)
    productImage.appendChild(imageLink)
    cartitem.appendChild(productImage)

    let productName = document.createElement('td')
    productName.className = 'text-left'
    let productLink = document.createElement('a')
    productLink.href = `/products/${item.id}`
    productLink.textContent = item.name
    productName.appendChild(productLink)
    cartitem.appendChild(productName)

    let productQty = document.createElement('td')
    productQty.className = 'text-center'
    productQty.textContent = `x${item.qty}`
    cartitem.appendChild(productQty)

    let productPrice = document.createElement('td')
    productPrice.className = 'text-center'
    productPrice.textContent = CART.formatMoney(item.qty * item.itemPrice)
    cartitem.appendChild(productPrice)

    let productRemove = document.createElement('td')
    productRemove.className = 'text-right'
    let btnRemove = document.createElement('a')
    btnRemove.classList = ['fa fa-times fa-delete']
    btnRemove.dataset.id = item.id
    btnRemove.addEventListener('click', decrementCart)
    productRemove.appendChild(btnRemove)
    cartitem.appendChild(productRemove)
    cartSection.appendChild(cartitem);

    if (CART.contents.length !== 0) {
      document.getElementById('totalAmount').innerHTML = CART.count()
      document.getElementById('subTotal').innerHTML = CART.formatMoney(CART.subTotal())
      document.getElementById('total').innerHTML = CART.formatMoney(CART.subTotal())
    }

  });
}

function incrementCart(ev) {
  ev.preventDefault();
  let id = parseInt(ev.target.getAttribute("data-id"));
  CART.increase(id, 1);
  let controls = ev.target.parentElement;
  let qty = controls.querySelector("span:nth-child(2)");
  let item = CART.find(id);
  if (item) {
    qty.textContent = item.qty;
  } else {
    document.getElementById("cart").removeChild(controls.parentElement);
  }
}

function decrementCart(ev) {
  ev.preventDefault();
  let id = parseInt(ev.target.getAttribute("data-id"));
  CART.reduce(id, 1);
  showCart()
  viewDetailCart()
  if (CART.contents.length == 0) {
    document.getElementById('totalAmount').innerHTML = 0
    document.getElementById('subTotal').innerHTML = 0
    document.getElementById('total').innerHTML = 0
  }
}

function getProducts(success, failure) {
  //request the list of products from the "server"
  const URL =
    "/api/products";
  fetch(URL, {
    method: "GET",
    mode: "cors"
  })
    .then(response => response.json())
    .then(showProducts)
    .catch(err => {
      errorMessage(err.message);
    });
}

function showProducts(products) {
  PRODUCTS = products;
  console.log(PRODUCTS);
}

function addItem(ev) {
  ev.preventDefault();
  let id = parseInt(ev.target.getAttribute("data-id"));
  console.log("add to cart item", id);
  CART.add(id);
  showCart();
  viewDetailCart()
}

function errorMessage(err) {
  //display the error message to the user
  console.error(err);
}
function changeCartQty(ev) {
  ev.preventDefault()
  let id = parseInt(ev.target.dataset.id)
  if(!id){
    alert('Thao tác từ từ thôi, hú yeah com\'on bae ')
    return
  } 
  let qty = document.getElementById(`qty-${id}`).value
  CART.changeQty(id, qty)
  console.log(qty, id)
  showCart()
  viewDetailCart()
}
const btnAddToCarts = document.getElementsByClassName('addToCart')
for (const btn of btnAddToCarts) {
  btn.addEventListener('click', addItem)
}
function viewDetailCart() {
  let cartOfView = CART.sort('qty')
  let cartSectionOfView = document.getElementById('viewDetailCart')
  if(!cartSectionOfView) return false
  cartSectionOfView.innerHTML = ''
  cartOfView.forEach( item => {
    let trProduct = document.createElement('tr')
    let tdProductImage = document.createElement('td')
    tdProductImage.className = 'text-center'
    let aProductImage = document.createElement('a')
    aProductImage.href = `/products/${item.id}`
    let imgProductImage = document.createElement('img')
    imgProductImage.style = 'width: 100px'
    imgProductImage.src = `/images/${item.image}`
    imgProductImage.title = item.name
    imgProductImage.alt = item.name
    imgProductImage.className = 'img-thumbnail'

    aProductImage.appendChild(imgProductImage)
    tdProductImage.appendChild(aProductImage)
    trProduct.appendChild(tdProductImage)

    let tdProductName = document.createElement('td')
    tdProductName.className = 'text-left'
    let aProductName = document.createElement('a')
    aProductName.href = `/products/${item.id}`
    aProductName.textContent = item.name
    tdProductName.appendChild(aProductName)
    trProduct.appendChild(tdProductName)

    
    let tdProductQty = document.createElement('td')
    tdProductQty.className = 'text-left'
    tdProductQty.width = '200px'
    let divProductQty = document.createElement('div')
    divProductQty.classList = ['input-group btn-block quantity']
    let inputProductQty = document.createElement('input')
    inputProductQty.type = 'number'
    inputProductQty.min = 0
    inputProductQty.name = 'quantity'
    inputProductQty.setAttribute('value', item.qty)
    inputProductQty.id = 'qty-' + item.id
    inputProductQty.size = 1
    inputProductQty.className = 'form-control'

    let spanProductQty = document.createElement('span')
    spanProductQty.classList = ['input-group-btn']
    let buttonProductQtyRefresh = document.createElement('button')
    buttonProductQtyRefresh.type = 'button'
    buttonProductQtyRefresh.dataset.toggle = 'tooltip'
    buttonProductQtyRefresh.dataset.id = item.id
    buttonProductQtyRefresh.title = 'Sửa'
    buttonProductQtyRefresh.classList = ['btn btn-primary']
    buttonProductQtyRefresh.innerHTML = '<i class="fa fa-refresh"></i>'
    buttonProductQtyRefresh.addEventListener('click', changeCartQty)//function refresh
    let buttonProductQtyRemove = document.createElement('button')
    buttonProductQtyRemove.type = 'button'
    buttonProductQtyRemove.dataset.toggle = 'tooltip'
    buttonProductQtyRemove.dataset.id = item.id
    buttonProductQtyRemove.addEventListener('click', decrementCart)
    buttonProductQtyRemove.title = 'Bỏ'
    buttonProductQtyRemove.classList = ['btn btn-danger']
    buttonProductQtyRemove.innerHTML = '<i class="fa fa-times-circle"></i>'

    spanProductQty.appendChild(buttonProductQtyRefresh)
    spanProductQty.appendChild(buttonProductQtyRemove)
    divProductQty.appendChild(inputProductQty)
    divProductQty.appendChild(spanProductQty)
    tdProductQty.appendChild(divProductQty)
    trProduct.appendChild(tdProductQty)

    let tdProductPrice = document.createElement('td')
    tdProductPrice.className = 'text-right'
    tdProductPrice.textContent = CART.formatMoney(item.itemPrice)
    trProduct.appendChild(tdProductPrice)

    let tdProductSubTotal = document.createElement('td')
    tdProductSubTotal.className = 'text-right'
    tdProductSubTotal.textContent = CART.formatMoney(item.itemPrice * item.qty)
    trProduct.appendChild(tdProductSubTotal)

    cartSectionOfView.appendChild(trProduct)
  })
}

let PRODUCTS = [];

document.addEventListener("DOMContentLoaded", () => {
  //when the page is ready
  getProducts(showProducts, errorMessage);
  //get the cart items from localStorage
  CART.init()
  //load the cart items
  showCart()
  viewDetailCart()
});
