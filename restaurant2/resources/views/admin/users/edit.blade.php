@extends('admin.layouts.admin')

@section('title', 'Edit User')
@section('header_title', 'Edit User')
@section('content_title', 'Update User Information')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">
            ← Back to Users
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- User Info Header -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <div class="flex items-center">
            <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900">{{ $user->name ?? 'Unknown User' }}</h3>
                <p class="text-sm text-gray-500">User ID: {{ $user->id ?? 'N/A' }}</p>
                <p class="text-sm text-gray-500">Member since: {{ ($user->created_at ?? now())->format('M d, Y') }}</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user->id ?? 0) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
            <input type="text"
                   id="name"
                   name="name"
                   value="{{ old('name', $user->name ?? '') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                   placeholder="Enter full name"
                   required>
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
            <input type="email"
                   id="email"
                   name="email"
                   value="{{ old('email', $user->email ?? '') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                   placeholder="Enter email address"
                   required>
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password (Optional)</label>
            <input type="password"
                   id="password"
                   name="password"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                   placeholder="Leave blank to keep current password">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-sm text-gray-500 mt-1">Leave blank to keep the current password. Minimum 8 characters if changing.</p>
        </div>

        <!-- Confirm Password -->
        <div id="confirm-password-field" style="display: none;">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
            <input type="password"
                   id="password_confirmation"
                   name="password_confirmation"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="Confirm new password">
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
            <select id="role"
                    name="role"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('role') border-red-500 @enderror"
                    required>
                <option value="">Select Role</option>
                <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="manager" {{ old('role', $user->role ?? '') === 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="cashier" {{ old('role', $user->role ?? '') === 'cashier' ? 'selected' : '' }}>Cashier</option>
            </select>
            @error('role')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Current Role Display -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Current Role: {{ ucfirst($user->role ?? 'Unknown') }}</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Be careful when changing user roles as it affects their access permissions.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Descriptions -->
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Role Permissions:</h4>
            <ul class="text-sm text-gray-600 space-y-1">
                <li><strong>Admin:</strong> Full access to all features and user management</li>
                <li><strong>Manager:</strong> Menu management and basic user oversight</li>
                <li><strong>Cashier:</strong> Limited access to order processing</li>
            </ul>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4 pt-4">
            <a href="{{ route('admin.users.index') }}"
               class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                Update User
            </button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    // Show/hide password confirmation field based on password input
    document.getElementById('password').addEventListener('input', function() {
        const confirmField = document.getElementById('confirm-password-field');
        const confirmInput = document.getElementById('password_confirmation');

        if (this.value.length > 0) {
            confirmField.style.display = 'block';
            confirmInput.setAttribute('required', 'required');
        } else {
            confirmField.style.display = 'none';
            confirmInput.removeAttribute('required');
            confirmInput.value = '';
        }
    });

    // Password confirmation validation
    document.getElementById('password_confirmation').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;

        if (password !== confirmPassword && confirmPassword.length > 0) {
            this.setCustomValidity('Passwords do not match');
            this.style.borderColor = '#ef4444';
        } else {
            this.setCustomValidity('');
            this.style.borderColor = '#d1d5db';
        }
    });

    // Role change confirmation for critical roles
    const originalRole = '{{ $user->role ?? "" }}';
    document.getElementById('role').addEventListener('change', function() {
        if (originalRole === 'admin' && this.value !== 'admin') {
            if (!confirm('Warning: You are changing an admin user to a different role. This will reduce their access permissions. Continue?')) {
                this.value = originalRole;
            }
        }
    });
</script>
@endsection
@endsection
