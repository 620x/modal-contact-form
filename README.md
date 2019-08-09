# modal-contact-form
Simple contact form in modal window with validation and SMTP Email sender

**Чтобы получить возможность отправлять e-mail письма:**

1. Нужно в файле js/main.js раскомментить вызов функции send().
2. Далее, в самой функции send() нужно указать абсолютный адрес файла sendMail.php.
3. В файле sendMail.php заполнить поля с данными о своем SMTP клиенте, там есть комментарии. В этом же файле можем править тело письма.

**Для правок валидации:**

1. Валидация реализована с помощью плагина jquery.validate.js, документация тут: https://jqueryvalidation.org/

**Демо внешнего вида:** https://codepen.io/620_x/pen/voKPrB
