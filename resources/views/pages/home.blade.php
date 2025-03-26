<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
     <div class="container">
         <div class="row">
           @foreach($products as $product)
             <div class="col-xxl-3 col-md-6 col-lg-4">
                 <div class="wsus__product_item">
                     <div class="img">
                         <a href="{{ route('detail', $product->id) }}"><img src="{{ asset($product->image) }}" alt="equipment" class="img-fluid w-100"></a>
                         <a href="{{ route('detail', $product->id) }}" class="add_cart">
                             <span><img src="{{ asset('assets/images/cart_icon_black.svg') }}" alt="cart" class="img-fluid w-100"></span>
                             Add To Cart
                         </a>
                         <ul>
                           <li><a href="#" onclick="addToWishlist()"><i class="fal fa-heart"></i></a></li>
                           <li><a href="#" onclick="addToCompare()"><i class="far fa-random"></i></a></li>
                       </ul>
                     </div>
                     <span class="new">new</span>
                     <div class="text">
                         <a href="{{ route('detail', $product->id) }}" class="title">{{ $product->name }}</a>
                         <p>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                         </p>
                         <h4>₦{{ number_format($product->price, 2) }}</h4>
                     </div>
                 </div>
             </div>
           @endforeach
         </div>
   
         <div class="wsus__pagination mt_60">
             <nav aria-label="Page navigation example">
                 <ul class="pagination justify-content-center">
                     <li class="page-item">
                         <a class="page-link" href="#" aria-label="Previous">
                             <i class="far fa-arrow-left"></i>
                         </a>
                     </li>
                     <li class="page-item"><a class="page-link active" href="#">01</a></li>
                     <li class="page-item"><a class="page-link" href="#">02</a></li>
                     <li class="page-item"><a class="page-link" href="#">03</a></li>
                     <li class="page-item">
                         <a class="page-link" href="#" aria-label="Next">
                             <i class="far fa-arrow-right"></i>
                         </a>
                     </li>
                 </ul>
             </nav>
         </div>
     </div>
   </section>
   </x-app-layout>
   