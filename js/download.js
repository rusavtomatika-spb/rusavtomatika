$(document).ready(function () {
    setTimeout(function () {
        //$('#eeti').empty();
        //$('#eeti').html("<a href='http://www.eeti.com.tw/DriverDownload.html' target='_blanck' title='откроется в новом окне'>по ссылке &#10157;</a>");

        $('#eWONone a').eq(0).attr({'href': 'http://ftp.ewon.biz/software/eBuddy/eBuddySetup.exe'});
        $('#eWONone a').eq(1).attr({'href': 'http://ftp.ewon.biz/software/eVCOM/eVCOMSetup.exe'});
        $('#eWONtwo a').eq(0).attr({'href': 'http://ftp.ewon.biz/software/eCatcher/eCatcher.msi'});
        $('#eWONtwo a').eq(1).attr({'href': 'http://ftp.ewon.biz/software/eCatcher/Talk2MConnectionChecker.msi'});
        $('#eWONbottom a').eq(0).attr({'href': 'http://wiki.ewon.biz/Support/07_Download/10_EWON_Softwares'});
        $('#eWONbottom a').eq(1).attr({'href': 'http://wiki.ewon.biz/Talk2m'});
    }, 00);
});
