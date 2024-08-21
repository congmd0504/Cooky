<div class="main-content">
    <div class="page-content pt-4 ">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Quản lý sản phẩm chi tiết</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Quản lý sản phẩm chi tiết</a>
                                </li>
                                <li class="breadcrumb-item active">Thêm sản phẩm chi tiết</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thêm sản phẩm chi tiết</h4>
                            <form action="?act=add-detail-sp" method="post" enctype="multipart/form-data" id="myForms" class="row" >
                                <div class="col-6">
                                <div class="form-group">
                                    <label for="simpleinput">Tên sản phẩm</label>
                                    <select name="id_san_pham" class="form-control" id="">
                                        <?php foreach($list_san_pham as $san_pham) :?>
                                            <option value="<?=$san_pham['id_san_pham']?>"><?=$san_pham['ten_san_pham']?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="simpleinput">Số lượng</label>
                                    <input type="number" class="form-control" name="so_luong">
                                </div>
                                </div>
                                <div class="col-6">
                                <div class="form-group">
                                    <label for="simpleinput">Size</label>
                                    <select name="id_size" class="form-control" id="">
                                        <?php foreach($list_size as $size) :?>
                                            <option value="<?=$size['id_size']?>"><?=$size['size']?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="simpleinput">Đồ ăn thêm</label>
                                    <select name="id_do_an_them" class="form-control" id="">
                                        <?php foreach($list_do_an_them as $do_an_them) :?>
                                            <option value="<?=$do_an_them['id_do_an_them']?>"><?=$do_an_them['do_an_them']?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="float-right ">
                                    <!-- <a href="?act=listdm" class="btn btn-outline-success">Danh sách danh mục</a> -->
                                    <input type="submit" id="inputError" class="btn btn-success" value="Thêm sản phẩm chi tiết" name="add-detail-sp">
                                </div>
                                </div>
                            </form>
                        </div>
                        <!-- end card-body-->
                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">2023 © Nguyễn Huy Tới.</div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        Quản lý Website
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>