<?php
$employment_center = array(
    ["code"=>1, "name"=>"Саган Микола Ілліч", "sex"=>"Чоловіча", "year of birth"=>2004, "specialty"=>"Системний аналіз", "date of reg"=>"23.09.2022"],
    ["code"=>2, "name"=>"No name", "sex"=>"Чоловіча", "year of birth"=>1940, "specialty"=>"2", "year of reg"=>"2"],
    ["code"=>3, "name"=>"No name", "sex"=>"Жіноча", "year of birth"=>2000, "specialty"=>"3", "year of reg"=>"4"],
    ["code"=>4, "name"=>"No name", "sex"=>"Жіноча", "year of birth"=>1960, "specialty"=>"3", "year of reg"=>"4"],
);

function showTable($employment_center){
    $table = "<table>";
    $table .= "<tr></tr>";
    foreach (array_keys($employment_center[1]) as $key) {
        $table .=
            "<th style='border: 1px; border-style: solid'>$key</th>";
    }

    if (isset($_POST["save1"])) {
        $new = add();
        array_push($employment_center, $new);
    }

    if (isset($_POST["save_to_file"])) {
        $file = fopen("array.txt", "w");
        fwrite($file, serialize($employment_center));
        fclose($file);
    }

    if (isset($_POST["load_from_file"])){
        $employment_center = unserialize(file_get_contents("array.txt"));
    }



    foreach ($employment_center as $employment){

        $table .= "<tr></tr>";
        if (isset($_POST["save2"])){
            $edit = edit($employment["code"]);

            if ($employment["code"] == $edit["code"]) {
                if (validation() == true) {
                    $employment = array_replace($employment, $edit);

                }
            }
        }
        foreach ($employment as $value){
            $table .=
                "<td style='border: 1px; border-style: solid'>$value</td>";
        }
    }
    echo $table;
}

function  getByRequest($employment, $value){
    date_default_timezone_set('UTC');
    $year = date("Y");
    if (($year - $employment["year of birth"] >= 60 && $employment["sex"] == "Жіноча") || ($year - $employment["year of birth"] >= 65 && $employment["sex"] == "Чоловіча"))
        return '<td style="border:1px;border-style: solid;">' .$value. '</td>';
}



function add(){
    return  [
        "code"=>$_POST["code"],
        "name"=>$_POST["name"],
        "sex"=>$_POST["sex"],
        "year of birth"=>$_POST["year-of-birth"],
        "specialty"=>$_POST["specialty"],
        "date of reg"=>$_POST["date-of-reg"]
    ];
}

function edit($code){
    if ($code == $_POST["code"]){
        return [
            "code"=>$_POST["code"],
            "name"=>$_POST["name"],
            "sex"=>$_POST["sex"],
            "year of birth"=>$_POST["year-of-birth"],
            "specialty"=>$_POST["specialty"],
            "date of reg"=>$_POST["date-of-reg"]
        ];

    }
}

function validation() {
    if (empty($_POST["name"]) ||
        empty($_POST["sex"]) ||
        $_POST["year-of-birth"] < 0 ||
        empty($_POST["specialty"]) ||
        empty($_POST["date-of-reg"]))
            $validation = false;
    else
        $validation = true;
    return $validation;
}

?>

<?php showTable($employment_center) ?>

    <form method="post">

        <button name="request" type="submit">Безробітні пенсійного віку</button><br><br>

        <button name="add" type="submit">Додати об'єкт</button>

        <button name="edit" type="submit">Змінити об'єкт</button>

        <button name="save_to_file" type="submit">Зберегти до файлу</button>

        <button name="load_from_file" type="submit">Завантажити з файлу</button>

        <table>
            <?php if (isset($_POST["request"])):?>
                <tr>
                    <?php foreach (array_keys($employment_center[1]) as $key):?>
                        <th style="border: 1px; border-style: solid "> <?= $key ?></th>
                    <?php endforeach;?>
                </tr>
                <?php foreach ($employment_center as $employment):?>
                    <tr>
                    <?php foreach ($employment as $value): ?>
                        <?=  getByRequest($employment, $value) ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                </tr>
            <?php endif;?>
        </table>

        <?php if (isset($_POST["add"])):?>
            <label> code
                <input type='number' name='code'>
            </label><br>
            <label> name
                <input type='text' name='name'>
            </label><br>
            <label> sex
                <input type='text' name='sex'>
            </label><br>
            <label> year of birth
                <input type='number' name='year-of-birth'>
            </label><br>
            <label> specialty
                <input type='text' name='specialty'>
            </label><br>
            <label> date of reg
                <input type="text" name='date-of-reg'
            </label>

            <button name="save1" type="submit">Зберегти</button>

        <?php endif;?>

        <?php if (isset($_POST["edit"])):?>
            <label> code
                <input type='number' name='code'>
            </label><br>
            <label> name
                <input type='text' name='name'>
            </label><br>
            <label> sex
                <input type='text' name='sex'>
            </label><br>
            <label> year of birth
                <input type='number' name='year-of-birth'>
            </label><br>
            <label> specialty
                <input type='text' name='specialty'>
            </label><br>
            <label> date of reg
                <input type="text" name='date-of-reg'
            </label>

            <button name="save2" type="submit">Зберегти</button>

        <?php endif;?>

    </form>