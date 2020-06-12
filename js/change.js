$(document).ready(function() {
     // su kien tang giam so luong
     $('input[type=number]').each(function(key, value) {
        $(value).on("change", function() {
            console.log('Hello world');
            // get the parent of input number element
            var parent = $(value).parents()[1];
            var parent2 = $(value).parents()[3];
            console.log(parent2);
            // get the price class
            var price = $(parent).find('h6 span.price');
            var pricePro = $(price).text();
            pricePro = replaceAll(pricePro,".");
            // get curr quantity
            var currQuan = $(parent).find('h6.currentQuan');
            var currQuantity = $(currQuan).text();
            console.log(currQuan);
            // get new quantity
            var newQuan = $(this).val();
            console.log(newQuan);
            // get total
            var totalEl = $(parent2).find('h6 span.total_price_print');
            console.log(totalEl);
            var totalPrice = replaceAll($(totalEl).text(),".");
            $.ajax({
                type: 'POST',
                url:  'changeQuan.php',
                data: {
                    price: pricePro,
                    currQuan: currQuantity,
                    newQuan: newQuan,
                    total: totalPrice,
                },
                dataType: 'JSON',
                success: function(response) {
                    console.log(response.quantity);
                    $(currQuan).text(response.quantity);
                    $(totalEl).text(response.total);
                }
            });
        });
    });
});