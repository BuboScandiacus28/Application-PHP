// Выполнение js-кода после загрузки всех элементов страницы
$(document).ready(function() {
	// Событие на всех тегах 'FORM' при их отправке 
	$('form').submit(function(event) {
		let  json;
		// Отмена у события действия по умолчанию
		event.preventDefault();
		// Выполнение запроса к серверу без перезагрузки страницы 
		$.ajax({
			// Тип запроса (GET/POST)
			type: $(this).attr('method'),
			// Адрес по которому будет отправлен запрос
			url: $(this).attr('action'),
			// Данные которые будут отправлены на сервер
			data: new FormData(this),
			// Отключение заголовков ?
			contentType: false,
			// Отключение кеширования
			cache: false,
			// Отключение преобразования данных в строку
			processData: false,
			// Функция, которая выводится в случае удачной отправки формы
			success: function(result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = json.url;
				} else {
					alert(json.status + ' - ' + json.message);
				}
			},
		});
	});
});