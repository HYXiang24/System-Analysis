document.addEventListener('DOMContentLoaded', () => {
    loadCartFromStorage(); // 從本地存儲加載購物車
    picktime();
});

//更新時間
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

let cart = []; // 購物車陣列

function loadCartFromStorage() {
    const storedCart = localStorage.getItem('cart');

    if (storedCart) {
        cart = JSON.parse(storedCart); // 解析本地存儲的購物車資料
        updateCartDisplay(); // 更新購物車顯示
    }
}

function updateCartDisplay() {
    const cartItems = document.getElementById('cartItems'); // 購物車項目
    const totalPrice = document.getElementById('totalPrice'); // 總價格

    cartItems.innerHTML = ''; // 清空購物車項目
    let total = 0; // 總金額

    cart.forEach(item => {
        const li = document.createElement('li'); // 創建列表項目
        li.textContent = `${item.name} x${item.quantity} - NT$${item.price * item.quantity}`; // 列表項目內容
        cartItems.appendChild(li); // 加入至購物車項目
        total += item.price * item.quantity; // 計算總金額
    });

    totalPrice.textContent = `總金額: NT$${total}`; // 顯示總金額

}

function picktime(){
    const PickTime = document.getElementById('pickuptime');
    const li = document.createElement('li');
    li.textContent = localStorage.getItem('pickupTime');
    PickTime.appendChild(li); 
}