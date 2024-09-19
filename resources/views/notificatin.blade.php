<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Notification Settings</h3>

            <!-- زر تفعيل وإيقاف الإشعارات -->
            <form id="notification-form" action="{{ route('notifications.toggle') }}" method="POST" class="mb-8">
                @csrf
                <div class="flex items-center">
                    <label class="text-gray-600 font-medium mr-4">Disable Notifications</label>

                    <!-- زر التبديل المخصص -->
                    <div class="notification-toggle">
                        <input style="display: none" type="checkbox" name="notifications_disabled" id="notification-toggle-checkbox"
                        {{ auth()->user()->notifications_disabled ? 'checked' : '' }}>
                        <label for="notification-toggle-checkbox" class="toggle-label">
                            <span class="toggle-switch"></span>
                        </label>
                    </div>
                </div>
            </form>

            <h3 class="text-xl font-semibold text-gray-700 mb-4">Your Notifications</h3>

            @forelse ($notifications ?? [] as $notification)
            <div class="notification bg-gray-100 border-l-4 border-blue-500 shadow-sm rounded-lg mb-6 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-800">{{ $notification->data }}</p>
                        <small class="text-gray-500">{{ $notification->created_at }}</small>
                    </div>

                    <div class="flex items-center">
                        @if (is_null($notification->read_at))
                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                    Mark as Read
                                </button>
                            </form>
                        @else
                            <span class="text-green-500 font-semibold">Read</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                <p>No notifications available.</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
