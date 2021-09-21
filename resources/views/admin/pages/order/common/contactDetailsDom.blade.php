<div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Contact Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Contact Name</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->contact_name }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Contact Address</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->address }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Contact Email</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->contact_email }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Contact Mobile</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->contact_mobile }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Address Latitude</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->address_lat }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Address Longitude</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->address_lng }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Instruction</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->instruction }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Note</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->note }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>