<div class="row-fluid row-custom">

    <div class="grid simple">

        <div class="grid-title">
            <div class="row">
                <div class="col-md-5">
                    <h3>Edit Spot Ticket</h3>
                </div>
            </div>
        </div>

        <div class="grid-body">

            <div class="col-md-10 col-md-offset-1">

                <form action="<?= base_url("admin/spot/update/ticket/$spot_ticket->id") ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                    
                    <input type="hidden" name="spot_id" value="<?= $spot_ticket->spot_id ?>" />

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
                            <input type="text" class="form-control" name="rate" value="<?= $spot_ticket->rate ?>" placeholder="1000">
                        </div>
                    </div>

                    <div class="text-right">
                        <input type="submit" class="btn btn-info" value="Update Tourist spot">
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
