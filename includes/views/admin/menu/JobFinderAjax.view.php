<?php?>
<div class="job-finder-ajax">
    <form action="" method="post">
        <label for="city">Город</label>
        <input type="text" class="job-finder-ajax-city" name="city"> <br>
        <label for="keywords">Ключевые слова</label>
        <input type="text" class="job-finder-ajax-keywords" name="keywords"> <br>
        <label for="nosalary">Показывать вакансии без з.п.</label>
        <input type="checkbox" class="job-finder-ajax-nosalary" name="nosalary"> <br>
        <label for="salary">Зарплата</label>
        <input type="text" class="job-finder-ajax-salary" name="salary"> <br>
        <input type="submit" class="button-ajax" value="Найти">
    </form>
</div>
<div id="job-finder-vacancies">
    <ul class="job-fonder-ajax">

    </ul>
</div>