<div class="row-fluid row-custom">

    <div class="grid simple">

        <div class="grid-title">
            <div class="row">
                <div class="col-md-3">
                    <h3>Add New Restaurant Table</h3>
                </div>
                
                <div class="dropdown pull-right" style="margin-top: 5px;">
                    <button id="create-new" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>

        <div class="grid-body collapse <?php if(validation_errors()) echo 'in'; ?>" id="create-form">

            <div class="col-md-10 col-md-offset-1">

                <form action="<?= base_url("admin/restaurant/insert/table") ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                    
                    <input type="hidden" name="restaurant_id" value="<?= $restaurant_id ?>" />

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
                            <input type="text" class="form-control" name="rate" placeholder="1000">
                        </div>
                    </div>

                    <div class="text-right">
                        <input type="submit" class="btn btn-info" value="Add Tourist Restaurant">
                    </div>

                </form>

            </div>

        </div>

    </div>

    <div class="grid simple">
        <div class="grid-title">
            <div class="row">
                <div class="col-md-5">
                    <h3>Restaurant Table List</h3>
                </div>
            </div>
        </div>
        <div class="grid-body">
            <div class="col-md-12">
                <table class="table datatable">
                    <thead>
                        <th>Type</th>
                        <th>Down Payment</th>
                        <th width="120"><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </thead>
                    <tbody>
                        <?php foreach ($restaurant_tables as $restaurant_table):?>
                            <tr>
                                <td><?= $restaurant_table->table_no?></td>
                                <td><?= $restaurant_table->rate ?> IDR</td>
                                <td>
                                    <a href="<?= base_url("admin/restaurant/edit/table/$restaurant_table->id") ?>" class="btn btn-default btn-xs" title="edit"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= base_url("admin/restaurant/delete/table/$restaurant_table->id") ?>" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>