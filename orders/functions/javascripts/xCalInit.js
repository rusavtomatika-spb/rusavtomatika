xCal.set({
    lang: "en", // ���������� ����
    order: 1, // �������� �������
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
