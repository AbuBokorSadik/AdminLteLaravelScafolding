<div class="row">
    <div class="col-md">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Product Details</h3>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                        <p><b>Product Weight</b> </p>
                                    </div>
                                    <div class="col-6">
                                        <p>{{ $order->product_weight }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                        <p><b>Product Height</b> </p>
                                    </div>
                                    <div class="col-6">
                                        <p>{{ $order->product_height }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                        <p><b>Product Length</b> </p>
                                    </div>
                                    <div class="col-6">
                                        <p>{{ $order->product_length }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                        <p><b>Product Width</b> </p>
                                    </div>
                                    <div class="col-6">
                                        <p>{{ $order->product_width }}</p>
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