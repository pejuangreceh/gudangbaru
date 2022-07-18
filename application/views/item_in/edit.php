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
                        <form method="POST" action="<?php echo base_url('OrderController/update/' . $id); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Order Code</label>
                                            <input value="<?= $order_code; ?>" type="text" class="form-control" name="order_code" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Item id</label>
                                            <select name="order_category_id" class="form-control select2" style="width: 100%;">
                                                <?php foreach ($categories as $category) { ?>
                                                    <option <?php if ($category->id == $order_category_id) {
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