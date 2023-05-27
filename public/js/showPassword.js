const showPassword = () => {
    const input_password = document.querySelector('#password');
    const password_view = document.querySelector('#password_view');

    input_password.type == 'password' ? input_password.type = 'text' : input_password.type = 'password';
    password_view.classList.value == 'show_pass' ? password_view.classList.value = 'hide_pass' : password_view.classList.value = 'show_pass';
}

const showPasswordToConfirm = () => {
    const input_password_confirm = document.querySelector('#password-confirm');
    const password_confirm_view = document.querySelector('#password_confirm_view');

    input_password_confirm.type == 'password' ? input_password_confirm.type = 'text' : input_password_confirm.type = 'password';
    password_confirm_view.classList.value == 'show_pass' ? password_confirm_view.classList.value = 'hide_pass' : password_confirm_view.classList.value = 'show_pass';
}