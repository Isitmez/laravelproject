@extends('layouts.admin')
@section('title', __('Dashboard'))
@section('page_title', __('Dashboard'))
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
@endsection

@section('content')

{{-- ── Stat Cards ──────────────────────────────────────────────── --}}
<div class="row g-3 mb-4">

    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10"
                     style="width:52px;height:52px;flex-shrink:0;">
                    <i class="bi bi-bag-check text-primary fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">{{ __('Total Orders') }}</div>
                    <div class="fs-4 fw-bold">{{ $stats['total_orders'] }}</div>
                    @if($stats['pending_orders'] > 0)
                        <span class="badge bg-warning text-dark" style="font-size:.65rem;">
                            {{ $stats['pending_orders'] }} {{ __('pending') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-success bg-opacity-10"
                     style="width:52px;height:52px;flex-shrink:0;">
                    <i class="bi bi-currency-dollar text-success fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">{{ __('Total Revenue') }}</div>
                    <div class="fs-4 fw-bold">${{ number_format($stats['total_revenue'], 2) }}</div>
                    <span class="text-muted" style="font-size:.7rem;">{{ __('delivered') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-info bg-opacity-10"
                     style="width:52px;height:52px;flex-shrink:0;">
                    <i class="bi bi-box-seam text-info fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">{{ __('Total Products') }}</div>
                    <div class="fs-4 fw-bold">{{ $stats['total_products'] }}</div>
                    @if($stats['out_of_stock'] > 0)
                        <span class="badge bg-danger" style="font-size:.65rem;">
                            {{ $stats['out_of_stock'] }} {{ __('out of stock') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-warning bg-opacity-10"
                     style="width:52px;height:52px;flex-shrink:0;">
                    <i class="bi bi-people text-warning fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">{{ __('Users') }}</div>
                    <div class="fs-4 fw-bold">{{ $stats['total_users'] }}</div>
                    <span class="text-muted" style="font-size:.7rem;">{{ __('registered members') }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ── Recent Orders + Latest Products ──────────────────────────── --}}
<div class="row g-3">

    {{-- Recent Orders --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-clock-history me-2 text-primary"></i>{{ __('Recent Orders') }}</h6>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">
                    {{ __('See All') }}
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>{{ __('Customer') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th class="pe-3">{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td class="ps-3">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-decoration-none fw-medium">
                                        #{{ $order->id }}
                                    </a>
                                </td>
                                <td>
                                    <div class="fw-medium">{{ $order->name }}</div>
                                    <div class="text-muted small">{{ $order->email }}</div>
                                </td>
                                <td class="fw-semibold">${{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status_color }}">
                                        {{ __($order->status_label) }}
                                    </span>
                                </td>
                                <td class="pe-3 text-muted small">{{ $order->created_at->format('d.m.Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>{{ __('No orders found.') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Latest Products --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-box-seam me-2 text-info"></i>{{ __('Latest Products') }}</h6>
                <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-outline-info">
                    <i class="bi bi-plus"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @forelse($latestProducts as $product)
                <div class="d-flex align-items-center gap-3 px-3 py-2 border-bottom">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="thumb" alt="{{ $product->title }}">
                    @else
                        <div class="thumb bg-light d-flex align-items-center justify-content-center">
                            <i class="bi bi-image text-muted"></i>
                        </div>
                    @endif
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="fw-medium text-truncate small">{{ $product->title }}</div>
                        <div class="text-muted" style="font-size:.75rem;">{{ $product->category->title ?? '—' }}</div>
                    </div>
                    <div class="text-end">
                        <div class="fw-semibold small">${{ number_format($product->price, 2) }}</div>
                        <div class="text-muted" style="font-size:.7rem;">{{ __('Stock:') }} {{ $product->stock }}</div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="bi bi-inbox d-block mb-1"></i>{{ __('No products found') }}
                </div>
                @endforelse
            </div>
            <div class="card-footer bg-transparent border-0 text-center">
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary w-100">
                    {{ __('See All Products') }}
                </a>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="card border-0 shadow-sm mt-3" style="border-radius:12px;">
            <div class="card-body">
                <h6 class="fw-semibold mb-3"><i class="bi bi-lightning-charge me-2 text-warning"></i>{{ __('Quick Actions') }}</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary btn-sm text-start">
                        <i class="bi bi-plus-circle me-2"></i>{{ __('Add New Category') }}
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-info btn-sm text-start">
                        <i class="bi bi-plus-circle me-2"></i>{{ __('Add New Product') }}
                    </a>
                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-outline-success btn-sm text-start">
                        <i class="bi bi-plus-circle me-2"></i>{{ __('Add New Slider') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ── Analytics Section ────────────────────────────────────────── --}}
<div class="row g-3 mb-4">
    {{-- Sales Revenue Area Chart --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-graph-up me-2 text-primary"></i>{{ __('Sales Overview') }}</h6>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 260px; width: 100%;">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Product Category Doughnut Chart --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-pie-chart me-2 text-info"></i>{{ __('Products') }} / {{ __('Category') }}</h6>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 260px; width: 100%; display: flex; align-items: center; justify-content: center;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Auto-close alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            new bootstrap.Alert(el).close();
        });
    }, 4000);

    document.addEventListener('DOMContentLoaded', () => {
        const isDarkMode = () => document.documentElement.getAttribute('data-bs-theme') === 'dark' || document.documentElement.classList.contains('dark-mode');

        const getColors = () => {
            const dark = isDarkMode();
            return {
                text: dark ? '#cbd5e0' : '#4a5568',
                grid: dark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.04)',
                borderSales: '#e94560',
                bgSales: dark ? 'rgba(233, 69, 96, 0.15)' : 'rgba(233, 69, 96, 0.05)',
                doughnutBorders: dark ? '#1a1520' : '#ffffff',
            };
        };

        let colors = getColors();

        // 1. Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: @json($salesLabels),
                datasets: [{
                    label: '{{ __('Total Revenue') }} ($)',
                    data: @json($salesData),
                    borderColor: colors.borderSales,
                    backgroundColor: colors.bgSales,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: colors.borderSales,
                    pointBorderColor: '#ffffff',
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        padding: 10,
                        backgroundColor: isDarkMode() ? '#1a1922' : '#ffffff',
                        titleColor: isDarkMode() ? '#ffffff' : '#1a1a2e',
                        bodyColor: isDarkMode() ? '#cbd5e0' : '#4a5568',
                        borderColor: 'rgba(233, 69, 96, 0.2)',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return ' $' + context.parsed.y.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: colors.text, font: { family: 'Poppins' } }
                    },
                    y: {
                        grid: { color: colors.grid },
                        ticks: {
                            color: colors.text,
                            font: { family: 'Poppins' },
                            callback: function(value) { return '$' + value; }
                        }
                    }
                }
            }
        });

        // 2. Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: @json($categoryLabels),
                datasets: [{
                    data: @json($categoryCounts),
                    backgroundColor: [
                        '#e94560', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#14b8a6'
                    ],
                    borderWidth: 2,
                    borderColor: colors.doughnutBorders,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: colors.text,
                            font: { family: 'Poppins', size: 11 },
                            boxWidth: 12
                        }
                    }
                },
                cutout: '70%'
            }
        });

        const observer = new MutationObserver(() => {
            const nextColors = getColors();
            
            // Update Sales Chart
            salesChart.data.datasets[0].backgroundColor = nextColors.bgSales;
            salesChart.options.scales.x.ticks.color = nextColors.text;
            salesChart.options.scales.y.ticks.color = nextColors.text;
            salesChart.options.scales.y.grid.color = nextColors.grid;
            salesChart.options.plugins.tooltip.backgroundColor = isDarkMode() ? '#1a1922' : '#ffffff';
            salesChart.options.plugins.tooltip.titleColor = isDarkMode() ? '#ffffff' : '#1a1a2e';
            salesChart.options.plugins.tooltip.bodyColor = isDarkMode() ? '#cbd5e0' : '#4a5568';
            salesChart.update();

            // Update Category Chart
            categoryChart.data.datasets[0].borderColor = nextColors.doughnutBorders;
            categoryChart.options.plugins.legend.labels.color = nextColors.text;
            categoryChart.update();
        });

        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['data-bs-theme', 'class'] });
    });
</script>
@endpush
