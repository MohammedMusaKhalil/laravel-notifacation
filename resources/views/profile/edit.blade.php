<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-2xl font-semibold text-gray-700 mb-4">Notification Settings</h3>
               <!-- نموذج لتفعيل/إيقاف إشعارات WhatsApp -->
                <form id="whatsapp-notification-form" action="{{ route('notifications.toggle.watsapp') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="flex items-center">
                        <label class="text-gray-600 font-medium mr-4">Enable WhatsApp Notifications</label>
                        <div class="notification-toggle">
                            <input style="display: none" type="checkbox" name="notifications_in_watsapp" id="whatsapp-notification-toggle-checkbox"
                            {{ auth()->user()->notifications_in_watsapp ? 'checked' : '' }}>
                            <label for="whatsapp-notification-toggle-checkbox" class="toggle-label">
                                <span class="toggle-switch"></span>
                            </label>
                        </div>
                    </div>
                </form>

                <!-- نموذج لتفعيل/إيقاف الإشعارات -->
                <form id="notification-form" action="{{ route('notifications.toggle') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="flex items-center">
                        <label class="text-gray-600 font-medium mr-4">Disable Notifications</label>
                        <div class="notification-toggle">
                            <input style="display: none" type="checkbox" name="notifications_disabled" id="notification-toggle-checkbox"
                            {{ auth()->user()->notifications_disabled ? 'checked' : '' }}>
                            <label for="notification-toggle-checkbox" class="toggle-label">
                                <span class="toggle-switch"></span>
                            </label>
                        </div>
                    </div>
                </form>

                <!-- نموذج لتخصيص الوقت -->
                <form id="notification-time-form" action="{{ route('notifications.updateTime') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="mb-4">
                        <label for="email_verified_at" class="block text-gray-600 font-medium mb-2">Preferred Time for Notifications</label>
                        <input type="time" name="email_verified_at" id="email_verified_at"
                               value="{{ auth()->user()->email_verified_at }}"
                               class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        @if (auth()->user()->email_verified_at)
                            <div class="mt-3">Old time is ({{ auth()->user()->email_verified_at }})</div>
                        @endif
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Save Time Settings
                    </button>
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
