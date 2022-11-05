<?php

//PDO - визначає інтерфейс для роботи з базами даних в PHP. Щоб користуватися функціоналом PDO необхідно використовувати
// відповідний для конкретної СУБД драйвер (мають бути встановленні відповідні розширення, наприклад, php_pdo_mysql,
// php_pdo_mssql, php_pdo_sqlite)
//PDO::query() виконує SQL запит та повертає результуючий набір у вигляді об'єкта PDOStatement
//PDO::exec() виконує SQL-запит та повертає кількість задіяних рядків.
//PDO::prepare готує запит до виконання та повертає пов'язаний з ним об'кт класу PDOStatement. Запит може містити
//іменовані (:name) та неіменовані (?) псевдозмінні, які будуть замінені на значення під час запуску запиту на виконання.
//PDOStatement::execute - запускає підготовлений запит на виконання.
//PDOStatement::fetch() - повертає наступний рядок із результуючого набору.
//PDOStatement::fetchAll() - повертає всі рядки із результуючого набору у вигляді масиву.
//PDOStatement::errorInfo() - отримання інформації про помилку.
//PDOStatement::closeCursor() - закриває курсор для того, щоб звільнити з'єднання якщо ви не вибрали усі значення із
// результуючого набору.
//PDO::lastInsertId() - повертає останній вставлений id.
//PDO::beginTransaction() - починає транзакцію.
//PDO::commit() - фіксує транзакцію.
//PDO::rollBack () - відкат транзакції.

$dsn = 'mysql:host=127.0.0.1;dbname=module;charset=utf8';
$user = 'kolya';
$password = '12345';
$dbh = new PDO($dsn, $user, $password);

$sql = "select * from products where id in (1,2);";
$statement = $dbh->query($sql);
var_dump($statement);


$list_of_subjects = array(
    ["id"=>1, "name"=>"Основи програмування мовою PHP", "teacher"=>"Андрашко Ю.В.", "number of points"=>rand(1, 100)],
    ["id"=>2, "name"=>"Архітектура програмного забезпечення", "teacher"=>"Андрашко Ю.В.", "number of points"=>rand(1, 100)],
    ["id"=>3, "name"=>"Сучасні фреймворки для розробки WEB додатків", "teacher"=>"Брила А.Ю.", "number of points"=>rand(1, 100)],
    ["id"=>4, "name"=>"Математичний аналіз", "teacher"=>"Погоріляк О.О.", "number of points"=>rand(1, 100)],
    ["id"=>5, "name"=>"Програмування", "teacher"=>"Антосяк П.П.", "number of points"=>rand(1, 100)],
);

function showTable($list_of_subjects){
    $table = "<table>";
    $table .= "<tr></tr>";
    foreach (array_keys($list_of_subjects[1]) as $key) {
        $table .=
            "<th style='border: 1px; border-style: solid'>$key</th>";
    }

    foreach ($list_of_subjects as $subject){

        $table .= "<tr></tr>";

        foreach ($subject as $value){
            $table .=
                "<td style='border: 1px; border-style: solid'>$value</td>";
        }
    }
    echo $table;
}

function  getSubjectsByPoints($list_of_subjects){
    $table = "<table>";
    $table .= "<tr></tr>";
    foreach (array_keys($list_of_subjects[1]) as $key) {
        $table .=
            "<th style='border: 1px; border-style: solid'>$key</th>";
    }
    foreach ($list_of_subjects as $subject){
        if (($subject["number of points"] >= $_POST["points"] )) {
            $table .= "<tr></tr>";
            foreach ($subject as $value) {
                $table .= '<td style="border:1px;border-style: solid;">' . $value . '</td>';
            }
        }
    }
    echo $table;
}

?>

<?php showTable($list_of_subjects) ?>

<?php if (isset($_POST["getByPoints"])):?>
    <?=  getSubjectsByPoints($list_of_subjects) ?>
<?php endif;?>

<form method="post">

    <label> Введіть бали<br>
        <input type='number' name='points'><br><br>

        <button name="getByPoints" type="submit">button</button>
</form>
