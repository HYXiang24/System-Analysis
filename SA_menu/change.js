(document).ready(function() {
    const changeForm = document.getElementById('changeForm');
  
    changeForm.addEventListener('submit', function(event) {
      event.preventDefault(); // 阻止表單的默認提交行為
  
      const itemName = document.getElementById('itemName').value;
      const itemPrice = document.getElementById('itemPrice').value;
      const itemImage = document.getElementById('itemImage').files[0]; // 取得上傳的圖片文件
  
      // 假設這裡要將修改後的資訊提交給後端處理
      console.log('修改後的菜品資訊：');
      console.log('菜品名稱：', itemName);
      console.log('價格：', itemPrice);
      console.log('圖片：', itemImage);
  
      // 清空表單
      changeForm.reset();
    });
  });
  