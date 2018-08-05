<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Http\Requests;

class ProfileController extends Controller
{
  public function index()
  {
    $profile = Profile::orderByDesc('id')->get();
    return response($profile);
  }

  public function show($id)
  {
    $profile = Profile::where('email', $id)->get();
    if(!$profile)
    {
      return response()->json(['code' => 204, 'message' => 'data not found']);
    }
      return response($profile);
  }

  public function store(Request $request)
  {

    $this->validate($request, [
      'name' => 'required',
      'email'  => 'required',
      'job'  => 'required',
    ]);
    $profile = Profile::where('email', $request->email)->first();
    if($profile)
    {
      return response()->json(['code' => 404, 'message' => 'error, email has been used']);
    }
    else
    {
    $profile = Profile::create([
      'name' => $request->name,
      'email'  => $request->email,
      'job'  => $request->job,
    ]);
    return response()->json(['code' => 200, 'message' => 'success']);
    }
  }

  public function update(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required',
      'job'  => 'required',
    ]);
    $profile = Profile::where('email', $request->email)->first();
    $profile->name = $request->name;
    $profile->job = $request->job;
    $profile->save();
    return response()->json(['code' => 200, 'message' => 'success']);
  }

  public function destroy(Request $request, $id)
  {
  $profile = Profile::where('email', $id)->first();
    if($profile)
    {
      $profile->delete();
      return response()->json(['code' => 200, 'message' => 'success']);
    }
    else
    {
      return response()->json(['code' => 404, 'message' => 'error, data not found']);
    }
  }
}
