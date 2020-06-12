<h3 class="d-inline mt-3 mb-3">Danh sách đơn hàng</h4>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-warning d-inline float-right mt-3 mb-3" data-toggle="modal" data-target="#addModal">
         Thêm đơn hàng
    </button>
    <!-- The Modal -->
    <div class="modal" id="addModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm đơn hàng</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <!-- <h6 class="mb-3 idBill">Mã Đơn Hàng: <span></span></h6> -->
                    <h6 class="mb-3">Tên khách hàng: <input type="text" name="customer_name" value=""></h6>
                    <h6 class="mb-3">Số điện thoại:  <input type="text" name="phone_number" value=""></h6>
                    <h6>Danh sách sản phẩm</h6>
                    <select id="inlineFormCustomSelectPref">
                        <?php
                            $products = getAllProductInfo($conn);
                            while ($item = $products->fetch_assoc()) {
                        ?>
                        <option value="<?= $item['id']?>"> 
                            <h6 class="d-inline"><?= $item['name_product']; ?></h6>
                        </option>
                        <?php
                        }
                        ?>
                     </select>
                     <button class="btn btn-info d-inlne btnAddPro">Thêm sản phẩm</button>
                    <h6 class="float-right">Tổng tiền:   <span class="total_price_print">0</span> VNĐ</h6>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btnAdd" data-dismiss="modal">Thêm</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Mã</th>
                <th>Khách hàng</th>
                <th>Danh sách sản phẩm</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $bills = getAllBills($conn);
            while ($bill = $bills->fetch_assoc()) {
        ?>
            <tr>
                <td class="idBill"><?= $bill['id'];?></td>
                <td><?= $bill['customer_name']; ?></td>
                <td>
                    <div class="product-list">
                        <?php
                        $listPro = explode(',',$bill['list_product']);
                        foreach ($listPro as $value) {
                            $tmp1 = explode('x',$value);
                            $id = $tmp1[1];                      
                            $pro =  getOneProductInfo($conn, $id)->fetch_assoc();
                        ?>
                        <div class="product-item border-bottom">
                            <img src="/images/products/<?= $pro['image'];?>" alt="Image_product" width=80 height=80>
                            <h6 class="d-inline"><?= $pro['name_product']; ?></h6>
                            <div class="d-inline float-right">
                                <h5><?= number_format($pro['price_product'],0,',','.'); ?> VNĐ</h5>
                                <h6>SL: <?= $tmp1[0]; ?></h6>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </td>
                <td><h6><?= number_format($bill['total_cost'],0,',','.'); ?> VNĐ</h6></td>
                <td><?= $bill['status'];?></td>
                <td>
                    <button class="btn btn-primary" type="button" data-toggle="modal"
                        data-target="#editBill<?=$bill['id']; ?>">Sửa</button>
                    <!-- The Edit Bill Modal -->
                    <div class="modal" id="editBill<?=$bill['id']; ?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Sửa đơn hàng <?= $bill['id']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <h6 class="mb-3 idBill">Mã Đơn Hàng: <span><?= $bill['id']?></span></h6>
                                    <h6 class="mb-3">Tên khách hàng: <input type="text" name="customer_name" value="<?= $bill['customer_name'];?>"></h6>
                                    <h6 class="mb-3">Số điện thoại:  <input type="text" name="phone_number" value="<?= $bill['phone_number'];?>"></h6>
                                    <h6>Danh sách sản phẩm</h6>
                                    <?php
                                    $listPro = explode(',',$bill['list_product']);
                                    foreach ($listPro as $value) {
                                        $tmp = explode('x',$value);
                                        $id = $tmp[1];
                                        $quan = $tmp[0];
                                        $pro =  getOneProductInfo($conn, $id)->fetch_assoc();
                                    ?>
                                        <div class="product-item">
                                            <select id="inlineFormCustomSelectPref">
                                                <option selected="selected" value="<?= $id ?>"> 
                                                    <h6 class="d-inline"><?= $pro['name_product']; ?></h6>
                                                </option>
                                                <?php
                                                    $pro2 = getProductExept($conn,$id);
                                                    while ($item = $pro2->fetch_assoc()) {
                                                ?>
                                                <option value="<?= $item['id'] ?>">
                                                    <h6 class="d-inline"><?= $item['name_product']; ?></h6>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <div class="d-inline-block ml-5">
                                                <h6>Giá/SP: <span class="price"><?= number_format($pro['price_product'],0,',','.'); ?></span> VNĐ</h6>
                                                <h6>SL : <input type="number" name="quantity" class="quan" value=<?= $quan; ?> min=1 max=100></h6>
                                                <h6 class="currentQuan d-none"><?= $quan; ?></h6>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <h6 class="float-right">Tổng tiền:   <span class="total_price_print"><?= number_format($bill['total_cost'],0,',','.'); ?></span> VNĐ</h6>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btnEdit" data-dismiss="modal">Cập nhật</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeBIll<?=$bill['id']; ?>">
                        Hủy
                    </button>
                    <!-- The Modal -->
                    <div class="modal" id="removeBIll<?=$bill['id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Hủy đơn hàng <span class="idBill"><?= $bill['id']; ?></span></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    Bạn có muốn hủy đơn hàng này ?
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btnConfirm" data-dismiss="modal">Xác nhận</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmBill<?=$bill['id']; ?>">
                        Xác nhận
                    </button>
                    <!-- The Modal -->
                    <div class="modal" id="confirmBill<?=$bill['id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Xác nhận đơn hàng <span class="idBill"><?= $bill['id']; ?></span></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    Bạn có muốn xác nhận đơn hàng này không ?
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btnConfirmBill" data-dismiss="modal">Xác nhận</button>
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
