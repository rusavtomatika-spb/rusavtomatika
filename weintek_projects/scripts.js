

$(document).ready(function () {
    $("div.h1").hover(
            function () {
                if (!($(".look").hasClass('showed'))) {
                    lookup();
                }
                ;
            },
            function () {
                if ($(".look").hasClass('showed')) {
                    setTimeout(function () {
                        lookdown()
                    }, 3000);
                    setTimeout(function () {
                        $(".look").removeClass('showed')
                    }, 6000);
                }
                ;
            });
});
function cyr2lat(str) {

    var cyr2latChars = new Array(
            ['�', 'a'], ['�', 'b'], ['�', 'v'], ['�', 'g'],
            ['�', 'd'], ['�', 'e'], ['�', 'yo'], ['�', 'zh'], ['�', 'z'],
            ['�', 'i'], ['�', 'y'], ['�', 'k'], ['�', 'l'],
            ['�', 'm'], ['�', 'n'], ['�', 'o'], ['�', 'p'], ['�', 'r'],
            ['�', 's'], ['�', 't'], ['�', 'u'], ['�', 'f'],
            ['�', 'h'], ['�', 'c'], ['�', 'ch'], ['�', 'sh'], ['�', 'shch'],
            ['�', ''], ['�', 'y'], ['�', ''], ['�', 'e'], ['�', 'yu'], ['�', 'ya'],
            ['�', 'A'], ['�', 'B'], ['�', 'V'], ['�', 'G'],
            ['�', 'D'], ['�', 'E'], ['�', 'YO'], ['�', 'ZH'], ['�', 'Z'],
            ['�', 'I'], ['�', 'Y'], ['�', 'K'], ['�', 'L'],
            ['�', 'M'], ['�', 'N'], ['�', 'O'], ['�', 'P'], ['�', 'R'],
            ['�', 'S'], ['�', 'T'], ['�', 'U'], ['�', 'F'],
            ['�', 'H'], ['�', 'C'], ['�', 'CH'], ['�', 'SH'], ['�', 'SHCH'],
            ['�', ''], ['�', 'Y'],
            ['�', ''],
            ['�', 'E'],
            ['�', 'YU'],
            ['�', 'YA'],
            ['a', 'a'], ['b', 'b'], ['c', 'c'], ['d', 'd'], ['e', 'e'],
            ['f', 'f'], ['g', 'g'], ['h', 'h'], ['i', 'i'], ['j', 'j'],
            ['k', 'k'], ['l', 'l'], ['m', 'm'], ['n', 'n'], ['o', 'o'],
            ['p', 'p'], ['q', 'q'], ['r', 'r'], ['s', 's'], ['t', 't'],
            ['u', 'u'], ['v', 'v'], ['w', 'w'], ['x', 'x'], ['y', 'y'],
            ['z', 'z'],
            ['A', 'A'], ['B', 'B'], ['C', 'C'], ['D', 'D'], ['E', 'E'],
            ['F', 'F'], ['G', 'G'], ['H', 'H'], ['I', 'I'], ['J', 'J'], ['K', 'K'],
            ['L', 'L'], ['M', 'M'], ['N', 'N'], ['O', 'O'], ['P', 'P'],
            ['Q', 'Q'], ['R', 'R'], ['S', 'S'], ['T', 'T'], ['U', 'U'], ['V', 'V'],
            ['W', 'W'], ['X', 'X'], ['Y', 'Y'], ['Z', 'Z'],
            [' ', ' '], ['0', '0'], ['1', '1'], ['2', '2'], ['3', '3'],
            ['4', '4'], ['5', '5'], ['6', '6'], ['7', '7'], ['8', '8'], ['9', '9'],
            ['-', '-']

            );
    var newStr = new String();
    for (var i = 0; i < str.length; i++) {

        ch = str.charAt(i);
        var newCh = '';
        for (var j = 0; j < cyr2latChars.length; j++) {
            if (ch == cyr2latChars[j][0]) {
                newCh = cyr2latChars[j][1];
            }
        }
        // ���� ������� ����������, �� ����������� ������������, ���� ��� - ������ ������
        newStr += newCh;
    }
    // ������� ������������� �������
    // ��� �� ������� ������� �������� ������, �� ��� �������� ��� ������
    return newStr.replace(/[ ]{2,}/gim, ' ').replace(/\n/gim, '');
}

function loadProjects(find_me) {
    if (find_me == "all") {
        $('#drive_search').empty();
        $('#original').show();
        $('.paginator').show();
        return;
    }

    $('.show_loading').show();
    $('#remove').click();
    urls = "/ajax/projects2.php";
    $.ajax({
        type: "GET",
        url: urls,
        data: "find_projects=" + find_me,
        // ������� �� ��� ������ PHP
        success: function (html) {
            $('.show_loading').hide();
            //�������������� ������� ������ ������� ��������

//� ������� ����� php �������
            if (html != 'pusto') {
                if (html != 'nothing') {
                    $('#original').hide();
                    $(".paginator").hide();
                    $('#drive_search').empty();
                    $("#drive_search").append(html);
                } else {
                    $('#drive_search').empty();
                    $("#drive_search").append('<div id="drive-note" style="color: #0054be;">������ �� �������</div>');
                    $('#original').show();
                    $('.paginator').show();
                }
            } else {

                $('#drive_search').empty();
                $("#drive_search").append('<div id="drive-note">������ ������</div>');
            }
        }
    });
}

function drivers() {
    $('.show_loading').show();

    $('.projects_tabs li').removeClass('active');
    $(".projects_tabs li[data-rel='all']").addClass('active');

    var ask_drivers = $('#ask_drivers').val();
    if (ask_drivers != '' || 1) {
        if ($('#ask_drivers').attr('rel') == 'drivers') {
            urls = "/ajax/drivers.php";
        } else if ($('#ask_drivers').attr('rel') == 'books') {
            urls = "/ajax/booksearch.php";
        } else if ($('#ask_drivers').attr('rel') == 'libraries') {
            urls = "/ajax/libraries.php";
        } else {
            urls = "/ajax/projects.php";
        }
        ;
        $.ajax({
            type: "GET",
            url: urls,
            data: "ask_drivers=" + ask_drivers,
            // ������� �� ��� ������ PHP
            success: function (html) {
                
                window_location_new = document.location.protocol + '//' 
                        + document.location.host 
                        + document.location.pathname                
                        + "?ask_drivers=" + ask_drivers;
                if (window.location != window_location_new)
                {
                     history.pushState(null, null, window_location_new);
                }

                

                if (html != 'pusto') {
                    if (html != 'nothing') {
                        $('#original').hide();
                        $('#drive_search').empty();
//$('#drive_search').html('');
//$("#drive_search").show();
                        $("#drive_search").append(html);
                        if ($('#ask_drivers').attr('rel') == 'books') {
                            $('.book').hide();
                            $("div.seachresult").bind("click", send_book);
                            $('#drive-button').show();
                        }
                        ;
                        $('#drive-button').hide();
                        $('#ui-id-2').css('display', 'none');
                        $('#remove').show();
                    } else {
                        $('#drive_search').empty();
//$("#drive_search").show();
                        $("#drive_search").append('<div id="drive-note" style="color: #0054be;">������ �� �������</div>');
                        $('input#ask_drivers').val('');
//$('#remove').show();
                        $('#original').show();
                    }
                    ;
                } else {

                    $('#drive_search').empty();
//$("#drive_search").show();
                    $("#drive_search").append('<div id="drive-note" style="color: #0054be;">������ ������</div>');
                    $('input#ask_drivers').val('');
//$('#remove').show();
                }
                $('.show_loading').hide();
            }
        });
    }
    ;
}

/*
 $(document).ready(function() {
 $('#ask_drivers').change(function() {
 if ($('#ask_drivers').val() != '') {
 $('#drive-button').bind('click', drivers);
 } else {$('#drive-button').unbind('click', drivers);  };
 });


 });
 */

$(document).ready(function () {
    /*
     $('.projects_tabs li a').click(function () {
     $('.projects_tabs li a').removeClass('active');
     $(this).addClass('active');
     loadProjects($(this).attr('data-rel'));
     cururl = window.location.href;
     cururl = cururl.substr(cururl.indexOf('?') + 1);
     console.log(cururl);
     document.location.hash = "!" + $(this).attr('data-rel');
     return false;
     });
     */
    $('input#ask_drivers').keypress(function (z) {
        if (z.keyCode == 13) {
            $(".paginator").remove();
            drivers();
        }
        ;
    });
    $('input#ask_drivers').keyup(function (z) {
        if ($('input#ask_drivers').attr('rel') == 'drivers') {
            if (64 < z.keyCode && z.keyCode < 110) {
                var v = $('input#ask_drivers').val();
                var nawv = cyr2lat(v);
                $('input#ask_drivers').val(nawv);
            }
            ;
        }
        ;
    });
    $('#drive-button').click(function () {
        drivers();
    });
    $('input#search-field').keydown(function (xxx)
    {
        if (xxx.which == 13) {
            drivers();
        }
        ;
    });
    
});
$(document).ready(function () {
    $('.t_row:even').addClass('l_gray');
});

$(document).ready(function () {
    $('#remove').click(function () {
        $('input#ask_drivers').val('');
        $('#drive_search').empty();
        $(this).hide();
        $('#original').show();
        $('#drive-button').show();
        if ($('#ask_drivers').attr('rel') == 'books') {
            $('.book').show();
        };
        setTimeout(function () {
            $('.projects_tabs a[data-rel="all"]').click();
            console.log($('.projects_tabs a[data-rel="all"]'));
        },100);

    });
});


