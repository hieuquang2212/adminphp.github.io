        function replaceAll(str, del) {
            while (str.indexOf(del) != -1) {
                str = str.replace(del, "");
            }
            return str;
        }
        
        $(document).ready(function() {
            // su kien khi chon san pham
        $('select#inlineFormCustomSelectPref').each(function(key, value) {
            $(value).change(function() {
                var selected = $(value).find('option:selected');
                $(selected).each(function() {
                    //console.log($(this));
                    var parent = $(this).parents()[0];
                    var parent2 = $(this).parents()[2];
                    var nextEl = $(parent).next();
                    //Get price elemet
                    var price = $(nextEl).find('h6 span.price');
                    var pr = $(price).text();
                    pr = replaceAll(pr,".");
                    console.log(pr);
                    // Get total price
                    // var totalEle = $(parent2).find('.total_price');
                    // var total = $(totalEle).text();
                    // total = replaceAll(total,".");
                    // console.log(total);
                    // Get total price print
                    var totalPrEle = $(parent2).find('.total_price_print');
                    var totalPr = $(totalPrEle).text();
                    totalPr = replaceAll(totalPr,".");
                    console.log(totalPr);
                    //Get quantity
                    var quantity = $(nextEl).find('h6 input.quan');
                    var quantitypro = $(quantity).val();
                    $(quantity).val("1");
                    $.ajax({
                        type: 'POST',
                        url: 'editBill.php',
                        data: {
                            idPro: $(this).val(),
                            prevPrice: pr,
                            total: totalPr,
                            quantity: quantitypro,
                            newQuan: 1,
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            $(price).text(response.price);
                            // var pricePro = $(price).text();
                            // console.log(price);
                            // pricePro = replaceAll(pricePro,".");
                            $(totalPrEle).text(response.total);
                        }
                    });
                });

            });
        });
       
        // su kien cap nhat don hang
        $('.btnEdit').click(function() {
            //get parent
            var parent = $(this).parents()[0];
            var modalBody = $(parent).prev();
            // get id bill
            var id = $($(modalBody).find('h6.idBill span')).text();
            // get customer's name
            var customerName = $($(modalBody).find('input[name=customer_name]')).val();
            // get phone number
            var phoneNumber = $($(modalBody).find('input[name=phone_number')).val();
            // create list product
            var listProduct = $(modalBody).find('.product-item');
            var listPro = "";
            $(listProduct).each(function(key, value) {
                var selected = $(value).find('#inlineFormCustomSelectPref option:selected');
                var id = $(selected).val();
                var quantity = $($(value).find('input[name=quantity]')).val();
                listPro += quantity + "x" + id + ",";
            });
            listPro = listPro.substring(0,listPro.length-1);
            // get total price
            var totalEl = $(modalBody).find('span.total_price_print');
            var total = $(totalEl).text();
            var totalBill = replaceAll(total,".");
            console.log(totalBill);
            $.ajax({
                type: 'POST',
                url: 'updateBill.php',
                data: {
                    id: id,
                    name: customerName,
                    phone: phoneNumber,
                    listProduct: listPro,
                    totalCost: totalBill,
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        });
        // them san pham vao danh sach
        var totalAddPrice = 0;
        $('.btnAddPro').click(function() {
            var currEle = $(this);
            var prevEl = $(this).prev();
            var selectedOption = $(prevEl).find('option:selected');
            console.log($(selectedOption).text());
            var id = $(selectedOption).val();
            //get parent
            var parent = $(this).parents()[0];
            var totalPrice = $(parent).find('span.total_price_print');
            var total = $(totalPrice).text();
            total = replaceAll(total,".");
            console.log(total);
            $.ajax({
                type: 'POST',
                url: 'addProduct.php',
                data: {
                    id: id,
                    total: total,
                },
                dataType: 'JSON',
                success: function(response) {
                    // $(currEle).after(response);
                    // 
                    // var price = $(response).find('span.price');
                    // var pricePro = $(price).text();
                    // total += parseInt(replaceAll(pricePro,"."));
                    var ele = "  <div class='product-item mt-3'> \
                                    <h6 class='idPro d-inline'>"+ response.id +"</h6> \
                                    <img src='" + response.image + "' alt='Hinh_anh' width=80 height=80> \
                                    <h6 class='d-inline'>" + response.name + "</h6> \
                                    <div class='d-inline-block ml-5'> \
                                        <h6>Giá/SP: <span class='price'>" + response.price + "</span> VNĐ</h6> \
                                        <h6>SL : <input type='number' name='quantity' class='quan' value=1 min=1 max=100></h6> \
                                        <h6 class='currentQuan d-none'>1</h6> \
                                    </div> \
                                    <button class='btn btn-link btnRemovePro'>Xóa</button> \
                                </div> \
                                ";
                    $(currEle).after(ele);
                    $.getScript('js/change.js');
                    $.getScript('js/remove.js');
                    $(totalPrice).text(response.total);
                    
                }
            });
        });
        $('.btnAdd').click(function() {
            //get parent
            var parent = $(this).parents()[0];
            var modalBody = $(parent).prev();
            // get id bill
            //var id = $($(modalBody).find('h6.idBill span')).text();
            // get customer's name
            var customerName = $($(modalBody).find('input[name=customer_name]')).val();
            console.log(customerName);
            // get phone number
            var phoneNumber = $($(modalBody).find('input[name=phone_number')).val();
            console.log(phoneNumber);
            // create list product
            var listProduct = $(modalBody).find('.product-item');
            var listPro = "";
            $(listProduct).each(function(key, value) {
                var idPro = $(value).find('h6.idPro');
                var id = $(idPro).text();
                var quantity = $($(value).find('input[name=quantity]')).val();
                listPro += quantity + "x" + id + ",";
            });
            listPro = listPro.substring(0,listPro.length-1);
            console.log(listPro);
            // get total price
            var totalEl = $(modalBody).find('span.total_price_print');
            var total = $(totalEl).text();
            var totalBill = replaceAll(total,".");
            console.log(totalBill);
            $.ajax({
                type: 'POST',
                url: 'addBill.php',
                data: {
                    customerName: customerName,
                    phoneNumber: phoneNumber,
                    listProduct: listPro,
                    totalCost: totalBill,
                    status: "Da xac nhan",
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        });
        $('.btnConfirm').click(function() {
            //get parent
            var parent = $(this).parents()[1];
            console.log(parent);
            var idBill = $(parent).find('span.idBill');
            var id = $(idBill).text();
            $.ajax({
                type: 'POST',
                url: 'removeBill.php',
                data: {
                    id: id,
                },
                success: function(response) {
                    alert(response);
                    location.reload();W
                }
            });
        });
        $('.btnConfirmBill').click(function() {
            //get parent
            var parent = $(this).parents()[1];
            var idBill = $(parent).find('span.idBill');
            var id = $(idBill).text();
            $.ajax({
                type: 'POST',
                url: 'confirmBill.php',
                data: {
                    id: id,
                },
                success: function(response) {
                    alert(response);
                    location.reload();W
                }
            });
        });
       
});
    