<div class="row">
    <dv class="col-md-12">
    <?php 
    $arrImages = [];
    $Images1 = "assets/img/banner1.jpg";
    $Images2 = "assets/img/banner2.jpg";
    $Images3 = "assets/img/banner3.jpg";
    $Images4 = "assets/img/banner4.jpg";
    $Images5 = "assets/img/banner5.jpg";
    array_push($arrImages,$Images1);
    array_push($arrImages,$Images2);
    array_push($arrImages,$Images3);
    array_push($arrImages,$Images4);
    array_push($arrImages,$Images5);
    $selectedImages = $arrImages[rand(0,count($arrImages)-1)];
    ?>
        <div class="banner" style="background-image:url(<?= base_url($selectedImages);?>);">
            <div class="banner-front row">
                <!-- search option -->
                <?php 
                    $arrQuotes = [];
                    $Quotes1 = "“A vacation is what you take when you can no longer take what you’ve been taking.” — Earl Wilson";
                    $Quotes2 = "“Isn’t it amazing how much stuff we get done the day before vacation?” — Charlie Brown";
                    $Quotes3 = "“A vacation is having nothing to do and all day to do it in.” — Robert Orben";
                    $Quotes4 = "“Happiness consists of living each day as if it were the first day of your honeymoon and the last day of your vacation.” — Leo Tolstoy";
                    $Quotes5 = "“No man needs a vacation so much as the man who has just had one.” — Elbert Hubbard";
                    $Quotes6 = "“The journey, not the arrival, matters.” — T.S. Eliot";
                    array_push($arrQuotes,$Quotes1);
                    array_push($arrQuotes,$Quotes2);
                    array_push($arrQuotes,$Quotes3);
                    array_push($arrQuotes,$Quotes4);
                    array_push($arrQuotes,$Quotes5);
                    array_push($arrQuotes,$Quotes6);
                    $selectedQuotes = $arrQuotes[rand(0,count($arrQuotes)-1)];
                ?>
                <h3 class="banner-quote"><?php echo $selectedQuotes ?></h2>
            </div>
        </div>
    </dv>  
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <section class="row posts">
                <header><h1 class="text-danger text-center">Book Spots</h1></header>
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
                <article class="post">
                    <div class="row well">
                        <div class="col-md-12">
                            <table class="table datatable">
                                <thead>
                                    <th>Ticket Type</th>
                                    <th>Price (IDR)</th>
                                    <th>Total Ticket</th>
                                    <th width="120"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                </thead>
                                <tbody>
                                    <?php foreach ($spot_tickets as $spot_ticket):?>
                                        <form action="<?= base_url("tourist/book/spot/ticket/$spot_ticket->id") ?>" class="form-horizontal" method="post">
                                            <input type="hidden" name="tourist_spot_id" value="<?= $spot_ticket->spot_id ?>" />
                                            <tr>
                                                <td><input type="text" class="form-control" name="ticket_type" value="<?= $spot_ticket->is_weekend == 1 ? "Weekend" : "Weekdays" ?>" readonly /></td>
                                                <td><input type="text" class="form-control" name="rate" value="<?= $spot_ticket->rate ?>" readonly /></td>
                                                <td>
                                                    <select class="form-control" name="booking_count">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-check"></i></button>
                                                </td>
                                            </tr>
                                        </form>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</div>
