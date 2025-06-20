@extends('layout.base')

{{--
    Asumsi:
    1. Anda memiliki layout utama di `resources/views/layout/base.blade.php`.
    2. Controller mengirimkan variabel `$menuCategories`.
--}}

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
        }

        .font-lora {
            font-family: 'Lora', serif;
        }

        .bg-brand-card {
            background-color: #4a2525;
        }

        .border-brand-accent {
            border-color: #eab308;
        }

        .text-brand-accent {
            color: #eab308;
        }

        .bg-brand-accent {
            background-color: #eab308;
        }

        .hover\:bg-brand-accent-dark:hover {
            background-color: #ca8a04;
        }

        .swal2-popup {
            background: #2d3748 !important;
            color: #f7fafc !important;
        }

        .swal-confirm-button {
            border: 2px solid #ca8a04 !important;
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto max-w-5xl p-4 sm:p-6 md:p-8">
        <header class="text-center mb-10 md:mb-16">
            <h1 class="font-lora text-4xl sm:text-5xl font-bold text-brand-accent tracking-wider">Order & Reserve</h1>
            <p class="text-slate-400 mt-2">Pilih hidangan yang Anda inginkan dan buat pesanan.</p>
        </header>

        <form id="order-form" method="POST" action="{{ route('orders.store') }}">
            @csrf

            <main class="space-y-12">
                @foreach ($menuCategories as $category => $menus)
                    <div>
                        <h2 class="font-lora text-3xl font-bold border-b-2 border-brand-accent/50 pb-2 mb-8 uppercase">
                            {{ $category }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach ($menus as $menu)
                                <div class="menu-item bg-brand-card rounded-lg border border-brand-accent/50 shadow-lg overflow-hidden transition-transform duration-300 hover:scale-[1.02]"
                                    data-id="{{ $menu->menu_id }}" data-price="{{ $menu->price }}"
                                    data-name="{{ $menu->name }}">
                                    <div class="flex">
                                        <img src="{{ $menu->image_path ?? 'https://placehold.co/150x150/333333/eab308?text=Menu' }}"
                                            alt="{{ $menu->name }}" class="w-1/3 object-cover">
                                        <div class="p-4 sm:p-6 flex flex-col justify-between w-2/3">
                                            <div>
                                                <h3 class="font-lora text-xl font-bold text-white">{{ $menu->name }}</h3>
                                                <p class="text-sm text-slate-300 mt-1 mb-3">{{ $menu->description }}</p>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="flex items-center text-yellow-400 mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    <span class="text-white ml-1 text-sm font-bold">4.8</span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <p class="text-lg font-bold text-brand-accent">IDR
                                                        {{ number_format($menu->price, 0, ',', '.') }}</p>
                                                    <div class="flex items-center space-x-2">
                                                        <button type="button"
                                                            class="quantity-btn minus-btn bg-gray-700 hover:bg-gray-600 rounded-full w-8 h-8 text-lg font-bold transition-colors">-</button>
                                                        <span
                                                            class="quantity-display text-white font-bold w-8 text-center text-lg">0</span>
                                                        <button type="button"
                                                            class="quantity-btn plus-btn bg-brand-accent hover:bg-brand-accent-dark rounded-full w-8 h-8 text-lg font-bold text-black transition-colors">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </main>

            <section class="mt-16 bg-brand-card border border-brand-accent/50 p-6 sm:p-8 rounded-lg">
                <h2 class="font-lora text-3xl font-bold mb-6">DETAILS</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <div class="space-y-4">
                        <h3 class="font-lora text-xl font-bold">Opsi Pesanan</h3>
                        <div>
                            <label for="order-type" class="block text-sm font-medium text-slate-300 mb-1">Tipe
                                Pesanan</label>
                            <select id="order-type" name="order_type"
                                class="w-full bg-gray-900/50 border border-slate-600 rounded-md py-2 px-3">
                                <option>Take Away</option>
                                <option selected>Dine In</option>
                                <option>Delivery</option>
                            </select>
                        </div>

                        <div>
                            <label for="event-id" class="block text-sm font-medium text-slate-300 mb-1">Event Code
                                (Opsional)</label>
                            <input type="text" id="event-id" name="event_id"
                                class="w-full bg-gray-900/50 border border-slate-600 rounded-md py-2 px-3"
                                placeholder="cth: BIRTHDAY24">
                        </div>
                        <div>
                            <label for="voucher-id" class="block text-sm font-medium text-slate-300 mb-1">Voucher Code
                                (Opsional)</label>
                            <input type="text" id="voucher-id" name="voucher_id"
                                class="w-full bg-gray-900/50 border border-slate-600 rounded-md py-2 px-3"
                                placeholder="Masukkan kode voucher">
                        </div>

                        <div id="reservation-fields" class="hidden space-y-4 pt-4 border-t border-slate-700/50">
                            <h3 class="font-lora text-xl font-bold">Detail Reservasi (Opsional)</h3>
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-slate-300 mb-1">Nama
                                    Lengkap</label>
                                <input type="text" id="customer_name" name="customer_name"
                                    class="w-full bg-gray-900/50 border border-slate-600 rounded-md py-2 px-3"
                                    placeholder="Nama Anda">
                            </div>
                            <div>
                                <label for="reservation_date" class="block text-sm font-medium text-slate-300 mb-1">Tanggal
                                    & Waktu</label>
                                <input type="datetime-local" id="reservation_date" name="reservation_date"
                                    class="w-full bg-gray-900/50 border border-slate-600 rounded-md py-2 px-3">
                            </div>
                            <div>
                                <label for="number_of_guests" class="block text-sm font-medium text-slate-300 mb-1">Jumlah
                                    Tamu</label>
                                <input type="number" id="number_of_guests" name="number_of_guests" min="1"
                                    class="w-full bg-gray-900/50 border border-slate-600 rounded-md py-2 px-3"
                                    placeholder="cth: 4">
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-900/50 p-4 rounded-lg flex flex-col">
                        <h3 class="text-lg font-bold mb-2 text-white">Ringkasan</h3>
                        <div id="order-summary-list"
                            class="flex-grow space-y-2 text-slate-300 text-sm pr-2 overflow-y-auto">
                            <p class="text-slate-500 italic">Keranjang Anda kosong.</p>
                        </div>
                        <div class="border-t border-slate-700 mt-4 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-white">Total:</span>
                                <span id="total-price" class="text-2xl font-bold text-brand-accent">IDR 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="cart-items"></div>
                <input type="hidden" name="total_payment" id="total_payment_input" value="0">

                <div class="mt-8 text-center">
                    <button type="submit"
                        class="w-full md:w-auto bg-brand-accent hover:bg-brand-accent-dark text-black font-bold py-3 px-12 rounded-lg text-lg transition-transform duration-200 hover:scale-105">
                        Submit Pesanan
                    </button>
                </div>
            </section>
        </form>
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            </script>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const orderForm = document.getElementById('order-form');
            const menuItems = document.querySelectorAll('.menu-item');
            const summaryList = document.getElementById('order-summary-list');
            const totalPriceEl = document.getElementById('total-price');
            const cartItemsContainer = document.getElementById('cart-items');
            const totalPaymentInput = document.getElementById('total_payment_input');
            const orderTypeSelect = document.getElementById('order-type');
            const reservationFields = document.getElementById('reservation-fields');
            let cart = {};

            // Fungsi untuk memformat mata uang
            const formatCurrency = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(number).replace(/\s*Rp/g, 'IDR ');
            };

            // Fungsi untuk memperbarui ringkasan pesanan
            const updateOrder = () => {
                let total = 0;
                let summaryHTML = '';
                cartItemsContainer.innerHTML = '';
                cart = {};

                menuItems.forEach(item => {
                    const quantity = parseInt(item.querySelector('.quantity-display').textContent);
                    if (quantity > 0) {
                        const price = parseFloat(item.dataset.price);
                        const name = item.dataset.name;
                        const id = item.dataset.id;

                        cart[id] = {
                            name: name,
                            quantity: quantity,
                            price: price
                        };
                        total += quantity * price;

                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = `items[${id}]`;
                        input.value = quantity;
                        cartItemsContainer.appendChild(input);
                    }
                });

                Object.values(cart).forEach(item => {
                    summaryHTML += `
                        <div class="flex justify-between items-center">
                            <span>${item.quantity}x ${item.name}</span>
                            <span class="font-medium">${formatCurrency(item.quantity * item.price)}</span>
                        </div>
                    `;
                });

                totalPriceEl.textContent = formatCurrency(total);
                totalPaymentInput.value = total;
                summaryList.innerHTML = summaryHTML ||
                    '<p class="text-slate-500 italic">Keranjang Anda kosong.</p>';
            };

            // Event listener untuk tombol +/-
            menuItems.forEach(item => {
                item.querySelector('.plus-btn').addEventListener('click', () => {
                    const quantityEl = item.querySelector('.quantity-display');
                    quantityEl.textContent = parseInt(quantityEl.textContent) + 1;
                    updateOrder();
                });
                item.querySelector('.minus-btn').addEventListener('click', () => {
                    const quantityEl = item.querySelector('.quantity-display');
                    let currentQuantity = parseInt(quantityEl.textContent);
                    if (currentQuantity > 0) {
                        quantityEl.textContent = currentQuantity - 1;
                        updateOrder();
                    }
                });
            });

            // Tampilkan/Sembunyikan form reservasi
            const toggleReservationFields = () => {
                if (orderTypeSelect.value === 'Dine In') {
                    reservationFields.classList.remove('hidden');
                } else {
                    reservationFields.classList.add('hidden');
                }
            };
            orderTypeSelect.addEventListener('change', toggleReservationFields);
            toggleReservationFields(); // Jalankan saat halaman pertama kali dimuat

            // Handle submit form dengan SweetAlert
            orderForm.addEventListener('submit', function(event) {
                event.preventDefault();

                if (Object.keys(cart).length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Keranjang Anda kosong! Silakan tambah setidaknya satu item.',
                        confirmButtonColor: '#eab308',
                        customClass: {
                            confirmButton: 'swal-confirm-button'
                        }
                    });
                    return;
                }

                let confirmationHtml = '<div class="text-left">';
                Object.values(cart).forEach(item => {
                    confirmationHtml += `<p>${item.quantity}x ${item.name}</p>`;
                });
                confirmationHtml +=
                    `<hr class="my-2 border-slate-500"><p class="font-bold text-lg">Total: ${formatCurrency(totalPaymentInput.value)}</p></div>`;

                Swal.fire({
                    title: 'Konfirmasi Pesanan Anda',
                    html: confirmationHtml,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#eab308',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, buat pesanan!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'swal-confirm-button'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        orderForm.submit();
                    }
                });
            });
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#eab308',
                customClass: {
                    confirmButton: 'swal-confirm-button'
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#eab308',
                customClass: {
                    confirmButton: 'swal-confirm-button'
                }
            });
        </script>
    @endif
@endsection
