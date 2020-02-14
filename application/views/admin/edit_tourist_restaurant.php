<div class="row-fluid row-custom">

    <div class="grid simple">
        <div class="grid-title">
            <div class="row">
                <div class="col-md-5">
                    <h3>Edit Restaurant</h3>
                </div>
            </div>
        </div>
        <div class="grid-body">
            <div class="col-md-10 col-md-offset-1">
                <form action="<?php echo base_url('admin/tourist-restaurant/update');?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?php echo $restaurant->id;?>">
                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Restaurant Name</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="<?php echo $restaurant->name;?>" placeholder="Cox's Bazar Sea Beach">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Type</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="type" value="<?php echo $restaurant->type;?>" placeholder="Hill, beach, forest">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Location</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="location" value="<?php echo $restaurant->location;?>" placeholder="Cox's Bazar, Chittagong">
                        </div>
                    </div>

                     <div class="form-group" style="display:none">
                        <div class="col-md-2">
                            <label for="name">Division</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="division" value="<?php echo $restaurant->division;?>" placeholder="Chittagong">
                        </div>
                    </div>

                    <div class="form-group" style="display:none">
                        <div class="col-md-2">
                            <label for="name">District</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="district" value="<?php echo $restaurant->district;?>" placeholder="Cox's Bazar">
                        </div>
                    </div>

                    <div class="form-group" style="display:none">
                        <div class="col-md-2">
                            <label for="name">Area</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="area" value="<?php echo $restaurant->area;?>" placeholder="Kolatoli, Cox's Bazar, Chittagong">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Description</label>
                        </div>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="6" name="description"><?php echo $restaurant->description;?></textarea>
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
                            <?php if($restaurant->image):?>
                                <center><img id="image" src="<?php echo base_url('assets/img/'.$restaurant->image);?>" width="150" /></center>
                            <?php else:?>
                                <center><img id="image" class="hidden" width="150" /></center>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="text-right">
                        <input type="submit" class="btn btn-info" value="Update Tourist Restaurant">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>