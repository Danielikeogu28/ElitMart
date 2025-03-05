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
                    <h3 class="card-title">Add New product</h3>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Go Back</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="mt-2 mb-2">Image</label>
                            <x-text-input type="file" name="image" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="" class="mt-2 mb-2">Images</label>
                            <x-text-input type="file" name="images[]" class="form-control" multiple />
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Name</label>
                            <x-text-input type="text" name="name" class="form-control"
                                value="{{ old('name') }}" />
                        </div>
                        <div class="form-group">
                            <label for="" class="mt-2 mb-2">Price</label>
                            <x-text-input type="text" name="price" class="form-control" placeholder="₦0.00"
                                value="{{ old('price') }}" />
                        </div>
                        
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Color</label>
                            <x-select-input name="color[]" class="form-control" multiple>
                                <option value="">Select Color</option>
                                <option value="black">Black</option>
                                <option value="white">White</option>
                                <option value="sliver">Sliver</option>
                                <option value="red">Red</option>
                                <option value="blue">Blue</option>
                                <option value="green">Green</option>
                                </x-selecte-input>
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">About</label>
                            <x-text-input type="text" name="about" class="form-control"
                                value="{{ old('about') }}" />
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Qty</label>
                            <x-text-input type="text" name="qty" class="form-control"
                                value="{{ old('qty') }}" />
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Sku</label>
                            <x-text-input type="text" name="sku" class="form-control"
                                value="{{ old('sku') }}" />
                        </div>
                        <div class="form-group">
                            <label for=""class="mt-2 mb-2">Tag</label>
                            <x-text-input type="text" name="tag" class="form-control"
                                value="{{ old('tag') }}" />
                        </div>
                        <div class="form-group">
                            <label for="description"class="mt-2 mb-2">Description</label>
                            <textarea id="descriptionx" name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>
                        <x-primary-button>Submit</x-primary-button>
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
