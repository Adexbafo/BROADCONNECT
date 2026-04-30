<x-app-layout>
    <div class="max-w-5xl mx-auto py-12 px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Total Fees Collected -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Protocol Revenue</p>
                <h3 class="text-3xl font-black mt-2 text-blue-600">${{ number_format(\App\Models\BCID::sum('fee_paid'), 2) }}</h3>
            </div>
            <!-- Total Citizens -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Citizens</p>
                <h3 class="text-3xl font-black mt-2">{{ \App\Models\BCID::count() }}</h3>
            </div>
        </div>

        <h2 class="text-xl font-black uppercase tracking-tighter mb-6 italic">Live Revenue Stream</h2>
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Citizen</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Network</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Fee (USD)</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase text-right">TX Hash</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach(\App\Models\BCID::latest()->get() as $log)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 text-xs font-bold text-gray-900">@ {{ $log->handle }}</td>
                        <td class="px-6 py-4 italic text-xs">{{ $log->network }}</td>
                        <td class="px-6 py-4 font-mono text-xs text-green-600">+$0.25</td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="text-[10px] font-mono text-blue-500 underline">{{ Str::limit($log->tx_hash, 10) }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>