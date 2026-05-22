<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certification;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::orderBy('order')
            ->orderBy('issued_at', 'desc')
            ->get();

        return response()->json($certifications);
    }
}