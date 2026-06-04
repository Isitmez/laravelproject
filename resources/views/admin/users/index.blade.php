@extends('layouts.admin')
@section('title', __('Users'))
@section('page_title', __('User Management'))
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('Users') }}</li>
@endsection

@section('content')

<div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
    <div class="card-body py-2">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="{{ __('Search name or email...') }}" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select form-select-sm">
                    <option value="">{{ __('All Roles') }}</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>{{ __('User') }}</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-search me-1"></i>{{ __('Filter') }}
                </button>
                @if(request()->hasAny(['search', 'role']))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm ms-1">{{ __('Clear') }}</a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>{{ __('User') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Order') }}</th>
                        <th>{{ __('Registration Date') }}</th>
                        <th class="pe-3 text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="ps-3 text-muted small">{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                     style="width:36px;height:36px;flex-shrink:0;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-medium">{{ $user->name }}</div>
                                    <div class="text-muted small">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge bg-danger"><i class="bi bi-shield-fill me-1"></i>{{ __('Admin') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('User') }}</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $user->phone ?? '—' }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $user->orders->count() }}</span>
                        </td>
                        <td class="text-muted small">{{ $user->created_at->format('d.m.Y') }}</td>
                        <td class="pe-3 text-end">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="btn btn-action btn-outline-primary me-1" title="{{ __('Edit') }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this user?') }}')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-action btn-outline-danger" title="{{ __('Delete') }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-people fs-2 d-block mb-2"></i>{{ __('No users found.') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer bg-transparent border-0">{{ $users->links() }}</div>
    @endif
</div>
@endsection
