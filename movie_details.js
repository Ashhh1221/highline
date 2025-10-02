function changeQty(button, delta) {
    // Find the sibling input element
    const input = button.parentElement.querySelector('.qty-input');
    let currentValue = parseInt(input.value) || 1;
    currentValue += delta;
    
    // Prevent quantity from going below 1
    if (currentValue < 1) currentValue = 1;
    
    input.value = currentValue;
}