function openInNewTab(href) {
    let redirectWindow = window.open(href, '_blank');
    redirectWindow.location;
}
Date.prototype.getWeek = function() {
    var date = new Date(this.getTime());
    date.setHours(0, 0, 0, 0);
    // Thursday in current week decides the year.
    date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
    // January 4 is always in week 1.
    var week1 = new Date(date.getFullYear(), 0, 4);
    // Adjust to Thursday in week 1 and count number of weeks from date to week1.
    return 1 + Math.round(((date.getTime() - week1.getTime()) / 86400000
        - 3 + (week1.getDay() + 6) % 7) / 7);
}
Date.prototype.getWeekYear = function() {
    var date = new Date(this.getTime());
    date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
    return date.getFullYear();
}


function getAjaxJSON(url, data) {
    return new Promise(function (succeed, fail) {
        $.ajax({
            //data: {'name': value},
            data: data,
            type: "post",
            url: url,
            success: function (data) {
                try {
                    succeed(JSON.parse(data));
                } catch (error) {
                    console.log('data: ', data);
                    fail(error);
                }
            },
            error: function (error) {
                fail(error);
            }
        });
    });
}


