<x-app-layout>
 <section class="d-flex justify-content-center align-items-center vh-100">
     <div class="container text-center">
         <h2 class="text-danger">Payment Failed</h2>
         <p>Unfortunately, your payment could not be processed.</p>
         <a href="{{ route('cart-checkout') }}" class="btn btn-primary">Return to Cart</a>
     </div>
 </section>
</x-app-layout>
