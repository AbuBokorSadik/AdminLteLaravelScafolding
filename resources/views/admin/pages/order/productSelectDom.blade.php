<div class="card card-info" style="margin-top: 15px;">
    <div class="card-header">
        @php
        $imgpath = $product->image ? '/storage/' . $product->image : 'img/dummy-product.jpg';
        @endphp
        <h2 class="card-title"><img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt=""> {{ $product->name }}</h2>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-3">
                <label for="product_quantity">Quantity</label>
                <input type="number" name="product_quantities[]" product_id="{{ $product->id }}" id="product_quan_{{ $product->id }}" class="form-control product_quantity">
            </div>
            <div class="col-3">
                <label for="product_measurement_unit">Measurement Unit</label>
                <input type="text" name="product_measurement_unit[]" value="{{ $product->measurement_unit }}" class="form-control product_measurement_unit" readonly>
            </div>
            <div class="col-3">
                <label for="product_unite_price">Unit Price</label>
                <input type="number" name="product_unite_price[]" id="product_uprice_{{ $product->id }}" value="{{ ceil($product->unit_price) }}" class="form-control product_unite_price" readonly>
            </div>
            <div class="col-3">
                <label for="product_total_price">Total Price</label>
                <input type="number" name="product_total_price[]" id="product_tprice_{{ $product->id }}" value="0" class="form-control product_total_price" readonly>
            </div>
            <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
        </div>
    </div>
</div>

<script>
    $(function() {
        const getAmount = function() {
            let amount = 0;
            $(".product_quantity").each(function() {
                const $input = $(this);
                const $product_id = $input.attr("product_id");
                amount += Number($("#product_tprice_" + $product_id).val());
            });
            $("#amount").val(amount);
        }

        const getServiceCharge = function() {
            const buyerId = $("#buyerId").val();
            const orderTypeId = $("#orderType").val();
            const amount = $("#amount").val();
            let serviceCharge = 0;

            if (orderTypeId) {
                const getUrl = "{{ URL('admin/service-charge') }}" + "/" + buyerId + "/" + orderTypeId;
                $.ajax({
                    type: "GET",
                    url: getUrl,
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.code == 200) {
                            if (data.data.slab_type == "P") {
                                serviceCharge = Math.ceil((Number(amount) * data.data.charge) / 100);
                            } else {
                                serviceCharge = Math.ceil(Number(amount) + data.data.charge);
                            }
                            $("#serviceCharge").val(serviceCharge);
                            // alert(serviceCharge);
                        } else {
                            alert("Something went wrong. Please try again later.");
                        }
                    },
                    error: function() {
                        alert("Something went wrong. Please try again later.");
                    }
                });
            }
        }

        $(".product_quantity").change(function() {
            const $input = $(this);
            const $product_id = $input.attr("product_id");
            const $unit_price = $("#product_uprice_" + $product_id).val();
            const $total_price = $input.val() * $unit_price;
            $("#product_tprice_" + $product_id).val($total_price);
            getAmount();
            getServiceCharge();
        });
    });
</script>