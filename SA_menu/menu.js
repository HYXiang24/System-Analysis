document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-edit');
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const addButton = document.querySelector('.btn-add');
    
    editButtons.forEach(button => {
      button.addEventListener('click', function() {
        // 在這裡處理修改按鈕的點擊事件
        window.location.href = 'change.html';
      });
    });
  
    deleteButtons.forEach(button => {
      button.addEventListener('click', function() {
        // 在這裡處理刪除按鈕的點擊事件
        const confirmed = confirm('確定要刪除這個菜品嗎？');
        if (confirmed) {
          const item = button.closest('.menu-item');
          item.remove(); // 刪除該項目
        }
      });
    });
  });
  
  