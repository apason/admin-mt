<?php
namespace App\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Network\Request;
use Cake\Network\Response;

class MtAdminAuthenticate extends BaseAuthenticate
{
    public function authenticate(Request $request, Response $response)
    {
      if ($request->data['username'] != "" && $request->data['password'] != "") {
        if ($request->data['username'] == "" && $request->data['password'] = "") {
          $user = array("username" => "admin");
          return $user;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }
}
