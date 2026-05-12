<x-guest-layout class='bg-gray-900'>

    <!-- The missing .gsap-logo element -->
    <div class="gsap-logo flex justify-center mb-8">
        <a href="/" class="text-3xl font-bold text-white tracking-wider" style="font-family: 'Outfit', sans-serif;">
            CAR<span class="text-gold">RENTAL</span>
        </a>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="gsap-input flex flex-col items-center">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1 w-full text-center">Email Address</label>
            <input id="email" class="block w-full px-4 py-3 rounded-full input-luxury focus:outline-none text-center" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-center w-full" />
        </div>

        <!-- Password -->
        <div class="gsap-input flex flex-col items-center">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1 w-full text-center">Password</label>
            <input id="password" class="block w-full px-4 py-3 rounded-full input-luxury focus:outline-none text-center"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            placeholder="••••••••" />
            <div class="flex justify-center mt-2 w-full">
                @if (Route::has('password.request'))
                    <a class="text-xs text-gold hover:text-white transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-center w-full" />
        </div>

        <!-- Remember Me & ReCAPTCHA -->
        <div class="flex flex-col space-y-4 gsap-input items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded bg-gray-800 border-gray-700 text-gold shadow-sm focus:ring-gold" name="remember">
                <span class="ms-2 text-sm text-gray-400">{{ __('Stay logged in') }}</span>
            </label>

            <div class="flex flex-col items-center">
                <div class="g-recaptcha" data-sitekey="6LcsVossAAAAAA7B4H3-ZRGtD_Xka25wrBSB21x0" data-theme="dark"></div>
                @error('g-recaptcha-response')
                    <span class="text-red-500 text-xs mt-2 text-center">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <script src="https://www.google.com/recaptcha/api.js?hl=ar" async defer></script>

        <div class="pt-2 gsap-input">
            <button type="submit" class="w-full py-4 rounded-full btn-luxury shadow-lg">
                {{ __('Secure Log In') }}
            </button>
        </div>

        <div class="text-center mt-6 gsap-fade">
            <p class="text-sm text-gray-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-gold font-bold hover:underline">Join the Elite</a>
            </p>
        </div>
    </form>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tl = gsap.timeline();

            tl.from('.gsap-logo', {
                y: -50,
                opacity: 0,
                duration: 1,
                ease: 'power4.out'
            })
            .from('.gsap-card', {
                scale: 0.95,
                opacity: 0,
                duration: 0.8,
                ease: 'power3.out'
            }, '-=0.5')
            .from('.gsap-fade', {
                y: 20,
                opacity: 0,
                duration: 0.8,
                stagger: 0.2,
                ease: 'power2.out'
            }, '-=0.3')
            .from('.gsap-input', {
                y: 20,
                opacity: 0,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power2.out'
            }, '-=0.4');
        });
    </script>
    @endpush
</x-guest-layout>
