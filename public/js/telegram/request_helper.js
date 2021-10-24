$(document).ready(function () {
   init();
});

function init() {
    eventsInit();
}

function eventsInit() {
    $(document).on('click', '.js-getMe', function (e) {
        get('/telegram/get_me');
    });

    $(document).on('click', '.js-auth-telegram', function (e) {
        let inputElem = $('.js-auth-input');
        let token = inputElem.val();
        if (token !== undefined && token.length > 0) {
            let mainElement = $('.access-token__container');
            let replaceElement = `<div class="access-token__container">
                        <div class="telegram-access-token">`+token+`</div>
                        <button class="button js-clear-auth-telegram">Clear</button>
                    </div>`;
            auth('/telegram/auth', {'token': token});
        }
    });

    $(document).on('click', '.js-clear-auth-telegram', function (e) {
        let mainElement = $('.not-access-token__container');
        let replaceElement = `<div class="not-access-token__container">
                        <input type="text" class="js-auth-input"/>
                        <button class="button js-auth-telegram">Auth</button>
                    </div>`;
        auth('/telegram/auth', {'token': ''});
    });
}

function auth(url, data) {
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (typeof data.ok !== 'undefined') {
            console.log(data)
            if (data.ok === true) {
                let username = '';
                if (data.result) {
                    if (data.result.username) {
                        username = data.result.username;
                    }
                    if (username === '' && data.result.first_name) {
                        username = data.result.first_name;
                    }
                }

                $('.not-access-token__container').replaceWith(
                    `<div class="access-token__container">
                        <div class="telegram-access-token">`+username+`</div>
                        <button class="button js-clear-auth-telegram">Clear</button>
                    </div>`);
            } else if (data.ok === false) {
                $('.access-token__container').replaceWith(
                    `<div class="not-access-token__container">
                        <input type="text" class="js-auth-input"/>
                        <button class="button js-auth-telegram">Auth</button>
                    </div>`);
            }
        }
    })
}

function post(url, data, mainElement = '', replaceElement = '') {
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data)
    })
        .then(function (response) {
            if (response !== undefined && response.length > 0) {
                let data = response.json();
                if (data.length > 0) {
                    if (mainElement !== '' && replaceElement !== '') {
                        mainElement.replaceWith(replaceElement);
                    }
                }
            }
        });
}

function get(url) {
    fetch(url)
        .then(function (response) {
            if (response !== undefined && response.length > 0) {
                let data = response.json();
                if (data.length > 0) {
                    console.log(data)
                }
            }
        });
}


