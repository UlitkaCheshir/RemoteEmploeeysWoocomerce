<?php get_header();

$path = get_template_directory_uri();

?>

<!--THANK YOU FORM-->
<section class="thanks" id="thanksSec">
  <div class="thanks-wrapper">
    <div class="icon-wrapper">
      <img src="<?=$path?>/assets/img/icons/success.svg" alt="Success">
    </div>
    <h1 class="thanks__title">Заявка отправлена!</h1>
    <!--<p class="thanks__text">В ближайшее время наши менеджеры свяжутся с вами.</p>
    <p class="thanks__text">Пока ждете, <b>заполните форму</b>, чтобы мы быстрее обработали данные</p>-->


    <!--FORM-->

    <!--<form name="Register" class="thanks-form" id="form-bottom">
      <div class="form-wrapper">
        <h4 class="form__title">Персональная информация:</h4>
        <input class="form__input" type="text" name="fio"   id="fio"   maxlength="45" placeholder="ФИО" readonly>
        <input class="form__input" type="text" name="phone" id="phone" placeholder="Номер телефона" readonly>
        <input class="form__input" type="email" name="email" id="email" placeholder="E-mail" readonly>
        <input class="form__input" type="text" name="city"  id="city"  maxlength="20" placeholder="Из какого вы города">
        <input class="form__input" type="text" name="age"   id="age"   maxlength="15" placeholder="Ваш возраст" pattern="[0-9]{2}">
        <input class="form__input" type="text" name="soc"   id="soc" maxlength="45" placeholder="Ссылка на соц. сеть (если нет фото)">
        <label class="form__text" for="photo">Ваше фото</label>
        <input class="form__text" type="file" name="photo" id="photo" accept="image/*">
      </div>
      <div class="form-wrapper">
        <h4 class="form__title">Профессиональные навыки</h4>
        <label class="form__text">Откуда Вы о нас узнали?</label>
        <select class="form__select" id="from">
          <option>OLX</option>
          <option>Work.ua</option>
          <option>Реклама в Telegram</option>
          <option>Группа в соц. сетях</option>
          <option>Реклама в Instagram</option>
          <option>Постер в университете</option>
          <option>Другое</option>
        </select>
        <label class="form__text">На какую должность претендуете:</label>
        <select class="form__select" id="vacancy">
          <option>Официант</option>
          <option>Бармен</option>
          <option>Хостес</option>
          <option>Танцор</option>
          <option>Танцор сальсы</option>
          <option>Помошник по кухне</option>
          <option>Уборщица</option>
          <option>Фотограф</option>
          <option>Промоутер</option>
        </select>
        <label class="form__text">Уровень владения английским языком:</label>
        <select class="form__select" id="language-en">
          <option>Не знаю</option>
          <option>Начальный</option>
          <option>Средний</option>
          <option>Продвинутый</option>
        </select>
        <label class="form__text">Опыт работы и личные качества</label>
        <textarea id="text" rows="5" cols="40" placeholder="Расскажите о своем образовании и опыте "></textarea>
      </div>
      <div class="hidden-msg">Введите корректные данные</div>
    </form>-->
    <!--<button id="submit-btn2" class="thanks-form__btn">Отправить</button>-->


  </div>
</section>
<!--END THANK YOU FORM-->

<?php get_footer(); ?>
