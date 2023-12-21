<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        $users = $query->get();
        return response()->json($users, 200);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->all());
        return response()->json(['message' => 'Create'], 201);
    }

    public function update(CreateUserRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->json(['message' => 'Updated'], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}

