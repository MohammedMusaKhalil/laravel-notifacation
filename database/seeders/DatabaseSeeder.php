<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // إدخال 25 مستخدم عشوائي
        foreach (range(1, 25) as $index) {
            \App\Models\User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // كلمة مرور افتراضية
                'last_login_at' => Arr::random([now()->subDays(rand(1,36))]),
            ]);
        }

        \App\Models\Admin::create([
            'name' => 'Admin',
            'email' => 'mm@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password


        ]);
        \App\Models\User::create([
            'first_name' => 'sami',
            'last_name' => 'sami',
            'email' => 'sami@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'last_login_at' => Arr::random([now()->subDays(rand(1,36))]),
        ]);
        \App\Models\User::create([
            'first_name' => 'rami',
            'last_name' => 'rami',
            'email' => 'rami@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'last_login_at' => Arr::random([now()->subDays(rand(1,36))]),

        ]);

        DB::table('languages')->insert([
            [
                'language' => 'Arabic',
                'code' => 'ar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'language' => 'English',
                'code' => 'en',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'language' => 'German',
                'code' => 'de',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'language' => 'French',
                'code' => 'fr',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('hobbies')->insert([
            [
                'hobby_name' => 'Reading',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hobby_name' => 'Writing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hobby_name' => 'Swimming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hobby_name' => 'Painting',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('favorite_colors')->insert([
            [
                'color_name' => 'Red',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'color_name' => 'Blue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'color_name' => 'Green',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'color_name' => 'Yellow',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        DB::table('favorite_books')->insert([
            [
                'book_name' => 'The Great Gatsby',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_name' => 'To Kill a Mockingbird',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_name' => '1984',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_name' => 'Moby Dick',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('favorite_musics')->insert([
            [
                'music_genre' => 'Rock',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'music_genre' => 'Jazz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'music_genre' => 'Classical',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'music_genre' => 'Pop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('other_interests')->insert([
            [
                'interest_name' => 'Traveling',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'interest_name' => 'Photography',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'interest_name' => 'Cooking',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'interest_name' => 'Gardening',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('zodiacsigns')->insert([
            [
                'zodiacn' => 'الحمل',
                'startDate' => '2021-03-21',
                'endDate' => '2021-04-19',
                'characteristics' => 'النشاط والشجاعة',
                'element' => 'النار، يمثل الطاقة والحماس',
                'rulingPlanet' => 'المريخ، كوكب الشجاعة والعمل',
                'symbol' => 'الكبش، يرمز إلى القوة والإصرار',
                'compatibility' => 'الأسد، القوس',
                'ZodiacSign' => 'جرأة وطموح',
                'PhysicalTraits' => 'وجه مميز وملامح حادة',
                'Interests' => 'الرياضة والمغامرات',
                'PersonalityTraits' => 'شجاع ومندفع',
                'ProfessionalLife' => 'مناسب للمهن القيادية والرياضية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'الثور',
                'startDate' => '2021-04-20',
                'endDate' => '2021-05-20',
                'characteristics' => 'الثبات والصبر',
                'element' => 'الأرض، يمثل الاستقرار والعملية',
                'rulingPlanet' => 'الزهرة، كوكب الحب والجمال',
                'symbol' => 'الثور، يرمز إلى القوة والعزيمة',
                'compatibility' => 'العذراء، الجدي',
                'ZodiacSign' => 'صبر وقوة داخلية',
                'PhysicalTraits' => 'جسد قوي ووجه حازم',
                'Interests' => 'الطبيعة والفن',
                'PersonalityTraits' => 'صبور وعملي',
                'ProfessionalLife' => 'مناسب للمهن الزراعية والفنية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'الجوزاء',
                'startDate' => '2021-05-21',
                'endDate' => '2021-06-20',
                'characteristics' => 'التكيف والتواصل',
                'element' => 'الهواء، يمثل التغيير والتواصل',
                'rulingPlanet' => 'عطارد، كوكب التواصل والفكر',
                'symbol' => 'التوأم، يرمز إلى الازدواجية والتنوع',
                'compatibility' => 'الميزان، الدلو',
                'ZodiacSign' => 'ذكي وفضولي',
                'PhysicalTraits' => 'وجه معبر وملامح نشطة',
                'Interests' => 'التواصل والسفر',
                'PersonalityTraits' => 'فضولي ومرن',
                'ProfessionalLife' => 'مناسب للمهن الإعلامية والتسويق',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'السرطان',
                'startDate' => '2021-06-21',
                'endDate' => '2021-07-22',
                'characteristics' => 'العاطفة والحساسية',
                'element' => 'الماء، يمثل العاطفة والحساسية',
                'rulingPlanet' => 'القمر، كوكب العواطف والخيال',
                'symbol' => 'السلطعون، يرمز إلى الحماية والاحتضان',
                'compatibility' => 'العقرب، الحوت',
                'ZodiacSign' => 'حساس وحنون',
                'PhysicalTraits' => 'عيون معبرة وملامح لطيفة',
                'Interests' => 'الأسرة والفنون',
                'PersonalityTraits' => 'عاطفي وحساس',
                'ProfessionalLife' => 'مناسب للمهن المرتبطة بالرعاية والفنون',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'الأسد',
                'startDate' => '2021-07-23',
                'endDate' => '2021-08-22',
                'characteristics' => 'الفخر والإبداع',
                'element' => 'النار، يمثل الطاقة والإبداع',
                'rulingPlanet' => 'الشمس، رمز القوة والحياة',
                'symbol' => 'الأسد، يرمز إلى الفخر والقيادة',
                'compatibility' => 'الحمل، القوس',
                'ZodiacSign' => 'قوي وواثق',
                'PhysicalTraits' => 'جسم قوي وملامح مميزة',
                'Interests' => 'الفن والقيادة',
                'PersonalityTraits' => 'واثق ومبدع',
                'ProfessionalLife' => 'مناسب للمهن الفنية والإدارية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'العذراء',
                'startDate' => '2021-08-23',
                'endDate' => '2021-09-22',
                'characteristics' => 'التحليل والعملية',
                'element' => 'الأرض، يمثل النظام والعملية',
                'rulingPlanet' => 'عطارد، كوكب التحليل والفكر',
                'symbol' => 'العذراء، يرمز إلى النقاء والتفاني',
                'compatibility' => 'الثور، الجدي',
                'ZodiacSign' => 'منظم وتحليلي',
                'PhysicalTraits' => 'ملامح هادئة وجسم متناسق',
                'Interests' => 'الصحة والعلوم',
                'PersonalityTraits' => 'دقيق ومنظم',
                'ProfessionalLife' => 'مناسب للمهن التحليلية والعلمية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'الميزان',
                'startDate' => '2021-09-23',
                'endDate' => '2021-10-22',
                'characteristics' => 'التوازن والدبلوماسية',
                'element' => 'الهواء، يمثل التوازن والتفكير',
                'rulingPlanet' => 'الزهرة، كوكب الجمال والعلاقات',
                'symbol' => 'الميزان، يرمز إلى العدالة والانسجام',
                'compatibility' => 'الجوزاء، الدلو',
                'ZodiacSign' => 'متوازن ودبلوماسي',
                'PhysicalTraits' => 'ملامح متناسقة وجسم متوازن',
                'Interests' => 'الفن والعلاقات الاجتماعية',
                'PersonalityTraits' => 'دبلوماسي وعادل',
                'ProfessionalLife' => 'مناسب للمهن الدبلوماسية والقانونية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'العقرب',
                'startDate' => '2021-10-23',
                'endDate' => '2021-11-21',
                'characteristics' => 'الشغف والقوة',
                'element' => 'الماء، يمثل الشغف والعمق',
                'rulingPlanet' => 'بلوتو، كوكب التحول والقوة',
                'symbol' => 'العقرب، يرمز إلى الشغف والقوة الداخلية',
                'compatibility' => 'السرطان، الحوت',
                'ZodiacSign' => 'غامض وقوي',
                'PhysicalTraits' => 'عيون حادة وملامح قوية',
                'Interests' => 'الأسرار والتحليل',
                'PersonalityTraits' => 'قوي وملتزم',
                'ProfessionalLife' => 'مناسب للمهن التحليلية والاستخباراتية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'القوس',
                'startDate' => '2021-11-22',
                'endDate' => '2021-12-21',
                'characteristics' => 'المغامرة والحرية',
                'element' => 'النار، يمثل الحرية والمغامرة',
                'rulingPlanet' => 'المشتري، كوكب الحظ والتوسع',
                'symbol' => 'القوس، يرمز إلى المغامرة والاستكشاف',
                'compatibility' => 'الحمل، الأسد',
                'ZodiacSign' => 'مغامر ومستقل',
                'PhysicalTraits' => 'جسم نشيط وملامح حيوية',
                'Interests' => 'السفر والتعلم',
                'PersonalityTraits' => 'حر ومستقل',
                'ProfessionalLife' => 'مناسب للمهن المتعلقة بالسفر والتدريس',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'الجدي',
                'startDate' => '2021-12-22',
                'endDate' => '2021-01-19',
                'characteristics' => 'الانضباط والطموح',
                'element' => 'الأرض، يمثل الانضباط والطموح',
                'rulingPlanet' => 'زحل، كوكب النظام والمسؤولية',
                'symbol' => 'الجدي، يرمز إلى الطموح والعمل الجاد',
                'compatibility' => 'الثور، العذراء',
                'ZodiacSign' => 'طموح ومنضبط',
                'PhysicalTraits' => 'جسم نحيف وملامح حازمة',
                'Interests' => 'العمل والإنجاز',
                'PersonalityTraits' => 'منضبط وملتزم',
                'ProfessionalLife' => 'مناسب للمهن الإدارية والمالية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'الدلو',
                'startDate' => '2021-01-20',
                'endDate' => '2021-02-18',
                'characteristics' => 'الابتكار والاستقلالية',
                'element' => 'الهواء، يمثل الحرية والابتكار',
                'rulingPlanet' => 'أورانوس، كوكب الابتكار والتغيير',
                'symbol' => 'حامل الماء، يرمز إلى التجديد والمعرفة',
                'compatibility' => 'الجوزاء، الميزان',
                'ZodiacSign' => 'مستقل ومبدع',
                'PhysicalTraits' => 'ملامح غير تقليدية وجسم نشيط',
                'Interests' => 'الابتكار والعلوم',
                'PersonalityTraits' => 'مستقل ومبدع',
                'ProfessionalLife' => 'مناسب للمهن التقنية والعلمية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zodiacn' => 'الحوت',
                'startDate' => '2021-02-19',
                'endDate' => '2021-03-20',
                'characteristics' => 'الخيال والرحمة',
                'element' => 'الماء، يمثل الخيال والعاطفة',
                'rulingPlanet' => 'نبتون، كوكب الأحلام والروحانية',
                'symbol' => 'السمك، يرمز إلى الروحانية والتكيف',
                'compatibility' => 'السرطان، العقرب',
                'ZodiacSign' => 'حساس وخيالي',
                'PhysicalTraits' => 'ملامح لطيفة وعيون معبرة',
                'Interests' => 'الفن والموسيقى',
                'PersonalityTraits' => 'رحيم وخيالي',
                'ProfessionalLife' => 'مناسب للمهن الفنية والروحانية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
