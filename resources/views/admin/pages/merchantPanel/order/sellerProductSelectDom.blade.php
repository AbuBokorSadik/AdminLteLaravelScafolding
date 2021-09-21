<label for="product">Products</label>
<select class="form-control" name="product_id" id="product">
    <option value="" selected>Select seller...</option>
    @foreach($products as $product)
    <option value="{{ $product->id }}">{{ $product->name }}</option>
    @endforeach
</select>

<div class="row">
    <!-- left column -->
    <div class="col-md" id="add_product">
        <!-- product quantity input content goes here -->
    </div>
</div>

<script>
    $(function() {
        const getProduct = function() {
            if ($(this).val()) {
                let product_id = $(this).val();
                let product_exist = false;
                $(".product_quantity").each(function() {
                    if (product_id == $(this).attr("product_id")) {
                        product_exist = true;
                    }

                });
                // console.log("product exist: " + product_exist);
                if (!product_exist) {
                    const getUrl = "{{ URL('merchant/product') }}" + "/" + $(this).val();
                    $.ajax({
                        type: "GET",
                        url: getUrl,
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.code == 200) {
                                $("#add_product").append(data.data);
                                console.log(data.data);
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
        }

        $("#product").change(getProduct);
    });
</script>