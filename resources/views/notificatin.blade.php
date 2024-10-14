<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications & Daily Advice') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Your Notifications</h3>

            <div id="notifications-list">
                <!-- سيتم تحديث الإشعارات هنا -->
            </div>

            <h3 class="text-2xl font-semibold text-gray-700 mb-4 mt-8">Your Daily Advice</h3>

            <div id="daily-advice-list">
                <!-- سيتم عرض النصائح هنا -->
                @if(isset($translatedAdvice) && count($translatedAdvice) > 0)
                    @foreach($translatedAdvice as $advice)
                        <div class="advice bg-blue-100 border-l-4 border-blue-500 shadow-sm rounded-lg mb-6 p-5">
                            <p class="text-gray-800">{{ $advice['translated_advice'] }}</p>
                            <small class="text-gray-500">{{ $advice['date'] }}</small>
                        </div>
                    @endforeach
                @else
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                        <p>No daily advice available.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // تحديد المنطقة الزمنية للمستخدم من المتصفح
        var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

        // إرسال المنطقة الزمنية إلى الخادم عبر AJAX
        fetch('{{ route('set.timezone') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ timezone: timezone })
        }).then(response => response.json())
        .then(data => {
            console.log('Timezone set successfully:', data);
        }).catch(error => {
            console.error('Error setting timezone:', error);
        });

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
                                                <form action="/notifications/${notification.id}/mark-as-read" method="POST">
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
