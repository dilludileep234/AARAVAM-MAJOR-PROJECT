<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StudentController extends Controller
{
    public function export()
    {
        $students = Student::all();

        $response = new StreamedResponse(function () use ($students) {
            $handle = fopen('php://output', 'w');

            // CSV Header
            fputcsv($handle, ['ID', 'Name', 'Age']);

            foreach ($students as $student) {
                fputcsv($handle, [
                    $student->ID,
                    $student->Name,
                    $student->Age
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set(
            'Content-Disposition',
            'attachment; filename="students.csv"'
        );

        return $response;
    }
}

