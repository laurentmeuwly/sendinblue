<?php

namespace LMeuwly\Sendinblue;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Config;
//use Illuminate\Http\Response;
//use LMeuwly\Sendinblue\Http\HttpClient;
//use LMeuwly\Sendinblue\Http\HttpResponse;
use SendinBlue\Client\Api\AccountApi as SbAccountApi;
use SendinBlue\Client\Api\ContactsApi as SbContactsApi;
use SendinBlue\Client\Configuration as SbConfig;

class SendinblueApi
{
    //protected $apikey;
    //protected $baseurl;
    //protected $responseCode;

    private $accountApiInstance;
    private $contactsApiInstance;
    
    public function __construct(string $apikey)
    {
        //$this->apikey = $apikey;
        //$this->baseurl = config::get('sendinblue.base_url');

        $apiConfig = SbConfig::getDefaultConfiguration()
            ->setApiKey('api-key', $apikey)
            ->setHost(Config::get('sendinblue.base_url'));

        $this->accountApiInstance = new SbAccountApi(new GuzzleClient(['verify' => false]), $apiConfig);
        $this->contactsApiInstance = new SbContactsApi(new GuzzleClient(['verify' => false]), $apiConfig);     
    }

    public function getLists()
    {
        try {
            return $this->contactsApiInstance->getLists();
        } catch (Exception $e){
            throw new Exception($e->getMessage(), 0, $e);
        }
    }

    public function getList(string $listId)
    {
        try {
            return $this->contactsApiInstance->getList($listId);
        } catch (Exception $e){
            throw new Exception($e->getMessage(), 0, $e);
        }
        //return $this->call('get', '/contacts/lists/' . $listId);
    }

    public function getListContacts(string $listId)
    {
        try {
            return $this->contactsApiInstance->getContactsFromList($listId);
        } catch (Exception $e){
            throw new Exception($e->getMessage(), 0, $e);
        }
        //return $this->call('get', '/contacts/lists/' . $listId . '/contacts');
    }

    public function subscribe($email, $firstname, $lastname, $options, $listId)
    {        
        // Manage specific attributes
        $sendinblueAttibute = config('sendinblue.attributes');
        if( false == $title = array_search($options['title'], $sendinblueAttibute['CIVILITE'])) {
            $title = 1; // 1=Monsieur, default
        }
        if( false == $language = array_search($options['language'], $sendinblueAttibute['LANGUE'])) {
            $language = 1; // 1=FR, default
        }

        $createContact = new \SendinBlue\Client\Model\CreateContact();
        $createContact->setEmail($email);
        $createContact->setAttributes(['PRENOM' => $firstname, 'NOM' => $lastname, 'CIVILITE' => $title, 'LANGUE' => $language]);
        $createContact->setListIds([$listId]);
        $createContact->setUpdateEnabled(true);
        
        try {
            $contact = $this->contactsApiInstance->createContact($createContact);       
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 0, $e);
        }

        //$updateContact['attributes'] = array('EMAIL'=>'example2@example2.com', 'FIRSTNAME'=>'John Doe');

        /*try {
            $this->contactsApiInstance->addContactToList($listId, $contact);  
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 0, $e);
        }*/

        /*$data = [
            'email' => $email,
        ];*/
        //return $this->call('post', '/contacts/lists/' . $listId . '/contacts/add', $data);
    }

    public function update($email, $firstname, $lastname, $options, $listId)
    {
        $updateContact  = new \SendinBlue\Client\Model\UpdateContact();
        //$updateContact ->setEmail($email);
        $updateContact ->setAttributes(['PRENOM' => $firstname, 'NOM' => $lastname, 'CIVILITE' => 1, 'LANGUE' => 2]);
        //$updateContact ->setListIds([$listId]);
        //$updateContact ->setUpdateEnabled(true);
        //dd($createContact);
        try {
            //$contact = $this->contactsApiInstance->createContact($createContact);            
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 0, $e);
        }

        //$updateContact['attributes'] = array('EMAIL'=>'example2@example2.com', 'FIRSTNAME'=>'John Doe');

        /*try {
            $this->contactsApiInstance->addContactToList($listId, $contact);  
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 0, $e);
        }*/

        /*$data = [
            'email' => $email,
        ];*/
        //return $this->call('post', '/contacts/lists/' . $listId . '/contacts/add', $data);
    }

    public function getContactInfo($email)
    {
        return $this->contactsApiInstance->getContactInfo($email);
    }

    public function getContactUnsubscribe($email)
    {
        $test = new \SendinBlue\Client\Model\GetExtendedContactDetailsStatisticsUnsubscriptions();
        dd($test);
        $result = $this->contactsApiInstance->getContactInfo($email);
        return $result;//->GetExtendedContactDetailsStatisticsUnsubscriptions();
    }

    public function getAttributes()
    {
        try {
            return $this->contactsApiInstance->getAttributes();
        } catch (Exception $e){
            throw new Exception($e->getMessage(), 0, $e);
        }        
    }


    public function call(string $method, string $endpoint, array $data=[]): array
    {
        $url = $this->baseurl . $endpoint;

        //$params = http_build_query($params);
        //$request = $this->api_endpoint_current . $params;
        //$response = $this->doRequest($url);
        $headers = [
            'Content-Type' => 'application/json',
            'api-key' => $this->apikey,            
        ];

        $response = (new HttpClient())->withHeaders($headers)->$method($url, $data);
        //dd($response->header('Content-Type'));
        
        //$this->responseCode = $response->status();
        //dd($response->json());
        
        return $response->json();
    }

    

}