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
                <header><h1 class="text-danger text-center">Your Restaurant Booking History</h1></header>
                <br><br><br>
                <article class="post">
                    <div class="row well">
                        <div class="col-md-12">
                            <table class="table datatable">
                                <thead>
                                    <th>Restaurant Name</th>
                                    <th>Restaurant Image</th>
                                    <th>Total Person</th>
                                    <th>Down Payment</th>
                                    <th>Total Down Payment</th>
                                    <th>Booking Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($histories as $history):?>
                                        <tr>
                                            <td><?= $history->restaurant_name ?></td>
                                            <td><img src="<?= base_url("assets/img/$history->restaurant_image") ?>" width="50"></td>
                                            <td><?= $history->booking_count ?></td>
                                            <td><?= $history->rate ?> IDR</td>
                                            <td><?= $history->total_price ?> IDR</td>
                                            <td><?= $history->date ?></td>
                                            <td><?= $history->status ?></td>
                                            <td><?php if ($history->status == "Waiting for payment"){ echo "<a href='" . base_url("tourist/pay/restaurant/$history->id") . "' class='btn btn-primary'>Pay</a>";} ?></td>
                                        </tr>
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
