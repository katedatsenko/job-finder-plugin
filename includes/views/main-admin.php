<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 014 14.02.17
 * Time: 18:21
 */
echo '<div class="header">
    <h1>This is temporary view</h1>
        </div>';
echo '<div class="body">
        <form class="temporary">
           <input name="name" placeholder="Укажите ваше имя" class="textbox" required />
           <input name="emailaddress" placeholder="Укажите ваш Email" class="textbox" type="email" required />
           <textarea rows="4" cols="50" name="subject" placeholder="Введите ваше сообщение:" class="message" required></textarea>
           <input name="submit" class="button" type="submit" value="Отправить" />
        </form>';
