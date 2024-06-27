<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\PointTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $user->verifyUserTaskStatus();
        return view('dashboard');
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function editPoints(Request $request) : RedirectResponse
    {
        request()->validate([
            'points' => ['required' , 'integer']
        ]);
        $userIdAuth = Auth::user()->id;
        $userTablePointMain = PointTable::where('user_id', $userIdAuth)
        ->where('name', 'MAIN TABLE')->first();
        $userTablePointMain->point_value = $request->points;
        $userTablePointMain->save();
        return redirect(RouteServiceProvider::HOME);
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
