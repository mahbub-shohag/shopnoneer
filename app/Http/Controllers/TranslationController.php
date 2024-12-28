<?php

namespace App\Http\Controllers;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TranslationController extends Controller
{
    public function translation(Request $request)
    {
        // Path to the CSV file in the storage
        $filePath = public_path('/translation/districts.csv');// Update the path if needed
        // Open the file for reading
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return response()->json(['error' => 'File not found or unreadable'], 404);
        }

        // Read the CSV file
        $rows = array_map('str_getcsv', file($filePath));
        $header = array_map('trim', $rows[0]); // Get the header row
        unset($rows[0]); // Remove the header row from data

        // Ensure the CSV contains the required columns
        if (!in_array('name', $header) || !in_array('name_bn', $header)) {
            return response()->json(['error' => 'CSV missing required columns'], 422);
        }

        $sqlStatements = [];
        foreach ($rows as $row) {
            $data = array_combine($header, $row); // Map headers to row values
            $name = addslashes(trim($data['name']));
            $nameBn = addslashes(trim($data['name_bn']));

            $sqlStatements[] = "UPDATE districts SET name_bn = '{$nameBn}' WHERE name = '{$name}';";
        }

        // Save the generated SQL statements to a file (optional)
        $outputPath = storage_path('translation/districts.sql');
        file_put_contents($outputPath, implode("\n", $sqlStatements));

        // Return the statements as a response
        return response()->json([
            'message' => 'SQL statements generated successfully',
            'output_file' => $outputPath,
        ]);
    }

}