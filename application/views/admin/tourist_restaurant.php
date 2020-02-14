<div class="row-fluid row-custom">
    <div class="grid simple">
        <div class="grid-title">
            <div class="row">
                <div class="col-md-3">
                    <h3>Add New Restaurant</h3>
                </div>
                
                <div class="dropdown pull-right" style="margin-top: 5px;">
                    <button id="create-new" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="grid-body collapse <?php if(validation_errors()) echo 'in'; ?>" id="create-form">
            <div class="col-md-10 col-md-offset-1">
                <form action="<?php echo base_url('admin/tourist-restaurant/add');?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Restaurant Name</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" placeholder="Restaurant Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Type</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="type" placeholder="Restaurant Type">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Location</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="location" placeholder="Restaurant Location">
                        </div>
                    </div>

                     <div class="form-group" style="display:none">
                        <div class="col-md-2">
                            <label for="name">Division</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="division" placeholder="Chittagong">
                        </div>
                    </div>

                    <div class="form-group" style="display:none">
                        <div class="col-md-2">
                            <label for="name">District</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="district" placeholder="Cox's Bazar">
                        </div>
                    </div>

                    <div class="form-group" style="display:none">
                        <div class="col-md-2">
                            <label for="name">Area</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="area" placeholder="Kolatoli, Cox's Bazar, Chittagong">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Description</label>
                        </div>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="6" name="description"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2">Image</label>
                        <div class="col-md-10">
                            <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" id="image-input">
                            <span id="image-error" class="text-danger hidden">only png, jpg & jpeg file types are allowed</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <center><img id="image" class="hidden" width="150" /></center>
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
                    <h3>Restaurant List</h3>
                </div>
            </div>
        </div>
        <div class="grid-body">
            <div class="col-md-12">
                <table class="table datatable">
                    <thead>
                        <th>Name</th>
                        <th>Restaurant Type</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th width="120"><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </thead>
                    <tbody>
                        <?php foreach ($restaurants as $restaurant):?>
                            <tr>
                                <td><a href="<?= base_url("admin/restaurant/create/table/$restaurant->id") ?>"><?= $restaurant->name;?></a></td>
                                <td><?= $restaurant->type;?></td>
                                <td><?= $restaurant->location;?></td>
                                <td>
                                    <span title="<?= $restaurant->description;?>">
                                        <?= (strlen($restaurant->description) > 100? substr($restaurant->description, 0,100): $restaurant->description);?>
                                    </span>
                                </td>
                                <td><img src="<?= base_url("assets/img/$restaurant->image") ?>" width="50"></td>
                                <td>
                                    <a href="<?= base_url("admin/restaurant/create/table/$restaurant->id") ?>" class="btn btn-success btn-xs" title="add tables"><i class="fa fa-plus"></i></a>
                                    <a href="<?= base_url("admin/tourist-restaurant/edit/$restaurant->id") ?>" class="btn btn-default btn-xs" title="edit"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= base_url("admin/tourist-restaurant/delete/$restaurant->id") ?>" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>