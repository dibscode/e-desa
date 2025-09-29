<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function handleRequest(Request $request)
    {
        $userPrompt = $request->input('prompt');
        if (empty($userPrompt)) {
            return response()->json(['answer' => 'Prompt tidak boleh kosong.'], 200);
        }

        $apiUrl = 'https://api.mhcloud.biz.id/api/v1/ai/gamma';
        $apiKey = 'API-MhCloud-ec5cd1a7-1b43-4cc4-9b33-d4e39ee62d90';

        try {
            $response = Http::timeout(60)->get($apiUrl, [
                'text' => $userPrompt,
                'apikey' => $apiKey,
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                if (isset($responseData['error'])) {
                    return response()->json(['answer' => 'Maaf, AI membalas dengan error: ' . $responseData['error']], 200);
                }
                $aiAnswer = $responseData['result'] ?? 'Maaf, AI tidak memberikan jawaban yang valid (field result kosong).';
                $aiAnswer = preg_replace('/(\*)\s*([^\n:]+):/', '**$2**:', $aiAnswer);
                $aiAnswer = preg_replace('/^(\*)\s*(.+)$/m', ' **$2**', $aiAnswer);
                $aiAnswer = str_replace('**', '', $aiAnswer);
                $aiAnswer = preg_replace('/(\*)/', ' ', $aiAnswer);
                return response()->json(['answer' => $aiAnswer]);
            } else {
                $errorMessage = 'Gagal menghubungi AI. Status HTTP: ' . $response->status();
                try {
                    $errorData = $response->json();
                    if (isset($errorData['message'])) {
                        $errorMessage .= ' Pesan API: ' . $errorData['message'];
                    }
                } catch (\Exception $e) {
                }

                return response()->json(['answer' => $errorMessage], 200);
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json(['answer' => 'Gagal terhubung ke API AI. Timeout (60 detik) atau masalah koneksi jaringan.'], 200);
        } catch (\Exception $e) {
            return response()->json(['answer' => 'Terjadi kesalahan internal pada server Laravel.'], 200);
        }
    }
}
