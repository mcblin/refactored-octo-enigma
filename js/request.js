window.addEventListener('DOMContentLoaded', (event) => {
    // Находим все инпуты типа number
    const numberInputs = document.querySelectorAll('input[type="number"]');

    // Для каждого найденного инпута
    numberInputs.forEach(input => {
        // Добавляем обработчик события фокуса (когда инпут получает фокус)
        input.addEventListener('focus', function() {
            // Если значение инпута равно "0", очищаем его
            if (this.value === "0") {
                this.value = "";
            }
        });

        // Добавляем обработчик события размытия (когда инпут теряет фокус)
        input.addEventListener('blur', function() {
            // Если значение инпута пустое, возвращаем "0"
            if (this.value === "") {
                this.value = "0";
            }
        });
    });
});

window.addEventListener('DOMContentLoaded', (event) => {
    // Находим форму
    const form = document.querySelector('form');

    // Находим модальное окно
    const modal = document.getElementById('confirmationModal');

    // Находим кнопки в модальном окне
    const cancelButton = document.getElementById('cancelButton');
    const confirmButton = document.getElementById('confirmButton');

    // Отображаем модальное окно с содержимым формы
    function openModal() {
        const modalText = document.getElementById('modalText');
        const formData = new FormData(form);
        let modalContent = "<ul>";

        let isEmpty = true; // Флаг для проверки наличия ненулевых значений

        // Словарь с русскими названиями полей
        const fieldNames = {
            'sender': 'Класс',
            'Zst': 'Завтрак "Школьника" 5-11 класс',
            'Ost': 'Обед "Школьника" 5-11 класс',
            'Ovzs': 'ОВЗ с 5-11 класс',
            'Sb': 'Субботний буфет',
            'DZst': 'Сахарный диабет Завтрак "Школьника" 5-11 класс',
            'DOst': 'Сахарный диабет Обед "Школьника" 5-11 класс',
            'MB': 'Мобилизованные',
            'Nov': 'Меню "Новинка"',
            'Om': 'Школьный обед мини 5-11 класс',
            'Sc': 'Меню Социальное',
            'Zm': 'Школьный завтрак мини 5-11 класс'
        };

        formData.forEach((value, key) => {
            if (value !== "0") {
                modalContent += `<li>${fieldNames[key]}: ${value}</li>`; // Используем русские названия полей
                isEmpty = false;
            }
        });

        modalContent += "</ul>";

        if (isEmpty) {
            modalText.innerText = "Необходимо заполнить хотя бы одно поле числом.";
            return;
        }

        modalText.innerHTML = "Отправляем заявку?<br>" + modalContent;
        modal.style.display = "block";
        document.body.style.overflow = "hidden"; // Блокируем прокрутку страницы
    }

    // Скрываем модальное окно
    function closeModal() {
        modal.style.display = "none";
        document.body.style.overflow = "auto"; // Восстанавливаем прокрутку страницы
    }

    // Добавляем обработчик события отправки формы
    form.addEventListener('submit', function(event) {
        // Отменяем стандартное действие отправки формы
        event.preventDefault();
        // Отображаем модальное окно
        openModal();
    });

    // Добавляем обработчик события нажатия кнопки "Отмена"
    cancelButton.addEventListener('click', function() {
        // Скрываем модальное окно
        closeModal();
    });

    // Добавляем обработчик события нажатия кнопки "Отправить"
    confirmButton.addEventListener('click', function() {
        // Сабмитим форму
        form.submit();
    });

    // Находим элемент для закрытия модального окна
    const closeBtn = document.querySelector('.close');

    // Добавляем обработчик события клика на элемент закрытия модального окна
    closeBtn.addEventListener('click', function() {
        // Скрываем модальное окно
        closeModal();
    });
});