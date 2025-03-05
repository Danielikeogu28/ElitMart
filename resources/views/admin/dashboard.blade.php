<x-app-layout>
    @if(isset($products) && $products->count() > 0)
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
            <h4 class="pt-3 pb-3 text-primary">Admin DashBoard</h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">All product</h3>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <a href="{{ route('detail', $product->id) }}">
                                            <img style="width:100px !important; height:100px; border-radius:50%;" 
                                                 src="{{ asset($product->image) }}">
                                        </a>
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>₦{{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->qty }}</td>
                                    <td>
                                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-primary">edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
    @else
        <p class="text-center">No products available.</p>
    @endif
    </section>
</x-app-layout>
