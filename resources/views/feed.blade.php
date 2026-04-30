<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @livewireStyles
</head>
<livewire:agent-chat />
<livewire:wallet-auth />
<body class="bg-slate-50 min-h-screen p-8">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-black tracking-tighter text-gray-900">PROTOCOL FEED</h1>
        <p class="text-gray-400 text-sm">BroadConnect Social Graph v1.0</p>
    </div>

    @livewire('protocol-feed')

    @livewireScripts
</body>