<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseComment;
use App\Models\CourseLike;
use App\Models\CourseCommentLike;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Seed Categories
        $catWeb = Category::create([
            'name' => 'Web',
            'slug' => 'web'
        ]);

        $catAndroid = Category::create([
            'name' => 'Android',
            'slug' => 'android'
        ]);

        $catBasics = Category::create([
            'name' => 'Bahasa Pemrograman Dasar',
            'slug' => 'bahasa-pemrograman-dasar'
        ]);

        // 2. Core Users (Admin, Instructors, Student)
        $admin = User::create([
            'name' => 'PintarDigital Admin',
            'email' => 'admin@pintardigital.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $instructor1 = User::create([
            'name' => 'Arifan Kristanto',
            'email' => 'arifan@pintardigital.com',
            'password' => Hash::make('password'),
            'role' => 'instructor',
            'bio' => 'Software Architect dengan pengalaman 10+ tahun membangun sistem backend skala besar menggunakan PHP & Laravel.',
        ]);

        $instructor2 = User::create([
            'name' => 'Rian Utama',
            'email' => 'rian@pintardigital.com',
            'password' => Hash::make('password'),
            'role' => 'instructor',
            'bio' => 'Mobile Developer & Google Developer Expert untuk Flutter, bersemangat membangun aplikasi mobile yang indah dan berkinerja tinggi.',
        ]);

        $instructor3 = User::create([
            'name' => 'Dewi Sartika',
            'email' => 'dewi@pintardigital.com',
            'password' => Hash::make('password'),
            'role' => 'instructor',
            'bio' => 'Pendidik teknologi dan Data Scientist dengan kecintaan mendalam pada Python dan dasar-dasar ilmu komputer.',
        ]);

        $student = User::create([
            'name' => 'Budi Sudarsono',
            'email' => 'student@pintardigital.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'bio' => 'Seorang pelajar yang sedang antusias mendalami dunia pemrograman web dan mobile.',
        ]);

        // 3. Seed Course 1: Laravel (Web Category)
        $courseLaravel = Course::create([
            'instructor_id' => $instructor1->id,
            'category_id' => $catWeb->id,
            'title' => 'Membangun Web Dinamis dengan Laravel 11',
            'slug' => 'membangun-web-dinamis-dengan-laravel-11',
            'description' => 'Pelajari cara membuat aplikasi web yang tangguh, aman, dan berkinerja tinggi menggunakan fitur terbaru dari Laravel 11.',
            'price' => 249000.00,
            'is_approved' => true,
        ]);

        // Chapters for Laravel
        $chap1 = $courseLaravel->chapters()->create(['title' => 'Dasar Laravel & Routing', 'order' => 1]);
        $sub1_1 = $chap1->subChapters()->create(['title' => 'Mengenal Routing di Laravel', 'order' => 1]);
        $sub1_1->material()->create([
            'title' => 'Dasar-Dasar Routing',
            'content' => "# Mengenal Routing di Laravel\n\nRouting adalah mekanisme yang mengarahkan permintaan HTTP ke controller atau penanganan tertentu di aplikasi Anda.\n\n### Contoh Kode:\n```php\nRoute::get('/halo', function () {\n    return 'Halo PintarDigital!';\n});\n```\n\n### Mengapa Routing Laravel Sangat Powerful?\n- **Sederhana & Ekspresif**: Sintaks yang mudah dibaca.\n- **Route Parameters**: Menangkap data dinamis dari URL dengan mudah.\n- **Middleware Integration**: Mengamankan rute dengan filter tertentu.",
            'type' => 'text'
        ]);

        $sub1_2 = $chap1->subChapters()->create(['title' => 'Uji Pemahaman: Routing', 'order' => 2]);
        $quiz1 = $sub1_2->quiz()->create(['title' => 'Kuis Dasar Routing']);
        $q1 = $quiz1->questions()->create(['question_text' => 'Metode HTTP apa yang digunakan untuk membuat data resource baru?']);
        $q1->choices()->create(['choice_text' => 'POST', 'is_correct' => true]);
        $q1->choices()->create(['choice_text' => 'GET', 'is_correct' => false]);
        $q1->choices()->create(['choice_text' => 'DELETE', 'is_correct' => false]);

        $chap2 = $courseLaravel->chapters()->create(['title' => 'Database & Eloquent ORM', 'order' => 2]);
        $sub2_1 = $chap2->subChapters()->create(['title' => 'Pengenalan Migrasi Database', 'order' => 1]);
        $sub2_1->material()->create([
            'title' => 'Apa itu Migrasi?',
            'content' => "# Pengenalan Migrasi Database\n\nMigrasi adalah seperti version control untuk database Anda, memungkinkan tim Anda untuk memodifikasi dan membagikan skema database aplikasi dengan mudah.",
            'type' => 'text'
        ]);

        // 4. Seed Course 2: Flutter (Android Category)
        $courseFlutter = Course::create([
            'instructor_id' => $instructor2->id,
            'category_id' => $catAndroid->id,
            'title' => 'Pembuatan Aplikasi Mobile dengan Flutter',
            'slug' => 'pembuatan-aplikasi-mobile-dengan-flutter',
            'description' => 'Kembangkan aplikasi mobile lintas platform (Android dan iOS) yang cepat dan indah hanya dengan satu basis kode Dart.',
            'price' => 299000.00,
            'is_approved' => true,
        ]);

        $chapFlutter1 = $courseFlutter->chapters()->create(['title' => 'Instalasi & Pengenalan Widget', 'order' => 1]);
        $subFlutter1 = $chapFlutter1->subChapters()->create(['title' => 'Memahami Konsep Widgets', 'order' => 1]);
        $subFlutter1->material()->create([
            'title' => 'Everything is a Widget',
            'content' => "# Memahami Konsep Widgets\n\nDi Flutter, hampir semua hal yang Anda lihat di layar adalah Widget. Dari struktur teks, gambar, tata letak, hingga animasi semuanya diatur oleh widget.",
            'type' => 'text'
        ]);

        // 5. Seed Course 3: Python (Basics Category)
        $coursePython = Course::create([
            'instructor_id' => $instructor3->id,
            'category_id' => $catBasics->id,
            'title' => 'Dasar Pemrograman Python untuk Pemula',
            'slug' => 'dasar-pemrograman-python-untuk-pemula',
            'description' => 'Langkah awal yang sempurna untuk masuk ke dunia pemrograman. Pelajari logika dasar menggunakan Python, bahasa pemrograman paling populer di dunia saat ini.',
            'price' => 0.00,
            'is_approved' => true,
        ]);

        $chapPython1 = $coursePython->chapters()->create(['title' => 'Pengenalan & Logika Dasar', 'order' => 1]);
        $subPython1 = $chapPython1->subChapters()->create(['title' => 'Variabel & Tipe Data', 'order' => 1]);
        $subPython1->material()->create([
            'title' => 'Dasar Variabel Python',
            'content' => "# Variabel & Tipe Data\n\nVariabel digunakan untuk menyimpan informasi yang akan dimanipulasi dan dirujuk dalam program komputer.\n\n```python\nnama = 'Budi'\numur = 20\nprint(f'Halo {nama}, umur kamu {umur} tahun.')\n```",
            'type' => 'text'
        ]);

        // 6. Enroll Student in Laravel Course
        $student->enrolledCourses()->attach($courseLaravel->id, ['enrolled_at' => now()]);

        // 7. Seed Likes on Courses
        CourseLike::create(['user_id' => $student->id, 'course_id' => $courseLaravel->id]);
        CourseLike::create(['user_id' => $instructor2->id, 'course_id' => $courseLaravel->id]);
        CourseLike::create(['user_id' => $student->id, 'course_id' => $coursePython->id]);

        // 8. Seed Comments, Ratings & Replies
        $cmt1 = CourseComment::create([
            'user_id' => $student->id,
            'course_id' => $courseLaravel->id,
            'content' => 'Kelas Laravel ini sangat menakjubkan! Penjelasan tertulisnya sangat detail dan saya suka kuis interaktifnya. Sangat cocok bagi yang ingin belajar serius tanpa terdistraksi video.',
            'rating' => 5,
        ]);

        $cmt2 = CourseComment::create([
            'user_id' => $instructor2->id,
            'course_id' => $courseLaravel->id,
            'content' => 'Bagus sekali modulnya pak Arifan! Terutama bagian penulisan routing-nya bersih sekali.',
            'rating' => 5,
        ]);

        // Replies
        CourseComment::create([
            'user_id' => $instructor1->id,
            'course_id' => $courseLaravel->id,
            'parent_id' => $cmt1->id,
            'content' => 'Terima kasih banyak Budi! Senang mendengar metode text-first ini membantu pemahaman kamu. Terus berproses!',
        ]);

        CourseComment::create([
            'user_id' => $instructor1->id,
            'course_id' => $courseLaravel->id,
            'parent_id' => $cmt2->id,
            'content' => 'Terima kasih pak Rian! Mari kita sama-sama mencetak lebih banyak developer andal.',
        ]);

        // 9. Seed Comment Likes
        CourseCommentLike::create(['user_id' => $instructor2->id, 'course_comment_id' => $cmt1->id]);
        CourseCommentLike::create(['user_id' => $student->id, 'course_comment_id' => $cmt2->id]);
    }
}
