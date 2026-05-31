<x-admin-panel>

    {{-- Breadcrumb --}}
    <div class="mb-1">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <span>Dashboard</span>
            <i class='bx bx-chevron-right'></i>
            <span class="text-gray-600 font-medium">Ringkasan Utama</span>
        </nav>
    </div>

    {{-- Page Title --}}
    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-800">Ringkasan Performa</h1>
        <p class="text-sm text-gray-500 mt-0.5">Pantau pertumbuhan ekosistem UMKM BojongStore secara real-time.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        {{-- Card 1: Total Produk --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-[#e8f5ec] rounded-lg flex items-center justify-center">
                    <i class='bx bx-package text-xl text-[#1a5c2a]'></i>
                </div>
                <span
                    class="text-xs font-semibold {{ $productGrowth >= 0 ? 'text-[#1a5c2a] bg-[#e8f5ec]' : 'text-red-600 bg-red-50' }} px-2.5 py-1 rounded-full">
                    {{ $productGrowth > 0 ? '+' : '' }}{{ $productGrowth }}% Bulan Ini
                </span>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Produk</p>
            <p class="text-3xl font-bold text-gray-800">{{ $total_products }}</p>
        </div>

        {{-- Card 2: Kategori --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-[#e8f5ec] rounded-lg flex items-center justify-center">
                    <i class='bx bx-category text-xl text-[#1a5c2a]'></i>
                </div>
                <span class="text-xs font-semibold text-[#1a5c2a] bg-[#e8f5ec] px-2.5 py-1 rounded-full">Aktif</span>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Kategori</p>
            <p class="text-3xl font-bold text-gray-800">{{ $total_categories }}</p>
        </div>

        {{-- Card 3: Review --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-[#e8f5ec] rounded-lg flex items-center justify-center">
                    <i class='bx bx-star text-xl text-[#1a5c2a]'></i>
                </div>
                <span
                    class="text-xs font-semibold text-orange-500 bg-orange-50 px-2.5 py-1 rounded-full">{{ $avg_rating > 0 ? number_format($avg_rating, 1) : '0' }}
                    Avg Rating</span>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Review</p>
            <p class="text-3xl font-bold text-gray-800">{{ $total_reviews }}</p>
        </div>
    </div>

    {{-- Bottom Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Aktivitas Terkini --}}
        <div class="lg:col-span-2 bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-2 mb-5">
                <h2 class="font-bold text-gray-800">Aktivitas Terkini</h2>
                <a href="#" class="text-sm font-semibold text-[#1a5c2a] hover:underline">Lihat Semua</a>
            </div>

            <div class="space-y-4">
                @forelse($recent_activities as $activity)
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 {{ str_contains($activity->action, 'menghapus') ? 'bg-red-50' : 'bg-[#e8f5ec]' }} rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        @if(str_contains($activity->action, 'menambah'))
                            <i class='bx bx-plus text-[#1a5c2a] text-base'></i>
                        @elseif(str_contains($activity->action, 'mengedit'))
                            <i class='bx bx-edit text-[#1a5c2a] text-base'></i>
                        @elseif(str_contains($activity->action, 'menghapus'))
                            <i class='bx bx-trash text-red-600 text-base'></i>
                        @else
                            <i class='bx bx-info-circle text-[#1a5c2a] text-base'></i>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">
                            <span class="font-semibold text-gray-900">{{ $activity->user->name ?? 'Admin' }}</span> 
                            {{ $activity->action }}
                            <span class="font-semibold {{ str_contains($activity->action, 'menghapus') ? 'text-red-600' : 'text-[#1a5c2a]' }}">{{ $activity->description }}</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $activity->created_at->diffForHumans() }} • Menu: Produk</p>
                    </div>
                </div>
                @empty
                <div class="text-sm text-gray-500 text-center py-4">Belum ada aktivitas.</div>
                @endforelse
            </div>
        </div>

        {{-- Visitor Chart --}}
        <div class="relative rounded-xl bg-white shadow-sm border border-gray-100 p-5 min-h-[280px] flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-800">Statistik Pengunjung</h3>
                <select id="timeframeSelect" class="text-sm border-gray-200 rounded-lg text-gray-600 focus:ring-[#1a5c2a] focus:border-[#1a5c2a] px-3 py-1.5 bg-gray-50 outline-none">
                    <option value="hari">Hari Ini</option>
                    <option value="minggu">Minggu Ini</option>
                    <option value="bulan">Bulan Ini</option>
                </select>
            </div>
            <div class="flex-1 relative w-full min-h-[220px]">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('visitorChart').getContext('2d');
            
            // Real Data for Visitors from backend
            const data = @json($visitorData);

            let chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.hari.labels,
                    datasets: [{
                        label: 'Pengunjung',
                        data: data.hari.data,
                        borderColor: '#1a5c2a',
                        backgroundColor: 'rgba(26, 92, 42, 0.1)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#1a5c2a',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1a5c2a',
                            padding: 10,
                            titleFont: { family: 'Poppins', size: 13 },
                            bodyFont: { family: 'Poppins', size: 12 },
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' Pengunjung';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f3f4f6', drawBorder: false },
                            ticks: { font: { family: 'Poppins', size: 11 }, color: '#9ca3af' }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { family: 'Poppins', size: 11 }, color: '#9ca3af' }
                        }
                    }
                }
            });

            document.getElementById('timeframeSelect').addEventListener('change', function(e) {
                const timeframe = e.target.value;
                chart.data.labels = data[timeframe].labels;
                chart.data.datasets[0].data = data[timeframe].data;
                chart.update();
            });
        });
    </script>
</x-admin-panel>