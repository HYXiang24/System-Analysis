document.addEventListener('DOMContentLoaded', function() {
    const addForm = document.getElementById('addForm');
  
    addForm.addEventListener('submit', function(event) {
      event.preventDefault(); // 阻止表單的默認提交行為
  
      const itemName = document.getElementById('itemName').value;
      const itemPrice = document.getElementById('itemPrice').value;
      const itemImage = document.getElementById('itemImage').files[0]; // 取得上傳的圖片文件
  
      // 可以將取得的資訊提交給後端處理，例如使用 fetch API 或 Ajax 送出 POST 請求
      // 這裡只是示例，你需要根據你的後端處理方式進行相應的處理
  
      console.log('新增菜品資訊：');
      console.log('菜品名稱：', itemName);
      console.log('價格：', itemPrice);
      console.log('圖片：', itemImage);
      
      // 清空表單
      addForm.reset();
    });
  });
  