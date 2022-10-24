<?php

include "EmploymentCenter.php";
include "EmploymentCenterCollection.php";

session_start();

if (empty($_SESSION)) {
    $_SESSION['EmploymentCenter'] = new EmploymentCenterCollection();
    $_SESSION['EmploymentCenter']->employmentCenterCollection() ;
}

$_SESSION['EmploymentCenter']->showTable();

if (isset($_POST['request'])){
    $_SESSION['EmploymentCenter']->unemployedPeopleOfRetirementAge();
}

if (isset($_POST['save1'])){
        $code = count($_SESSION['EmploymentCenter']->employmentCenterCollection());
        $_SESSION['EmploymentCenter']->add($_POST);

}

if (isset($_POST['save2'])){
        $_SESSION['EmploymentCenter']->edit($_POST);
}

if (isset($_POST['save_to_file'])){
    $_SESSION['EmploymentCenter']->saveEmploymentCenter();
}

if (isset($_POST['load_from_file'])){
    $_SESSION['EmploymentCenter']->loadEmploymentCenter();
}
?>

 <form method="post">

        <button name="request" type="submit">Безробітні пенсійного віку</button><br><br>

        <button name="add" type="submit">Додати об'єкт</button>

        <button name="edit" type="submit">Змінити об'єкт</button>

        <button name="save_to_file" type="submit">Зберегти до файлу</button>

        <button name="load_from_file" type="submit">Завантажити з файлу</button>

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