<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Equipment::with('user')->get());
    }

    public function assign(Request $request, Equipment $equipment): JsonResponse
    {
        $request->validate([
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        $userId = $request->input('user_id');

        if ($userId !== null && $equipment->user_id !== null) {
            return response()->json([
                'message' => 'Equipment is already assigned. Unassign it first.',
            ], 422);
        }

        $equipment->update(['user_id' => $userId]);

        return response()->json($equipment->load('user'));
    }
}
