const loginForm = $('#login');
const loginEmail = $('#login-email');
const loginPassword = $('#login-password');
const loginBtn = $('#login-btn');

const signForm = $('#signUp');
const signEmail = $('#sign-email');
const signName = $('#sign-name');
const signPassword = $('#sign-password');
const signBtn = $('#sign-btn');

loginEmail.on('input', () => removeError(loginForm, loginEmail));
loginPassword.on('input', () => removeError(loginForm, loginPassword));
signEmail.on('input', () => removeError(signForm, signEmail));
signName.on('input', () => removeError(signForm, signName));
signPassword.on('input', () => removeError(signForm, signPassword));

loginBtn.click(e => {
    e.stopPropagation();
    let email = loginEmail.val();
    let password = loginPassword.val();

    if(!!email && !!password) {
        if (!isValidEmail(email)) {
            addError('Неверный формат email', loginForm, loginEmail);
        }
        if (!isValidPassword(password)) {
            addError('Неверный формат пароля', loginForm, loginPassword);
        }
        if (email && password && isValidEmail(email) && isValidPassword(password)){
            removeError(loginForm, loginPassword);
            removeError(loginForm, loginEmail);
            $.ajax({
                url: '/User/Login/',
                method: 'post',
                data: {
                    email,
                    password,
                }
            }).then(data => {
                let newData = JSON.parse(data);
                if(!newData.status) {
                    addError(newData.message, loginForm);
                } else {
                    setCookie('hash', newData.hash, 1);
                    document.location.reload(true);
                }
            })
        }
    } else {
        addError('Поля не могут быть пустыми', loginForm, loginPassword);
        addError('Поля не могут быть пустыми', loginForm, loginEmail);
    }
});

signBtn.click(e => {
    e.stopPropagation();
    let email = signEmail.val();
    let password = signPassword.val();
    let name = signName.val();

    if(!!email && !!password && !!name) {
        if (!isValidEmail(email)) {
            addError('Неверный формат email', signForm, signEmail);
        }
        if (!isValidPassword(password)) {
            addError('Неверный формат пароля', signForm, signPassword);
        }
        if (email && password && isValidEmail(email) && isValidPassword(password)){
            removeError(signForm, signPassword);
            removeError(signForm, signEmail);
            $.ajax({
                url: '/User/SignUp/',
                method: 'post',
                data: {
                    email,
                    name,
                    password,
                }
            }).then(data => {
                let newData = JSON.parse(data);
                if(!newData.status) {
                    addError(newData.message, signForm);
                } else {
                    setCookie('hash', newData.hash, 1);
                    document.location.reload(true);
                }
            })
        }
    } else {
        addError('Поля не могут быть пустыми', signForm, signPassword);
        addError('Поля не могут быть пустыми', signForm, signEmail);
        addError('Поля не могут быть пустыми', signForm, signName);
    }
});


addError = (message, form, field = null) => {
    form.addClass('needs-validation');
    let helpBlock = form.find('.help-block');
    if(field){
        field.addClass('is-invalid');
    }
    helpBlock.addClass('invalid-feedback d-block');
    helpBlock.html(message);
};

removeError = (form, field) => {
    form.removeClass('needs-validation');
    let helpBlock = form.find('.help-block');
    field.removeClass('is-invalid');
    helpBlock.removeClass('invalid-feedback d-block');
    helpBlock.html('');
};

setCookie = (cname, cvalue, exdays) => {
    let d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};

isValidEmail = email => !!email.match(/@.+\./);
isValidPassword = password => !password.match(/\s/);