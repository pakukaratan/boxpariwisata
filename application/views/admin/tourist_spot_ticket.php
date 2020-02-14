<div class="row-fluid row-custom">

    <div class="grid simple">

        <div class="grid-title">
            <div class="row">
                <div class="col-md-3">
                    <h3>Add New Spot Ticket</h3>
                </div>
                
                <div class="dropdown pull-right" style="margin-top: 5px;">
                    <button id="create-new" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>

        <div class="grid-body collapse <?php if(validation_errors()) echo 'in'; ?>" id="create-form">

            <div class="col-md-10 col-md-offset-1">

                <form action="<?= base_url("admin/spot/insert/ticket") ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                    
                    <input type="hidden" name="spot_id" value="<?= $spot_id ?>" />

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Day</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" name="day">
                                <option value="0">WeekDays</option>
                                <option value="1">WeekEnd</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Price (IDR)</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="rate" placeholder="1000">
                        </div>
                    </div>

                    <div class="text-right">
                        <input type="submit" class="btn btn-info" value="Add Tourist Spot">
                    </div>

                </form>

            </div>

        </div>

    </div>

    <div class="grid simple">
        <div class="grid-title">
            <div class="row">
                <div class="col-md-5">
                    <h3>Spot Ticket List</h3>
                </div>
            </div>
        </div>
        <div class="grid-body">
            <div class="col-md-12">
                <table class="table datatable">
                    <thead>
                        <th>Type</th>
                        <th>Price</th>
                        <th width="120"><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </thead>
                    <tbody>
                        <?php foreach ($spot_tickets as $spot_ticket):?>
                            <tr>
                                <td><?= $spot_ticket->is_weekend == 1 ? "Weekend" : "WeekDays" ?></td>
                                <td><?= $spot_ticket->rate ?> IDR</td>
                                <td>
                                    <a href="<?= base_url("admin/spot/edit/ticket/$spot_ticket->id") ?>" class="btn btn-default btn-xs" title="edit"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= base_url("admin/spot/delete/ticket/$spot_ticket->id") ?>" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>