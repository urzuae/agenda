<?php
class MainController extends Controller
{
  var $request = null;
  var $route = array();

  public function __construct($request)
  {
    parent::__construct($request);
    $this->verifyUrl();
  }

  public function make_call()
  {
    $method = $this->route[$this->request->get_route()];
    
    $this->$method($this->request->params);
  }

  private function create_person($params)
  {
    $person = new Person($params->first_name, $params->last_name);

    $person->save();

    if(isset($params->emails) && $params->emails != null) {
      foreach($params->emails as $email_obj) {
        $email = new Email($email_obj->address, $email_obj->type, $person->id);
        $email->save();
      }
    }

    if(isset($params->phones) && $params->phones != null) {
      foreach($params->phones as $phone_obj) {
        $phone = new Phone($phone_obj->number, $phone_obj->type, $person->id);
        $phone->save();
      }
    }

    $this->success($person, 201);
  }

  private function get_person()
  {
    $person = Person::find($this->request->params->id);

    if(null == $person)
      $this->not_found();

    $this->success($person, 200);
  }

  private function update_person($params)
  {
    $person = Person::find($params->id);

    if(null == $person)
      $this->not_found();

    $person->first_name = $params->first_name;
    $person->last_name = $params->last_name;

    $person->save();

    if($params->emails != null) {
      foreach($params->emails as $email_obj) {
        $email = new Email($email_obj->address, $email_obj->type, $person->id, $email_obj->id ?? null);
        $email->save();
      }
    }

    if($params->phones != null) {
      foreach($params->phones as $phone_obj) {
        $phone = new Phone($phone_obj->number, $phone_obj->type, $person->id, $phone_obj->id ?? null);
        $phone->save();
      }
    }

    $this->success($person, 200);
  }

  private function delete_person()
  {
    $person = Person::find($this->request->params->id);

    if(null == $person)
      $this->not_found();

    $person->delete();

    $this->no_content();
  }

  private function create_phone($params)
  {
    $phone = new Phone($params->number, $params->type, $params->person_id);

    if(null == $phone)
      $this->not_found();

    $phone->save();

    $this->success($phone, 201);
  }

  private function get_phone()
  {
    $phone = Phone::find($this->request->params->id);

    if(null == $phone)
      $this->not_found();

    $this->success($phone, 200);
  }

  private function update_phone($params)
  {
    $phone = Phone::find($params->id);

    if(null == $phone)
      $this->not_found();

    $phone->number = $params->number;
    $phone->type = $params->type;

    $phone->save();

    $this->success($phone, 200);
  }

  private function delete_phone()
  {
    $phone = Phone::find($this->request->params->id);

    if(null == $phone)
      $this->not_found();

    $phone->delete();

    $this->no_content();
  }

  private function create_email($params)
  {
    $email = new Email($params->address, $params->type, $params->person_id);

    $email->save();

    $this->success($email, 201);
  }

  private function get_email()
  {
    $email = email::find($this->request->params->id);

    if(null == $email)
      $this->not_found();

    $this->success($email, 200);
  }

  private function update_email($params)
  {
    $email = Email::find($params->id);

    if(null == $email)
      $this->not_found();

    $email->address = $params->address;
    $email->type = $params->type;

    $email->save();

    $this->success($email, 200);
  }

  private function delete_email()
  {
    $email = Email::find($this->request->params->id);

    if(null == $email)
      $this->not_found();

    $email->delete();

    $this->no_content();
  }
}