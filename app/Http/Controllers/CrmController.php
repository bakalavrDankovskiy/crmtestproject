<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use App\Models\Crm\Lead;
use App\Models\Crm\Token;
use Exception;
use Illuminate\Support\Carbon;
use League\OAuth2\Client\Token\AccessToken;

class CrmController extends Controller
{
    public function showImportPage()
    {
        return view('leadsImport');
    }

    public function importLeadsToDb(AmoCRMApiClient $apiClient)
    {
        $accessToken = $this->getTokenFromStorage($apiClient);

        if (!$accessToken) {
            $accessToken = $this->getTokenFromCrm($apiClient);
        }

        $apiClient->setAccessToken($accessToken);

        $leadsCollections = $apiClient->leads()->get()->chunk(50);

        foreach ($leadsCollections as $leadCollection) {
            foreach ($leadCollection->toArray() as $leadModel) {
                Lead::updateOrCreate(['id' => $leadModel['id']], $leadModel);
            }
        }

        return redirect()
            ->back()
            ->with(['success' => 'Данные успешно импортированы']);
    }

    public function getTokenFromCrm(AmoCRMApiClient $apiClient): ?AccessToken
    {
        try {
            $accessToken = $apiClient->getOAuthClient()->getAccessTokenByCode(config('services.amocrm.auth_code'));

            if (!$accessToken->hasExpired()) {
                Token::create([
                    'client_id' => config('services.amocrm.client_id'),
                    'access_token' => $accessToken->getToken(),
                    'refresh_token' => $accessToken->getRefreshToken(),
                    'last_used_at' => now()->timestamp,
                    'expires_at' => Carbon::parse($accessToken->getExpires()),
                    'base_domain' => $apiClient->getAccountBaseDomain(),
                ]);
            }

            return $accessToken;
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function getTokenFromStorage(AmoCRMApiClient $apiClient): ?AccessToken
    {
        $clientId = $apiClient->getOAuthClient()->getOAuthProvider()->getClientId();

        $token = Token::firstWhere('client_id', $clientId);

        if (!$token) {
            return null;
        }

        $accessToken = new AccessToken([
            'access_token' => $token->access_token,
            'refresh_token' => $token->refresh_token,
            'expires' => $token->expires_at->timestamp,
            'baseDomain' => $token->base_domain,
        ]);

        if ($accessToken->hasExpired()) {
            try {
                $accessToken = $apiClient->getOAuthClient()->getAccessTokenByRefreshToken($accessToken);
            } catch (Exception $e) {
                dd($e);
            }

            Token::update([
                'client_id' => config('services.amocrm.client_id'),
                'access_token' => $accessToken->getToken(),
                'refresh_token' => $accessToken->getRefreshToken(),
                'last_used_at' => now()->timestamp,
                'expires_at' => Carbon::parse($accessToken->getExpires()),
                'base_domain' => $apiClient->getAccountBaseDomain(),
            ]);
        }

        return $accessToken;
    }
}
