<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-3xl font-black mb-8 italic">BROADERAGENT_TRANSPARENCY_LOG</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Treasury Counter -->
            <div class="bg-black text-green-400 p-8 rounded-3xl shadow-xl border-2 border-green-900/30">
                <p class="text-xs font-mono uppercase tracking-widest opacity-60">Total Funds Secured</p>
                <h2 class="text-5xl font-mono mt-2">$30.00</h2>
                <div class="mt-4 h-2 bg-green-900/20 rounded-full">
                    <div class="h-2 bg-green-500 rounded-full" style="width: 75%"></div>
                </div>
            </div>

            <!-- Network Health -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-xs font-bold text-gray-400 uppercase">Protocol Health</p>
                <h2 class="text-5xl font-black text-gray-900 mt-2">98.5%</h2>
                <p class="text-sm text-gray-500 mt-2">Status: <span class="text-green-500 font-bold">OPTIMAL</span></p>
            </div>
        </div>

        <!-- Terminal Feed -->
        <div class="mt-10 bg-gray-900 text-gray-300 p-6 rounded-3xl font-mono text-sm shadow-2xl">
            <p class="text-blue-400">>> [SYS] ANALYZING RECENT BROADCASTS...</p>
            <p class="mt-2 text-yellow-500">>> [WARN] DUPLICATE CONTENT DETECTED ON BCID-3</p>
            <p class="mt-2 text-green-400">>> [INFO] TREASURY VERIFIED AT 10:00 AM WAT</p>
        </div>
    </div>
</x-app-layout>