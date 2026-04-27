<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Passport - @ {{ $citizen->handle }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @livewireStyles
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-6">

    <div class="max-w-sm w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
        
        <div class="bg-black p-8 text-center">
            <div class="inline-block p-3 rounded-full bg-gradient-to-tr from-blue-500 to-purple-600 mb-4">
                <i class="fas fa-fingerprint text-white text-3xl"></i>
            </div>
            <h1 class="text-white text-xl font-bold tracking-tight">CITIZEN PASSPORT</h1>
            <p class="text-gray-400 text-xs uppercase tracking-widest mt-1">BroadConnect Protocol</p>
        </div>

        <div class="p-8 space-y-6">
            
            <div class="text-center">
                <p class="text-gray-500 text-sm font-medium">Username Handle</p>
                <h2 class="text-2xl font-black text-gray-900 italic">@ {{ $citizen->handle }}</h2>
            </div>

            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl border border-gray-100">
                <div>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Sequence Number</p>
                    <p class="text-lg font-mono font-bold text-blue-600">BCID-{{ $citizen->sequence_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Status</p>
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $citizen->is_active ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                        {{ $citizen->is_active ? 'Verified' : 'Pending' }}
                    </span>
                </div>
            </div>

            @livewire('follower-count', ['citizenId' => $citizen->id])

            <div class="space-y-3 px-2">
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-network-wired text-gray-400 w-5"></i>
                    <span class="text-gray-600 font-medium text-xs">Minted on <strong>{{ ucfirst($citizen->network) }}</strong></span>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-hashtag text-gray-400 w-5"></i>
                    <span class="text-gray-400 text-[10px] truncate">TX: {{ $citizen->tx_hash }}</span>
                </div>
            </div>

            <div class="pt-2">
                @livewire('connect-button', ['targetId' => $citizen->id])
            </div>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
             <p class="text-[10px] text-gray-400 font-medium">Member since {{ $citizen->created_at->format('M Y') }}</p>
        </div>
    </div>

    @livewireScripts
</body>
</html>