export function setCookie(name, value, options = {}) {
    //setCookie('user', 'John', {secure: true, 'max-age': 3600});
    let date = new Date;
    date.setDate(date.getDate() + 365);
    date = date.toUTCString();
    options = {
        path: '/',
        'expires': date,
        domain: '.' + window.location.host,
        secure: true,
        SameSite: 'Strict',
    };
    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }
    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }
    document.cookie = updatedCookie;
}

export function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
