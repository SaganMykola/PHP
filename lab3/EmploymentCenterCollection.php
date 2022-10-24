<?php

class EmploymentCenterCollection{
    public $employments;

    public function __construct(){}

    public function employmentCenterCollection(){
        return $this->employments = [
            new EmploymentCenter(0, [

                "name"=>"Саган Микола Ілліч",
                "sex"=>"Чоловіча",
                "year-of-birth"=>2004,
                "specialty"=>"Системний аналіз",
                "date-of-reg"=>"23.09.2022",
            ]),

            new EmploymentCenter(1, [

                "name"=>"No name",
                "sex"=>"Чоловіча",
                "year-of-birth"=>1940,
                "specialty"=>"2",
                "date-of-reg"=>"2",
            ]),

            new EmploymentCenter(2, [

                "name"=>"No name",
                "sex"=>"Жіноча",
                "year-of-birth"=>2000,
                "specialty"=>"3",
                "date-of-reg"=>"3",
            ]),

            new EmploymentCenter(3, [

                "name"=>"No name",
                "sex"=>"Жіноча",
                "year-of-birth"=>1960,
                "specialty"=>"4",
                "date-of-reg"=>"4",
            ])
        ];
    }

    public  function getByCode($code){
        foreach ($this->employments as $employment){
            if ($employment->code == $code){
                return $employment;
            }
        }
    }

    public function showTable(){
        $table = "<table>";
        $table .= "<tr>
                <th>Code</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Year of birth</th>
                <th>Specialty</th>
                <th>Date of registration</th>
            </tr>";

        foreach ($this->employments as $employment){
            $table .= "<tr></tr>";
            foreach ($employment as $value){
                $table .= "<td style='border: 1px; border-style: solid'>$value</td>";
            }
        }

        echo $table;
    }

    public function unemployedPeopleOfRetirementAge()
    {
        $unemployed = array();
        date_default_timezone_set('UTC');
        $year = date("Y");
        foreach ($this->employments as $employment){
            if ($year - $employment->year_of_birth >= 60){ //&& $this->employments['sex'] == "Жіноча") || ($year - $this->employments['year-of-birth'] >= 65 && $this->employments['sex'] == "Чоловіча")) {
                array_push($unemployed, $employment);
            }
        }
        $table = "<table>";
        $table .= "<tr>
                <th>Code</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Year of birth</th>
                <th>Specialty</th>
                <th>Date of registration</th>
            </tr>";
        for ($i = 0; $i < count($unemployed); $i++){
            $table .= "<tr></tr>";

            foreach ($unemployed[$i] as $value) {
                $table .= "<td style='border: 1px; border-style: solid'>$value</td>";
            }
        }
        echo $table;
    }

    public function add($employment){
        $this->employments[] = $employment;
    }

    public function edit($array){
        foreach ($this->employments as $employment){
            if ($this->getByCode($array['code']) == $employment->code){
                $employment->name = $array['name'];
                $employment->sex = $array['sex'];
                $employment->year_of_birth = $array['year-of-birth'];
                $employment->specialty = $array['specialty'];
                $employment->date_of_reg = $array['date-of-reg'];
            }
        }
    }

    public function saveEmploymentCenter(){
        $file = fopen("array.txt", "w");
        fwrite($file, serialize($this->employments));
        fclose($file);
    }

    public function loadEmploymentCenter(){
        $this->employments = unserialize(file_get_contents("array.txt"));
    }
}
