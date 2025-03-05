<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
           
            <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
            <h4 class="pt-3 pb-3 text-primary">Admin DashBoard</h4>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Edit product</h3>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Go Back</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div>
                                <img style="width:100px  !important; height:100px; border-radius:50%;" src="{{ asset($product->image) }}" alt="">
                            </div>
                            <label for="" class="mt-2 mb-2">Image</label>
                            <x-text-input type="file" name="image" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="" class="mt-2 mb-2">Images</label>
                            <x-text-input type="file" name="images[]" class="form-control" multiple />
                        </div>
                        <div class="d-flex">
                            @foreach ($product->images as $image )
                                <img style="width:100px  !important; " src="{{ asset($image->path) }}" class="ms-2 mt-2" alt="">
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Name</label>
                            <x-text-input type="text" name="name" class="form-control"
                                value="{{ $product->name }}" />
                        </div>
                        <div class="form-group">
                            <label for="" class="mt-2 mb-2">&#8358; Price</label>
                            <x-text-input type="text" name="price" class="form-control"
                                value="{{ $product->price }}" placeholder="₦0.00" />
                        </div>
                        
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Color</label>
                            <x-select-input name="color[]" class="form-control" multiple>
                             <option value="">Select Color</option>
                             <option @selected(in_array('black', $colors ?? [])) value="black">Black</option>
                             <option @selected(in_array('white', $colors ?? [])) value="white">White</option>
                             <option @selected(in_array('silver', $colors ?? [])) value="silver">Silver</option>
                             <option @selected(in_array('red', $colors ?? [])) value="red">Red</option>
                             <option @selected(in_array('blue', $colors ?? [])) value="blue">Blue</option>
                             <option @selected(in_array('green', $colors ?? [])) value="green">Green</option>
                             
                         </x-select-input>
                         
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">About</label>
                            <x-text-input type="text" name="about" class="form-control"
                                value="{{ $product->about }}" />
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Qty</label>
                            <x-text-input type="text" name="qty" class="form-control"
                                value="{{ $product->qty }}" />
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Sku</label>
                            <x-text-input type="text" name="sku" class="form-control"
                                value="{{ $product->sku }}" />
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Tag</label>
                            <x-text-input type="text" name="tag" class="form-control"
                                value="{{ $product->tag }}" />
                        </div>
                        <div class="form-group">
                            <label for="description"class="mt-2 mb-2">Description</label>
                            <textarea id="descriptionx" name="description" class="form-control">{!! $product->description !!}</textarea>
                        </div>
                        <x-primary-button>Update</x-primary-button>
                    </form>

                </div>
            </div>
    </section>
    <x-slot name="scripts">
        <script>
            tinymce.init({
                selector: '#description',
                height: 500,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
        </script>

    </x-slot>
</x-app-layout>
