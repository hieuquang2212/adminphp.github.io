$(document).ready(function() {
    $('.btnRemovePro').click(function() {
        // get parent
        var parent = $(this).parents()[0];
        var parent2 = $(this).parents()[1];
        // get price product
        var priceEle = $(parent).find('span.price');
        var pricePro = replaceAll($(priceEle).text(),".");
        console.log(pricePro);
        // get quantity product
        var quantityEle = $(parent).find('input.quan');
        var quantity = $(quantityEle).val();
        console.log(quantity);
        // get total price
        var totalEle = $(parent2).find('span.total_price_print');
        var total = replaceAll($(totalEle).text(),".");
        console.log(total);
        $.ajax({
            type: 'POST',
            url: 'removePro.php',
            data: {
                quantity: quantity,
                price: replaceAll(pricePro,"."),
                total: replaceAll(total,"."),
            },
            success: function(response) {
                $(totalEle).text(response);
                $(parent).remove();
            }   
        });
    });
});