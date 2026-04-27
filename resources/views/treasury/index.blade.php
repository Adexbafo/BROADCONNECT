<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-md mx-auto space-y-6">
        <h1 class="text-2xl font-bold text-gray-900">Treasury Overview</h1>
        
        <div class="bg-black text-white p-6 rounded-2xl shadow-xl">
            <p class="text-gray-400 text-sm">Total Protocol Revenue</p>
            <h2 class="text-4xl font-black mt-1">${{ number_format($totalUsd, 2) }}</h2>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs text-gray-500 uppercase font-bold">Citizens</p>
                <p class="text-xl font-bold">{{ $totalCitizens }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs text-gray-500 uppercase font-bold">Pending</p>
                <p class="text-xl font-bold text-orange-500">{{ $pendingCitizens }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-gray-200">
            <h3 class="text-sm font-bold mb-3">Network Distribution</h3>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span>Base (EVM)</span>
                    <span class="font-mono">{{ $baseCount }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span>Supra (Move)</span>
                    <span class="font-mono">{{ $supraCount }}</span>
                </div>
            </div>
        </div>

        <a href="/" class="block text-center text-blue-600 text-sm font-semibold">← Back to Registration</a>
    </div>
</body>