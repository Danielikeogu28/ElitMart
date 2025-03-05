<x-app-layout>
    <section class="wsus__cart mt_170 pb_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 wow fadeInUp">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="pro_img">Item</th>

                                        <th class="pro_name">Name</th>

                                        <th class="pro_select">Quantity</th>

                                        <th class="pro_tk ">Price</th>

                                        <th class="pro_tk ">Total Price</th>

                                        <th class="pro_icon">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="pro_img">
                                                <img src="{{ asset($product['image']) }}" alt="product"
                                                    class="img-fluid w-100">
                                            </td>

                                            <td class="pro_name">
                                                <a href="#">{{ $product['name'] }}</a>
                                            </td>

                                            <td class="pro_select">
                                                <div class="quentity_btn">
                                                    <button class="btn btn-danger decrement"
                                                        data-id="{{ $product['id'] }}"><i
                                                            class="fal fa-minus"></i></button>
                                                    <input class="qty" type="text" placeholder="1"
                                                        value="{{ $product['qty'] }}" min="1">
                                                    <button class="btn btn-success increment"
                                                        data-id="{{ $product['id'] }}"><i
                                                            class="fal fa-plus"></i></button>
                                                </div>
                                            </td>

                                            <td class="pro_tk  ">
                                                <div>₦{{ number_format($product['price'], 2) }}</div>
                                            </td>

                                            <td class="pro_tk total-price">
                                                <div>₦{{ number_format($product['price'] * $product['qty'], 2) }}</div>
                                            </td>


                                            <td class="pro_icon">
                                                <form action="{{ route('remove-cart', $product['id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><i class="fal fa-trash"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="wsus__cart_list_bottom">
                        <div class="row justify-content-between">
                            <div class="col-md-6 col-xl-5 ms-auto">
                                <div class="wsus__cart_list_pricing">
                                    @php
                                        $total = 0;
                                        foreach ($products as $product) {
                                            $total += $product['price'] * $product['qty'];
                                        }
                                    @endphp
                                    <h6>Total: <span>₦{{ number_format($total, 2) }}</span></h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <ul class="wsus__cart_list_bottom_btn">
                        <li><a href="{{ route('home') }}" class="common_btn cont_shop">Continue To Shipping</a>
                        </li>

                        @if ($total > 0)
                            <form method="POST" action="{{ route('paystack.pay') }}">
                                @csrf
                                <input type="hidden" name="total" value="{{ $total }}">
                                <button type="submit" class="btn btn-primary">Pay with Paystack</button>
                            </form>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {

                $(".increment").on("click", function() {
                    let qty = $(this).siblings(".qty").val();
                    let id = $(this).data("id");
                    qty = parseInt(qty) + 1;
                    $(this).siblings(".qty").val(qty);

                    $.ajax({
                        url: "{{ url('/update-quantity') }}",
                        method: "POST",

                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            qty: qty
                        },
                        success: function(data) {
                            if (data.status == "ok") {
                                window.location.reload();
                            }
                        },
                        error: function(xhr, status, error) {}
                    });
                });

                $(".decrement").on("click", function() {
                    let qty = $(this).siblings(".qty").val();
                    let id = $(this).data("id");
                    qty = parseInt(qty) - 1;
                    if (qty < 1) {
                        qty = 1;
                    }
                    $(this).siblings(".qty").val(qty);
                    $.ajax({
                        url: "{{ url('/update-quantity') }}",
                        method: "POST",

                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            qty: qty
                        },
                        success: function(data) {
                            if (data.status == "ok") {
                                window.location.reload();
                            }
                        },
                        error: function(xhr, status, error) {}
                    });

                });
                console.log("clicked");
            });
        </script>
    </x-slot>
</x-app-layout>
