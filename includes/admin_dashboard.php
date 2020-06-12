<nav class="navbar navbar-light bg-dark">
    <a class="navbar-brand text-white-50" href="#">Admin Dashboard</a>
    <div class="dropdown float-right">
        <button class="btn dropdown-toggle text-white-50" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Chào
            <?php 
                        if (isset($_SESSION['admin_name']))
                        echo $_SESSION['admin_name'];
                ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Hồ sơ cá nhân</a>
            <a class="dropdown-item" href="logout.php">Đăng xuất</a>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" style="padding: 0;">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Sản phẩm</button>
                <button class="tablinks" onclick="openCity(event, 'Paris')">Nhân viên</button>
                <button class="tablinks" onclick="openCity(event, 'Tokyo')">Doanh thu</button>
            </div>
        </div>
        <div class="col-md-10">
            <div id="London" class="tabcontent">
                <?php
                    include("admin/product.php");
                ?>
            </div>
            <div id="Paris" class="tabcontent">
                <?php
                    include("admin/salers.php");
                ?>
            </div>

            <div id="Tokyo" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>
        </div>
    </div>
</div>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
// preview image after selected image file
function readURL(input) {
            console.log(input.files[0]);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    console.log(e.target.result);
                    $('#product-image')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
// Get the element with id="defaultOpen" and click on it
// document.getElementById("defaultOpen").click();
    $(document).ready(function() {
        $('.btnUpdate').click(function() {
            var form = $(this).parents()[0];
            $.ajax({
                type: "POST",
                url: "editPro.php",
                data: {
                    id: $(form).find('input[name=idPro]').val(),
                    name: $(form).find('input[name=namePro]').val(),
                    price: $(form).find('input[name=pricePro]').val(),
                    quantity: $(form).find('input[name=quantityPro]').val(),
                    status: $(form).find('.status_select option:selected').val(),
                },
                dataType: "text",
                success: function (response) {
                    alert(response);
                    location.reload();
                }
            });
        });
        $('.btnDelete').click(function() {
            var parent = $(this).parents()[0];
            var id = $(parent).find('h4 span').text();
            $.ajax({
                type: 'POST',
                url: "deletePro.php",
                data: {
                    id: id,
                },
                dataType: "text",
                success: function (response) {
                    alert(response);
                    location.reload();
                }
            });
        });
        $('.btnAddProduct').click(function() {
            // get parent
            var parent = $(this).parents()[1];
            // get input type = file
            var fileEle = $(parent).find('input[type=file]');
            // create formData
            var fd = new FormData();
            // get file upload name
            var fileName = $(fileEle)[0].files[0];
            fd.append('file',fileName);
            fd.append('name', $(parent).find('input[name=product_name]').val());
            fd.append('price',$(parent).find('input[name=price_product]').val());
            fd.append('description',$(parent).find('textarea.description').val());
            fd.append('quantity',$(parent).find('input[name=quantity_product]').val());
            fd.append('status',$(parent).find('select.statusPro option:selected').val());
            console.log(fd);
            $.ajax({
                type: "POST",
                url: "insertPro.php",
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert(response);
                    location.reload();
                }
            });
        });
    });
</script>