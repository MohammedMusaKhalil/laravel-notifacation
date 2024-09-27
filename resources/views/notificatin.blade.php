<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Your Notifications</h3>

            <div id="notifications-list">
                <!-- سيتم تحديث الإشعارات هنا -->
            </div>
        </div>
    </div>

    <script>
        // استدعاء الإشعارات من خلال الـ API وتحديث قائمة الإشعارات
        function fetchNotifications() {
            fetch('/api/notifications')
                .then(response => response.json())
                .then(data => {
                    let notificationsList = document.getElementById('notifications-list');

                    // تحقق من وجود العنصر
                    if (!notificationsList) {
                        console.error('Element with id "notifications-list" not found.');
                        return;
                    }

                    notificationsList.innerHTML = '';

                    // إذا كانت البيانات موجودة
                    if (data.length > 0) {
                        data.forEach(notification => {
                            let notificationItem = `
                                <div class="notification bg-gray-100 border-l-4 border-blue-500 shadow-sm rounded-lg mb-6 p-5">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-gray-800">${notification.data}</p>
                                            <small class="text-gray-500">${notification.created_at}</small>
                                        </div>
                                        <div class="flex items-center">
                                            ${notification.read_at === null ? `
                                                <form action="/notifications/markAsRead/${notification.id}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                                        Mark as Read
                                                    </button>
                                                </form>
                                            ` : '<span class="text-green-500 font-semibold">Read</span>'}
                                        </div>
                                    </div>
                                </div>`;
                            notificationsList.innerHTML += notificationItem;
                        });
                    } else {
                        notificationsList.innerHTML = '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert"><p>No notifications available.</p></div>';
                    }
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }

        // عند تحميل DOM بالكامل
        document.addEventListener('DOMContentLoaded', function() {
            fetchNotifications();
            setInterval(fetchNotifications, 5000); // تحديث كل 5 ثواني
        });
    </script>
</x-app-layout>
