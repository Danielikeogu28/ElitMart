<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
                <a href="{{ url()->previous() }}" class="common_btn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Back</a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div class="">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>