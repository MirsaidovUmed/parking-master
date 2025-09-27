/*Кнопка поиска*/
 $(document).ready(function(){
  
  $(".fa-search").click(function(){
    $(".wrap, .input").toggleClass("active");
    $("input[type='text']").focus();
  });
  
});

/*Всплывающее окно*/

// выбираем все кнопки для открытия попапов
const openButtons = document.querySelectorAll('.open-popup');

// выбираем оверлей и контейнер для попапов
const overlay = document.getElementById('overlay');
const popupContainer = document.getElementById('popup-container');

// выбираем кнопки закрытия попапов
const closeButtons = popupContainer.querySelectorAll('.close-popup');

// обработчик клика на кнопке открытия попапа
openButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    // получаем ID попапа, который нужно открыть
    const popupId = button.getAttribute('data-popup-id');

    // выбираем соответствующий попап и делаем его видимым
    const popup = document.getElementById(popupId);
    popup.classList.add('active');

    // показываем оверлей
    overlay.style.display = 'block';
  });
});

// обработчик клика на кнопке закрытия попапа
closeButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    // выбираем родительский попап и скрываем его
    const popup = button.closest('.popup');
    popup.classList.remove('active');

    // скрываем оверлей
    overlay.style.display = 'none';
  });
});

// обработчик клика на оверлее
overlay.addEventListener('click', function(event) {
  // если клик был не на попапе, закрываем его
  if (event.target === overlay) {
    // скрываем родительский попап и оверлей
    const popup = document.querySelector('.popup.active');
    popup.classList.remove('active');
    overlay.style.display = 'none';
  }
});
