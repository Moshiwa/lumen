$(document).ready(function () {
   init();
});

function init() {
    eventsInit();
}

function eventsInit() {
    $(document).on('click', '.js-getMe', function (e) {
        getMe('/telegram/get_me');
    });

    $(document).on('click', '.js-get-me__clear', function (e) {
        let currentElement = $(e.target);
        let parentElement = currentElement.closest('.response__get-me');
        parentElement.remove();
    });

    $(document).on('click', '.js-auth-telegram', function (e) {
        let inputElem = $('.js-auth-input');
        let token = inputElem.val();
        if (token !== undefined && token.length > 0) {
            auth('/telegram/auth', {'token': token});
        }
    });

    $(document).on('click', '.js-clear-auth-telegram', function (e) {
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
                        <div class="telegram-access-token">${username}</div>
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
        //$('.telegram-api').load(location.href + ' .telegram-api');
        window.location.reload();
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

function getMe(url) {
    fetch(url)
        .then(function (response) {
            let data = response.json();
            if (data.length === 0) {
                console.error('data is empty');
                return {};
            }
            return data;
        })
        .then(function (data){
            let id = data.result.id;
            let username = data.result.username;
            let parentElement =  $('.right-block__response');
            if (parentElement.find('.response__get-me').length === 0) {
                $('.right-block__response').append(`
                <div class="response__get-me">
                    <div class="get-me__id">
                        <div class="title">Id: </div>
                        <div class="value">${id}</div>
                    </div>
                    <div class="get-me__username">
                        <div class="title">BotName: </div>
                        <div class="value">${username}</div>
                    </div>
                    <div class="js-get-me__clear get-me__clear">x</div>
                </div>
                `);
            }
        })
    ;
}



