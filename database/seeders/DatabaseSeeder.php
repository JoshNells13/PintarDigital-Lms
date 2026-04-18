<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Core Users
        $admin = $this->createAdmin();
        $instructor = $this->createInstructor();
        $student = $this->createStudent();

        // 2. Sample Course: Digital Mastery
        $course = $this->createMainCourse($instructor);

        // 3. Enroll Student
        $student->enrolledCourses()->attach($course->id, ['enrolled_at' => now()]);
    }

    private function createAdmin()
    {
        return User::factory()->create([
            'name' => 'PintarDigital Admin',
            'email' => 'admin@pintardigital.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);
    }

    private function createInstructor()
    {
        return User::factory()->create([
            'name' => 'Arifan Kristanto',
            'email' => 'instructor@pintardigital.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'instructor',
        ]);
    }

    private function createStudent()
    {
        return User::factory()->create([
            'name' => 'Budi Sudarsono',
            'email' => 'student@pintardigital.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'student',
        ]);
    }

    private function createMainCourse($instructor)
    {
        $course = \App\Models\Course::create([
            'instructor_id' => $instructor->id,
            'title' => 'The Art of Minimalist UI Design',
            'slug' => 'minimalist-ui-design-mastery',
            'description' => 'Learn how to build premium, high-converting digital interfaces using modern design principles and PintarDigital methodologies.',
            'price' => 199.00,
            'is_approved' => true,
        ]);

        // Chapter 1: Visual Foundations
        $chapter1 = $course->chapters()->create(['title' => 'Visual Foundations', 'order' => 1]);
        
        $sub1 = $chapter1->subChapters()->create(['title' => 'The Power of Negative Space', 'order' => 1]);
        $sub1->material()->create([
            'title' => 'Why Less is More',
            'content' => "# The Power of Negative Space\n\nNegative space, often referred to as whitespace, is the area between design elements. In this lesson, we explore how it improves readability and focus.\n\n### Why Whitespace Matters:\n- **Better Legibility**: Focuses the eye on the content.\n- **Luxury Feel**: High-end brands use generous spacing.\n- **Cognitive Load**: Reduces visual noise.",
            'type' => 'text'
        ]);

        $sub2 = $chapter1->subChapters()->create(['title' => 'Check: UI Foundations', 'order' => 2]);
        $quiz = $sub2->quiz()->create(['title' => 'Foundation Assessment']);
        $q1 = $quiz->questions()->create(['question_text' => 'What is another term for Negative Space?']);
        $q1->choices()->create(['choice_text' => 'Whitespace', 'is_correct' => true]);
        $q1->choices()->create(['choice_text' => 'Blackhole', 'is_correct' => false]);
        $q1->choices()->create(['choice_text' => 'Padding only', 'is_correct' => false]);

        // Chapter 2: Color Psychology
        $chapter2 = $course->chapters()->create(['title' => 'Color Psychology', 'order' => 2]);
        $chapter2->subChapters()->create(['title' => 'Choosing Your Palette', 'order' => 1]);

        return $course;
    }
}
