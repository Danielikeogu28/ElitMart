<x-app-layout>
    <section class="wsus__product_details mt_170 mb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 wow fadeInLeft">
                    <div class="wsus__product_details_slider_area">
                        <div class="row slider-forFive">
                            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 mx-auto">
                                <div class="wsus__product_details_slide_show_img">
                                    <img src="{{ asset($product->image) }}" alt="product" class="img-fluid w-100"
                                        style="max-width: 300px; height: auto;">
                                </div>
                            </div>
                            @foreach ($product->images as $image)
                                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 mx-auto">
                                    <div class="wsus__product_details_slide_show_img">
                                        <img src="{{ asset($image->path) }}" alt="product" class="img-fluid w-100"
                                            style="max-width: 300px; height: auto;">
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="wsus__product_details_slider">
                            <div class="row slider-navFive">
                                <div class="col-xl-2">
                                    <div class="wsus__product_details_slider_img">
                                        <img src="{{ asset($product->image) }}" alt="product" class="img-fluid w-100">
                                    </div>
                                </div>
                                @foreach ($product->images as $image)
                                    <div class="col-xl-2">
                                        <div class="wsus__product_details_slider_img">
                                            <img src="{{ asset($image->path) }}" alt="product" class="img-fluid w-100">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-7 wow fadeInRight">
                    <div class="wsus__product_summary">
                        <h2>{{ $product->name }}</h2>
                        <span>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <b>8k+ reviews</b>
                        </span>
                        <h6>₦{{ number_format($product->price, 2) }}</h6>
                        <p>{{ $product->about }}</p>

                        <h6 class="mt_30">Color</h6>
                        <select class="select_2 color" name="color">
                            <option value="">Select Color</option>
                            @foreach ($product->colors as $color)
                                <option value="{{ $color->color }}">{{ $color->color }}</option>
                            @endforeach

                        </select>


                        <div class="wsus__product_add_cart">
                            <div class="wsus__product_quantity">
                                <button class="minus decrement" type="submit"><i class="far fa-minus"></i></button>
                                <input type="text" value="1" min="1" class="qty" name="qty">
                                <button class="plus increment" type="submit"><i class="far fa-plus"></i></button>
                            </div>
                            <div class="wsus__buy_cart_button">
                                <a href="" class="common_btn add-to-cart" data-id="{{ $product->id }}">Add to
                                    cart</a>
                            </div>
                        </div>
                        <ul class="wishlist d-flex flex-wrap">
                            <li><a href="#"><span><i class="fal fa-heart"></i></span>ADD TO WISHLIST</a></li>
                            <li><a href="#"><span><i class="fal fa-share-alt"></i></span>SHARE</a></li>
                        </ul>
                        <ul class="details">
                            <li>SKU:<span>{{ $product->sku }}</span></li>
                            <li>Quantity:<span>{{ $product->qty }}</span></li>
                            <li>Tags:<span>{{ $product->tag }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="wsus__product_details_menu_contant">
                        <div class="wsus__product_description wow fadeInUp">
                            <p>{{ $product->description }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".add-to-cart").on("click", function(e) {
                    e.preventDefault();
                    let id = $(this).data("id");
                    let color = $(".color").val();
                    let qty = $(".qty").val();

                    $.ajax({

                        url: "{{ url('http://127.0.0.1:8000/add-to-cart') }}/" + id,
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            color: color,
                            qty: qty
                        },
                        beforeSend: function() {
                            if (!validation()) {
                                return false;
                            }
                        },
                        success: function(data) {
                            if (data.status == "ok") {
                                $(".cart-count").html(data.cart_count)
                                notyf.success('Product Added to Cart..');
                            }
                        },
                        error: function(xhr, status, error) {}
                    });

                });

                function validation() {
                    let color = $(".color").val();
                    if (color == "") {
                        notyf.error('Please Select a colore')
                        return false;
                    }
                    return true;
                }

                $(".increment").on("click", function() {
                    let qty = $(".qty").val();
                    qty = parseInt(qty) + 1;
                    $(".qty").val(qty);
                });
                $(".decrement").on("click", function() {
                    let qty = $(".qty").val();
                    qty = parseInt(qty) - 1;
                    if (qty < 1) {
                        qty = 1;
                    }
                    $(".qty").val(qty);
                });
                console.log("clicked");
            });
        </script>
    </x-slot>
</x-app-layout>
