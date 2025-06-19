@extends('layout.base')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        body { background-color: #1a1a1a; color: #f1f5f9; font-family: 'Inter', sans-serif; }
        .font-lora { font-family: 'Lora', serif; }
        .bg-brand-dark { background-color: #1a1a1a; }
        .bg-brand-card { background-color: #4a2525; }
        .border-brand-accent { border-color: #eab308; }
        .text-brand-accent { color: #eab308; }
        .bg-brand-accent { background-color: #eab308; }
        .hover\:bg-brand-accent-dark:hover { background-color: #ca8a04; }
    </style>
@endsection

@section('content')
    <div class="container mx-auto max-w-4xl p-4 sm:p-6 md:p-8">

        <header class="text-center mb-10 md:mb-12">
            <h1 class="font-lora text-4xl sm:text-5xl font-bold text-brand-accent tracking-wider">Order Details</h1>
            <p class="text-slate-400 mt-2">Thank you for your order!</p>
        </header>

        <main class="bg-brand-card border border-brand-accent/50 p-6 sm:p-8 rounded-lg shadow-lg">

            <!-- Informasi Utama Pesanan -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 border-b border-slate-600 pb-6 mb-6 text-center">
                <div>
                    <h2 class="text-sm text-slate-400 uppercase tracking-wider">Order ID</h2>
                    <p class="text-lg font-bold text-white">#{{ $order->order_id }}</p>
                </div>
                <div>
                    <h2 class="text-sm text-slate-400 uppercase tracking-wider">Order Date</h2>
                    <p class="text-lg font-bold text-white">{{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <h2 class="text-sm text-slate-400 uppercase tracking-wider">Order Type</h2>
                    <p class="text-lg font-bold text-white">{{ $order->order_type }}</p>
                </div>
                 <div>
                    <h2 class="text-sm text-slate-400 uppercase tracking-wider">Total</h2>
                    <p class="text-lg font-bold text-brand-accent">IDR {{ number_format($order->total_payment, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Daftar Item yang Dipesan -->
            <h3 class="font-lora text-2xl font-bold mb-4">Items Ordered</h3>
            <div class="space-y-4">
                @forelse($order->orderDetails as $detail)
                    <div class="flex items-center justify-between p-4 bg-gray-900/50 rounded-lg">
                        <div class="flex items-center">
                            <img src="{{ $detail->menu->image_path ?? 'https://placehold.co/80x80/333333/eab308?text=Item' }}" alt="{{ $detail->menu->name }}" class="w-16 h-16 rounded-md object-cover mr-4">
                            <div>
                                <p class="font-bold text-white">{{ $detail->menu->name }}</p>
                                <p class="text-sm text-slate-400">{{ $detail->quantity }} x IDR {{ number_format($detail->menu->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <p class="font-semibold text-lg text-white">IDR {{ number_format($detail->quantity * $detail->menu->price, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <p class="text-slate-400 text-center py-4">No items found for this order.</p>
                @endforelse
            </div>
        </main>
    </div>
@endsection
