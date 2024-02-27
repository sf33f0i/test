<?php
namespace App\Kernel\Validator;
use App\Kernel\Session\Session;
use App\Kernel\Validator\ValidatorInterface;

class Validator implements ValidatorInterface
{
    private array $alias = [];
    private array $errors = [];
    private array $data;
    private Session $session;
    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->alias= $this->loadAlias();
    }
    public function validate($data, $rules):array|bool
    {
        $this->session->remove('errors');
        $this->data = $data;
        $this->errors = [];

        foreach ($rules as $key => $ruleArray)
        {
            $rules = $ruleArray;
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);

                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $error = $this->validationRule($key, $ruleName, $ruleValue);
                if ($error) {
                    $this->errors[] = $error;
                }
            }
        }
        if(empty($this->errors)){
            return $this->data;
        }
        $this->session->set('errors', $this->errors);
        return false;
    }

    public function errors():array
    {
        return $this->errors;
    }

    public function loadAlias()
    {
        return include_once APP_PATH.'/config/aliasForValidation.php';
    }

    public function validationRule(string $key,string $ruleName, $ruleValue = null)
    {
        $value = $this->data[$key];
        switch ($ruleName){
            case 'required': return $this->valueIsRequired($value, $key);
            case 'max': return $this->maxValue($value, $ruleValue, $key);
            case 'min': return $this->minValue($value, $ruleValue, $key);
            case 'email': return $this->emailValue($value);

        }
    }

    public function valueIsRequired($value, $key):string|bool
    {
        if (empty($value)){
            return 'Поле '.($this->alias[$key]??$key).' пустое';
        }
        return false;
    }

    public function maxValue($value, $ruleValue, $key):string|bool
    {
        if (!is_null($value)) {
            if (strlen($value) > $ruleValue) {
                return "Слишком много символов в поле ". $this->alias[$key]??$key;
            }
        }
        return false;
    }
    public function minValue($value, $ruleValue, $key):string|bool
    {
        if (is_null($value)){
            return "Слишком мало символов в поле ". $this->alias[$key]??$key;
        }
        if(strlen($value) < $ruleValue){
            return "Слишком мало символов в поле ". $this->alias[$key]??$key;
        }
        return false;
    }

    public function emailValue($value):string|bool
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "E-mail адрес указан не верно.";
        }
        return false;
    }
}