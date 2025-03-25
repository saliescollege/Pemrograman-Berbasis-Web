const calculator = (operator, x, y) => {
    let result;
    
    switch (operator) {
        case '+':
            result = x + y;
            break;
        case '-':
            result = x - y;
            break;
        case '*':
            result = x * y;
            break;
        case '/':
            result = y !== 0 ? x / y : "Tidak bisa dibagi dengan nol.";
            break;
        case '%':
            result = x % y;
            break;
        default:
            result = "Operator tidak valid.";
    }
    
    return result;
};

console.log(calculator('+', 8, 4)); 
console.log(calculator('-', 8, 4)); 
console.log(calculator('*', 8, 4)); 
console.log(calculator('/', 8, 4)); 
console.log(calculator('%', 8, 3));
console.log(calculator('/', 8, 0)); 
