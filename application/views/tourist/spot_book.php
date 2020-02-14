<div class="row">
    <dv class="col-md-12">
        <div class="banner" style="background-image:url(<?= base_url('assets/img/banner.jpg');?>);">
            <div class="banner-front row">
                <!-- search option -->
                <h3 class="banner-quote">“The gladdest moment in human life, me thinks, is a departure into unknown lands.” – Sir Richard Burton</h2>
            </div>
        </div>
    </dv>  
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <section class="row posts">
            <header><h1 class="text-danger text-center">Tourist spots in Indonesia</h1></header>
                <div class="row">
                <div class="col-md-12">
                        <?php foreach($locations as $location):?>
                            <?php $loc = str_replace(" ", "_", $location->location);?>
                            <a href="<?= base_url('spot/'.$loc);?>" class="btn btn-primary"><?= ucfirst($location->location)."(".$location->total_spot.")";?></a>
                        <?php endforeach;?>
                    </div>
                </div>
                <br><br><br>
                <?php if(isset($_SESSION['message'])): ?>
                    <?php if($_SESSION['type'] == 'success'): ?>
                        <div class="alert alert-success">
                    <?php elseif($_SESSION['type'] == 'danger'): ?>
                        <div class="alert alert-danger">
                    <?php endif ?>
                            <strong><?= $_SESSION['message'] ?></strong>
                        </div>
                <?php endif ?>
                <?php foreach($spots as $spot):?>
                    <article class="post">
                        <div class="row well">
                        <div class="spot-img col-md-6">
                                <img class="img-responsive" src="<?= base_url('assets/img/'.$spot->image);?>">
                            </div>
                            <div class="col-md-4">
                                <span class="spot-name text-info"><?= $spot->name;?></span> <br>
                                <span class="spot-info"><b>Place Type: </b><?= $spot->type;?></span> <br>
                                <span class="spot-info"><b>Location: </b><?= $spot->location;?></span> <br>
                                <p class="text-justify"><?= $location->description;?></p>
                            </div>
                            <div class="col-md-offset-1 col-md-1">
                                <a href="<?= base_url("tourist/book/spot/$location->id") ?>" class="btn btn-primary">Book</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach;?>
            </section>
        </div>
    </div>
</div>
