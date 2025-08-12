function priceChange() {
    document.querySelector('#payment_method').textContent = document.getElementById('method').value;
}

function imgChange() {
    document.querySelector('.img__label').textContent = document.querySelector('#img').value;
}

function itemChange() {
    document.querySelector('.label__txt').textContent = document.querySelector('#img').value;
}

const updateText = document.querySelector('.update_message');

updateText.onclick = function () {
    updateText.classList.replace('update_message', 'edit_message');
    updateText.selectionStart = updateText.value.length;
    updateText.selectionEnd = updateText.value.length;
    updateText.focus();
}