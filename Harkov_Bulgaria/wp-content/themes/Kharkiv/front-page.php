<?php get_header();

$path = get_template_directory_uri();

?>



<header class="header" id="header">
  <div class="fluid">
    <div class="header-wrapper">
      <a href="https://of-w.com/" class="header-logo">
        <img src="<?=$path?>/assets/img/logo.png" alt="Offline Workers" class="header-logo__img">
      </a>
      <nav class="header-menu" id="headerMenu">
        <a href="https://of-w.com/">
          <img src="<?=$path?>/assets/img/logo.png" alt="Offline Workers" class="header-menu__logo">
        </a>
        <a href="#vacancySec"   class="header-menu__link">Вакансии</a>
        <a href="#companiesSec" class="header-menu__link">Работодатели</a>
        <a href="#aboutSec"     class="header-menu__link">О нас</a>
        <a href="#form"         class="header-menu__link">Подать заявку</a>
        <a href="/bulgaria"     class="header-menu__link">Работа в Болгарии</a>
        <div class="contacts-wrapper">
          <span class="contacts__item">+38(095)587-09-51</span>
          <span class="contacts__item">+38(066)421-62-67</span>
          <span class="contacts__item">hr@of-w.com</span>
        </div>
        <div class="contacts-wrapper">
          <a class="contacts__item" href="tg://resolve?domain=offline_workers">
            <i class="fab fa-telegram-plane"></i>
          </a>
          <a class="contacts__item" href="viber://chat?number=+380664216267">
            <i class="fab fa-viber"></i>
          </a>
          <a class="contacts__item" href="https://wa.me/380664216267">
            <i class="fab fa-whatsapp"></i>
          </a>
          <a class="contacts__item" href="https://www.facebook.com/offline.workers/">
            <i class="fab fa-facebook-square"></i>
          </a>
          <a class="contacts__item" href="https://www.instagram.com/offline.workers/?utm_source=ig_profile_share&igshid=10ue1p664oa82">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </nav>
    </div>
    <div class="burger-wrapper">
      <span class="burger-lines"></span>
    </div>
    <h1 class="header-title">
      Работа в Харькове
    </h1>
  </div>
</header>
<!--END HEADER-->

<!--VACANCY SECTION-->
<section class="vacancy section" id="vacancySec">
  <div class="container">
    <h3 class="section-title">
      Выбери вакансию
    </h3>
    <div class="vacancy-wrapper">
      <div class="vacancy-card">
        <img src="<?=$path?>/assets/img/vacancy/waiter.png" alt="Waiter" class="vacancy-card__img">
        <h4 class="vacancy-card__title">
          Официант
        </h4>
      </div>
      <div class="vacancy-card">
        <img src="<?=$path?>/assets/img/vacancy/cook.png" alt="Cook" class="vacancy-card__img">
        <h4 class="vacancy-card__title">
          Помощник по кухне
        </h4>
      </div>
      <div class="vacancy-card">
        <img src="<?=$path?>/assets/img/vacancy/pj.png" alt="PJ" class="vacancy-card__img">
        <h4 class="vacancy-card__title">
          Танцовщицы
        </h4>
      </div>
      <div class="vacancy-card">
        <img src="<?=$path?>/assets/img/vacancy/photograph.png" alt="Photograph" class="vacancy-card__img">
        <h4 class="vacancy-card__title">
          Фотограф
        </h4>
      </div>
      <div class="vacancy-card">
        <img src="<?=$path?>/assets/img/vacancy/hostes.png" alt="Hostes" class="vacancy-card__img">
        <h4 class="vacancy-card__title">
          Хостес
        </h4>
      </div>
      <div class="vacancy-card">
        <img src="<?=$path?>/assets/img/vacancy/cleaner.png" alt="Cleaner" class="vacancy-card__img">
        <h4 class="vacancy-card__title">
          Уборщица
        </h4>
      </div>
      <div class="vacancy-card">
        <img src="<?=$path?>/assets/img/vacancy/barman.png" alt="Barman" class="vacancy-card__img">
        <h4 class="vacancy-card__title">
          Бармен
        </h4>
      </div>
      <div class="vacancy-card">
        <img src="<?=$path?>/assets/img/vacancy/salsa-dancer.png" alt="Salsa" class="vacancy-card__img">
        <h4 class="vacancy-card__title">
          Танцовщицы сальсы
        </h4>
      </div>
      <div class="vacancy-card">
        <img src="<?=$path?>/assets/img/vacancy/promouter.png" alt="Promouter" class="vacancy-card__img">
        <h4 class="vacancy-card__title">
          Промоутер
        </h4>
      </div>
    </div>
  </div>
</section>
<!--END SECTION-->

<!--COMPANIES SECTION-->
<section class="companies section" id="companiesSec">
  <div class="container">
    <h3 class="section-title">
      Работодатели
    </h3>
    <div class="companies-wrapper">
      <div class="companies-card">
        <img src="<?=$path?>/assets/img/restaraunts/loza-strekoza.png" alt="Loza" class="companies-card__img">
        <h4 class="companies-card__title">
          Loza-Strekoza
        </h4>
      </div>
      <div class="companies-card">
        <img src="<?=$path?>/assets/img/restaraunts/taco-loco.png" alt="Loco" class="companies-card__img">
        <h4 class="companies-card__title">
          Taco-Loco
        </h4>
      </div>
      <div class="companies-card">
        <img src="<?=$path?>/assets/img/restaraunts/pan-azian.png" alt="Pan-azian" class="companies-card__img">
        <h4 class="companies-card__title">
          Пан азиатский
        </h4>
      </div>
      <div class="companies-card">
        <img src="<?=$path?>/assets/img/restaraunts/la-gril.png" alt="La-grill" class="companies-card__img">
        <h4 class="companies-card__title">
          La grill
        </h4>
      </div>
    </div>
  </div>
</section>
<!--END SECTION-->

<!--SLIDER-->
<section class="slider section" id="sliderSec">
  <div class="container">
    <h3 class="section-title">
        Смотрите также вакансии для работы в офисе
    </h3>
    <div class="slider-wrapper">
      <a href="http://remotemployees.com/lead-generation/">
        <div class="slider-item">
          <div class="slider-item__img lead"></div>
          <h4 class="slider-item__title">
            Лидогенератор
          </h4>
        </div>
      </a>
      <a href="http://remotemployees.com/translation/">
        <div class="slider-item">
          <div class="slider-item__img trans"></div>
          <h4 class="slider-item__title">
            Переводчик
          </h4>
        </div>
      </a>
      <a href="http://remotemployees.com/media-buying/">
        <div class="slider-item">
          <div class="slider-item__img media"></div>
          <h4 class="slider-item__title">
            Медиабаер
          </h4>
        </div>
      </a>
    </div>
  </div>
</section>
<!--END SLIDER-->

<!--ABOUT US SECTION-->
<section class="about section" id="aboutSec">
  <div class="container">
    <h3 class="section-title">
      О нас
    </h3>
    <div class="about-wrapper">
      <div class="about-content">
        <div class="about-content-item">
          <div class="about-content-item__img">
            <img src="<?=$path?>/assets/img/icons/home.svg" alt="first-i">
          </div>
          <p class="about-content-item__text">
            IT компания Offline Workers подберет для вас вакансию на любой вкус.
          </p>
        </div>
        <div class="about-content-item">
          <div class="about-content-item__img">
            <img src="<?=$path?>/assets/img/icons/colective.svg" alt="second-i">
          </div>
          <p class="about-content-item__text">
            Открыты вакансии как для рабочих специальностей, так и для работы в офисе.
            Наш дружный коллектив всегда рад новым пополнениям.
          </p>
        </div>
        <div class="about-content-item">
          <div class="about-content-item__img">
            <img src="<?=$path?>/assets/img/icons/money.svg" alt="third-i">
          </div>
          <p class="about-content-item__text">
            Со своей стороны гарантируем своевременные выплаты з/п и личностный рост.
          </p>
        </div>
      </div>
      <form class="form" id="form">
        <p class="form__title">Подать заявку</p>
        <input class="form__input" type="text" id="fio" placeholder="ФИО" required>
        <input class="form__input" type="text" id="phone" placeholder="Номер телефона" required>
        <input class="form__input" type="text" name="age"   id="age"   maxlength="15" placeholder="Ваш возраст" pattern="[0-9]{2}" required>
        <!--<input class="form__input" type="email" id="email" placeholder="Ваш Email" required>-->
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
          <div class="form__btn"  id="submit-btn">Отправить</div>
        <div class="hidden-msg">Введите корректные данные</div>
      </form>
    </div>
  </div>
</section>
<!--END SECTION-->

<?php get_footer(); ?>
