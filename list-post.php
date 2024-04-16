<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Popup Generate</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
  .popup-generate {
    display: none;
  }
  .loading-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    color: white;
    font-size: 24px;
    text-align: center;
    padding-top: 50vh;
  }
</style>
</head>
<body>
<a href="/pdf-template.php?num_cost=&post_id=11111" class="generate-pdf" data-post-id="11111">Generate1</a> <br><br>
<a href="/pdf-template.php?num_cost=&post_id=22222" class="generate-pdf" data-post-id="22222">Generate2</a> <br><br>
<a href="/pdf-template.php?num_cost=&post_id=3333" class="generate-pdf" data-post-id="3333">Generate3</a> <br><br>
<div class="popup-generate">
  <input type="number" class="num_cost" value="">
  <button type="button" class="send-data">Send</button>
</div>
<div class="loading-overlay">
  Generating file... Please wait.
</div>

<script>
$(document).ready(function() {
  $(".generate-pdf").click(function(event) {
    event.preventDefault(); // Предотвращаем стандартное действие ссылки
    var href = $(this).attr('href');
    var popupGenerate = $('.popup-generate');
    var numCostInput = popupGenerate.find('.num_cost');
    var postId = $(this).data('post-id');
    var loadingOverlay = $('.loading-overlay');

    // Показываем popup-generate
    popupGenerate.show();

    // При клике на кнопке "Send"
    $(".send-data").off('click').click(function() {
      var numCost = numCostInput.val().trim();
      var updatedHref = href.replace(/num_cost=([^&]*)/, 'num_cost=' + numCost);
      updatedHref = updatedHref.replace(/post_id=([^&]*)/, 'post_id=' + postId);
      popupGenerate.hide();
      numCostInput.val(""); // Очищаем поле num_cost
      // Показываем индикатор загрузки
      loadingOverlay.show();
      
      // Отправляем данные на сервер
      $.ajax({
        type: "GET",
        url: updatedHref,
        success: function(data) {
          // В случае успеха ничего не делаем здесь
        },
        complete: function() {
          // Переходим по ссылке только после завершения запроса
          window.location.href = updatedHref;
          // Скрываем сообщение о загрузке после завершения перехода на страницу
          loadingOverlay.hide();
        }
      });
    });
  });
  
});
</script>
</body>
</html>
