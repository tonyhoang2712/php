
<?php 

$carts = get_cart(); ?>

<div class="main-content">
    <div class="container">
        <div class="banner-header banner-lbook3">
            <img src="public/images/banner-catalog1.jpg" alt="Banner-header">
            <div class="text">
                <h3>Checkout</h3>
                <p><a href="index.php" title="Home">Trang chủ</a><i class="fa fa-caret-right"></i>Checkout</p>
            </div>
        </div>
    </div>
    <div class="cart-box-container">
        <div class="container container-ver2 space-padding-tb-30">
            <div class="row head-cart">
                <div class="col-md-4 space-30">
                    <div class="item center">
                        <p class="icon">01</p>
                        <h3>Giỏ hàng</h3>
                    </div>
                </div>
                <!-- End col-md-4 -->
                <div class="col-md-4 space-30">
                    <div class="item active center">
                        <p class="icon">02</p>
                        <h3>Thanh toán</h3>
                    </div>
                </div>
                <!-- End col-md-4 -->
                <div class="col-md-4 space-30">
                    <div class="item center">
                        <p class="icon">03</p>
                        <h3>Hoàn thành</h3>
                    </div>
                </div>
                <!-- End col-md-4 -->
            </div>
        </div>
        <!-- End container -->
        <div class=" container">            
            <div class="row">
                <div class="box cart-container">
                <?php if($carts) : ?>
                    <div class="col-sm-4">
                     <?php if (!isset($_SESSION['logIn'])): ?> 
                                    <form action="cart/checkout-ajax.php" method="POST" role="form" id="form-order">
                                       
                                        <div class="form-group">
                                             <label >Họ tên</label>
                                             <input type="text" class="form-control" name="full_name" placeholder="Họ tên">
                                        </div>
                                                
                                        <div class="form-group">
                                             <label >Email</label>
                                             <input type="text" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                             <label >Số điện thoại</label>
                                             <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                                        </div>
                                        <div class="form-group">
                                             <label >Địa chỉ</label>
                                             <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
                                        </div>
                                        <div class="form-group">
                                        <label for="">Note </label>
                                        <textarea name="note" class="form-control" rows="3" ></textarea>
                                        </div>
                                                                      
                                            <input type="text" name="total_amount" value="<?php echo get_cost(); ?>" />
                                            <button type="submit" name="submit" class="btn btn-primary btn-order">Xác nhận</button>
                                    </form>
                                    <?php else: ?><?php $user = $_SESSION['logIn']; ?>
                                        <table class="table table-bordered table-hover">

                        <tbody>
                            
                            <tr>
                                <th>Họ tên</th>
                                <td><?php echo $user['full_name'] ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $user['email'] ?></td>
                            </tr>
                            <tr>
                                <th>SĐT</th>
                                <td><?php echo $user['phone'] ?></td>
                            </tr>
                            <tr>
                                <th>Địa chỉ</th>
                                <td><?php echo $user['address'] ?></td>
                            </tr>
                            
                        </tbody>
                    </table>
                    <form action="cart/checkout-ajax.php" method="POST" role="form" id="form-order">
                                        <div class="form-group">
                                             <label class="sr-only">Họ tên</label>
                                             <input type="hidden" class="form-control" name="full_name" value="<?php echo $user['full_name'] ?>" >
                                        </div>
                                                
                                        <div class="form-group">
                                             <label class="sr-only">Email</label>
                                             <input type="hidden" class="form-control" name="email" value="<?php echo $user['email'] ?>">
                                        </div>
                                        <div class="form-group">
                                             <label class="sr-only">Số điện thoại</label>
                                             <input type="hidden" class="form-control" name="phone" value="<?php echo $user['phone'] ?>">
                                        </div>
                                        <div class="form-group">
                                             <label class="sr-only">Địa chỉ</label>
                                             <input type="hidden" class="form-control" name="address" value="<?php echo $user['address'] ?>">
                                        </div>
                                        <?php if(empty($user['full_name']) || empty($user['phone']) || empty($user['address'])) : ?>
                                        <a href="index.php?route=login&actions=edit-info" class="btn btn-primary">Bổ sung thông tin</a>
                                        <?php else: ?>
                                        <div class="form-group">
                                        <label for="">Note </label>
                                        <textarea name="note" class="form-control" rows="3" ></textarea>
                                        </div>
                                                                      
                                            <input type="hidden" name="total_amount" value="<?php echo get_cost(); ?>" />
                                            <button type="submit" name="submit" class="btn btn-primary btn-order">Xác nhận</button>
                                        <?php endif; ?>
                                         
                                    </form> 
                                    <?php endif; ?>                 
                    </div>
                    <div class="col-sm-8" style="margin-top: 5px;">
                        <table class="table cart-table space-30 " >
                            <thead>
                                <tr class="text-center">
                                    <th >Hình ảnh</th>
                                    <th width="30%">Tên sản phẩm</th>
                                    <th width="20%">Giá</th>
                                    <th width="10%">Số lượng</th>
                                    <th width="20%">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-list-cart">
                                
                                <?php if(count($carts)) : foreach($carts as $p) : ?>
                    
                                    <tr class="item_cart">
                    
                                        <td>
                                            <img src="uploads/products/<?php echo $p['image'] ?>" width="50"/>
                                        </td>
                                        <td><?php echo $p['name'] ;?></td>
                                        <td><?php echo number_format($p['price'],0,' ',',') ;?> đ/kg</td>
                                        <td>
                                            <?php echo $p['quantity'] ;?>
                                        </td>
                                        <td>
                                            <?php echo number_format(thanh_tien($p['id']),0,' ','.') ;?> đ
                                        </td>
                                        
                                    </tr>
                    
                                <?php endforeach; endif; ?>
                                
                            </tbody>
                        </table>
                        <div id="tbody-list-all-cart">
                            <div class="row-total">
                                <div class="float-left">
                                    <h3>Tổng tiền</h3>
                                </div>
                                <!--End align-left-->
                                <div class="float-right">
                                    <p><?php echo number_format(get_cost(),0,' ','.'); ?> VNĐ</p>
                                </div>
                                <!--End align-right-->
                            </div>
                            
                        </div>
                        <!-- End box -->                          
                    </div>
                    <?php  else: ?>

                    <div >
                        <div class="alert text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <div style="font-size: 25px;"><strong>Lỗi:</strong> Giỏ hàng không có sản phẩm!!!</div>
                            <p style="margin-top: 30px;">
                                <a class="link-v1 lh-50 bg-brand" href="index.php" ><i class="fa fa-caret-left"></i> TIẾP TỤC MUA HÀNG</a>
                            </p>
                        </div>
                    </div>
                <?php  endif; ?>
                </div>
                <div class="modal fade" id="modal-message">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 class="modal-title">Xác nhận</h3>
                            </div>
                            <div class="modal-body">
                                <strong> Đặt hàng thành công</strong>
                            </div>
                            <div class="modal-footer">
                                
                                
                                <a href="index.php?route=cart&actions=finish-order" class="btn btn-primary">Finish!</a>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End container -->
        </div>
        <!-- End cat-box-container -->
    </div>
    
<?php
if (isset($_GET['clear-cart'])) {
            clear_cart();
        }
        ?>
    
  