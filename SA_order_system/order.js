let cart = [];
//把物件(餐點 包含name price quantity)加入localstorage cart裡面
function addToOrder(name, price) {
    const existingItem = cart.find(item => item.name === name);

    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({ name: name, price: price, quantity: 1 });
    }
    //同步更新購物車資訊
    updateCartDisplay();

    saveCartToStorage();
}
//同步更新購物車資訊
function updateCartDisplay() {
    const cartItems = document.getElementById('cartItems');
    const totalPrice = document.getElementById('totalPrice');

    cartItems.innerHTML = '';
    let total = 0;

    cart.forEach(item => {
        const li = document.createElement('li');
        li.textContent = `${item.name} x${item.quantity} - NT$${item.price * item.quantity}`;
        cartItems.appendChild(li);
        total += item.price * item.quantity;
    });

    totalPrice.textContent = `總金額: NT$${total}`;

    const cartButton = document.getElementById('cartButton');
    cartButton.textContent = `購物車 (${cart.length})`;
}

function saveCartToStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

document.addEventListener('DOMContentLoaded', () => {
    //暫無功用
    /* const cartButton = document.getElementById('cartButton');
    cartButton.addEventListener('click', () => {
        document.getElementById('cartContainer').style.display = 'block';
    }); */

    //檢查購物車是否是空的
    const checkoutButton = document.getElementById('checkoutButton');
    checkoutButton.addEventListener('click', () => {
        if (cart.length > 0) {
            window.location.href = "cart.html";
        } else {
            alert('購物車是空的，無法結帳。');
        }
    });
    //刷新網頁無法清空購物車
    //loadCartFromStorage();
});

function loadCartFromStorage() {
    const storedCart = localStorage.getItem('cart');

    if (storedCart) {
        cart = JSON.parse(storedCart);
        updateCartDisplay();
    }
}
//增加餐點按鈕
function increaseQuantity(name) {
    const item = cart.find(item => item.name === name);
    if (item) {
        item.quantity++;
        updateCartDisplay();
        saveCartToStorage();
    }
}
//減少餐點按鈕
function decreaseQuantity(name) {
    const item = cart.find(item => item.name === name);
    if (item && item.quantity > 1) {
        item.quantity--;
        updateCartDisplay();
        saveCartToStorage();
    } else if (item && item.quantity === 1) {
        cart = cart.filter(item => item.name !== name);
        updateCartDisplay();
        saveCartToStorage();
    }
}
//點擊分類快速移動至該分類
function scrollToCategory(categoryId) {
    const categorySection = document.getElementById(categoryId);
    if (categorySection) {
        categorySection.scrollIntoView({ behavior: 'smooth' });
    }
}

function updateTime() {
    const timeElement = document.getElementById('time');
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    timeElement.textContent = `${hours}:${minutes}:${seconds}`;
}

// 初始化並設置每秒更新一次
updateTime();
setInterval(updateTime, 1000);
