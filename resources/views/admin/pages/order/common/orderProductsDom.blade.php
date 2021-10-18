<div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Order Products</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <table class="table table-striped projects text-center">
                                <thead>
                                    <tr>
                                        <th width='5'>
                                            Sl#
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Unit Price
                                        </th>
                                        <th>
                                            Quantity
                                        </th>
                                        <th>
                                            Total Price
                                        </th>
                                        <th>
                                            Measurement Unit
                                        </th>
                                        <th>
                                            Image
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $serialNo = 1;
                                    @endphp
                                    @foreach($products as $product)
                                    <td>
                                        {{ $serialNo }}
                                    </td>
                                    <td>
                                        {{ $product->product->name }}
                                    </td>
                                    <td>
                                        {{ ceil($product->unit_price) }} <b> {{ config('app_configuration.currency')}} </b>
                                    </td>
                                    <td>
                                        {{ ceil($product->quantity) }}
                                    </td>
                                    <td>
                                        {{ ceil($product->total_price) }} <b> {{ config('app_configuration.currency')}} </b>
                                    </td>
                                    <td>
                                        {{ $product->measurement_unit }}
                                    </td>
                                    <td>
                                        @php
                                        $serialNo++;
                                        $imgpath = $product->product->image ? '/storage/' . $product->product->image : 'img/dummy-product.jpg';
                                        @endphp
                                        <img src="{{ asset($imgpath) }}" alt="Image not found" style="height:50px; width:50px;">
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>