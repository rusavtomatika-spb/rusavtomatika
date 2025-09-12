xCal.set({
    lang: "en", // Английский язык
    order: 1, // Обратный порядок
    now: 1 ,
    delim: "-",
    x: 1,
    autoOff: 1

});
$(document).on(
    'focus',
    '.datepicker',
    function (event) {
        xCal(this);
    });
