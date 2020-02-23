<div class="row-fluid row-custom">

    <div class="grid simple">
        <div class="grid-title">
            <div class="row">
                <div class="col-md-5">
                    <h3>Edit Precaution</h3>
                </div>
            </div>
        </div>
        <div class="grid-body">
            <div class="col-md-10 col-md-offset-1">
                <form action="<?php echo base_url('admin/tourist-precaution/update');?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?php echo $precaution->id;?>">
                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="title">Title</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="<?php echo $precaution->title;?>" placeholder="Cox's Bazar Sea Beach">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Description</label>
                        </div>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="6" name="description"><?php echo $precaution->description;?></textarea>
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
                            <?php if($precaution->image):?>
                                <center><img id="image" src="<?php echo base_url('assets/img/'.$precaution->image);?>" width="150" /></center>
                            <?php else:?>
                                <center><img id="image" class="hidden" width="150" /></center>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="text-right">
                        <input type="submit" class="btn btn-info" value="Update Tourist Precaution">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>