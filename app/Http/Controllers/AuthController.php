<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\SyncTemperatureData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $sync_temperature_data;

    public function __construct(SyncTemperatureData $sync_temperature_data)
    {
        $this->sync_temperature_data = $sync_temperature_data;
    }

    public function register(StoreUserRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->sync_temperature_data->addUsertoCity($user);

        return response()->json(['msg' => 'success'], 200);

    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::with('cities')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user_token = $user->createToken($request->device_name)->plainTextToken;

        if ($user_token) {
            //sync data with db
            $this->sync_temperature_data->processApiData($user);

            return $user_token;
        } else {
            return response()->json(['msg' => 'Conflict'], 409);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['msg' => 'success'], 200);
    }

}
