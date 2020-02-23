<div class="row-fluid row-custom">

    <div class="grid simple">

        <div class="grid-title">
            <div class="row">
                <div class="col-md-5">
                    <h3>Spot Ticket Booking History</h3>
                </div>
            </div>
        </div>

        <div class="grid-body">

            <div class="col-md-12">

                <table class="table datatable">

                    <thead>
                        <th>Spot Name</th>
                        <th>Spot Image</th>
                        <th>Tourist Name</th>
                        <th>Total Ticket</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Booking Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>

                        <?php foreach ($spot_bookings as $spot_booking): ?>
                            <tr>
                                <td><?= $spot_booking->name ?></td>
                                <td><img src="<?= base_url("assets/img/$spot_booking->spot_image") ?>" width="50"></td>
                                <td><?= $spot_booking->tourist_name ?></td>
                                <td><?= $spot_booking->booking_count ?></td>
                                <td><?= $spot_booking->rate ?> IDR</td>
                                <td><?= $spot_booking->total_price ?> IDR</td>
                                <td><?= $spot_booking->date ?></td>
                                <td><?= $spot_booking->status ?></td>
                                <td><?php if ($spot_booking->status == "Waiting Confirmation"){ echo "<a href='" . base_url("admin/confirm/spot/$spot_booking->id") . "' class='btn btn-primary'>Confirm</a>";} ?></td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
