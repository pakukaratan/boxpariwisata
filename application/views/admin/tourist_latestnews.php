<div class="row-fluid row-custom">
    <div class="grid simple">
        <div class="grid-title">
            <div class="row">
                <div class="col-md-3">
                    <h3>Add New Latest News</h3>
                </div>
                
                <div class="dropdown pull-right" style="margin-top: 5px;">
                    <button id="create-new" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="grid-body collapse <?php if(validation_errors()) echo 'in'; ?>" id="create-form">
            <div class="col-md-10 col-md-offset-1">
                <form action="<?php echo base_url('admin/tourist-latestnews/add');?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="title">Title</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="description">Description</label>
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
                        <input type="submit" class="btn btn-info" value="Add Tourist Latest News">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="grid simple">
        <div class="grid-title">
            <div class="row">
                <div class="col-md-5">
                    <h3>Latest News Articles List</h3>
                </div>
            </div>
        </div>
        <div class="grid-body">
            <div class="col-md-12">
                <table class="table datatable">
                    <thead>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th width="120"><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </thead>
                    <tbody>
                        <?php foreach ($latestnewss as $latestnews):?>
                            <tr>
                                <td><a href="<?= base_url("admin/latestnews/create/ticket/$latestnews->id") ?>"><?= $latestnews->title;?></a></td>
                                <td>
                                    <span title="<?= $latestnews->description;?>">
                                        <?= (strlen($latestnews->description) > 100? substr($latestnews->description, 0,100): $latestnews->description);?>
                                    </span>
                                </td>
                                <td><img src="<?= base_url("assets/img/$latestnews->image") ?>" width="50"></td>
                                <td>
                                    <a href="<?= base_url("admin/tourist-latestnews/edit/$latestnews->id") ?>" class="btn btn-default btn-xs" title="edit"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= base_url("admin/tourist-latestnews/delete/$latestnews->id") ?>" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>