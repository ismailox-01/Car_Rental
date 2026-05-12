<x-guest-layout class='bg-gray-900'>
     <!-- The missing .gsap-logo element -->
    <div class="gsap-logo flex justify-center mb-8">
        <a href="/" class="text-3xl font-bold text-white tracking-wider" style="font-family: 'Outfit', sans-serif;">
            CAR<span class="text-gold">RENTAL</span>
        </a>
    </div>


    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="gsap-input flex flex-col items-center">
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1 w-full text-center">Full Name</label>
            <input id="name" class="block w-full px-4 py-3 rounded-full input-luxury focus:outline-none text-center" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-center w-full" />
        </div>

        <!-- Email Address -->
        <div class="gsap-input flex flex-col items-center">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1 w-full text-center">Email Address</label>
            <input id="email" class="block w-full px-4 py-3 rounded-full input-luxury focus:outline-none text-center" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-center w-full" />
        </div>

        <!-- Password -->
        <div class="gsap-input flex flex-col items-center">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1 w-full text-center">Password</label>
            <input id="password" class="block w-full px-4 py-3 rounded-full input-luxury focus:outline-none text-center"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-center w-full" />
        </div>

        <!-- Confirm Password -->
        <div class="gsap-input flex flex-col items-center">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1 w-full text-center">Confirm Password</label>
            <input id="password_confirmation" class="block w-full px-4 py-3 rounded-full input-luxury focus:outline-none text-center"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-center w-full" />
        </div>

        <div class="pt-4 gsap-input">
            <button type="submit" class="w-full py-4 rounded-full btn-luxury shadow-lg">
                {{ __('Create Account') }}
            </button>
        </div>

        <div class="text-center mt-6 gsap-fade">
            <p class="text-sm text-gray-400">
                Already registered? 
                <a href="{{ route('login') }}" class="text-gold font-bold hover:underline">Secure Log In</a>
            </p>
        </div>
    </form>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tl = gsap.timeline();

            tl.from('.gsap-card', {
                scale: 0.95,
                opacity: 0,
                duration: 0.8,
                ease: 'power3.out'
            })
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
