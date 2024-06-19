<?php

namespace App\Http\Controllers\Frontend\User;

use App\User;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdateProfileRequest $request)
    {
        
        $output = $this->userRepository->update(
            $request->user()->id,
            $request->only('first_name', 'last_name', 'email',  
                'avatar_location', 'profile', 'matches_info', 'a_phone', 'subscribed', 'show_image', 
            'question_one', 'question_two', 'question_three', 'question_four'),
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );
        
        if ($request->hasFile('avatar_location')) {
            $image = $request->file('avatar_location');
            $name = '/avatars/'. time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/avatars');
            $imageName = $image->move($destinationPath, $name);
            $user = User::whereId(auth()->user()->id)->first();
            $user->avatar_location = $name;
            $user->save();
        }
        $getpin = User::where('pincode', $request->pincode)->first();

        if($getpin){
            if($getpin->id != auth()->user()->id)
                return redirect()->route('frontend.user.account')->withFlashDanger('Please Select different Pin');
        }
        else{
            $user = User::whereId(auth()->user()->id)->first();
            $user->pincode = $request->pincode;
            $user->save();
        }
        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            auth()->logout();

            return redirect()->route('frontend.auth.login')->withFlashInfo(__('strings.frontend.user.email_changed_notice'));
        }

        return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.profile_updated'));
    }
}
