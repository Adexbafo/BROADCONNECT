<x-app-layout>
    <div class="min-h-[80vh] flex flex-col items-center justify-center px-4">
        <div class="text-center mb-12 max-w-2xl">
            <h1 class="text-6xl font-black text-gray-900 leading-tight">Decentralized Social <br> Identity on <span class="text-blue-600">Base</span> &amp; <span class="text-purple-600">Supra</span></h1>
            <p class="mt-4 text-gray-500 font-medium">Join the Latest protocol. Claim your unique BCID, secure your treasury, and vibe-code with the community.</p>
        </div>

        <!-- The Registration Component -->
        @livewire('identity-registration')
    </div>
</x-app-layout>