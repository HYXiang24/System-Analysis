document.addEventListener('DOMContentLoaded', () => {
    loadCartFromStorage(); // 從本地存儲加載購物車
    fetchDataAndStoreInLocalStorage();

    const checkoutButton = document.getElementById('checkoutButton');
    checkoutButton.addEventListener('click', () => {
        const myData = JSON.parse(localStorage.getItem('myData'));
        if (myData && myData.status === '1') {
            alert('店家忙碌中，請稍等15~20分鐘再嘗試訂餐');
            return; // 如果狀態為1，跳出函數，不執行後續程式碼
        }
        else{
            const now = new Date();
            const pickupTime = new Date(now.getTime() + 15 * 60 * 1000); // 15分鐘後
    
            // 格式化取餐時間
            const pickupTimeString = `${pickupTime.getHours()}:${pickupTime.getMinutes().toString().padStart(2, '0')}`;
    
            // 將結帳時間和取餐時間儲存到本地儲存
            localStorage.setItem('pickupTime', pickupTimeString);
            alert(`感謝您的購買！請您在 ${pickupTimeString} 取餐 ~~`); // 提示感謝購買並顯示取餐時間
            
            //傳送到資料庫中
            sendCartToServer(); 

            // 到明細頁面
            window.location.href = "detail.html";
        }
    });

    const backButton = document.getElementById('backButton');
    backButton.addEventListener('click', () => {
        window.location.href = 'order.html'; // 返回訂單頁面
    });


    function fetchDataAndStoreInLocalStorage() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_busy_status.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                localStorage.setItem('myData', JSON.stringify(data));
                console.log('Data stored in localStorage:', data);
            }
        };
        xhr.send();
    }
});

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

    if (cart.length === 0) {
        checkoutButton.disabled = true; // 禁用結帳按鈕
    } else {
        checkoutButton.disabled = false; // 啟用結帳按鈕
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

function sendCartToServer() {
    fetch('./cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(cart),
    })
    .then(response => response.json())
    .then(data => console.log('Success:', data))
    .catch((error) => console.error('Error:', error));
}

// 初始化並設置每秒更新一次
updateTime();
setInterval(updateTime, 1000);