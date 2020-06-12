<h3 class="mt-3 mb-3">Danh sách sản phẩm</h3>
<button type="button" class="btn btn-warning d-inline float-right mt-3 mb-3" data-toggle="modal" data-target="#addModal">
         Thêm sản phẩm
</button>
    <div class="modal" id="addModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <!-- <h6 class="mb-3 idBill">Mã Đơn Hàng: <span></span></h6> -->
                    <h6 class="mb-3">Tên sản phẩm: <input type="text" name="product_name" value=""></h6>
                    <h6 class="mb-3">Giá sản phẩm: <input type="text" name="price_product" value=""></h6>
                    <h6 class="mb-3">Hình ảnh : 
                        <input type="file" name="image_file" onchange="readURL(this);"> <br>
                        <img id="product-image" src="#" alt="your image" />
                    </h6>
                    <h6 class="mb-3">Mô tả: </h6>
                    <textarea rows=5 col=20 class="description"></textarea>
                    <h6 class="mb-3">Số lượng : <input type="number" name="quantity_product" value=1 min=1></h6>
                    <h6 class="mb-3">Trạng thái : 
                        <select class="statusPro">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                        </select>
                    </h6>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btnAddProduct" data-dismiss="modal">Thêm</button>
                </div>
            </div>
        </div>
    </div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Mã</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $products = getAllProductInfo($conn);
        while ($pro = $products->fetch_assoc()) {
      ?>
        <tr>
            <td class="proId"><?= $pro['id'];?></td>
            <td><?= $pro['name_product'];?></td>
            <td><?= number_format($pro['price_product'],0,',','.')?> VND</td>
            <td><img src="img/products/<?= $pro['image']; ?>" alt="HÌnh 1" width=80 height=80></td>
            <td><?= $pro['quantity']; ?></td>
            <td><?php
                if ($pro['status'] == 0) echo 'Ẩn';
                else echo 'Hiện';
            ?></td>
            <td>
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?= $pro['id']; ?>" id="editModal">Sửa</button>
                <!-- The Modal -->
                <div class="modal" id="myModal-<?= $pro['id']; ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Sửa sản phẩm</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" class="formData">
                                    Mã sản phẩm : <input type="text" value="<?= $pro['id']; ?>" name="idPro" style="margin-bottom: 20px;">
                                    <br>
                                    Tên sản phẩm : <input type="text" value="<?= $pro['name_product']; ?>" name="namePro"
                                        style="margin-bottom: 20px;"> <br>
                                    Giá : <input type="text" value="<?= $pro['price_product']; ?>" name="pricePro"
                                        style="margin-bottom: 20px;margin-left: 52px;"> VNĐ <br>
                                    Hình ảnh : <img src="img/products/<?= $pro['image']; ?>" width=100 height=100
                                        style="margin-bottom: 20px;">
                                    <input type="button" name="btn-upload" id="btnUpload" value="Tải ảnh lên"> <br>
                                    Mô tả : <textarea style="margin-bottom: 20px;" rows="4" cols="50" name="description"><?= $pro['description']; ?></textarea> <br>
                                    Số lượng : <input type="text" value="<?= $pro['quantity']; ?>" name="quantityPro"
                                        style="margin-bottom: 20px;margin-left: 52px;"> <br>
                                    Trạng thái:   <select class="status_select">
                                                    <option value="0" 
                                                            <?php if($pro['status'] == 1) echo"selected"; ?>>
                                                            Ẩn
                                                    </option>
                                                    <option value="1" 
                                                            <?php if($pro['status'] == 1) echo"selected"; ?>>
                                                            Hiện
                                                    </option>
                                                 </select>
                                    <button class="btn btn-success float-right btnUpdate" type="button">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-danger" data-toggle="modal" data-target="#myEditModal-<?= $pro['id']; ?>" id="deleteModal">Xóa</button>
                <div class="modal" id="myEditModal-<?= $pro['id']; ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Xóa</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <h4>Bạn có muốn xóa sản phẩm <span><?= $pro['id'];?></span> không ?</h4>
                                <button class="btn btn-danger float-right btnDelete" type="button">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        <?php
        }
      ?>
    </tbody>
</table>