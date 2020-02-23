<div class="row-fluid row-custom">

    <div class="grid simple">

        <div class="grid-title">
            <div class="row">
                <div class="col-md-5">
                    <h3>Restaurant Table Booking History</h3>
                </div>
            </div>
        </div>

        <div class="grid-body">

            <div class="col-md-12">

                <table class="table datatable">

                    <thead>
                        <th>Restaurant Name</th>
                        <th>Restaurant Image</th>
                        <th>Tourist Name</th>
                        <th>Table Type</th>
                        <th>Total Person</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Booking Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>

                        <?php foreach ($restaurant_bookings as $restaurant_booking): ?>
                            <tr>
                                <td><?= $restaurant_booking->name ?></td>
                                <td><img src="<?= base_url("assets/img/$restaurant_booking->restaurant_image") ?>" width="50"></td>
                                <td><?= $restaurant_booking->tourist_name ?></td>
                                <td><?= $restaurant_booking->booking_no ?></td>
                                <td><?= $restaurant_booking->booking_count ?></td>
                                <td><?= $restaurant_booking->rate ?> IDR</td>
                                <td><?= $restaurant_booking->total_price ?> IDR</td>
                                <td><?= $restaurant_booking->date ?></td>
                                <td><?= $restaurant_booking->status ?></td>
                                <td><?php if ($restaurant_booking->status == "Waiting Confirmation"){ echo "<a href='" . base_url("admin/confirm/restaurant/$restaurant_booking->id") . "' class='btn btn-primary'>Confirm</a>";} ?></td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
