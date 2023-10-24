<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\WelcomeMail;
use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     *
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $company = Company::firstOrCreate([
            'name' => $request->company_name,
            ]);

        $client = Client::firstOrCreate([
            'company_id' => $company->id,
        ]);

        $user->client()->associate($client);
        $user->save();

        event(new Registered($user));
        Auth::login($user);
        $token = $user->createToken('LaravelSanctumAuth', ['user-get-user'])->plainTextToken;
//        $this->sendMail($user);

        return redirect()->route('dashboard')->with(['token' => $token, 'firstname' => $user->firstname, 'lastname' => $user->lastname]);
    }

    protected function sendMail(User $user)
    {
        $mj = Mailjet::getClient();

        $body = [
            'FromEmail' => "stephane@lery.cc",
            'FromName' => "Stephane",
            'Subject' => "Welcome",
            'MJ-TemplateID' => 5017483,
            'MJ-TemplateLanguage' => true,
            'Vars' =>['name'=>'Stephane'],
            'Recipients' => [['Email' => "stephane@lery.cc"]]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);

        if($response->success()){
            Log::info('email sent'.$response->getReasonPhrase());
        } else {
            Log::error('not sent'.$response->getReasonPhrase());
        }

    }

}
