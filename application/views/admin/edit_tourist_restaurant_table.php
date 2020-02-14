<div class="row-fluid row-custom">

    <div class="grid simple">

        <div class="grid-title">
            <div class="row">
                <div class="col-md-5">
                    <h3>Edit Restaurant Table</h3>
                </div>
            </div>
        </div>

        <div class="grid-body">

            <div class="col-md-10 col-md-offset-1">

                <form action="<?= base_url("admin/restaurant/update/table/$restaurant_table->id") ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                    
                    <input type="hidden" name="restaurant_id" value="<?= $restaurant_table->restaurant_id ?>" />

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Type</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" name="type">
                                <option value="VIP">VIP</option>
                                <option value="Regular">Regular</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Down Payment (IDR)</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="rate" value="<?= $restaurant_table->rate ?>" placeholder="1000">
                        </div>
                    </div>

                    <div class="text-right">
                        <input type="submit" class="btn btn-info" value="Update Tourist restaurant">
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
