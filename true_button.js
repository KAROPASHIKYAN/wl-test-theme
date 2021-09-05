(function() {
    tinymce.PluginManager.add('true_mce_button', function( editor, url ) { // true_mce_button - ID кнопки
        editor.addButton('true_mce_button', {  // true_mce_button - ID кнопки, везде должен быть одинаковым
            text: '[cars]', // текст кнопки, если вы хотите, чтобы ваша кнопка содержала только иконку, удалите эту строку
            title: 'Вставить шорткод [cars]', // всплывающая подсказка
            icon: false, // тут можно указать любую из существующих векторных иконок в TinyMCE либо собственный CSS-класс
            onclick: function() {
                editor.insertContent('[cars]'); // вставляем шорткод [cars] в редактор, также можно задать любое действие jQuery
            }
        });
    });
})();