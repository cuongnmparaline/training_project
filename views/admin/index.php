
<?php
require_once('views/layouts/header.php');
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="form-search" id="form-search">
                <form action="?controller=admin&action=search" method="POST">
                    <label for="name">Name*</label>
                    <input type="text" name="name" id="name" value=""> <br> <br>
                    <?php echo form_error('name')?>
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" value=""> <br> <br>

                    <a href="?controller=admin&action=index" class="btn btn-primary">Reset</a>
                    <button type="submit" id="search-button" class="btn btn-secondary">Search</button>
                </form>
                <br> <br>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">

                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Tên đăng nhập</span></td>
                                <td><span class="thead-text">Họ và tên</span></td>
                                <td><span class="thead-text">Email</span></td>
                                <td><span class="thead-text">Số điện thoại</span></td>
                                <td><span class="thead-text">Địa chỉ</span></td>
                                <td><span class="thead-text">Phân quyền</span></td>
                            </tr>
                            </thead>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem" value=""></td>
                                    <td><span class="tbody-text"></span></td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="?mod=users&action=update&" title=""></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="thead-text"></span></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging-pages" class="fl-right">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
