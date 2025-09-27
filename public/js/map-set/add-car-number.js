// Получаем элементы DOM
var addCarBtn = document.getElementById("add-car-btn");
var addCarModal = document.getElementById("add-car-modal");
var carForm = document.getElementById("car-form");
var carList = document.getElementById("car-list");

// Показываем модальное окно при клике на кнопку
addCarBtn.onclick = function() {
  addCarModal.style.display = "block";
}

// Скрываем модальное окно при клике на кнопку закрытия
var closeBtn = addCarModal.getElementsByClassName("close")[0];
closeBtn.onclick = function() {
  addCarModal.style.display = "none";
}

// Добавляем машину в список при отправке формы
carForm.onsubmit = function(event) {
  event.preventDefault(); // предотвращаем отправку формы
  var number = document.getElementById("number").value;
  var letters = document.getElementById("letters").value;
  var digits = document.getElementById("digits").value;
  var passport = document.getElementById("passport").value;
  var photo = document.getElementById("photo").files[0];
  var defaultPhoto = 'images/add.svg'; // путь к фотографии по умолчанию

  // Создаем элементы DOM для новой машины
  var carItem = document.createElement("div");
  var carNumber = document.createElement("span");
  var carPhoto = document.createElement("img");
  var deleteBtn = document.createElement("button");

  // Устанавливаем атрибуты и содержимое элементов
  carNumber.textContent = number + " " + letters + " " + digits;

  if(photo) {
    carPhoto.src = URL.createObjectURL(photo);
  } else {
    carPhoto.src = defaultPhoto;
  }

  carPhoto.alt = number;
  carPhoto.width = 40;
  carPhoto.padding = 10;
  deleteBtn.textContent = "Удалить";

  // Добавляем классы и обработчик события кнопке удаления
  carItem.classList.add("car-item");
  carPhoto.classList.add("car-photo");
  deleteBtn.classList.add("delete-btn");
  deleteBtn.onclick = function() {
    carItem.remove();
  }

  // Добавляем элементы в DOM
  carItem.appendChild(carPhoto);
  carItem.appendChild(carNumber);
  carItem.appendChild(deleteBtn);
  carList.appendChild(carItem);

  // Скрываем модальное окно
  addCarModal.style.display = "none";

  // Сбрасываем значения формы
  carForm.reset();
}
