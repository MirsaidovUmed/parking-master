const cardForm = document.getElementById('card-form');
const addCardBtn = document.getElementById('add-card-btn');
const modal = document.getElementById('modal');
const cardList = document.getElementById('card-list');

// Открываем модальное окно при клике на кнопку "Добавить"
addCardBtn.addEventListener('click', () => {
  modal.style.display = 'block';
});

// Обработчик отправки формы
cardForm.addEventListener('submit', (event) => {
  event.preventDefault();

  const name = cardForm.elements['name'].value;
  const cardNumber = cardForm.elements['card-number'].value;
  const cardType = cardForm.elements['card-type'].value;

  // Проверяем данные карты на корректность
  if (!isValidCard(name, cardNumber, cardType)) {
    alert('Проверьте правильность введенных данных карты');
    return;
  }

  // Добавляем новую карту в список
  const cardItem = document.createElement('div');
  cardItem.classList.add('card-item');
  cardItem.textContent = `${cardType} ${name} **** **** **** ${cardNumber.slice(-4)}`;

  const deleteBtn = document.createElement('button');
  deleteBtn.textContent = 'Удалить';
  deleteBtn.addEventListener('click', () => {
    cardItem.remove();
  });
  cardItem.appendChild(deleteBtn);

  cardList.appendChild(cardItem);

  // Очищаем форму и закрываем модальное окно
  cardForm.reset();
  modal.style.display = 'none';
    
     // Сбрасываем значения формы
  carForm.reset();
}