<?php
class EmploymentCenter
{
    public $code;
    public $name;
    public $sex;
    public $year_of_birth;
    public $specialty;
    public $date_of_reg;

    public function  __construct($code, $array){
        $this->code = $code;
        $this->name = $array['name'];
        $this->sex = $array['sex'];
        $this->year_of_birth = $array['year-of-birth'];
        $this->specialty = $array['specialty'];
        $this->date_of_reg = $array['date-of-reg'];
    }

    public function validation($array) {
        if (empty($array["name"]) ||
            empty($array["sex"]) ||
            $array["year-of-birth"] < 0 ||
            empty($array["specialty"]) ||
            empty($array["date-of-reg"]))
            $validation = false;
        else
            $validation = true;
        return $validation;
    }

}


