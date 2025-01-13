document.getElementById('payButton').addEventListener('click', function(){
    document.getElementById('confirmation').style.display = "block";
    document.getElementById('checkout-full-container').style.filter = "blur(3px)";
});

document.getElementById('cancel-btn').addEventListener('click', function() {
    document.getElementById('confirmation').style.display = "none";
    document.getElementById('checkout-full-container').style.filter = "none";
}); 