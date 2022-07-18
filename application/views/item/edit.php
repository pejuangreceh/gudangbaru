<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <!-- right column -->
                <div class="col-md-6 ">

                    <!-- general form elements disabled -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <form method="POST" action="<?php echo base_url('itemController/update/' . $id); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>SKU Number</label>
                                            <input value="<?= $sku_number; ?>" type="text" class="form-control" name="sku_number" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Item Code</label>
                                            <input value="<?= $item_code; ?>" type="text" class="form-control" name="item_code" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <input value="<?= $item_name; ?>" type="text" class="form-control" name="item_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Category Item</label>
                                            <select name="item_category_id" class="form-control select2" style="width: 100%;">
                                                <?php foreach ($categories as $category) { ?>
                                                    <option <?php if ($category->id == $item_category_id) {
                                                                echo 'selected="selected"';
                                                            } ?> value="<?= $category->id; ?>"><?= $category->category_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select name="unit_id" class="form-control select2" style="width: 100%;">
                                                <?php foreach ($units as $unit) { ?>
                                                    <option <?php if ($unit->id == $unit_id) {
                                                                echo 'selected="selected"';
                                                            } ?> value="<?= $unit->id; ?>"><?= $unit->unit_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Buying Price</label>
                                            <input value="<?= $buying_price; ?>" type="number" class="form-control" name="buying_price" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Selling Price</label>
                                            <input value="<?= $selling_price; ?>" type="number" class="form-control" name="selling_price" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <button onclick="history.back()" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>